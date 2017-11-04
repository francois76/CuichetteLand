<?php

namespace CuichetteLand\websiteBundle\Controller;

use CuichetteLand\websiteBundle\Entity\user;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserController extends homePageController
{

    public function formAction(Request $request)
    {
        $user = $this->getDoctrine()
            ->getRepository(user::class)
            ->findOneBy(
                array('mail' => $request->get('mail'))
            );

        if ($request->isMethod('POST')) {

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
          $user->setNom($request->get('lastname'));
          $user->setPrenom($request->get('firstname'));
          $user->setMail($request->get('email'));
          $user->setSalt($salt);

          // Executing the query on database
          $em->persist($user);
          $em->flush();


          return $this->redirectToRoute('cuichette_landwebsite_homepage');
        }
        else {
          return $this->render('CuichetteLandwebsiteBundle:Default:form.html.twig', array(
            'mail' => 1,
          ));
        }
    }
}
