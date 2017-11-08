<?php

namespace CuichetteLand\websiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use \PDO;
class categoriesPageController extends Controller
{
   public function categoriesAction($categorie)
    {
		$em = $this->getDoctrine()->getManager();
		$categories = $em->getRepository('CuichetteLandwebsiteBundle:Produits')->getAllCategories();
		$user= $this->get('security.token_storage')->getToken()->getUser();
		$ids = array();
		$products = $em->getRepository('CuichetteLandwebsiteBundle:Produits')->getAllProducts($categorie); // products possede les id de tous les $categorie (grande ou petite) cuichettes
		$images = array();
		$names = array();
		$descriptions = array();
		foreach($products as $product)
		{
			array_push($images, $em->getRepository('CuichetteLandwebsiteBundle:Images')->getmainpicture($product['id']));
			array_push($names, $em->getRepository('CuichetteLandwebsiteBundle:Produits')->getname($product['id']));
			array_push($descriptions, $em->getRepository('CuichetteLandwebsiteBundle:Produits')->getdescription($product['id']));
		}
        return $this->render('CuichetteLandwebsiteBundle:Default:categories.html.twig', array(
		'names' => $names, 'images' => $images, 'description' => $descriptions, 'categorie' => $categorie, 'products' => $products, 'categories' => $categories, 'user' => $user));
    }
	
	
}
