<?php

namespace AppBundle\Controller;

use AppBundle\Entity\ContentInterface;
use AppBundle\Entity\Event;
use AppBundle\Entity\Film;
use AppBundle\Entity\Partner;
use AppBundle\Entity\Party;
use AppBundle\Entity\Post;
use AppBundle\Service\FileUploader;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;

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
     * @Route("post/{id}", name="post_show")
     * @Method("GET")
     */
    public function showAction(Post $post)
    {
        return $this->redirectToRoute('post_index');
    }

    /**
     * @Route("/", name="post_index")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $models = [Post::class, Film::class, Party::class, Partner::class, Event::class];
        $entities = [];
        $order = [];
        foreach ($models as $model){
            $contents = $em->getRepository($model)->findAll();
            $entities = array_merge($entities, $contents);
            $order = [];
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
     * @Route("admin/post/new", name="post_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        return parent::newAction($request);
    }

    /**
     * @Route("admin/post/{id}/edit", name="post_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Post $post)
    {
        return parent::edit($request, $post);
    }

    /**
     * @Route("admin/post/{id}", name="post_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Post $post)
    {
        return parent::delete($request, $post);
    }
}
