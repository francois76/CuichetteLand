<?php

namespace CuichetteLand\websiteBundle\Controller;

use CuichetteLand\websiteBundle\Entity\Produits;
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
class articleController extends Controller
{
   public function articleAction($id, Request $request)
    {
		$em = $this->getDoctrine()->getManager(); 
		$article = $this->getDoctrine()->getManager()->getRepository('CuichetteLandwebsiteBundle:Produits')->find($id);
		$user= $this->get('security.token_storage')->getToken()->getUser();
		$categories = $em->getRepository('CuichetteLandwebsiteBundle:Produits')->getAllCategories();
		
		$Achats = new Achats();
		$formBuilder = $this->get('form.factory')->createBuilder(FormType::class, $Achats);
		$formBuilder ->add('quantite', TextType::class, array(
    'label' => false,
)) 
		->add('save',      SubmitType::class, array(
    'label' => 'Ajouter au panier', 
    'attr' => array('class' => 'special button')
));
		$form = $formBuilder->getForm();
		if ($request->isMethod('POST')) {
			$form->handleRequest($request);

			if ($form->isValid()) {
				$Achats -> setUtilisateur( $user -> getID());
				$Achats -> setValide ("0");
				$Achats -> setIdarticle($article -> getId());
				$em->persist($Achats);
				$em->flush();
				$request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');
				return $this->redirectToRoute('cuichette_landwebsite_panier');
	  }
	}
		return $this->render('CuichetteLandwebsiteBundle:Default:article.html.twig', 
		array('produit' => $article, 'categories' => $categories, 'user' => $user, 'form' => $form->createView()));
    }
}
