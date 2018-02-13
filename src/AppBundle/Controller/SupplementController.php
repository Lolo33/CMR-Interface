<?php

namespace AppBundle\Controller;

use AppBundle\Entity\ProductSupplementCategory;
use AppBundle\Entity\Supplement;
use AppBundle\Entity\SupplementCategory;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SupplementController extends Controller
{
    public function getSupplementsAction($id)
    {
        return $this->render('AppBundle:Supplement:get_supplements.html.twig', array(
            // ...
        ));
    }

    public function postSupplementAction($id, Request $request)
    {
        $supplements= $this->getDoctrine()->getRepository("AppBundle:SupplementCategory")->findAll();
        $product = $this->getDoctrine()->getRepository("AppBundle:Product")->find($id);
        $em = $this->get("doctrine.orm.entity_manager");
        if ($request->get("grp-name") != null){
            $name = $request->get("grp-name");
            $supplementsGrp = new SupplementCategory();
            $supplementsGrp->setIsActive(true);
            $supplementsGrp->setName($name);
            $supplementsGrp->setRestaurant($this->getUser()->getRestaurant());
            $em->persist($supplementsGrp);
            if ($request->get("sup-name") != null) {
                if (count($request->get("sup-name")) == count($request->get("sup-prix"))) {
                    foreach ($request->get("sup-name") as $k => $sup) {
                        $price = floatval($request->get("sup-prix")[$k]);
                        $property = new Supplement();
                        $property->setName($sup);
                        $property->setIsActive(true);
                        $property->setIsSoldOut(false);
                        $property->setSupGroup($supplementsGrp);
                        $property->setPrice($price);
                        $em->persist($property);
                    }
                    $em->flush();
                    $html = '<div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="prop-grp-' . $supplementsGrp->getId() . '">
                                <label class="custom-control-label" for="prop-grp-' . $supplementsGrp->getId() . '">
                                    ' . $name . ' ( ';
                    foreach ($request->get("sup-name") as $sup) {
                        $html .= $sup . ",";
                    }
                    $html .= ')
                                </label>
                            </div>';
                    return new Response($html, 200);
                }
            }else{
                return new Response("Une erreur est survenue, vous devez saisir au moins 2 propriétés pour ajouter un groupe.", 400);
            }
        }else {
            return $this->render('AppBundle:Supplement:post_supplement.html.twig', array(
                "supplements" => $supplements,
                "product" => $product
            ));
        }
    }

    public function postProductSupplementAction($id, Request $request)
    {
        $em = $this->get("doctrine.orm.entity_manager");
        $product = $this->getDoctrine()->getRepository("AppBundle:Product")->find($id);
        if ($this->getUser() != null) {
            if ($this->getUser()->getRestaurant() != null) {
                if (!empty($request->get("grp")) || $request->get("no-grp") != null) {
                    if ($product->getCategory()->getRestaurant()->getId() == $this->getUser()->getRestaurant()->getId()) {
                        foreach ($request->get("grp") as $grp) {
                            $group = $this->getDoctrine()->getRepository("AppBundle:SupplementCategory")->find($grp);
                            $prodGrp = new ProductSupplementCategory();
                            $prodGrp->setSupGroup($group);
                            $prodGrp->setProduct($product);
                            $em->persist($prodGrp);
                        }
                        $product->setIsActive(true);
                        $em->merge($product);
                        $em->flush();
                        return $this->redirectToRoute("get_products");
                    }else{
                        return new Response("Vous devez posséder un restaurant pour accéder a cette page.", 400);
                    }
                }else{
                    return new Response("Vous devez faire un choix de suppléments pour ce produit (ou cocher \"Pas de suppléments\".", 400);
                }
            }else{
                return new Response("Vous devez posséder un restaurant pour accéder a cette page.", 400);
            }
        }else{
            return new Response("Vous devez etre connecté pour accéder à cette page.", 400);
        }
    }

}
