<?php

namespace HuCap\UsuariosBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * @Route("/api")
 */
class ApiController extends Controller
{
	/**
	 * @Route("/articles")
	 */
	public function articlesAction()
	{
		$articles = array('article1', 'article2', 'article3');
		return new JsonResponse($articles);
	}

	/**
	 * @Route("/user")
	 */
	public function userAction()
	{
		$user = $this->container->get('security.context')->getToken()->getUser();
		if($user) {
			return new JsonResponse(array(
					'id' => $user->getId(),
					'username' => $user->getUsername()
			));
		}

		return new JsonResponse(array(
				'message' => 'User is not identified'
		));

	}
}