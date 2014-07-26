<?php

namespace NHK\QcBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MenuController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $platforms = $em->getRepository('NHKQcBundle:SellphonePlatform')->findBy(array('status'=>1));
        $arrayRender =  array(
            'platforms'    =>  $platforms
        );
        return $this->render('NHKQcBundle:Menu:index.html.php',$arrayRender);
    }
}
