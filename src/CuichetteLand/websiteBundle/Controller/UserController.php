<?php

namespace CuichetteLand\websiteBundle\Controller;

use CuichetteLand\websiteBundle\Entity\user;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegistrationController extends homePageController
{
    public function indexAction()
    {
        return $this->render('CuichetteLand:websiteBundle:Default:form.html.twig');
    }

    public function inscriptionAction(Request $request)
    {
        $user = $this->getDoctrine()
            ->getRepository(user::class)
            ->findOneBy(
                array('email' => $request->get('email'))
            );

        if (!$user) { // Si le mail n'est pas déja utilisé

          // Init
          $em = $this->getDoctrine()->getManager();
          $user = new user();

          // Password encryption
          $factory = $this->get('security.encoder_factory');
          $encoder = $factory->getEncoder($user);
          $salt = uniqid(mt_rand(), true);
          $password = $encoder->encodePassword($request->get('password'), $salt);

          // Creating the user
          $user->setPassword($password);
          $user->setNom($request->get('nom'));
          $user->setPrenom($request->get('prenom'));
          $user->setMail($request->get('mail'));
            $user->setSalt($salt);


          // Executing the query on database
          $em->persist($user);
          $em->flush();

          return $this->redirectToRoute('cuichette_landwebsite_homepage');
        }
        else {
          return $this->render('CuichetteLand:websiteBundle:Default:form.html.twig', array(
            'mail' => 1,
          ));
        }
    }
}
