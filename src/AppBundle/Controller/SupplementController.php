<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SupplementController extends Controller
{
    public function getSupplementsAction($id)
    {
        return $this->render('AppBundle:Supplement:get_supplements.html.twig', array(
            // ...
        ));
    }

    public function postSupplementAction($id)
    {
        return $this->render('AppBundle:Supplement:post_supplement.html.twig', array(
            // ...
        ));
    }

    public function postProductSupplementAction($id)
    {
        return $this->render('AppBundle:Supplement:post_product_supplement.html.twig', array(
            // ...
        ));
    }

}
