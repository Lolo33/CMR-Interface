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

    public static function formaterPrix($prix){
        $prix_tab = explode(".", $prix);
        if (strlen($prix_tab[0]) == 1)
            $prix = "0".$prix;
        if (isset($prix_tab[1])) {
            if (strlen($prix_tab[1]) == 1)
                $prix .= "0";
        }else{
            $prix .= ".00";
        }
        return $prix;
    }

}