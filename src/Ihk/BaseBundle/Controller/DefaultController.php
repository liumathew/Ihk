<?php

namespace Ihk\BaseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use \Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use \Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use \Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
	/**
	 * @Route("", name="ihk_base_default.homepage")
	 * @Method({"GET"})
	 * @template("IhkBaseBundle:Default:index.html.twig")
	 */
    public function indexAction(Request $request)
    {
		$tags=$this->getTags();

		return  array(
			'tags' => $tags,
		);
    }

	private function getHotKitchens(Request $request)
	{
		/** @var \Doctrine\ORM\EntityManager */
		$em = $this->getDoctrine()->getManager();

		$dql = "SELECT k FROM IhkBaseBundle:Kitchen k ORDER BY k.score DESC";

		$query = $em->createQuery($dql);

		$paginator = $this->get('knp_paginator');

		$pagination = $paginator->paginate(
			$query,
			$request->query->get('page', 1), /*page number*/
			3/*limit per page*/
		);

		// parameters to template
		return  $pagination;

	}

	private function getLatestKitchens(Request $request)
	{
		/** @var \Doctrine\ORM\EntityManager */
		$em = $this->getDoctrine()->getManager();

		$dql = "SELECT k FROM IhkBaseBundle:Kitchen k ORDER BY k.id DESC";

		$query = $em->createQuery($dql);

		$paginator = $this->get('knp_paginator');

		$pagination = $paginator->paginate(
			$query,
			$request->query->get('page', 1), /*page number*/
			3/*limit per page*/
		);

		// parameters to template
		return  $pagination;
	}

	private function getHotDishes(Request $request)
	{
		/** @var \Doctrine\ORM\EntityManager */
		$em = $this->getDoctrine()->getManager();

		$dql = "SELECT k FROM IhkBaseBundle:Dish k ORDER BY k.score DESC";

		$query = $em->createQuery($dql);

		$paginator = $this->get('knp_paginator');

		$pagination = $paginator->paginate(
			$query,
			$request->query->get('page', 1), /*page number*/
			3/*limit per page*/
		);

		// parameters to template
		return  $pagination;
	}
	private function getLatestDishes(Request $request)
	{
		/** @var \Doctrine\ORM\EntityManager */
		$em = $this->getDoctrine()->getManager();

		$dql = "SELECT k FROM IhkBaseBundle:Dish k ORDER BY k.id DESC";

		$query = $em->createQuery($dql);

		$paginator = $this->get('knp_paginator');

		$pagination = $paginator->paginate(
			$query,
			$request->query->get('page', 1), /*page number*/
			3/*limit per page*/
		);

		// parameters to template
		return  $pagination;
	}

	private function getCategories(){
		/** @var \Doctrine\ORM\EntityManager */
		$em = $this->getDoctrine()->getManager();

		$categories = $em->getRepository('IhkBaseBundle:Category')->findAll();

		return $categories;
	}

	private function getTags()
	{
		/** @var \Doctrine\ORM\EntityManager */
		$em = $this->getDoctrine()->getManager();

		$tags = $em->getRepository('IhkBaseBundle:Tag')->findAll();

		return $tags;
	}
}
