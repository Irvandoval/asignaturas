<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Actividad
 *
 * @ORM\Table(name="actividad", uniqueConstraints={@ORM\UniqueConstraint(name="actividad_pk", columns={"id_actividad"})}, indexes={@ORM\Index(name="actividad_se_agrupa_por_fk", columns={"id_tipo_actividad"}), @ORM\Index(name="horario_act_fk", columns={"id_h_asig"}), @ORM\Index(name="actividad_tiene_diashora_fk", columns={"id_diahora"}), @ORM\Index(name="actividad_se_desarrolla_en_fk", columns={"id_lugar"})})
 * @ORM\Entity
 */
class Actividad
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_actividad", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="actividad_id_actividad_seq", allocationSize=1, initialValue=1)
     */
    private $idActividad;

    /**
     * @var \AppBundle\Entity\Horarioasignatura
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Horarioasignatura")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_h_asig", referencedColumnName="id_h_asig")
     * })
     */
    private $idHAsig;

    /**
     * @var \AppBundle\Entity\Diahora
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Diahora")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_diahora", referencedColumnName="id_diahora")
     * })
     */
    private $idDiahora;

    /**
     * @var \AppBundle\Entity\Lugar
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Lugar")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_lugar", referencedColumnName="id_lugar")
     * })
     */
    private $idLugar;

    /**
     * @var \AppBundle\Entity\Tipoactividad
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Tipoactividad")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_tipo_actividad", referencedColumnName="id_tipo_actividad")
     * })
     */
    private $idTipoActividad;


}

