<?php
/**
 * Created by PhpStorm.
 * User: Niquelesstup
 * Date: 17/10/2017
 * Time: 13:33
 */

namespace AppBundle\Entity;


use Symfony\Component\HttpFoundation\Response;

class Globals
{

    public static function errNotFound($message = "Ressource not found"){
        return \FOS\RestBundle\View\View::create(['message' => $message], Response::HTTP_NOT_FOUND);
    }

    public static function errForbidden($message = "Ressource not found"){
        return \FOS\RestBundle\View\View::create(['message' => $message], Response::HTTP_FORBIDDEN);
    }

}