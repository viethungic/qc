<?php

namespace NHK\QcBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MenuController extends Controller
{
    public function indexAction()
    {
        $arrayRender =  array(
        );
        return $this->render('NHKQcBundle:Menu:index.html.php',$arrayRender);
    }
}
