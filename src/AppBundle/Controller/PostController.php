<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Content;
use AppBundle\Entity\ContentInterface;
use AppBundle\Entity\Post;
use AppBundle\Service\FileUploader;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Response;

/**
 * Post controller.
 */

/**
 * Class PostController
 * @package AppBundle\Controller
 */
class PostController extends ContentController
{
    /**
     * @return string
     */
    protected function getModelClass()
    {
        return Post::class;
    }

    /**
     * @Route("/", name="post_index")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $models = ['Post', 'Film', 'Party', 'Partner', 'Event'];
        $entities = [];
        foreach ($models as $model){
            $contents = $em->getRepository('AppBundle:' . $model)->findAll();
            $entities = array_merge($entities, $contents);
            /** @var ContentInterface $content */
            foreach($contents as $content){
                $order[] = $content->getUpdatedAt();
            }
        }
        array_multisort($order, SORT_DESC, $entities);

        return $this->render($this->getModelName() . '/index.html.twig', array_merge($this->getParams(), [
            'models' => $this->paginateContentByRequst($entities, $request)
        ]));
    }

    /**
     * @Route("post/new", name="post_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request, FileUploader $fileUploader)
    {
        return parent::newAction($request, $fileUploader);
    }

    /**
     * @Route("post/{id}/edit", name="post_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Post $post, FileUploader $fileUploader)
    {
        return parent::edit($request, $post, $fileUploader);
    }

    /**
     * @Route("post/{id}", name="post_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Post $post)
    {
        return parent::delete($request, $post);
    }
}
