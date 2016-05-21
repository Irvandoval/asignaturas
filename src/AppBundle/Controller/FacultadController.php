<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use JMS\Serializer\SerializerBuilder;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * @Route("/api")
 */
class FacultadController extends Controller
{
  /**
   * @Route("/facultades")
   * @Method({"GET"})
   */
  public function getFacultades()
  {
      $em = $this->getDoctrine()->getRepository('AppBundle:Facultad');
      $facultades = $em->findAll();
      if (!$facultades) {
          return $this->handleError('No hay facultades registradas.', 404);
      }

      return new JsonResponse($facultades);
  }

   /**
    * @Route("/facultades/{id}", requirements={"id" = "\d+"})
    * @Method({"GET"})
    */
   public function getFacultad($id = 0)
   {
       $em = $this->getDoctrine()->getRepository('AppBundle:Facultad');
       $facultad = $em->findOneByIdFacultad($id);
       if (!$facultad) {
           return $this->handleError('Facultad no encontrada', 404);
       }

       return new JsonResponse($facultad);
   }

   /**
    * @Route("/facultades/{id}", requirements={"id" = "\d+"})
    * @Method({"DELETE"})
    */
   public function deleteFacultad($id = 0)
   {
       $em = $this->getDoctrine()->getManager();
       $facultad = $em->getRepository('AppBundle:Facultad')->findOneByIdFacultad($id);
       if (!$facultad) {
           return $this->handleError('no se ha encontrado facultad', 404);
       }
       $em->remove($facultad);
       $em->flush();

       return new JsonResponse(array('mensaje' => 'eliminado'));
   }

   /**
    * @Route("/facultades")
    * @Method({"PUT"})
    */
   public function createFacultad(Request $req)
   {
       $em = $this->getDoctrine()->getManager();
       $serializer = SerializerBuilder::create()->build();
       $data = $req->getContent();
       $facultad = $serializer->deserialize($data, 'AppBundle\Entity\Facultad', 'json');
       $em->persist($facultad);
       $em->flush();

       return new JsonResponse($facultad, 201);
   }

    /**
     * @Route("/facultades/{id}", requirements={"id" = "\d+"})
     * @Method({"POST"})
     */
    public function updateFacultad(Request $req, $id = 0)
    {
        $serializer = SerializerBuilder::create()->build();
        $em = $this->getDoctrine()->getManager();
        $facultad = $em->getRepository('AppBundle:Facultad')->findOneByIdFacultad($id);
        if (!$facultad) {
            return $this->handleError('no se ha encontrado facultad', 404);
        }
        $data = $req->getContent();
        $upFacultad = $serializer->deserialize($data, 'AppBundle\Entity\Facultad', 'json');
        if ($upFacultad->getNombre()) {
            $facultad->setNombre($upFacultad->getNombre());
        }
        $em->flush();

        return new JsonResponse($facultad, 200);
    }

    public function handleError($message, $errCode)
    {
        return new JsonResponse(array('mensaje' => $message), $errCode);
    }
}
