<?php

namespace HuCap\UsuariosBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	protected $id;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="google_id", type="string", length=255, unique=true, nullable=true)
	 */
	protected $googleId;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="linkedin_id", type="string", length=255, unique=true, nullable=true)
	 */
	protected $linkedinId;
	
	
	public function __construct()
	{
		parent::__construct();
		// your own logic
	}
	
	/**
	 * @return string
	 */
	public function getGoogleId(){
		return $this->googleId;
	}
	
	/**
	 * @param string $googleId
	 */
	public function setGoogleId($googleId){
		$this->googleId = $googleId;
	}
	
	/**
	 * @return string
	 */
	public function getLinkedinId(){
		return $this->linkedinId;
	}
	
	/**
	 * @param string $linkedinId
	 */
	public function setLinkedinId($linkedinId){
		$this->linkedinId = $linkedinId;
	}
}