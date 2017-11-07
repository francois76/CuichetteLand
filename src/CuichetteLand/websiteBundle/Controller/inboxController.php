<?php

namespace CuichetteLand\websiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use CuichetteLand\websiteBundle\Entity\test;
use \PDO;
class inboxController extends Controller
{
   public function inboxAction()
    {
		$em = $this->getDoctrine()->getManager();
		$categories = $em->getRepository('CuichetteLandwebsiteBundle:Produits')->getAllCategories();
		$user= $this->get('security.token_storage')->getToken()->getUser();
		
		
        return $this->render('CuichetteLandwebsiteBundle:Mail:inbox.html.twig', array(
		'categories' => $categories, 'user' => $user
));
    }
	
	
}
