<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Restaurant;
use AppBundle\Entity\ScheduleBooking;
use AppBundle\Entity\ScheduleFormatted;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ScheduleController extends Controller
{

    public function formatterHorairesRestaurant(Restaurant $Restaurant, $dates){
        $arrayNewSchedule = [];
        foreach ($Restaurant->getScheduleList() as $schedule) {
            foreach ($dates as $date) {
                if ($schedule->getDayOpening() == $date->format("w")){
                    $arrayNewSchedule[] = new ScheduleFormatted($schedule, $date, "FR");
                }
            }
        }
        $Restaurant->setRealHours($arrayNewSchedule);
        return $Restaurant;
    }

    public function getSchedulesAction()
    {
        $restau = $this->getUser()->getRestaurant();
        $dates_week = [];
        for ($i=0; $i<7; $i++){
            $dt = new \DateTime();
            $dt->add(new \DateInterval("P" . $i . "D"));
            $dates_week[] = $dt;
        }
        $tabLundi = [];
        $tabMardi = [];
        $tabMercredi = [];
        $tabJeudi = [];
        $tabVendredi = [];
        $tabSamedi = [];
        $tabDimanche = [];
        $restau = $this->formatterHorairesRestaurant($restau, $dates_week);
        //var_dump($restau->getRealHours());
        foreach ($restau->getRealHours() as $hour){
            switch ($hour->getSchedule()->getDayOpening()){
                case 1:
                    $tabLundi[] = $hour;
                    break;
                case 2:
                    $tabMardi[] = $hour;
                    break;
                case 3:
                    $tabMercredi[] = $hour;
                    break;
                case 4:
                    $tabJeudi[] = $hour;
                    break;
                case 5:
                    $tabVendredi[] = $hour;
                    break;
                case 6:
                    $tabSamedi[] = $hour;
                    break;
                case 0:
                    $tabDimanche[] = $hour;
                    break;
            }
        }
        $schedules = array($tabLundi, $tabMardi, $tabMercredi, $tabJeudi, $tabVendredi, $tabSamedi, $tabDimanche);
        if ($restau != null) {
            return $this->render('AppBundle:Schedule:get_schedules.html.twig', array(
                "schedules" => $schedules
            ));
        }else{
            return new Response(null, 403);
        }
    }

    public function postScheduleAction(Request $request)
    {
        $em = $this->get("doctrine.orm.entity_manager");
        $timeOpening = $request->get("timeOpening");
        $timeClosing = $request->get("timeClosing");
        $dayOpening = $request->get("dayOpening");
        $dayClosing = $request->get("dayClosing");
        $user = $this->getUser();
        if ($user != null) {
            $restau = $user->getRestaurant();
            if ($restau != null) {
                if ($timeOpening != null && $timeClosing != null && $dayOpening != null && $dayClosing != null) {
                    $timeOpening = new \DateTime($timeOpening);
                    $timeClosing = new \DateTime($timeClosing);
                    $schedulesExisting = $this->getDoctrine()->getRepository("AppBundle:ScheduleBooking")->findBy(array("dayOpening" => $dayOpening));
                    $in = false;
                    foreach ($schedulesExisting as $sch){
                        if (($timeOpening > new \DateTime($sch->getHourOpening()) && $timeOpening < new \DateTime($sch->getHourClosing())) || ($timeClosing > new \DateTime($sch->getHourOpening()) && $timeClosing < new \DateTime($sch->getHourClosing()))){
                            $in = true;
                        }
                    }
                    if (!$in && $timeOpening < $timeClosing && ($dayClosing - $dayOpening) <= 1 ) {
                        $newHor = new ScheduleBooking();
                        $newHor->setRestaurant($restau);
                        $newHor->setDayOpening($dayOpening);
                        $newHor->setDayClosing($dayClosing);
                        $newHor->setHourOpening($timeOpening);
                        $newHor->setHourClosing($timeClosing);
                        $newHor->setHourService(0);
                        $em->persist($newHor);
                        $em->flush();
                        return $this->redirectToRoute("get_schedules");
                    }else {
                        return new Response("Horaires incorrectes : veuillez saisir des horaires non comprises dans un service existant ce jour la, et ne dépassant pas 1 jour d'écart.", 400);
                    }
                } else {
                    return new Response(null, 400);
                }
            }else{
                return new Response(null, 400);
            }
        }else{
            return new Response(null, 400);
        }
    }

    public function updateScheduleAction(Request $request)
    {
        $em = $this->get("doctrine.orm.entity_manager");
        $user = $this->getUser();
        $hourOpening = new \DateTime($request->get("timeOpen"));
        $id = $request->get("id");
        $hourClosing = new \DateTime($request->get("timeClose"));
        if ($user != null) {
            $restau = $user->getRestaurant();
            if ($restau != null) {
                $schedule = $this->getDoctrine()->getRepository("AppBundle:ScheduleBooking")->find($id);
                if (!empty($schedule) && $schedule->getRestaurant() == $restau){
                    $schedule->setHourOpening($hourOpening);
                    $schedule->setHourClosing($hourClosing);
                    $em->merge($schedule);
                    $em->flush();
                    return $this->redirectToRoute("get_schedules");
                }else
                    return new Response("Cet horaire ne correspond pas à votre restaurant ou n'existe pas. Accès refusé", 400);
            }else
                return new Response("", 400);
        }else
            return new Response("", 400);
    }

    public function deleteScheduleAction($id)
    {
        $em = $this->get("doctrine.orm.entity_manager");
        $user = $this->getUser();
        if ($user != null) {
            $restau = $user->getRestaurant();
            if ($restau != null) {
                $schedule = $this->getDoctrine()->getRepository("AppBundle:ScheduleBooking")->find($id);
                if (!empty($schedule) && $schedule->getRestaurant() == $restau){
                    $em->remove($schedule);
                    $em->flush();
                    return $this->redirectToRoute("get_schedules");
                }else
                    return new Response("Cet horaire ne correspond pas à votre restaurant ou n'existe pas. Accès refusé", 400);
            }else
                return new Response("", 400);
        }else
            return new Response("", 400);
    }

}
