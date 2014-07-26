<?php

namespace NHK\QcBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class BreadCrumbController extends Controller
{
    public function indexAction(Request $request)
    {
        $arrayRender =  array(
            'request' => $request
        );
        return $this->render('NHKQcBundle:BreadCrumb:index.html.php',$arrayRender);
    }
}
