<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Party;
use AppBundle\Service\FileUploader;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Party controller.
 *
 * @Route("party")
 */
class PartyController extends ContentController
{
    /**
     * @return string
     */
    protected function getModelClass()
    {
        return Party::class;
    }

    /**
     * @Route("/", name="party_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        return parent::indexAction();
    }

    /**
     * @Route("/new", name="party_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request, FileUploader $fileUploader)
    {
       return parent::newAction($request, $fileUploader);
    }

    /**
     * @Route("/{id}", name="party_show")
     * @Method("GET")
     */
    public function showAction(Party $party)
    {
        return $this->show($party);
    }

    /**
     * @Route("/{id}/edit", name="party_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Party $party, FileUploader $fileUploader)
    {
       return $this->edit($request, $party, $fileUploader);
    }

    /**
     * @Route("/{id}", name="party_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Party $party)
    {
        return $this->delete($request, $party);
    }
}
