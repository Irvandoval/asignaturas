<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Type;
use JsonSerializable;

/**
 * Usuario
 *
 * @ORM\Table(name="usuario", uniqueConstraints={@ORM\UniqueConstraint(name="usuario_pk", columns={"id_usuario"})}, indexes={@ORM\Index(name="pertenece_fk", columns={"id_escuela"}), @ORM\Index(name="IDX_2265B05DC5A188EC", columns={"id_fos_user"})})
 * @ORM\Entity
 */
class Usuario implements JsonSerializable
{
    /**
     * @var string
     * @Type("string")
     * @ORM\Column(name="nombres", type="string", length=50, nullable=true)
     */
    private $nombres;

    /**
     * @var string
     * @Type("string")
     * @ORM\Column(name="apellidos", type="string", length=50, nullable=true)
     */
    private $apellidos;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_usuario", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="usuario_id_usuario_seq", allocationSize=1, initialValue=1)
     */
    private $idUsuario;

    /**
     * @var \AppBundle\Entity\FosUser
     * @Type("integer")
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\FosUser")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_fos_user", referencedColumnName="id")
     * })
     */
    private $idFosUser;

    /**
     * @var \AppBundle\Entity\Escuelas
     * @Type("integer")
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Escuelas")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_escuela", referencedColumnName="id_escuela")
     * })
     */
    private $idEscuela;


    public function getNombres(){
     return $this->nombres;
    }

    public function getApellidos(){
     return $this->nombres;
    }

    public function setNombres($nombres){
      $this->nombres =  $nombres;
    }

    public function setApellidos($apellidos){
      $this->apellidos = $apellidos;
    }

    public function setIdEscuela($idEscuela){
      $this->idEscuela = $idEscuela;
    }

    public function setIdFosUser($idFosUser){
      $this->idFosUser = $idFosUser;
    }

    public function jsonSerialize(){
      return array(
       'idUsuario'=> $this->idUsuario,
       'nombres' => $this->nombres,
       'apellidos'=> $this->apellidos,
       'escuela'=> $this->idEscuela,
       'user'=> $this->idFosUser
      );
    }


}
