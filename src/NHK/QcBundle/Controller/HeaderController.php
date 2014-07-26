<?php

namespace NHK\QcBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HeaderController extends Controller
{
    public function indexAction()
    {
        $arrayRender =  array();
        return $this->render('NHKQcBundle:Header:index.html.php',$arrayRender);
    }
}
