<?php

namespace HuCap\UsuariosBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;

class SecurityController extends Controller
{
	/**
	 * @Route("/oauth/v2/auth_login")
	 */
	public function loginAction(Request $request)
	{
		$session = $request->getSession();

		if ($request->attributes->has(Security::AUTHENTICATION_ERROR)) {
			$error = $request->attributes->get(Security::AUTHENTICATION_ERROR);
		} elseif (null !== $session && $session->has(Security::AUTHENTICATION_ERROR)) {
			$error = $session->get(Security::AUTHENTICATION_ERROR);
			$session->remove(Security::AUTHENTICATION_ERROR);
		} else {
			$error = '';
		}

		if ($error) {
			$error = $error->getMessage(); // WARNING! Symfony source code identifies this line as a potential security threat.
		}

		$lastUsername = (null === $session) ? '' : $session->get(Security::LAST_USERNAME);

		$csrfToken = $this->has('security.csrf.token_manager')
						? $this->get('security.csrf.token_manager')->getToken('authenticate')->getValue()
						: null;
		
		return $this->render('FOSUserBundle:Security:login.html.twig', array(
				'last_username' => $lastUsername,
				'error'         => $error,
				'csrf_token' 	=> $csrfToken,
		));
	}

	/**
	 * @Route("/oauth/v2/auth_login_check")
	 */
	public function loginCheckAction(Request $request)
	{

	}
}
