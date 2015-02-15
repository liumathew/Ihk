<?php

namespace Ihk\BaseBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Ihk\BaseBundle\Entity\Kitchen;
use Ihk\BaseBundle\Form\KitchenType;

/**
 * Kitchen controller.
 *
 * @Route("/kitchen")
 */
class KitchenController extends Controller
{

	/**
	 * Lists all Kitchen entities.
	 *
	 * @Route("/", name="kitchen")
	 * @Method("GET")
	 * @Template()
	 */
	public function indexAction()
	{
		$em = $this->getDoctrine()->getManager();

		$entities = $em->getRepository('IhkBaseBundle:Kitchen')->findAll();

		return array(
			'entities' => $entities,
		);
	}

	/**
	 * Creates a new Kitchen entity.
	 *
	 * @Route("/", name="kitchen_create")
	 * @Method("POST")
	 * @Template("IhkBaseBundle:Kitchen:new.html.twig")
	 */
	public function createAction(Request $request)
	{
		$entity = new Kitchen();
		$form   = $this->createCreateForm($entity);
		$form->handleRequest($request);

		if ($form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($entity);
			$em->flush();

			return $this->redirect($this->generateUrl('kitchen_show', array('id' => $entity->getId())));
		}

		return array(
			'entity' => $entity,
			'form'   => $form->createView(),
		);
	}

	/**
	 * Creates a form to create a Kitchen entity.
	 *
	 * @param Kitchen $entity The entity
	 *
	 * @return \Symfony\Component\Form\Form The form
	 */
	private function createCreateForm(Kitchen $entity)
	{
		$form = $this->createForm(new KitchenType(), $entity, array(
			'action' => $this->generateUrl('kitchen_create'),
			'method' => 'POST',
		));

		$form->add('submit', 'submit', array('label' => 'Create'));

		return $form;
	}

	/**
	 * Displays a form to create a new Kitchen entity.
	 *
	 * @Route("/new", name="kitchen_new")
	 * @Method("GET")
	 * @Template()
	 */
	public function newAction()
	{
		$entity = new Kitchen();
		$form   = $this->createCreateForm($entity);

		return array(
			'entity' => $entity,
			'form'   => $form->createView(),
		);
	}

	/**
	 * Finds and displays a Kitchen entity.
	 *
	 * @Route("/{id}", name="kitchen_show")
	 * @Method("GET")
	 * @Template()
	 */
	public function showAction($id)
	{
		$em = $this->getDoctrine()->getManager();

		$entity = $em->getRepository('IhkBaseBundle:Kitchen')->find($id);

		if (!$entity) {
			throw $this->createNotFoundException('Unable to find Kitchen entity.');
		}

		$deleteForm = $this->createDeleteForm($id);

		return array(
			'entity'      => $entity,
			'delete_form' => $deleteForm->createView(),
		);
	}

	/**
	 * Displays a form to edit an existing Kitchen entity.
	 *
	 * @Route("/{id}/edit", name="kitchen_edit")
	 * @Method("GET")
	 * @Template()
	 */
	public function editAction($id)
	{
		$em = $this->getDoctrine()->getManager();

		$entity = $em->getRepository('IhkBaseBundle:Kitchen')->find($id);

		if (!$entity) {
			throw $this->createNotFoundException('Unable to find Kitchen entity.');
		}

		$editForm   = $this->createEditForm($entity);
		$deleteForm = $this->createDeleteForm($id);

		return array(
			'entity'      => $entity,
			'edit_form'   => $editForm->createView(),
			'delete_form' => $deleteForm->createView(),
		);
	}

	/**
	 * Creates a form to edit a Kitchen entity.
	 *
	 * @param Kitchen $entity The entity
	 *
	 * @return \Symfony\Component\Form\Form The form
	 */
	private function createEditForm(Kitchen $entity)
	{
		$form = $this->createForm(new KitchenType(), $entity, array(
			'action' => $this->generateUrl('kitchen_update', array('id' => $entity->getId())),
			'method' => 'PUT',
		));

		$form->add('submit', 'submit', array('label' => 'Update'));

		return $form;
	}

	/**
	 * Edits an existing Kitchen entity.
	 *
	 * @Route("/{id}", name="kitchen_update")
	 * @Method("PUT")
	 * @Template("IhkBaseBundle:Kitchen:edit.html.twig")
	 */
	public function updateAction(Request $request, $id)
	{
		$em = $this->getDoctrine()->getManager();

		$entity = $em->getRepository('IhkBaseBundle:Kitchen')->find($id);

		if (!$entity) {
			throw $this->createNotFoundException('Unable to find Kitchen entity.');
		}

		$deleteForm = $this->createDeleteForm($id);
		$editForm   = $this->createEditForm($entity);
		$editForm->handleRequest($request);

		if ($editForm->isValid()) {
			$em->flush();

			return $this->redirect($this->generateUrl('kitchen_edit', array('id' => $id)));
		}

		return array(
			'entity'      => $entity,
			'edit_form'   => $editForm->createView(),
			'delete_form' => $deleteForm->createView(),
		);
	}

	/**
	 * Deletes a Kitchen entity.
	 *
	 * @Route("/{id}", name="kitchen_delete")
	 * @Method("DELETE")
	 */
	public function deleteAction(Request $request, $id)
	{
		$form = $this->createDeleteForm($id);
		$form->handleRequest($request);

		if ($form->isValid()) {
			$em     = $this->getDoctrine()->getManager();
			$entity = $em->getRepository('IhkBaseBundle:Kitchen')->find($id);

			if (!$entity) {
				throw $this->createNotFoundException('Unable to find Kitchen entity.');
			}

			$em->remove($entity);
			$em->flush();
		}

		return $this->redirect($this->generateUrl('kitchen'));
	}

	/**
	 * Creates a form to delete a Kitchen entity by id.
	 *
	 * @param mixed $id The entity id
	 *
	 * @return \Symfony\Component\Form\Form The form
	 */
	private function createDeleteForm($id)
	{
		return $this->createFormBuilder()
			->setAction($this->generateUrl('kitchen_delete', array('id' => $id)))
			->setMethod('DELETE')
			->add('submit', 'submit', array('label' => 'Delete'))
			->getForm();
	}

	/**
	 * Finds and displays Dishes in Kitchen.
	 *
	 * @Route("/{id}/dishes", name="kitchen_show_dishes")
	 * @Method("GET")
	 * @Template("IhkBaseBundle:Kitchen:dishes.html.twig")
	 */
	public function showDishesAction($id)
	{
		$em = $this->getDoctrine()->getManager();

		$kitchen = $em->getRepository('IhkBaseBundle:Kitchen')->find($id);
		if (!$kitchen) {
			throw $this->createNotFoundException('Unable to find Kitchen entity.');
		}

		$dishes = $em->getRepository('IhkBaseBundle:Dish')->findByKitchenId($id);
		if (!$dishes) {
			throw $this->createNotFoundException('Unable to find Dish entity.');
		}

		return array(
			'kitchen' => $kitchen,
			'dishes'  => $dishes,
		);
	}
}
