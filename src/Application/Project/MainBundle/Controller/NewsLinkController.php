<?php

namespace Application\Project\MainBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Application\Project\MainBundle\Entity\NewsLink;
use Application\Project\MainBundle\Form\NewsLinkType;

/**
 * NewsLink controller.
 *
<<<<<<< HEAD
 * @Route("/news_link")
=======
 * @Route("/news")
>>>>>>> 088c128b5d3c8fc55bd8fc171363dc03b4423771
 */
class NewsLinkController extends Controller
{

    /**
     * Lists all NewsLink entities.
     *
<<<<<<< HEAD
     * @Route("/", name="news_link")
=======
     * @Route("/", name="news")
>>>>>>> 088c128b5d3c8fc55bd8fc171363dc03b4423771
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('MainBundle:NewsLink')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new NewsLink entity.
     *
<<<<<<< HEAD
     * @Route("/", name="news_link_create")
=======
     * @Route("/", name="news_create")
>>>>>>> 088c128b5d3c8fc55bd8fc171363dc03b4423771
     * @Method("POST")
     * @Template("MainBundle:NewsLink:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new NewsLink();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('news_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a NewsLink entity.
    *
    * @param NewsLink $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(NewsLink $entity)
    {
        $form = $this->createForm(new NewsLinkType(), $entity, array(
            'action' => $this->generateUrl('news_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new NewsLink entity.
     *
<<<<<<< HEAD
     * @Route("/new", name="news_link_new")
=======
     * @Route("/new", name="news_new")
>>>>>>> 088c128b5d3c8fc55bd8fc171363dc03b4423771
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new NewsLink();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a NewsLink entity.
     *
<<<<<<< HEAD
     * @Route("/{id}", name="news_link_show")
=======
     * @Route("/{id}", name="news_show")
>>>>>>> 088c128b5d3c8fc55bd8fc171363dc03b4423771
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MainBundle:NewsLink')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find NewsLink entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing NewsLink entity.
     *
<<<<<<< HEAD
     * @Route("/{id}/edit", name="news_link_edit")
=======
     * @Route("/{id}/edit", name="news_edit")
>>>>>>> 088c128b5d3c8fc55bd8fc171363dc03b4423771
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MainBundle:NewsLink')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find NewsLink entity.');
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
    * Creates a form to edit a NewsLink entity.
    *
    * @param NewsLink $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(NewsLink $entity)
    {
        $form = $this->createForm(new NewsLinkType(), $entity, array(
            'action' => $this->generateUrl('news_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing NewsLink entity.
     *
<<<<<<< HEAD
     * @Route("/{id}", name="news_link_update")
=======
     * @Route("/{id}", name="news_update")
>>>>>>> 088c128b5d3c8fc55bd8fc171363dc03b4423771
     * @Method("PUT")
     * @Template("MainBundle:NewsLink:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MainBundle:NewsLink')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find NewsLink entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('news_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a NewsLink entity.
     *
<<<<<<< HEAD
     * @Route("/{id}", name="news_link_delete")
=======
     * @Route("/{id}", name="news_delete")
>>>>>>> 088c128b5d3c8fc55bd8fc171363dc03b4423771
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('MainBundle:NewsLink')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find NewsLink entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('news'));
    }

    /**
     * Creates a form to delete a NewsLink entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('news_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
