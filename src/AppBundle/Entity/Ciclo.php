<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ciclo
 *
 * @ORM\Table(name="ciclo", uniqueConstraints={@ORM\UniqueConstraint(name="ciclo_pk", columns={"id_ciclo"})})
 * @ORM\Entity
 */
class Ciclo
{
    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=15, nullable=false)
     */
    private $nombre;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_inicio", type="date", nullable=false)
     */
    private $fechaInicio;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_fin", type="date", nullable=false)
     */
    private $fechaFin;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_ciclo", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ciclo_id_ciclo_seq", allocationSize=1, initialValue=1)
     */
    private $idCiclo;


}

