<?php

namespace CuichetteLand\websiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use CuichetteLand\websiteBundle\Entity\User;
use CuichetteLand\websiteBundle\Entity\Achats;
use CuichetteLand\websiteBundle\Entity\Produits;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use \PDO;
class panierController extends Controller
{
   public function panierAction(Request $request)
    {
		$em = $this->getDoctrine()->getManager(); 
		$user= $this->get('security.token_storage')->getToken()->getUser();
		$categories = $em->getRepository('CuichetteLandwebsiteBundle:Produits')->getAllCategories();
		$achatsId = $em->getRepository('CuichetteLandwebsiteBundle:Achats')-> getAllProductChosen($user);
		$error = 0;
		$achats = array();
		$sum = 0;
		foreach($achatsId as $achatId)
		{
			$achat = array();
			$produit = $em->getRepository('CuichetteLandwebsiteBundle:Produits')->find($achatId -> getIdarticle());
			array_push($achat, $produit -> getNom());
			array_push($achat, $achatId -> getQuantite());
			array_push($achat, ($produit -> getPrix()* $achatId -> getQuantite()));
			array_push($achat, ($achatId -> getId()));
			$sum = $sum + ($produit -> getPrix()*$achatId -> getQuantite()) ;
			array_push($achats, $achat);
		}
		$formBuilder = $this->get('form.factory')->createBuilder(FormType::class, $achatsId);
		$formBuilder ->add('pay',      SubmitType::class, array(
    'label' => 'Payer', 
    'attr' => array('class' => 'special button')
));
		$form = $formBuilder->getForm();
		if ($request->isMethod('POST')) {
			$form->handleRequest($request);

			if ($form->isValid()) {
				if($sum > $user -> getAccount() )
				{
					$error = 1;
					return $this->render('CuichetteLandwebsiteBundle:Default:panier.html.twig', array(
					'user' => $user, 'achats' => $achats, 'somme' => $sum, 'form' => $form->createView(), 'categories' => $categories, 'error' => $error
					));
				}
				$em->getRepository('CuichetteLandwebsiteBundle:Achats') -> setChosenProductsAsValidate($user);
				foreach($achatsId as $achatId)
				{
					$produit = $em->getRepository('CuichetteLandwebsiteBundle:Produits')->find($achatId -> getIdarticle());
					$produit -> setQuantite($produit -> getQuantite() - $achatId -> getQuantite());
				}
				$user -> setAccount($user -> getAccount()-$sum);
				$em->flush();
				$request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');
				return $this->redirectToRoute('cuichette_landwebsite_homepage');
	  }
	}
        return $this->render('CuichetteLandwebsiteBundle:Default:panier.html.twig', array(
		'user' => $user, 'achats' => $achats, 'somme' => $sum, 'form' => $form->createView(), 'categories' => $categories, 'error' => $error
));
    }
	
	
}
