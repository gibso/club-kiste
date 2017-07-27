<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Film;
use GuzzleHttp\Exception\RequestException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use \Tmdb\ApiToken;
use \Tmdb\Client;
use Tmdb\Exception\NullResponseException;
use Tmdb\Exception\TmdbApiException;
use Tmdb\Model\Movie;
use Tmdb\Repository\MovieRepository;

/**
 * Film controller.
 *
 * @Route("film")
 */
class FilmController extends Controller
{
    /**
     * Lists all film entities.
     *
     * @Route("/", name="film_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $films = $em->getRepository('AppBundle:Film')->findAll();
        $tmdbRepo = $this->getTmdbRepository();

        return $this->render('film/index.html.twig', array(
            'models' => $films,
            'modelName' => Film::MODEL_NAME,
            'tmdbRepo' => $tmdbRepo
        ));
    }

    /**
     * Creates a new film entity.
     *
     * @Route("/new", name="film_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $film = new Film();
        $form = $this->createForm('AppBundle\Form\FilmType', $film);
        $form->handleRequest($request);
        $notFoundError = false;

        if ($form->isSubmitted() && $form->isValid()) {
            $time = \DateTime::createFromFormat('H:i', $request->get('showtimetime'));
            $film->getShowtime()->setTime($time->format('H'), $time->format('i'));

            $repository = $this->getTmdbRepository();
            try {
                $repository->load($film->getTmdbId());
                $em = $this->getDoctrine()->getManager();
                $em->persist($film);
                $em->flush();

                return $this->redirectToRoute('film_show', array('id' => $film->getId()));
            } catch (TmdbApiException $error) {
                $notFoundError = true;
            }
        }

        return $this->render('film/edit.html.twig', array(
            'film' => $film,
            'edit_form' => $form->createView(),
            'modelName' => Film::MODEL_NAME,
            'notFoundError' => $notFoundError
        ));
    }

    /**
     * Finds and displays a film entity.
     *
     * @Route("/{id}", name="film_show")
     * @Method("GET")
     */
    public function showAction(Film $film)
    {
        $deleteForm = $this->createDeleteForm($film);
        $repository = $this->getTmdbRepository();
        try {
            $movie = $repository->load($film->getTmdbId(), ['language' => 'de']);
        } catch (NullResponseException $error) {
            return $this->render('304.html.twig');
        } catch (TmdbApiException $error) {
            return $this->render('304.html.twig');
        }

        return $this->render('film/show.html.twig', array(
            'model' => $film,
            'tmdbMovie' => $movie,
            'delete_form' => $deleteForm->createView(),
            'modelName' => Film::MODEL_NAME
        ));
    }

    /**
     * Displays a form to edit an existing film entity.
     *
     * @Route("/{id}/edit", name="film_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Film $film)
    {
        $deleteForm = $this->createDeleteForm($film);
        $editForm = $this->createForm('AppBundle\Form\FilmType', $film);
        $editForm->handleRequest($request);
        $notFoundError = false;

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $time = \DateTime::createFromFormat('H:i', $request->get('showtimetime'));
            $film->getShowtime()->setTime($time->format('H'), $time->format('i'));

            $repository = $this->getTmdbRepository();
            try {
                $repository->load($film->getTmdbId());
                $this->getDoctrine()->getManager()->flush();
                return $this->redirectToRoute('film_show', array('id' => $film->getId()));
            } catch (TmdbApiException $error) {
                $notFoundError = true;
            }
        }

        return $this->render('film/edit.html.twig', array(
            'film' => $film,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'modelName' => Film::MODEL_NAME,
            'notFoundError' => $notFoundError
        ));
    }

    /**
     * Deletes a film entity.
     *
     * @Route("/{id}", name="film_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Film $film)
    {
        $form = $this->createDeleteForm($film);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($film);
            $em->flush();
        }

        return $this->redirectToRoute('film_index');
    }

    /**
     * Creates a form to delete a film entity.
     *
     * @param Film $film The film entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Film $film)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('film_delete', array('id' => $film->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }

    /**
     * @return MovieRepository
     */
    private function getTmdbRepository()
    {
        $token = new ApiToken('ff386fbbd6b6b546ff5f97d8b6584c4d');
        $client = new Client($token);
        return new MovieRepository($client);
    }
}
