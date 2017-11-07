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
   public function newmessageAction()
    {
		$em = $this->getDoctrine()->getManager();
		$categories = $em->getRepository('CuichetteLandwebsiteBundle:Produits')->getAllCategories();
		$user= $this->get('security.token_storage')->getToken()->getUser();
		$email = new Email();
		$formBuilder = $this->get('form.factory')->createBuilder(FormType::class, $email);
		$formBuilder
      ->add('idDestinataire',      TextType::class)
      ->add('objet',     TextType::class)
      ->add('contenu',   TextareaType::class)
	  ->add('send',      SubmitType::class, array(
    'label' => 'Envoyer', 
    'attr' => array('class' => 'special button')
));
    ;
	 $form = $formBuilder->getForm();
		
        return $this->render('CuichetteLandwebsiteBundle:Mail:newmessage.html.twig', array(
		'categories' => $categories, 'user' => $user, 'form' => $form->createView()
));
    }
	
	
}
