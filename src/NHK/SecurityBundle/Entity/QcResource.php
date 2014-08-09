<?php

namespace NHK\SecurityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * QcResource
 */
class QcResource
{
    /**
     * @var string
     */
    private $controller;

    /**
     * @var string
     */
    private $controllerName;

    /**
     * @var string
     */
    private $route;

    /**
     * @var string
     */
    private $routeName;

    /**
     * @var integer
     */
    private $id;


    /**
     * Set controller
     *
     * @param string $controller
     * @return QcResource
     */
    public function setController($controller)
    {
        $this->controller = $controller;

        return $this;
    }

    /**
     * Get controller
     *
     * @return string 
     */
    public function getController()
    {
        return $this->controller;
    }

    /**
     * Set controllerName
     *
     * @param string $controllerName
     * @return QcResource
     */
    public function setControllerName($controllerName)
    {
        $this->controllerName = $controllerName;

        return $this;
    }

    /**
     * Get controllerName
     *
     * @return string 
     */
    public function getControllerName()
    {
        return $this->controllerName;
    }

    /**
     * Set route
     *
     * @param string $route
     * @return QcResource
     */
    public function setRoute($route)
    {
        $this->route = $route;

        return $this;
    }

    /**
     * Get route
     *
     * @return string 
     */
    public function getRoute()
    {
        return $this->route;
    }

    /**
     * Set routeName
     *
     * @param string $routeName
     * @return QcResource
     */
    public function setRouteName($routeName)
    {
        $this->routeName = $routeName;

        return $this;
    }

    /**
     * Get routeName
     *
     * @return string 
     */
    public function getRouteName()
    {
        return $this->routeName;
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * @var integer
     */
    private $parentId;

    /**
     * @var integer
     */
    private $level;

    /**
     * @var boolean
     */
    private $status;


    /**
     * Set parentId
     *
     * @param integer $parentId
     * @return QcResource
     */
    public function setParentId($parentId)
    {
        $this->parentId = $parentId;

        return $this;
    }

    /**
     * Get parentId
     *
     * @return integer 
     */
    public function getParentId()
    {
        return $this->parentId;
    }

    /**
     * Set level
     *
     * @param integer $level
     * @return QcResource
     */
    public function setLevel($level)
    {
        $this->level = $level;

        return $this;
    }

    /**
     * Get level
     *
     * @return integer 
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * Set status
     *
     * @param boolean $status
     * @return QcResource
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return boolean 
     */
    public function getStatus()
    {
        return $this->status;
    }
}
