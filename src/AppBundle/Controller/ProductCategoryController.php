<?php

namespace AppBundle\Controller;

use AppBundle\Entity\ProductCategory;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductCategoryController extends Controller
{
    public function postCategoryAction(Request $request)
    {
        $em = $this->get("doctrine.orm.entity_manager");
        $name = $request->get("name");
        $desc = $request->get("desc");
        $user = $this->getUser();
        if ($user != null){
            $restau = $user->getRestaurant();
            if ($restau != null) {
                if ($name != null && $desc != null){
                    $cat = new ProductCategory();
                    $cat->setRestaurant($restau);
                    $cat->setIsActive(1);
                    $cat->setName($name);
                    $cat->setDescription($desc);
                    $cat->setPosition(1);
                    $em->persist($cat);
                    $em->flush();
                    return $this->redirectToRoute("get_products");
                }else{
                    return new Response(null, 400);
                }
            }else{
                return new Response(null, 400);
            }
        }else{
            return new Response(null, 400);
        }
    }

    public function updateCategoryAction()
    {
        return $this->render('AppBundle:ProductCategory:update_category.html.twig', array(
            // ...
        ));
    }

    public function deleteCategoryAction($id)
    {
        $em = $this->get("doctrine.orm.entity_manager");
        $user = $this->getUser();
        if ($user != null) {
            $restau = $user->getRestaurant();
            if ($restau != null) {
                $categ = $this->getDoctrine()->getRepository("AppBundle:ProductCategory")->find($id);
                $isDeletable = false;
                foreach ($restau->getCategoriesOfProducts() as $cat){
                    if ($cat->getid() == $categ->getId())
                        $isDeletable = true;
                }
                if (!empty($categ) && $isDeletable){
                    $em->remove($categ);
                    $em->flush();
                    return $this->redirectToRoute("get_products");
                }else{
                    return new Response("Cette catégorie ne vous appartient pas, accès refusé.", 400);
                }
            }else{
                return new Response("Vous devez posséder un restaurant pour acceder a cette page", 400);
            }
        }else{
            return new Response(null, 400);
        }
    }

}
