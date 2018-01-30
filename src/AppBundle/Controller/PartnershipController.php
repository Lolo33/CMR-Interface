<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Contract;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class PartnershipController extends Controller
{
    public function getPartnershipAction()
    {
        $partners = $this->getDoctrine()->getRepository("AppBundle:Contract")->findAll();
        return $this->render('AppBundle:Partnership:get_partnership.html.twig', array(
            "partners" => $partners
        ));
    }

    public function postPartnershipAction($id)
    {
        $em = $this->get("doctrine.orm.entity_manager");
        $contract = $this->getDoctrine()->getRepository("AppBundle:Contract")->find($id);
        if ($this->getUser() != null && $this->getUser()->getRestaurant() != null){
            $contract->setAccepted(true);
            $em->merge($contract);
            $em->flush();
            $partners = $this->getDoctrine()->getRepository("AppBundle:Contract")->findAll();
            return $this->redirectToRoute("get_partnership");
        }
    }

    public function deletePartnershipAction($id)
    {
        $em = $this->get("doctrine.orm.entity_manager");
        $contract = $this->getDoctrine()->getRepository("AppBundle:Contract")->find($id);
        if ($this->getUser() != null){
            if ($this->getUser()->getRestaurant()->getId() == $contract->getId()){
                $contract->setAccepted(false);
                $em->merge($contract);
                $em->flush();
                $partners = $this->getDoctrine()->getRepository("AppBundle:Contract")->findAll();
                return $this->redirectToRoute("get_partnership");
            }
        }
    }

    public function getPartnerAction($id)
    {
        return $this->render('AppBundle:Partnership:get_partner.html.twig', array(
            // ...
        ));
    }

}
