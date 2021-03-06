<?php

namespace Ihk\BaseBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Ihk\BaseBundle\Entity\Rule;
use Ihk\BaseBundle\Form\RuleType;

/**
 * Rule controller.
 *
 * @Route("/rule")
 */
class RuleController extends Controller
{

    /**
     * Lists all Rule entities.
     *
     * @Route("/", name="rule")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('IhkBaseBundle:Rule')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Rule entity.
     *
     * @Route("/", name="rule_create")
     * @Method("POST")
     * @Template("IhkBaseBundle:Rule:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Rule();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('rule_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Rule entity.
     *
     * @param Rule $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Rule $entity)
    {
        $form = $this->createForm(new RuleType(), $entity, array(
            'action' => $this->generateUrl('rule_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Rule entity.
     *
     * @Route("/new", name="rule_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Rule();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Rule entity.
     *
     * @Route("/{id}", name="rule_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('IhkBaseBundle:Rule')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Rule entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Rule entity.
     *
     * @Route("/{id}/edit", name="rule_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('IhkBaseBundle:Rule')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Rule entity.');
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
    * Creates a form to edit a Rule entity.
    *
    * @param Rule $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Rule $entity)
    {
        $form = $this->createForm(new RuleType(), $entity, array(
            'action' => $this->generateUrl('rule_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Rule entity.
     *
     * @Route("/{id}", name="rule_update")
     * @Method("PUT")
     * @Template("IhkBaseBundle:Rule:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('IhkBaseBundle:Rule')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Rule entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('rule_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Rule entity.
     *
     * @Route("/{id}", name="rule_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('IhkBaseBundle:Rule')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Rule entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('rule'));
    }

    /**
     * Creates a form to delete a Rule entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('rule_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
