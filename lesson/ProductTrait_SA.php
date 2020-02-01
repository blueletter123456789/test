<?php

namespace Customize\Entity;

use Doctrine\ORM\Mapping as ORM;
use Eccube\Annotation\EntityExtension;
use Eccube\Annotation as Eccube;

	/**
	* @EntityExtension("Eccube\Entity\Product")
	*/

	/**
	* @Eccube\EntityExtension("Eccube\Entity\Product")
	*/


trait ProductTrait
{

	/**
     * @ORM\Column(type="string", nullable=true)
     */

	/*
	* @var string
	* @ORM\Column(name="weight", type="string", nullable=true)
	* @Eccube\FormAppend(
	* auto_render=true, 
	* options={
	* 		"required": false, 
	* 		"label":"重量"
	* 	}
	*)
	*/

    public $weight;

}

?>