<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Horarioasignatura
 *
 * @ORM\Table(name="horarioasignatura", uniqueConstraints={@ORM\UniqueConstraint(name="horarioasignatura_pk", columns={"id_h_asig"})}, indexes={@ORM\Index(name="horario_esta_compuesto_por_fk", columns={"id_horario"}), @ORM\Index(name="asignatura_tiene_horario_fk", columns={"id_asignatura"})})
 * @ORM\Entity
 */
class Horarioasignatura
{
    /**
     * @var string
     *
     * @ORM\Column(name="correlativo", type="decimal", precision=10, scale=0, nullable=false)
     */
    private $correlativo;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_h_asig", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="horarioasignatura_id_h_asig_seq", allocationSize=1, initialValue=1)
     */
    private $idHAsig;

    /**
     * @var \AppBundle\Entity\Horario
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Horario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_horario", referencedColumnName="id_horario")
     * })
     */
    private $idHorario;

    /**
     * @var \AppBundle\Entity\Asignatura
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Asignatura")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_asignatura", referencedColumnName="id_asignatura")
     * })
     */
    private $idAsignatura;


}

