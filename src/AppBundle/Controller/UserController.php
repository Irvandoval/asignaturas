<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use JMS\Serializer\SerializerBuilder;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Usuario;

/**
 * @Route("/api")
 */
class UserController extends Controller
{
    /**
    * @Route("/usuarios")
    * @Method({"GET"})
    */
 public function getUsers() {
   $em = $this->getDoctrine()->getManager();
   $usuarios = $em->getRepository('AppBundle:Usuario')->findAll();
   if (!$usuarios) {
       return $this->handleError('No se ha encontrado usuarios.', 404);
   }
   return new JsonResponse($usuarios);
 }

 /**
 * @Route("/usuarios/{username}")
 * @Method({"GET"})
 *
 */
public function getUser($username) {
$em = $this->getDoctrine()->getManager();
$fosUser =  $em->getRepository('AppBundle:FosUser')->findOneByUsername($username);
if(!$fosUser){
   return $this->handleError('No se ha encontrado usuario.', 404);
}
$usuario = $em->getRepository('AppBundle:Usuario')->findOneByIdFosUser($fosUser);
if (!$usuario) {
    return $this->handleError('No se ha encontrado usuario.', 404);
}
return new JsonResponse($usuario);
}

  /**
   * @Route("/usuarios")
   * @Method({"PUT"})
   */
  public function createUser(Request $req)
  {
      $em = $this->getDoctrine()->getManager();
      $serializer = SerializerBuilder::create()->build();
      $escuela = $em->getRepository('AppBundle:Escuelas')->findOneByIdEscuela($req->get('id_escuela'));
      if (!$escuela) {
          return $this->handleError('No se ha encontrado escuela con el id ingresado.', 404);
      }
    // Creamos el username y pass en la tabla fos_user
      $userManager = $this->get('fos_user.user_manager');
      $user = $userManager->createUser();
      $user->setUsername($req->get('username'));
      $user->setEmail($req->get('email'));
      $user->setRoles(array($req->get('role')));
      $user->setPlainPassword($req->get('password'));
      $user->setEnabled(true);
      $userManager->updateUser($user);
      $fosUser =  $em->getRepository('AppBundle:FosUser')->findOneById($user->getId());
      if (!$fosUser) {
          return $this->handleError('No se ha encontrado fouser con el id ingresado.', 404);
      }
      //Guardamos datos del perfil de usuario en tabla usuario
      $perfil = new Usuario();
      $perfil->setNombres($req->get('nombres'));
      $perfil->setApellidos($req->get('apellidos'));
      $perfil->setIdFosUser($fosUser);
      $perfil->setIdEscuela($escuela);
      $em->persist($perfil);
      $em->flush();

      return new JsonResponse(array('mensaje' => 'guardado'), 200);
  }

    public function handleError($message, $errCode)
    {
        return new JsonResponse(array('mensaje' => $message), $errCode);
    }
}
