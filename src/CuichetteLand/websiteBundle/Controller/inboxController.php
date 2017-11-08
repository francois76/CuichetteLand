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
		$emailsId = $em->getRepository('CuichetteLandwebsiteBundle:Email')-> getAllEmailReceived($user);
		$emails = array();
		foreach($emailsId as $emailId)
		{
			$email = array();
			array_push($email, ($em->getRepository('CuichetteLandwebsiteBundle:User')-> getLoginFromId($emailId -> getIdExpediteur()))[0]);
			array_push($email, $emailId -> getDate());
			array_push($email, $emailId -> getObjet());
			array_push($email, $emailId -> getId());
			array_push($emails, $email);
			
		}
		
		
        return $this->render('CuichetteLandwebsiteBundle:Mail:inbox.html.twig', array(
		'categories' => $categories, 'user' => $user, 'emails' => $emails
));
    }
	
	
}
