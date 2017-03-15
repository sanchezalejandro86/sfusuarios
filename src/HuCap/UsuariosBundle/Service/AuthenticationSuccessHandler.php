<?php

namespace HuCap\UsuariosBundle\Service;

use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authentication\DefaultAuthenticationSuccessHandler;
use Symfony\Component\DependencyInjection\ContainerInterface;

class AuthenticationSuccessHandler extends DefaultAuthenticationSuccessHandler implements ContainerAwareInterface{

	/**
	 * @var ContainerInterface
	 */
	protected $container;
	/**
	 * Sets the container.
	 *
	 * @param ContainerInterface|null $container A ContainerInterface instance or null
	 */
	public function setContainer(ContainerInterface $container = null)
	{
		$this->container = $container;
	}

	public function onAuthenticationSuccess(Request $request, TokenInterface $token)
	{
		if ($url = $request->getSession()->get('_security.oauth_authorize.target_path')) {
			$newRequest = Request::create($url, 'GET');
			return $this->container->get('fos_oauth_server.server')->finishClientAuthorization(true, $token->getUser(), $newRequest, null);
		}		
		
		return parent::onAuthenticationSuccess($request, $token);
	}
	
}