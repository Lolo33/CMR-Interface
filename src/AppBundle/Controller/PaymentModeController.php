<?php

namespace AppBundle\Controller;

use AppBundle\Entity\RestaurantPaymentMode;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PaymentModeController extends Controller
{

    /*
     * Gère l'affichage des moyens de paiement d'un restaurant
     */
    public function getPaymentModesAction()
    {
        $restaurant = $this->getUser()->getRestaurant();
        $listOrderType = $this->getDoctrine()->getRepository("AppBundle:OrderType")->findAll();
        $paymentModes = $this->getDoctrine()->getRepository("AppBundle:PaymentMode")->findAll();
        $restaurantPMs = $this->getDoctrine()->getRepository("AppBundle:RestaurantPaymentMode")->findBy(array("restaurant" => $restaurant));
        return $this->render('AppBundle:PaymentMode:get_payment_modes.html.twig', array(
            "orderTypes" => $listOrderType,
            "paymentModes" => $paymentModes,
            "restaurantPMs" => $restaurantPMs
        ));
    }

    /*
     * Gère la sélection des moyens de paiements par type de restauration pour le restaurant courant de l'utilisateur
     */
    public function postPaymentModeAction(Request $request)
    {
        $em = $this->get("doctrine.orm.entity_manager");
        $content_tab = explode("&", $request->getContent());
        $errors = null;
        if ($this->getUser() != null) {
            $restau = $this->getUser()->getRestaurant();
            if ($restau != null) {
                $pmAlreadyAccepted = $this->getDoctrine()->getRepository("AppBundle:RestaurantPaymentMode")->findBy(array("restaurant" => $restau));

                // Solution 1
                foreach ($pmAlreadyAccepted as $pmRest) {
                    $em->remove($pmRest);
                    $em->flush();
                }

                foreach ($content_tab as $pm) {
                    $id_tab = explode("%2C", explode("=", $pm)[0]);
                    $type_id = $id_tab[0];
                    $pm_id = $id_tab[1];

                    // Solution 1
                    $restPms = new RestaurantPaymentMode();
                    $restPms->setRestaurant($restau);
                    $restPms->setOrderType($this->getDoctrine()->getRepository("AppBundle:OrderType")->find($type_id));
                    $restPms->setPaymentMode($this->getDoctrine()->getRepository("AppBundle:PaymentMode")->find($pm_id));
                    $em->persist($restPms);
                    $em->flush();

                    /* Solution 2
                       $add = true;
                       foreach ($pmAlreadyAccepted as $pmRest) {
                        if ($pmRest->getOrderType()->getId() == $type_id && $pmRest->getPaymentMode()->getId() == $pm_id) {
                            $add = false;
                        }
                    }
                    if ($add) {
                        $restPms = new RestaurantPaymentMode();
                        $restPms->setRestaurant($restau);
                        $restPms->setOrderType($this->getDoctrine()->getRepository("AppBundle:OrderType")->find($type_id));
                        $restPms->setPaymentMode($this->getDoctrine()->getRepository("AppBundle:PaymentMode")->find($pm_id));
                        $em->persist($restPms);
                        $em->flush();
                    }*/
                }
                return $this->redirectToRoute("get_payment_modes");
            }else{
                return new Response(null, 403);
            }
        }else{
            return new Response(null, 403);
        }
    }

}
