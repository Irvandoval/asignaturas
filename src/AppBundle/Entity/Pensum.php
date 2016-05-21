<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pensum
 *
 * @ORM\Table(name="pensum", uniqueConstraints={@ORM\UniqueConstraint(name="pensum_pk", columns={"id_pensum"})}, indexes={@ORM\Index(name="pensum_tiene_fk", columns={"id_asignatura"}), @ORM\Index(name="pensum_pertencece_fk", columns={"id_carrera"})})
 * @ORM\Entity
 */
class Pensum
{
    /**
     * @var integer
     *
     * @ORM\Column(name="nivel", type="integer", nullable=true)
     */
    private $nivel;

    /**
     * @var boolean
     *
     * @ORM\Column(name="activa", type="boolean", nullable=true)
     */
    private $activa;

    /**
     * @var string
     *
     * @ORM\Column(name="plan", type="string", length=25, nullable=true)
     */
    private $plan;

    /**
     * @var boolean
     *
     * @ORM\Column(name="vigente", type="boolean", nullable=true)
     */
    private $vigente;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_pensum", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="pensum_id_pensum_seq", allocationSize=1, initialValue=1)
     */
    private $idPensum;

    /**
     * @var \AppBundle\Entity\Asignatura
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Asignatura")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_asignatura", referencedColumnName="id_asignatura")
     * })
     */
    private $idAsignatura;

    /**
     * @var \AppBundle\Entity\Carrera
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Carrera")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_carrera", referencedColumnName="id_carrera")
     * })
     */
    private $idCarrera;


}

