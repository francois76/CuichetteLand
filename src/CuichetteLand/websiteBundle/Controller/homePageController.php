<?php

namespace CuichetteLand\websiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use CuichetteLand\websiteBundle\Entity\test;
use \PDO;
class homePageController extends Controller
{
   public function indexAction()
    {
		$em = $this->getDoctrine()->getManager();
		$categories = $em->getRepository('CuichetteLandwebsiteBundle:Produits')->getAllCategories();
		$ids = array();
		foreach($categories as $categorie)
		{
			array_push($ids, $em->getRepository('CuichetteLandwebsiteBundle:Produits')->getthreeproducts($categorie));
		}
		$names = array();
		foreach($ids as $idcategories)
		{
			array_push($names, array($em->getRepository('CuichetteLandwebsiteBundle:Images')->getmainpicture($idcategories[0]["id"]),$em->getRepository('CuichetteLandwebsiteBundle:Images')->getmainpicture($idcategories[1]["id"]),$em->getRepository('CuichetteLandwebsiteBundle:Images')->getmainpicture($idcategories[2]["id"])));
		}
        return $this->render('CuichetteLandwebsiteBundle:Default:index.html.twig', array(
		'names' => $names, 'categories' => $categories
));
    }
	
	
}
