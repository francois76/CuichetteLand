<?php

namespace CuichetteLand\websiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use CuichetteLand\websiteBundle\Entity\test;
use CuichetteLand\websiteBundle\Entity\Email;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use \PDO;
class newmessageController extends Controller
{
   public function newmessageAction(Request $request)
    {
		$em = $this->getDoctrine()->getManager();
		$categories = $em->getRepository('CuichetteLandwebsiteBundle:Produits')->getAllCategories();
		$user= $this->get('security.token_storage')->getToken()->getUser();
		$email = new Email();
		$formBuilder = $this->get('form.factory')->createBuilder(FormType::class, $email);
		$formBuilder
      ->add('idDestinataire',      TextType::class, array(
    'label' => 'Destinataire'))
      ->add('objet',     TextType::class)
      ->add('contenu',   TextareaType::class)
	  ->add('send',      SubmitType::class, array(
    'label' => 'Envoyer', 
    'attr' => array('class' => 'special button')
));
    ;
	 $form = $formBuilder->getForm();
	 if ($request->isMethod('POST')) {
			$form->handleRequest($request);
				if ($form->isValid()) {
				$email-> setIdDestinataire($em->getRepository('CuichetteLandwebsiteBundle:User')-> getIdFromlogin($email -> getIdDestinataire())[0]["id"]);
				$email-> setIdExpediteur($user -> getId());
				$date = new \DateTime();
				$email -> setDate($date);
				$em->persist($email);
				$em->flush();
				$request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');
				return $this->redirectToRoute('cuichette_landwebsite_inbox');
				}
			}
		
        return $this->render('CuichetteLandwebsiteBundle:Mail:newmessage.html.twig', array(
		'categories' => $categories, 'user' => $user, 'form' => $form->createView()
));
    }
	
	
}
