<?php

namespace NHK\SecurityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AclClasses
 */
class AclClasses
{
    /**
     * @var string
     */
    private $classType;

    /**
     * @var integer
     */
    private $id;


    /**
     * Set classType
     *
     * @param string $classType
     * @return AclClasses
     */
    public function setClassType($classType)
    {
        $this->classType = $classType;

        return $this;
    }

    /**
     * Get classType
     *
     * @return string 
     */
    public function getClassType()
    {
        return $this->classType;
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
