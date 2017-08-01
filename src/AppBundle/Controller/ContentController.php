<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Content;
use AppBundle\Entity\ContentInterface;
use AppBundle\Entity\Partner;
use AppBundle\Entity\Party;
use AppBundle\Entity\Product;
use AppBundle\Service\FileUploader;
use Doctrine\Common\Persistence\ObjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

abstract class ContentController extends Controller
{
    /**
     * @return ObjectRepository
     */
    private function getModelRepository()
    {
        return $this->getDoctrine()->getManager()->getRepository($this->getModelClass());
    }

    protected function getModelClass()
    {
        return Content::class;
    }

    protected function getModelName()
    {
        return strtolower(substr($this->getModelClass(), strrpos($this->getModelClass(), "\\") + 1));

    }

    protected function getActiveNavi()
    {
        $this->getModelName();
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        $models = $this->getModelRepository()->findAll();
        return $this->render($this->getModelName() . '/index.html.twig', array(
            'models' => $models,
            'active' => $this->getActiveNavi(),
            'modelName' => $this->getModelName()
        ));
    }

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

        return $this->render($content->getModelName() . '/edit.html.twig', array(
            'model' => $content,
            'edit_form' => $form->createView(),
            'modelName' => $this->getModelName(),
            'active' => 'partner'
        ));
    }

    public function show(ContentInterface $content)
    {
        $deleteForm = $this->createDeleteForm($content);
        return $this->render('party/show.html.twig', [
            'model' => $content,
            'delete_form' => $deleteForm->createView(),
            'active' => $this->getActiveNavi(),
            'modelName' => $this->getModelName()
        ]);
    }

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

            return $this->redirectToRoute($content->getModelName() . '_edit', array('id' => $content->getId()));
        }

        return $this->render($this->getModelName() . '/edit.html.twig', array(
            'model' => $content,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'modelName' => $content->getModelName(),
            'active' => $this->getActiveNavi()
        ));
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
        throw new \Exception('The Creator for ' . $this->getModelName() . ' is not implemented yet');
    }

    /**
     * Creates a form to delete a content entity.
     *
     * @param ContentInterface $content
     *
     * @return \Symfony\Component\Form\Form The form
     */
    protected function createDeleteForm(ContentInterface $content)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl($content->getModelName() . '_delete', array('id' => $content->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }


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
