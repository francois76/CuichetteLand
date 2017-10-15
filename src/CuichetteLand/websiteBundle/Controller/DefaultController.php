<?php

namespace CuichetteLand\websiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use CuichetteLand\websiteBundle\Entity\test;
use \PDO;
class DefaultController extends Controller
{
   public function indexAction()
    {
		$em = $this->getDoctrine()->getManager();
		$imageRepository = $em->getRepository('CuichetteLandwebsiteBundle:Images');
		$image = $imageRepository->find("1");
		$adresse = $image -> getNomImage();
        return $this->render('CuichetteLandwebsiteBundle:Default:index.html.twig', array(
  'adresse' => $adresse
));
    }
}
