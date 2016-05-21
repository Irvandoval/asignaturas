<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Diahora
 *
 * @ORM\Table(name="diahora", uniqueConstraints={@ORM\UniqueConstraint(name="diahora_pk", columns={"id_diahora"})}, indexes={@ORM\Index(name="se_crean_fk", columns={"id_ciclo"})})
 * @ORM\Entity
 */
class Diahora
{
    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=20, nullable=true)
     */
    private $nombre;

    /**
     * @var integer
     *
     * @ORM\Column(name="dia", type="integer", nullable=true)
     */
    private $dia;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="hora", type="time", nullable=true)
     */
    private $hora;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_diahora", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="diahora_id_diahora_seq", allocationSize=1, initialValue=1)
     */
    private $idDiahora;

    /**
     * @var \AppBundle\Entity\Ciclo
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Ciclo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_ciclo", referencedColumnName="id_ciclo")
     * })
     */
    private $idCiclo;


}

