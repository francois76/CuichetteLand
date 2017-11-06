<?php

namespace CuichetteLand\websiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use CuichetteLand\websiteBundle\Entity\User;
use CuichetteLand\websiteBundle\Entity\Achats;
use CuichetteLand\websiteBundle\Entity\Produits;

use \PDO;
class deleteController extends Controller
{
   public function deleteAction($id)
    {
		$em = $this->getDoctrine()->getManager(); 
		$user= $this->get('security.token_storage')->getToken()->getUser();
		$achat = $em->getRepository('CuichetteLandwebsiteBundle:Achats') -> getAchatFromId($id);
		$securityContext = $this->container->get('security.authorization_checker');
		if ($securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED')) 
		{
			if($achat[0] -> getUtilisateur() == $user -> getId())
			{
				$em->getRepository('CuichetteLandwebsiteBundle:Achats') -> deleteAchat($id);
			}
		}
		return $this->redirectToRoute('cuichette_landwebsite_panier');
    }
	
	
}
