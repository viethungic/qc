<?php

namespace NHK\SecurityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * QcMenu
 */
class QcMenu
{
    /**
     * @var integer
     */
    private $parentId;

    /**
     * @var string
     */
    private $menuName;

    /**
     * @var string
     */
    private $menuRoute;

    /**
     * @var integer
     */
    private $id;


    /**
     * Set parentId
     *
     * @param integer $parentId
     * @return QcMenu
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
     * Set menuName
     *
     * @param string $menuName
     * @return QcMenu
     */
    public function setMenuName($menuName)
    {
        $this->menuName = $menuName;

        return $this;
    }

    /**
     * Get menuName
     *
     * @return string 
     */
    public function getMenuName()
    {
        return $this->menuName;
    }

    /**
     * Set menuRoute
     *
     * @param string $menuRoute
     * @return QcMenu
     */
    public function setMenuRoute($menuRoute)
    {
        $this->menuRoute = $menuRoute;

        return $this;
    }

    /**
     * Get menuRoute
     *
     * @return string 
     */
    public function getMenuRoute()
    {
        return $this->menuRoute;
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
}
