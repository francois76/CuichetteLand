<?php

namespace CuichetteLand\websiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
class categoriesPageController extends Controller
{
   public function categoriesAction()
    {
        return $this->render('CuichetteLandwebsiteBundle:Default:categories.html.twig');
    }
}
