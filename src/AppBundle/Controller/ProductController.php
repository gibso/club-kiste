<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Product;
use AppBundle\Service\FileUploader;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class ProductController
 * @package AppBundle\Controller
 */
class ProductController extends ContentController
{
    /**
     * @return string
     */
    protected function getModelClass()
    {
        return Product::class;
    }

    /**
     * @Route("product/{id}", name="product_show")
     * @Method("GET")
     */
    public function showAction(Product $product)
    {
        return $this->redirectToRoute('product_index');
    }

    /**
     * @Route("sortiment", name="product_index")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        $alcoholic = $request->get('alcoholic') ? true : false;
        $products = $this->getDoctrine()->getRepository('AppBundle:Product')->findBy(['alcoholic' => $alcoholic], ['updatedAt' => 'DESC']);
        return $this->render($this->getModelName() . '/index.html.twig', array_merge($this->getParams(), [
            'models' => $this->paginateContentByRequst($products, $request),
            'alcoholic' => $alcoholic
        ]));
    }

    /**
     * @Route("admin/sortiment/new", name="product_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        return parent::newAction($request);
    }

    /**
     * @Route("admin/sortiment/{id}/edit", name="product_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Product $product)
    {
        return $this->edit($request, $product);
    }

    /**
     * @Route("admin/sortiment/{id}", name="product_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Product $product)
    {
        return $this->delete($request, $product);
    }
}
