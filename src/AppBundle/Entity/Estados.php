<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Estados
 *
 * @ORM\Table(name="estados", uniqueConstraints={@ORM\UniqueConstraint(name="estados_pk", columns={"id_estado"})})
 * @ORM\Entity
 */
class Estados
{
    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=30, nullable=true)
     */
    private $nombre;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_estado", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="estados_id_estado_seq", allocationSize=1, initialValue=1)
     */
    private $idEstado;


}

