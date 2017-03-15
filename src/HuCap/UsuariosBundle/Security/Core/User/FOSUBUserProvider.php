<?php

namespace HuCap\UsuariosBundle\Security\Core\User;

use HWI\Bundle\OAuthBundle\OAuth\Response\UserResponseInterface;
use HWI\Bundle\OAuthBundle\Security\Core\User\FOSUBUserProvider as BaseClass;

class FOSUBUserProvider extends BaseClass
{
	/**
	 * {@inheritdoc}
	 */
	public function loadUserByOAuthUserResponse(UserResponseInterface $response)
	{
		$username = $response->getUsername();
		$user = $this->userManager->findUserBy(array($this->getProperty($response) => $username));
		
		if (null !== $user) {
			return $user;
		}else{
			$email = $response->getEmail();
			
			if (!empty($email)) {
				$user = $this->userManager->findUserByUsername($email);
			}
			
			// Si no se encontro ningun usuario
			if ( empty ( $user ) ) {
				$user = $this->userManager->createUser();
	
				$user->setUsername($response->getEmail());
				$user->setEmail($response->getEmail());
				$user->setPassword($response->getEmail());
				$user->setEnabled(true);
				$this->userManager->updateUser($user);
			}
			
			$property = $this->getProperty($response);
			$this->accessor->setValue($user, $property, $username);
			return $user;
		}
		
		return parent::loadUserByOAuthUserResponse($response);
	}
}