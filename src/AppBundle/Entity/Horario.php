<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Horario
 *
 * @ORM\Table(name="horario", uniqueConstraints={@ORM\UniqueConstraint(name="horario_pk", columns={"id_horario"})}, indexes={@ORM\Index(name="tiene_fk", columns={"id_estado"}), @ORM\Index(name="horario_es_parte_de_fk", columns={"id_ciclo"}), @ORM\Index(name="carrera_tiene_horario_fk", columns={"id_carrera"}), @ORM\Index(name="horario_creado_por_fk", columns={"id_usuario"})})
 * @ORM\Entity
 */
class Horario
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_creacion", type="date", nullable=true)
     */
    private $fechaCreacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_horario", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="horario_id_horario_seq", allocationSize=1, initialValue=1)
     */
    private $idHorario;

    /**
     * @var \AppBundle\Entity\Estados
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Estados")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_estado", referencedColumnName="id_estado")
     * })
     */
    private $idEstado;

    /**
     * @var \AppBundle\Entity\Ciclo
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Ciclo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_ciclo", referencedColumnName="id_ciclo")
     * })
     */
    private $idCiclo;

    /**
     * @var \AppBundle\Entity\Usuario
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Usuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_usuario", referencedColumnName="id_usuario")
     * })
     */
    private $idUsuario;

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

