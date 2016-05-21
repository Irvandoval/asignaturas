<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Lugar
 *
 * @ORM\Table(name="lugar", uniqueConstraints={@ORM\UniqueConstraint(name="lugar_pk", columns={"id_lugar"})}, indexes={@ORM\Index(name="lugar_esta_ubicado_en_fk", columns={"id_tipo_lugar"}), @ORM\Index(name="lugar_es_parte_de_fk", columns={"id_facultad"})})
 * @ORM\Entity
 */
class Lugar
{
    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=100, nullable=true)
     */
    private $nombre;

    /**
     * @var integer
     *
     * @ORM\Column(name="cupo", type="integer", nullable=true)
     */
    private $cupo;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_lugar", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="lugar_id_lugar_seq", allocationSize=1, initialValue=1)
     */
    private $idLugar;

    /**
     * @var \AppBundle\Entity\Facultad
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Facultad")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_facultad", referencedColumnName="id_facultad")
     * })
     */
    private $idFacultad;

    /**
     * @var \AppBundle\Entity\Tipolugar
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Tipolugar")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_tipo_lugar", referencedColumnName="id_tipo_lugar")
     * })
     */
    private $idTipoLugar;


}

