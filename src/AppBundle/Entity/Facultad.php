<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Type;
use JsonSerializable;

/**
 * Facultad
 *
 * @ORM\Table(name="facultad", uniqueConstraints={@ORM\UniqueConstraint(name="facultad_pk", columns={"id_facultad"})})
 * @ORM\Entity
 */
class Facultad implements JsonSerializable
{
    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=100, nullable=false)
     * @Type("string")
     */
    private $nombre;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_facultad", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="facultad_id_facultad_seq", allocationSize=1, initialValue=1)
     * @Type("integer")
     */
    private $idFacultad;



    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Facultad
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Get idFacultad
     *
     * @return integer
     */
    public function getIdFacultad()
    {
        return $this->idFacultad;
    }

    public function jsonSerialize(){
      return array(
       'idFacultad' => $this->idFacultad,
       'nombre'=> $this->nombre
      );
    }
}
