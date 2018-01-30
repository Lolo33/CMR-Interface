<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Requetes;
use FOS\UserBundle\Model\UserManager;
use FOS\UserBundle\Util\CanonicalFieldsUpdater;
use FOS\UserBundle\Util\PasswordUpdaterInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class OrderController extends Controller
{
    public function listCurrentOrdersAction()
    {
        $objUser = $this->getUser();
        $orders = $this->getDoctrine()->getRepository("AppBundle:Order")->findBy(array("restaurant" => $objUser->getRestaurant()));
        $orders_ajd = [];
        foreach ($orders as $order) {
            if ((new \DateTime($order->getHourToBeReady()))->format("Y-m-d") == (new \DateTime())->format("Y-m-d"))
                $orders_ajd[] = $order;
        }
        return $this->render('AppBundle:Order:list_orders.html.twig', array(
            "orders" => $orders_ajd
        ));
    }

    public function listAllOrdersAction()
    {
        $objUser = $this->getUser();
        $orders = $this->getDoctrine()->getRepository("AppBundle:Order")->findBy(array("restaurant" => $objUser->getRestaurant()));
        return $this->render('AppBundle:Order:list_orders.html.twig', array(
            "orders" => $orders
        ));
    }

    public function showOrderAction($id)
    {
        $order = $this->getDoctrine()->getRepository("AppBundle:Order")->find($id);
        return $this->render('AppBundle:Order:show_order.html.twig', array(
            "order" => $order,
            "ajd" => (new \DateTime())->format("Y-m-d H:i:s")
        ));
    }

    public function postOrderAction()
    {
        return $this->render('AppBundle:Order:post_order.html.twig', array(
            // ...
        ));
    }

}
