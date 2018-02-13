<?php

namespace AppBundle\Controller;

use AppBundle\Entity\ProductPropertyCategory;
use AppBundle\Entity\Property;
use AppBundle\Entity\PropertyCategory;
use AppBundle\Form\PropertyType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PropertyController extends Controller
{
    public function getPropertiesAction()
    {
        return $this->render('AppBundle:Property:get_properties.html.twig', array(
            // ...
        ));
    }

    public function postPropertyAction($id, Request $request)
    {
        $properties = $this->getDoctrine()->getRepository("AppBundle:PropertyCategory")->findAll();
        $product = $this->getDoctrine()->getRepository("AppBundle:Product")->find($id);
        $em = $this->get("doctrine.orm.entity_manager");
        if ($request->get("grp-name") != null){
            $name = $request->get("grp-name");
            $propertyGrp = new PropertyCategory();
            $propertyGrp->setIsActive(true);
            $propertyGrp->setName($name);
            $propertyGrp->setRestaurant($this->getUser()->getRestaurant());
            $unique = false;
            if ($request->get("prop-unique") != null)
                $unique = true;
            $propertyGrp->setIsUnique($unique);
            $em->persist($propertyGrp);
            if ($request->get("prop-name") != null) {
                if (count($request->get("prop-name")) == count($request->get("prop-prix"))) {
                    foreach ($request->get("prop-name") as $k => $prop) {
                        $price = floatval($request->get("prop-prix")[$k]);
                        $property = new Property();
                        $property->setName($prop);
                        $property->setIsActive(true);
                        $property->setIsSoldOut(false);
                        $property->setOptionGroup($propertyGrp);
                        $property->setPrice($price);
                        $em->persist($property);
                    }
                    $em->flush();
                    $html = '<div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="prop-grp-' . $propertyGrp->getId() . '">
                                <label class="custom-control-label" for="prop-grp-' . $propertyGrp->getId() . '">
                                    ' . $name . ' ( ';
                    foreach ($request->get("prop-name") as $prop) {
                        $html .= $prop . ", ";
                    }
                    $html .= ')
                                </label>
                            </div>';
                    return new Response($html, 200);
                }else{
                    return new Response("Une erreur est survenue, vous devez saisir le prix supplémentaire pour chacune des propriétés.");
                }
            }else{
                return new Response("Une erreur est survenue, vous devez saisir au moins 2 propriétés pour ajouter un groupe.");
            }
        }else {
            return $this->render('AppBundle:Property:post_property.html.twig', array(
                "properties" => $properties,
                "product" => $product
            ));
        }
    }

    public function postProductPropertyAction($id, Request $request){
        $em = $this->get("doctrine.orm.entity_manager");
        $product = $this->getDoctrine()->getRepository("AppBundle:Product")->find($id);
        if ($this->getUser() != null) {
            if ($this->getUser()->getRestaurant() != null) {
                if (!empty($request->get("grp")) || $request->get("no-grp") != null) {
                    if ($product->getCategory()->getRestaurant()->getId() == $this->getUser()->getRestaurant()->getId()) {
                        foreach ($request->get("grp") as $grp) {
                            $group = $this->getDoctrine()->getRepository("AppBundle:PropertyCategory")->find($grp);
                            $prodGrp = new ProductPropertyCategory();
                            $prodGrp->setOptionGroup($group);
                            $prodGrp->setPosition(1);
                            $prodGrp->setProduct($product);
                            $em->persist($prodGrp);
                        }
                        $em->flush();
                        return $this->redirectToRoute("post_supplement", array("id" => $product->getId()));
                    }else{
                        return new Response("Vous devez posséder un restaurant pour acceder a cette page.", 400);
                    }
                }else{
                    return new Response("Vous devez faire un choix de propriétés pour ce produit (ou cocher \"Pas de propriétés\".", 400);
                }
            }else{
                return new Response("Vous devez posséder un restaurant pour acceder a cette page.", 400);
            }
        }else{
            return new Response("Vous devez etre connecté pour accéder à cette page.", 400);
        }
    }

}
