<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Product;
use AppBundle\Service\FileUploader;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Product controller.
 *
 * @Route("product")
 */
class ProductController extends ContentController
{
    protected function getModelClass()
    {
        return Product::class;
    }

    /**
     * @Route("s/{alcoholic}", defaults={"alcoholic" = false}, name="product_index")
     * @Method("GET")
     */
    public function indexAction($alcoholic = false)
    {
        $em = $this->getDoctrine()->getManager();
        $products = $em->getRepository('AppBundle:Product')->findBy(['alcoholic' => $alcoholic]);

        return $this->render('product/index.html.twig', array(
            'models' => $products,
            'modelName' => $this->getModelName(),
            'active' => 'products',
            'alcoholic' => $alcoholic
        ));
    }

    /**
     * @Route("/new", name="product_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request, FileUploader $fileUploader)
    {
        return parent::newAction($request, $fileUploader);
    }

    /**
     * @Route("/{id}/edit", name="product_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Product $product, FileUploader $fileUploader)
    {
        return $this->edit($request, $product, $fileUploader);
    }

    /**
     * @Route("/{id}", name="product_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Product $product)
    {
      return $this->delete($request, $product);
    }
}
