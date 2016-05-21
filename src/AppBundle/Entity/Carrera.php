<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Carrera
 *
 * @ORM\Table(name="carrera", uniqueConstraints={@ORM\UniqueConstraint(name="carrera_pk", columns={"id_carrera"})}, indexes={@ORM\Index(name="facultad_tiene_fk", columns={"id_facultad"})})
 * @ORM\Entity
 */
class Carrera
{
    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=75, nullable=false)
     */
    private $nombre;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_carrera", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="carrera_id_carrera_seq", allocationSize=1, initialValue=1)
     */
    private $idCarrera;

    /**
     * @var \AppBundle\Entity\Facultad
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Facultad")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_facultad", referencedColumnName="id_facultad")
     * })
     */
    private $idFacultad;


}

