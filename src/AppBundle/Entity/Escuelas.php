<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Type;
use JsonSerializable;
/**
 * Escuelas
 *
 * @ORM\Table(name="escuelas", uniqueConstraints={@ORM\UniqueConstraint(name="escuelas_pk", columns={"id_escuela"})}, indexes={@ORM\Index(name="facultad_tiene_escuelas_fk", columns={"id_facultad"})})
 * @ORM\Entity
 */
class Escuelas implements JsonSerializable
{
     /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=150, nullable=true)
     * @Type("string")
     */
     private $nombre;

     /**
     * @var \AppBundle\Entity\Facultad
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Facultad")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_facultad", referencedColumnName="id_facultad")
     * })
     * @Type("integer")
     */
    private $idFacultad;


    /**
     * @var integer
     *
     * @ORM\Column(name="id_escuela", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="escuelas_id_escuela_seq", allocationSize=1, initialValue=1)
     * @Type("integer")
     */
    private $idEscuela;


    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Escuelas
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
     * Set idFacultad
     *
     * @param \AppBundle\Entity\Facultad $idFacultad
     *
     * @return Escuelas
     */
    public function setIdFacultad(\AppBundle\Entity\Facultad $idFacultad = null)
    {
        $this->idFacultad = $idFacultad;

        return $this;
    }

    /**
     * Get idEscuela
     *
     * @return integer
     */
    public function getIdEscuela()
    {
        return $this->idEscuela;
    }



    /**
     * Get idFacultad
     *
     * @return \AppBundle\Entity\Facultad
     */
    public function getIdFacultad()
    {
        return $this->idFacultad;
    }

    public function jsonSerialize()
    {
     return array(
      'idEscuela'=> $this->idEscuela,
      'nombre' => $this->nombre,
      'facultad' => $this->idFacultad
     );
    }
}
