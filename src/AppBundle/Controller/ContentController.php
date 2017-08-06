<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Content;
use AppBundle\Entity\ContentInterface;
use AppBundle\Entity\Event;
use AppBundle\Entity\Eventseries;
use AppBundle\Entity\Partner;
use AppBundle\Entity\Party;
use AppBundle\Entity\Post;
use AppBundle\Entity\Product;
use AppBundle\Service\FileUploader;
use Doctrine\Common\Persistence\ObjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ContentController
 * @package AppBundle\Controller
 */
abstract class ContentController extends Controller
{
    const PAGE_LIMIT = 7;

    /**
     * @return ObjectRepository
     */
    protected function getModelRepository()
    {
        return $this->getDoctrine()->getManager()->getRepository($this->getModelClass());
    }

    /**
     * @return string
     */
    protected function getModelClass()
    {
        return Content::class;
    }

    /**
     * @return string
     */
    protected function getModelName()
    {
        return strtolower(substr($this->getModelClass(), strrpos($this->getModelClass(), "\\") + 1));

    }

    /**
     * @return string
     */
    protected function getActiveNavi()
    {
        return $this->getModelName();
    }

    /**
     * @return array
     */
    protected function getParams()
    {
        return [
            'active' => $this->getActiveNavi(),
            'modelName' => $this->getModelName(),
            'eventseriesNav' => $this->getDoctrine()->getManager()->getRepository(Eventseries::class)->findAll()
        ];
    }

    /**
     * @return Response
     */
    public function indexAction(Request $request)
    {
        $content = $this->getModelRepository()->findBy([],['updatedAt' => 'DESC']);
        return $this->render($this->getModelName() . '/index.html.twig', array_merge($this->getParams(), [
            'models' => $this->paginateContentByRequst($content, $request),
        ]));
    }

    /**
     * @param array $content
     * @param Request $request
     * @return array
     */
    protected function paginateContentByRequst(Array $content, Request $request)
    {
        $paginator  = $this->get('knp_paginator');
        $pageNumber = $request->get('page') ? $request->get('page') : 1;
        return $paginator->paginate(
            $content,
            $pageNumber,
            self::PAGE_LIMIT
        );
    }

    /**
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function newAction(Request $request)
    {
        $content = $this->createNewContent();
        return $this->edit($request, $content);
    }

    /**
     * @param ContentInterface $content
     * @return Response
     */
    public function show(ContentInterface $content)
    {
        $deleteForm = $this->createDeleteForm($content);
        return $this->render($this->getModelName() . '/show.html.twig', array_merge($this->getParams(), [
            'model' => $content,
            'delete_form' => $deleteForm->createView()
        ]));
    }

    /**
     * @param Request $request
     * @param ContentInterface $content
     * @return RedirectResponse|Response
     */
    public function edit(Request $request, ContentInterface $content, $params = [])
    {
        $deleteForm = $content->getId() ? $this->createDeleteForm($content)->createView() : null;
        $editForm = $this->createForm('AppBundle\Form\\' . ucfirst($this->getModelName()) . 'Type', $content);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            return $this->saveContent($content);
        }

        return $this->render($this->getModelName() . '/edit.html.twig', array_merge($params, $this->getParams(), [
            'model' => $content,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm
        ]));
    }

    /**
     * @return ContentInterface
     * @throws \Exception
     */
    private function createNewContent()
    {
        if ($this->getModelClass() === Partner::class) {
            return new Partner();
        }
        if ($this->getModelClass() === Product::class) {
            return new Product();
        }
        if ($this->getModelClass() === Party::class) {
            return new Party();
        }
        if ($this->getModelClass() === Post::class) {
            return new Post();
        }
        if ($this->getModelClass() === Eventseries::class){
            return new Eventseries();
        }
        if ($this->getModelClass() === Event::class){
            return new Event();
        }
        throw new \Exception('The Creator for ' . $this->getModelName() . ' is not implemented yet');
    }

    /**
     * @param ContentInterface $content
     * @return \Symfony\Component\Form\Form The form
     */
    protected function createDeleteForm(ContentInterface $content)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl($content->getModelName() . '_delete', ['id' => $content->getId()]))
            ->setMethod('DELETE')
            ->getForm();
    }

    /**
     * @param Request $request
     * @param ContentInterface $content
     * @return RedirectResponse
     */
    public function delete(Request $request, ContentInterface $content)
    {
        $form = $this->createDeleteForm($content);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($content);
            $em->flush();
        }

        $routeParams = $this->getModelClass() === Event::class ? ['id' => $content->getSeries()->getId()] : [];
        return $this->redirectToRoute($content->getModelName() . '_index', $routeParams);
    }

    protected function saveContent(ContentInterface $content)
    {
        if ($content->getImageFile()) {
            $fileName = $this->get('FileUploader')->uploadFileTo(
                $content->getImageFile(), $this->getParameter('images_directory')
            );
            $content->setImage($fileName);
        }

        $em = $this->getDoctrine()->getManager();
        if (!$content->getId()){
            $content->setCreator($this->getUser());
            $em->persist($content);
        }
        $em->flush();

        return $this->redirectToRoute($this->getModelName() . '_show', ['id' => $content->getId()]);
    }
}
