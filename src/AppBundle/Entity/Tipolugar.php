<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tipolugar
 *
 * @ORM\Table(name="tipolugar", uniqueConstraints={@ORM\UniqueConstraint(name="tipolugar_pk", columns={"id_tipo_lugar"})})
 * @ORM\Entity
 */
class Tipolugar
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
     * @ORM\Column(name="id_tipo_lugar", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="tipolugar_id_tipo_lugar_seq", allocationSize=1, initialValue=1)
     */
    private $idTipoLugar;


}

