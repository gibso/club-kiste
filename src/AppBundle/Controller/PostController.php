<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Content;
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
class PostController extends Controller
{
    /**
     * Lists all post entities.
     *
     * @Route("/", name="post_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $posts = $em->getRepository('AppBundle:Post')->findBy([], ['updatedAt' => 'DESC']);
        $films = $em->getRepository('AppBundle:Film')->findBy([], ['updatedAt' => 'DESC']);
        $partys = $em->getRepository('AppBundle:Party')->findBy([], ['updatedAt' => 'DESC']);
        $products = $em->getRepository('AppBundle:Product')->findBy([], ['updatedAt' => 'DESC']);
        $partner = $em->getRepository('AppBundle:Partner')->findBy([], ['updatedAt' => 'DESC']);


        $content = array_merge($posts, $films, $partys, $products, $partner);

        /**
         * @var Content $value
         */
        foreach ($content as $key => $value){
            $order[] = $value->getUpdatedAt();
        }
        array_multisort($order, SORT_DESC, $content);

        return $this->render('post/index.html.twig', [
            'models' => $content,
            'modelName' => Post::MODEL_NAME,
            'active' => 'news'
        ]);
    }

    /**
     * Creates a new post entity.
     *
     * @Route("post/new", name="post_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request, FileUploader $fileUploader)
    {
        $post = new Post();
        $form = $this->createForm('AppBundle\Form\PostType', $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($post->getImageFile()) {
                $fileName = $fileUploader->uploadFileTo(
                    $post->getImageFile(), $this->getParameter('images_directory')
                );
                $post->setImage($fileName);
            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();

            return $this->redirectToRoute('post_index');
        }

        return $this->render('post/edit.html.twig', array(
            'model' => $post,
            'modelName' => Post::MODEL_NAME,
            'edit_form' => $form->createView(),
            'active' => 'news'
        ));
    }

    /**
     * @Route("post/{id}/edit", name="post_edit")
     * @Method({"GET", "POST"})
     *
     * @param Request $request
     * @param Post $post
     * @param FileUploader $fileUploader
     *
     * @return Response
     */
    public function editAction(Request $request, Post $post, FileUploader $fileUploader)
    {
        $deleteForm = $this->createDeleteForm($post);
        $editForm = $this->createForm('AppBundle\Form\PostType', $post);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            if ($post->getImageFile()) {
                $fileName = $fileUploader->uploadFileTo(
                    $post->getImageFile(), $this->getParameter('images_directory')
                );
                $post->setImage($fileName);
            }

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('post_index', array('id' => $post->getId()));
        }

        return $this->render('post/edit.html.twig', array(
            'model' => $post,
            'modelName' => Post::MODEL_NAME,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'active' => 'news'
        ));
    }

    /**
     * Deletes a post entity.
     *
     * @Route("post/{id}", name="post_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Post $post)
    {
        $form = $this->createDeleteForm($post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($post);
            $em->flush();
        }

        return $this->redirectToRoute('post_index');
    }

    /**
     * Creates a form to delete a post entity.
     *
     * @param Post $post The post entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Post $post)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('post_delete', array('id' => $post->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }
}
