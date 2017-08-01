<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Eventseries;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Eventseries controller.
 *
 * @Route("eventseries")
 */
class EventseriesController extends Controller
{
    /**
     * Lists all eventseries entities.
     *
     * @Route("/", name="eventseries_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $eventseries = $em->getRepository('AppBundle:Eventseries')->findAll();

        return $this->render('eventseries/index.html.twig', array(
            'eventseries' => $eventseries,
        ));
    }

    /**
     * Creates a new eventseries entity.
     *
     * @Route("/new", name="eventseries_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $eventseries = new Eventseries();
        $form = $this->createForm('AppBundle\Form\EventseriesType', $eventseries);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($eventseries);
            $em->flush();

            return $this->redirectToRoute('eventseries_show', array('id' => $eventseries->getId()));
        }

        return $this->render('eventseries/edit.html.twig', array(
            'model' => $eventseries,
            'edit_form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a eventseries entity.
     *
     * @Route("/{id}", name="eventseries_show")
     * @Method("GET")
     */
    public function showAction(Eventseries $eventseries)
    {
        $deleteForm = $this->createDeleteForm($eventseries);

        return $this->render('eventseries/show.html.twig', array(
            'eventseries' => $eventseries,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing eventseries entity.
     *
     * @Route("/{id}/edit", name="eventseries_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Eventseries $eventseries)
    {
        $deleteForm = $this->createDeleteForm($eventseries);
        $editForm = $this->createForm('AppBundle\Form\EventseriesType', $eventseries);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('eventseries_edit', array('id' => $eventseries->getId()));
        }

        return $this->render('eventseries/edit.html.twig', array(
            'eventseries' => $eventseries,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a eventseries entity.
     *
     * @Route("/{id}", name="eventseries_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Eventseries $eventseries)
    {
        $form = $this->createDeleteForm($eventseries);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($eventseries);
            $em->flush();
        }

        return $this->redirectToRoute('eventseries_index');
    }

    /**
     * Creates a form to delete a eventseries entity.
     *
     * @param Eventseries $eventseries The eventseries entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Eventseries $eventseries)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('eventseries_delete', array('id' => $eventseries->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
