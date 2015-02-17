<?php

namespace Ihk\BaseBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Ihk\BaseBundle\Entity\Dish;
use Ihk\BaseBundle\Form\DishType;

/**
 * Dish controller.
 *
 * @Route("/dish")
 */
class DishController extends Controller
{

    /**
     * Lists all Dish entities.
     *
     * @Route("/", name="dish")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('IhkBaseBundle:Dish')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Dish entity.
     *
     * @Route("/", name="dish_create")
     * @Method("POST")
     * @Template("IhkBaseBundle:Dish:new.html.twig")
     */
    public function createAction(Request $request)
    {

        $entity = new Dish();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
			$em = $this->getDoctrine()->getManager();

			$ownerId = $this->getUser()->getId();
			$kitchen = $em->getRepository('IhkBaseBundle:Kitchen')->findOneByOwnerId($ownerId);
			$kitchenId = $kitchen->getId();
			$entity->setKitchenId($kitchenId);

            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('dish_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Dish entity.
     *
     * @param Dish $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Dish $entity)
    {


        $form = $this->createForm(new DishType(), $entity, array(
            'action' => $this->generateUrl('dish_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Dish entity.
     *
     * @Route("/new", name="dish_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Dish();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Dish entity.
     *
     * @Route("/{id}", name="dish_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('IhkBaseBundle:Dish')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Dish entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Dish entity.
     *
     * @Route("/{id}/edit", name="dish_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('IhkBaseBundle:Dish')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Dish entity.');
        }

		$kitchenId = $entity->getKitchenId();
		$kitchen   = $em->getRepository('IhkBaseBundle:Kitchen')->find($kitchenId);

		if (!$kitchen->isOwner($this->getUser())) {
			throw $this->createAccessDeniedException();
		}

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Dish entity.
    *
    * @param Dish $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Dish $entity)
    {
        $form = $this->createForm(new DishType(), $entity, array(
            'action' => $this->generateUrl('dish_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Dish entity.
     *
     * @Route("/{id}", name="dish_update")
     * @Method("PUT")
     * @Template("IhkBaseBundle:Dish:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
		$em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('IhkBaseBundle:Dish')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Dish entity.');
        }

		$kitchenId = $entity->getKitchenId();
		$kitchen   = $em->getRepository('IhkBaseBundle:Kitchen')->find($kitchenId);

		if (!$kitchen->isOwner($this->getUser())) {
			throw $this->createAccessDeniedException();
		}

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('dish_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Dish entity.
     *
     * @Route("/{id}", name="dish_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('IhkBaseBundle:Dish')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Dish entity.');
            }

			$kitchenId = $entity->getKitchenId();
			$kitchen   = $em->getRepository('IhkBaseBundle:Kitchen')->find($kitchenId);

			if (!$kitchen->isOwner($this->getUser())) {
				throw $this->createAccessDeniedException();
			}

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('dish'));
    }

    /**
     * Creates a form to delete a Dish entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('dish_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
