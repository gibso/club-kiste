<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Party;
use AppBundle\Service\FileUploader;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Party controller.
 *
 * @Route("party")
 */
class PartyController extends Controller
{
    /**
     * Lists all party entities.
     *
     * @Route("/", name="party_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $parties = $em->getRepository('AppBundle:Party')->findBy([], ['doorsopen' => 'DESC']);
        return $this->render('party/index.html.twig', array(
            'models' => $parties,
            'modelName' => Party::MODEL_NAME,
            'active' => 'party'
        ));
    }

    /**
     * Creates a new party entity.
     *
     * @Route("/new", name="party_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request, FileUploader $fileUploader)
    {
        $party = new Party();
        $form = $this->createForm('AppBundle\Form\PartyType', $party);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($party->getImageFile()) {
                $fileName = $fileUploader->uploadFileTo(
                    $party->getImageFile(), $this->getParameter('images_directory')
                );
                $party->setImage($fileName);
            }
            $em = $this->getDoctrine()->getManager();
            $em->persist($party);
            $em->flush();

            return $this->redirectToRoute('party_show', array('id' => $party->getId()));
        }

        return $this->render('party/edit.html.twig', array(
            'model' => $party,
            'modelName' => Party::MODEL_NAME,
            'edit_form' => $form->createView(),
            'active' => 'party'
        ));
    }

    /**
     * Finds and displays a party entity.
     *
     * @Route("/{id}", name="party_show")
     * @Method("GET")
     */
    public function showAction(Party $party)
    {
        $deleteForm = $this->createDeleteForm($party);

        return $this->render('party/show.html.twig', [
            'model' => $party,
            'delete_form' => $deleteForm->createView(),
            'active' => 'party',
            'modelName' => Party::MODEL_NAME
        ]);
    }

    /**
     * Displays a form to edit an existing party entity.
     *
     * @Route("/{id}/edit", name="party_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Party $party, FileUploader $fileUploader)
    {
        $deleteForm = $this->createDeleteForm($party);
        $editForm = $this->createForm('AppBundle\Form\PartyType', $party);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            if ($party->getImageFile()) {
                $fileName = $fileUploader->uploadFileTo(
                    $party->getImageFile(), $this->getParameter('images_directory')
                );
                $party->setImage($fileName);
            }
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('party_edit', array('id' => $party->getId()));
        }

        return $this->render('party/edit.html.twig', array(
            'model' => $party,
            'edit_form' => $editForm->createView(),
            'modelName' => Party::MODEL_NAME,
            'delete_form' => $deleteForm->createView(),
            'active' => 'party'
        ));
    }

    /**
     * Deletes a party entity.
     *
     * @Route("/{id}", name="party_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Party $party)
    {
        $form = $this->createDeleteForm($party);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($party);
            $em->flush();
        }

        return $this->redirectToRoute('party_index');
    }

    /**
     * Creates a form to delete a party entity.
     *
     * @param Party $party The party entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Party $party)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('party_delete', array('id' => $party->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }
}
