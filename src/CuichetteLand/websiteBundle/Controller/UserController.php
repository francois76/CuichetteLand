<?php

namespace CuichetteLand\websiteBundle\Controller;

use CuichetteLand\websiteBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserController extends Controller
{

    public function formAction(Request $request)
    {
        $user = $this->getDoctrine()
            ->getRepository(User::class)
            ->findOneBy(
                array('mail' => $request->get('mail'))
            );
		$em = $this->getDoctrine()->getManager();
		$categories = $em->getRepository('CuichetteLandwebsiteBundle:Produits')->getAllCategories();
		$blankuser= $this->get('security.token_storage')->getToken()->getUser();
		

        if ($request->isMethod('POST')) {

          // Init
          $user = new user();

          // Password encryption
          $factory = $this->get('security.encoder_factory');
          $encoder = $factory->getEncoder($user);
          $salt = uniqid(mt_rand(), true);
          $password = $encoder->encodePassword($request->get('password'), $salt);

          // Creating the user
          $user->setPassword($password);
          $user->setNom($request->get('lastname'));
          $user->setPrenom($request->get('firstname'));
          $user->setMail($request->get('email'));
		  $user->setRoles(array('ROLE_USER'));
          $user->setSalt($salt);
		  $user -> setAccount('0');

          // Executing the query on database
          $em->persist($user);
          $em->flush();


          return $this->redirectToRoute('cuichette_landwebsite_homepage');
        }
        else {
          return $this->render('CuichetteLandwebsiteBundle:Security:register.html.twig', array(
            'mail' => 1, 'categories' => $categories, 'user' => $blankuser
          ));
        }
    }
}
