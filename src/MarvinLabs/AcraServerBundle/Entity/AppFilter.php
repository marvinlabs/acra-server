<?php

namespace MarvinLabs\AcraServerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AppFilter
 *
 * @ORM\Table(name="acra_app_filter")
 * @ORM\Entity(repositoryClass="MarvinLabs\AcraServerBundle\Entity\AppFilterRepository")
 */
class AppFilter
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="package_name_regex", type="text", nullable=false)
     */
    private $packageNameRegEx;


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
     * Set packageNameRegEx
     *
     * @param string $packageNameRegEx
     * @return AppFilter
     */
    public function setPackageNameRegEx($packageNameRegEx)
    {
        $this->packageNameRegEx = $packageNameRegEx;
    
        return $this;
    }

    /**
     * Get packageNameRegEx
     *
     * @return string 
     */
    public function getPackageNameRegEx()
    {
        return $this->packageNameRegEx;
    }
}