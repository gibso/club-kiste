<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Film;
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
 * Class FilmController
 * @package AppBundle\Controller
 * @Route("film")
 */
class FilmController extends ContentController
{
    /**
     * @return string
     */
    protected function getModelClass()
    {
        return Film::class;
    }

    /**
     * @Route("/", name="film_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        return $this->render($this->getModelName() . '/index.html.twig', array_merge($this->getParams(), [
            'models' => $this->getModelRepository()->findBy([],['doorsopen' => 'ASC']),
            'tmdbRepo' => $this->getTmdbRepository()
        ]));
    }

    /**
     * @Route("/new", name="film_new")
     * @Method({"GET", "POST"})
     */
    public function newFilmAction(Request $request)
    {
        $film = new Film();
        $form = $this->createForm('AppBundle\Form\FilmType', $film);
        $form->handleRequest($request);
        $notFoundError = false;

        if ($form->isSubmitted() && $form->isValid()) {
            $time = \DateTime::createFromFormat('H:i', $request->get('doorsopentime'));
            $film->getDoorsopen()->setTime($time->format('H'), $time->format('i'));

            $repository = $this->getTmdbRepository();
            try {
                /** @var Movie $tmdbMovie */
                $tmdbMovie = $repository->load($film->getTmdbId(), ['language' => 'de']);
                $film->setTitle($tmdbMovie->getTitle());
                $film->setContent($tmdbMovie->getOverview());
                $film->setImage($tmdbMovie->getPosterPath());
                $em = $this->getDoctrine()->getManager();
                $em->persist($film);
                $em->flush();

                return $this->redirectToRoute('film_show', ['id' => $film->getId()]);
            } catch (TmdbApiException $error) {
                $notFoundError = true;
            }
        }

        return $this->render($film->getModelName() . '/edit.html.twig', array_merge($this->getParams(), [
            'model' => $film,
            'edit_form' => $form->createView(),
            'notFoundError' => $notFoundError
        ]));
    }

    /**
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

        return $this->render($this->getModelName() . '/show.html.twig', array_merge($this->getParams(), [
            'model' => $film,
            'delete_form' => $deleteForm->createView(),
            'tmdbMovie' => $movie
        ]));
    }

    /**
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
            $time = \DateTime::createFromFormat('H:i', $request->get('doorsopentime'));
            $film->getDoorsopen()->setTime($time->format('H'), $time->format('i'));

            $repository = $this->getTmdbRepository();
            try {
                /** @var Movie $tmdbMovie */
                $tmdbMovie = $repository->load($film->getTmdbId(), ['language' => 'de']);
                $film->setTitle($tmdbMovie->getTitle());
                $film->setContent($tmdbMovie->getOverview());
                $film->setImage($tmdbMovie->getPosterPath());
                $this->getDoctrine()->getManager()->flush();
                return $this->redirectToRoute('film_show', ['id' => $film->getId()]);
            } catch (TmdbApiException $error) {
                $notFoundError = true;
            }
        }

        return $this->render($this->getModelName() . '/edit.html.twig', array_merge($this->getParams(), [
            'model' => $film,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'notFoundError' => $notFoundError
        ]));
    }

    /**
     * @Route("/{id}", name="film_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Film $film)
    {
        return parent::delete($request, $film);
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
