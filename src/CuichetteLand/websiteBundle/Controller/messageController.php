<?php

namespace CuichetteLand\websiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use CuichetteLand\websiteBundle\Entity\test;
use \PDO;
class messageController extends Controller
{
   public function messageAction($id)
    {
		$em = $this->getDoctrine()->getManager();
		$categories = $em->getRepository('CuichetteLandwebsiteBundle:Produits')->getAllCategories();
		$user= $this->get('security.token_storage')->getToken()->getUser();
		$emailId = $em->getRepository('CuichetteLandwebsiteBundle:Email')->find($id);
		$email = array();
		array_push($email, ($em->getRepository('CuichetteLandwebsiteBundle:User')-> getLoginFromId($emailId -> getIdDestinataire()))[0]);
		array_push($email, $emailId -> getObjet());
		array_push($email, $emailId -> getContenu());
		
        return $this->render('CuichetteLandwebsiteBundle:Mail:message.html.twig', array(
		'categories' => $categories, 'user' => $user, 'email' => $email
));
    }
	
	
}
