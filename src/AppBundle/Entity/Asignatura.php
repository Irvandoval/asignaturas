<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Asignatura
 *
 * @ORM\Table(name="asignatura", uniqueConstraints={@ORM\UniqueConstraint(name="asignatura_pk", columns={"id_asignatura"})})
 * @ORM\Entity
 */
class Asignatura
{
    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=50, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo", type="string", length=20, nullable=false)
     */
    private $codigo;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_asignatura", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="asignatura_id_asignatura_seq", allocationSize=1, initialValue=1)
     */
    private $idAsignatura;


}

