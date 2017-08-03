<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Content;
use AppBundle\Entity\ContentInterface;
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
    public function indexAction()
    {
        return $this->render($this->getModelName() . '/index.html.twig', array_merge($this->getParams(), [
            'models' => $this->getModelRepository()->findBy([],['updatedAt' => 'DESC'])
        ]));
    }

    /**
     * @param Request $request
     * @param FileUploader $fileUploader
     * @return RedirectResponse|Response
     */
    public function newAction(Request $request, FileUploader $fileUploader)
    {
        $content = $this->createNewContent();
        $form = $this->createForm('AppBundle\Form\\' . ucfirst($this->getModelName()) . 'Type', $content);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($content->getImageFile()) {
                $fileName = $fileUploader->uploadFileTo(
                    $content->getImageFile(), $this->getParameter('images_directory')
                );
                $content->setImage($fileName);
            }
            $em = $this->getDoctrine()->getManager();
            $em->persist($content);
            $em->flush();

            return $this->redirectToRoute($this->getModelName() . '_index');
        }

        return $this->render($content->getModelName() . '/edit.html.twig', array_merge($this->getParams(), [
            'model' => $content,
            'edit_form' => $form->createView(),
        ]));
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
     * @param FileUploader $fileUploader
     * @return RedirectResponse|Response
     */
    public function edit(Request $request, ContentInterface $content, FileUploader $fileUploader)
    {
        $deleteForm = $this->createDeleteForm($content);
        $editForm = $this->createForm('AppBundle\Form\\' . ucfirst($this->getModelName()) . 'Type', $content);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            if ($content->getImageFile()) {
                $fileName = $fileUploader->uploadFileTo(
                    $content->getImageFile(), $this->getParameter('images_directory')
                );
                $content->setImage($fileName);
            }

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute($content->getModelName() . '_edit', ['id' => $content->getId()]);
        }

        return $this->render($this->getModelName() . '/edit.html.twig', array_merge($this->getParams(), [
            'model' => $content,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView()
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

        return $this->redirectToRoute($content->getModelName() . '_index');
    }
}
