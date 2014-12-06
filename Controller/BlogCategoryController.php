<?php

namespace Mockizart\BlogBundle\Controller;

use Symfony\Component\HttpFoundation\Request;

/**
 * BlogCategory controller.
 *
 */
class BlogCategoryController extends BaseController
{

    public function getParam($name)
    {
        $this->setParams('category');
        return parent::getParam($name);
    }

    /**
     * Lists all BlogCategory entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository($this->getParam('entity_alias'))->findAll();

        return $this->render($this->getParam('entity_alias') . ':index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Creates a new BlogCategory entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = $this->getEntityService()
            ->setRequest($request)
            ->setEntity()
            ->getEntity();

        $form = $this->get($this->getParam('service_form_name'))->createForm($entity);
        $id = $this->getEntityService()->create($form);

        if ($id) {
            return $this->redirect($this->generateUrl($this->routesNames['show'], array('id' => $id)));
        }

        return $this->render($this->getParam('entity_alias') . ':new.html.twig', array(
            'entity' => $this->getEntityService()->setEntity()->getEntity(),
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to create a new BlogCategory entity.
     *
     */
    public function newAction()
    {
        $entity = $this->getEntityService()
            ->setEntity()
            ->getEntity();
        $form = $this->get($this->getParam('service_form_name'));

        return $this->render($this->getParam('entity_alias') . ':new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createForm($entity)->createView(),
        ));
    }

    /**
     * Finds and displays a MockblogCategory entity.
     *
     */
    public function showAction($id)
    {
        $entity = $this->getEntityService()->find($id);
        $deleteForm = $this->get($this->getParam('service_form_name'))->deleteForm($id);

        return $this->render($this->getParam('entity_alias') . ':show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing MockblogCategory entity.
     *
     */
    public function editAction($id)
    {
        $entity = $this->getEntityService()->setEntity()->find($id);
        $form = $this->get($this->getParam('service_form_name'));
        $editForm = $form->editForm($entity);
        $deleteForm = $form->deleteForm($id);

        return $this->render($this->getParam('entity_alias') . ':edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));

    }

    /**
     * Edits an existing MockblogCategory entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $entity = $this->getEntityService()
            ->setRequest($request)
            ->setEntity()
            ->find($id);
        $form = $this->get($this->getParam('service_form_name'));

        $deleteForm = $form->deleteForm($id);
        $editForm = $form->editForm($entity);

        if ($this->getEntityService()->save($editForm)) {
            return $this->redirect($this->generateUrl($this->routesNames['edit'], array('id' => $id)));
        }

        return $this->render($this->getParam('entity_alias') . ':edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a MockblogCategory entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->get($this->getParam('service_form_name'))->deleteForm($id);
        $this->getEntityService()
            ->setRequest($request)
            ->setEntity($id)
            ->delete($form);
        return $this->redirect($this->generateUrl($this->routesNames['list']));
    }
}
