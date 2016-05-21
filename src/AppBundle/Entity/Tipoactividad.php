<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tipoactividad
 *
 * @ORM\Table(name="tipoactividad", uniqueConstraints={@ORM\UniqueConstraint(name="tipoactividad_pk", columns={"id_tipo_actividad"})})
 * @ORM\Entity
 */
class Tipoactividad
{
    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=100, nullable=false)
     */
    private $nombre;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_tipo_actividad", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="tipoactividad_id_tipo_actividad_seq", allocationSize=1, initialValue=1)
     */
    private $idTipoActividad;


}

