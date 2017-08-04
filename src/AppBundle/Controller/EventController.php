<?php
/**
 * Created by PhpStorm.
 * User: oliver
 * Date: 03.08.17
 * Time: 21:28
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Event;
use AppBundle\Entity\Eventseries;
use AppBundle\Repository\EventRepository;
use Doctrine\DBAL\Types\Type;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\DateTime;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * Class EventseriesController
 * @package AppBundle\Controller
 * @Route("eventseries")
 */
class EventController extends ContentController
{
    protected function getModelClass()
    {
        return Event::class;
    }

    /**
     * @Route("/{id}/event/new", name="eventseries_event_new")
     * @Method({"GET", "POST"})
     */
    public function newEventAction(Request $request, Eventseries $eventseries)
    {
        $event = new Event();
        $form = $this->createForm('AppBundle\Form\EventType', $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $event->setSeries($eventseries);
            $em = $this->getDoctrine()->getManager();
            $em->persist($event);
            $em->flush();

            return $this->redirectToRoute('eventseries_event_index', ['id' => $eventseries->getId()]);
        }
        return $this->render('eventseries/event/edit.html.twig', array_merge($this->getParams(), [
            'model' => $event,
            'eventseries' => $eventseries,
            'edit_form' => $form->createView(),
        ]));
    }

    /**
     * @Route("/{seriesId}/event/{eventId}/edit", name="eventseries_event_edit")
     * @ParamConverter("eventseries", options={"mapping": {"seriesId"   : "id"}})
     * @ParamConverter("event", options={"mapping": {"eventId" : "id"}})
     * @Method({"GET", "POST"})
     */
    public function editEventAction(Request $request, Eventseries $eventseries, Event $event)
    {
        $deleteForm = $this->createDeleteForm($event);
        $editForm = $this->createForm('AppBundle\Form\EventType', $event);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $event->setSeries($eventseries);
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('eventseries_event_index', ['id' => $event->getId()]);
        }

        return $this->render( 'eventseries/event/edit.html.twig', array_merge($this->getParams(), [
            'model' => $event,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'eventseries' => $eventseries
        ]));
    }

    /**
     * @Route("/{id}/events", name="eventseries_event_index")
     * @Method({"GET"})
     */
    public function manageEventsAction(Request $request, Eventseries $eventseries)
    {
        return $this->render('eventseries/event/index.html.twig', array_merge($this->getParams(), [
            'eventseries' => $eventseries,
        ]));
    }

    /**
     * @Route("/{id}", name="event_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Event $event)
    {
        return $this->delete($request, $event);
    }
}