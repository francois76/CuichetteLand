<?php

namespace CuichetteLand\websiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use CuichetteLand\websiteBundle\Entity\test;
use CuichetteLand\websiteBundle\Entity\Produits;
use \PDO;
class articleController extends Controller
{
   public function articleAction()
    {
      $articles = $this->getDoctrine()->getManager()->getRepository('CuichetteLandwebsiteBundle:Produits')->findAll();
		return $this->render('CuichetteLandwebsiteBundle:Default:article.html.twig', array('cuichette' => $articles));
    }
}
