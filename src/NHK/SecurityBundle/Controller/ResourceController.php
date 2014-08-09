<?php

namespace NHK\SecurityBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ResourceController extends Controller
{
    public function indexAction()
    {
        $routes = $this->getAllRouting();
        var_dump($routes);
        $arrayReturn = array();
        return $this->render('NHKSecurityBundle:Resource:index.html.php', $arrayReturn);
    }
    
    public function getAllRouting(){
        /** @var $router \Symfony\Component\Routing\Router */
        $router = $this->container->get('router');
        /** @var $collection \Symfony\Component\Routing\RouteCollection */
        $collection = $router->getRouteCollection();
        $allRoutes = $collection->all();
    
        $routes = array();
    
        /** @var $params \Symfony\Component\Routing\Route */
        foreach ($allRoutes as $route => $params)
        {
            $defaults = $params->getDefaults();
    
            if (isset($defaults['_controller']))
            {
                $controllerAction = explode(':', $defaults['_controller']);
                $controller = $controllerAction[0];
    
                if (!isset($routes[$controller])) {
                    $routes[$controller] = array();
                }
    
                $routes[$controller][]= $route;
            }
        }
        return $routes;
    }
}
