<?php

namespace CuichetteLand\websiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use CuichetteLand\websiteBundle\Entity\User;
use CuichetteLand\websiteBundle\Entity\Achats;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

use \PDO;
class testVendingController extends Controller
{
   public function testVendingAction(Request $request)
    {
		$em = $this->getDoctrine()->getManager(); //deja présent sur la page normalement XD
		$user= $this->get('security.token_storage')->getToken()->getUser();
		$produit = $em->getRepository('CuichetteLandwebsiteBundle:Produits')->find(1); // a remplacer par le produit courant
		
		$Achats = new Achats();
		$formBuilder = $this->get('form.factory')->createBuilder(FormType::class, $Achats);
		$formBuilder ->add('quantite', TextType::class) 
		->add('save',      SubmitType::class);
		$form = $formBuilder->getForm();
		if ($request->isMethod('POST')) {
			$form->handleRequest($request);

			if ($form->isValid()) {
				$Achats -> setUtilisateur( $user -> getID());
				$Achats -> setValide ("0");
				$Achats -> setIdarticle($produit -> getId());
				$em->persist($Achats);
				$em->flush();
				$request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');
				return $this->redirectToRoute('cuichette_landwebsite_homepage');
	  }
	}
        return $this->render('CuichetteLandwebsiteBundle:Default:testVending.html.twig', array(
		'user' => $user,'form' => $form->createView(), 'produit' => $produit
));
    }
	
	
}