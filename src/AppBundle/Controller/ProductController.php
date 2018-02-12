<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Product;
use AppBundle\Form\ProductType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    public function getProductsAction()
    {
        $restaurant = $this->getUser()->getRestaurant();
        $categories = $this->getDoctrine()->getRepository("AppBundle:ProductCategory")->findBy(array("restaurant" => $restaurant));
        return $this->render('AppBundle:Product:get_products.html.twig', array(
            "categories" => $categories
        ));
    }

    public function getProductAction($id)
    {
        return $this->render('AppBundle:Product:get_product.html.twig', array(
            // ...
        ));
    }

    public function postProductAction($id, Request $request)
    {
        $cat = $this->getDoctrine()->getRepository("AppBundle:ProductCategory")->find($id);
        $prod = new Product();
        $formProd = $this->get('form.factory')->create(ProductType::class, $prod);

        $formProd->handleRequest($request);
        if ($formProd->isSubmitted() && $formProd->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $prod->setPosition(1);
            $prod->setIsActive(false);
            $prod->setImgUrl("");
            $prod->setIsSoldOut(false);
            $prod->setCategory($cat);
            $em->persist($prod);
            $em->flush();
            return $this->redirectToRoute('post_property', array("id" => $prod->getId()));
        }
        return $this->render('AppBundle:Product:post_product.html.twig', array(
            "formProduct" => $formProd->createView(),
            "category" => $cat
        ));
    }

    public function deleteProductAction($id)
    {
        $em = $this->get("doctrine.orm.entity_manager");
        $user = $this->getUser();
        if ($user != null) {
            $restau = $user->getRestaurant();
            if ($restau != null) {
                $prod = $this->getDoctrine()->getRepository("AppBundle:Product")->find($id);
                if ($prod->getCategory()->getRestaurant() == $restau && !empty($prod)){
                    foreach ($prod->getProperties() as $prop)
                        $em->remove($prop);
                    foreach ($prod->getSupplements() as $sup)
                        $em->remove($sup);
                    $em->remove($prod);
                    $em->flush();
                    return $this->redirectToRoute("get_products");
                }else{
                    return new Response("Ce produit n'existe pas ou ne vous appartient pas, acces refusé", 400);
                }
            }else{
                return new Response(null, 400);
            }
        }else{
            return new Response(null, 400);
        }
    }

}
