<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Partner;
use AppBundle\Service\FileUploader;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class PartnerController
 * @package AppBundle\Controller
 * @Route("partner")
 */
class PartnerController extends ContentController
{
    /**
     * @return string
     */
    protected function getModelClass()
    {
        return Partner::class;
    }

    /**
     * @Route("/", name="partner_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        return parent::indexAction();
    }

    /**
     * @Route("/new", name="partner_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request, FileUploader $fileUploader)
    {
        return parent::newAction($request, $fileUploader);
    }

    /**
     * @Route("/{id}/edit", name="partner_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Partner $partner, FileUploader $fileUploader)
    {
        return $this->edit($request, $partner, $fileUploader);
    }

    /**
     * @Route("/{id}", name="partner_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Partner $partner)
    {
        return $this->delete($request, $partner);
    }
}
