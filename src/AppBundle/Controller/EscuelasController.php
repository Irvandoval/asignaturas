<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use JMS\Serializer\SerializerBuilder;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/api")
 */
class EscuelasController extends Controller
{
    /**
   * @Route("/escuelas")
   * @Method({"GET"})
   */
  public function getEscuelas()
  {
      $em = $this->getDoctrine()->getRepository('AppBundle:Escuelas');
      $escuelas = $em->findAll();
      if (!$escuelas) {
          return $this->handleError('No hay escuelas registradas.', 404);
      }

      return new JsonResponse($escuelas);
  }

   /**
    * @Route("/escuelas/{id}", requirements={"id" = "\d+"})
    * @Method({"GET"})
    */
   public function getEscuela($id = 0)
   {
       $em = $this->getDoctrine()->getRepository('AppBundle:Escuelas');
       $escuela = $em->findOneByIdEscuela($id);
       if (!$escuela) {
           return $this->handleError('Escuela no encontrada', 404);
       }

       return new JsonResponse($escuela);
   }

   /**
    * @Route("/escuelas/{id}", requirements={"id" = "\d+"})
    * @Method({"DELETE"})
    */
   public function deleteEscuela($id = 0)
   {
       $em = $this->getDoctrine()->getManager();
       $escuela = $em->getRepository('AppBundle:Escuelas')->findOneByIdEscuela($id);
       if (!$escuela) {
           return $this->handleError('No se ha encontrado', 404);
       }
       $em->remove($escuela);
       $em->flush();

       return new JsonResponse(array('mensaje' => 'eliminado'));
   }

   /**
    * @Route("/escuelas")
    * @Method({"PUT"})
    */
   public function createEscuela(Request $req)
   {
       $em = $this->getDoctrine()->getManager();
       $serializer = SerializerBuilder::create()->build();
       $data = $req->getContent();
       $escuela = $serializer->deserialize($data, 'AppBundle\Entity\Escuelas', 'json');
       $facultad = $em->getRepository('AppBundle:Facultad')->findOneByIdFacultad($escuela->getIdFacultad());
       if (!$facultad) {
           return $this->handleError('no se ha encontrado facultad'.$escuela->getIdFacultad(), 500);
       }
       $escuela->setIdFacultad($facultad);
       $em->persist($escuela);
       $em->flush();

       return new JsonResponse($escuela, 201);
   }
   /**
    * @Route("/escuelas/{id}", requirements = {"id" = "\d+"})
    * @Method({"POST"})
    */
   public function updateEscuela(Request $req, $id = 0)
   {
       $serializer = SerializerBuilder::create()->build();
       $em = $this->getDoctrine()->getManager();
       $escuela = $em->getRepository('AppBundle:Escuelas')->findOneByIdFacultad($id);
       if (!$escuela) {
           return $this->handleError('No se ha encontrado escuela', 404);
       }
       $data = $req->getContent();
       $updateEscuela = $serializer->deserialize($data, 'AppBundle\Entity\Escuelas', 'json');
       if ($updateEscuela->getNombre()) {
           $escuela->setNombre($updateEscuela->getNombre());
       }
       $em->flush();

       return new JsonResponse($escuela, 200);
   }

    public function handleError($message, $errCode){
      return new JsonResponse(array('mensaje' => $message), $errCode);
    }
}
