<?php

namespace CuichetteLand\websiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use CuichetteLand\websiteBundle\Entity\User;
use CuichetteLand\websiteBundle\Entity\Achats;
use CuichetteLand\websiteBundle\Entity\Produits;

use \PDO;
class deletemailController extends Controller
{
   public function deletemailAction($id)
    {
		$em = $this->getDoctrine()->getManager(); 
		$user= $this->get('security.token_storage')->getToken()->getUser();
		$mail = $em->getRepository('CuichetteLandwebsiteBundle:Email') -> find($id);
		$securityContext = $this->container->get('security.authorization_checker');
		if ($securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED')) 
		{
			if($mail -> getIdDestinataire() == $user -> getId())
			{
				$em->getRepository('CuichetteLandwebsiteBundle:Email') -> deleteEmail($id);
			}
		}
		return $this->redirectToRoute('cuichette_landwebsite_inbox');
    }
	
	
}
