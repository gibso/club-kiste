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
use ClassesWithParents\E;
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
 */
class EventController extends ContentController
{
    protected function getActiveNavi()
    {
        return 'eventseries';
    }

    protected function getModelClass()
    {
        return Event::class;
    }

    /**
     * @Route("event/{id}", name="event_show")
     * @Method("GET")
     */
    public function showAction(Event $event)
    {
        return $this->redirectToRoute('eventseries_show', [
            'id' => $event->getSeries()->getId()
        ]);
    }

    /**
     * @Route("admin/eventseries/{id}/event/new", name="event_new")
     * @Method({"GET", "POST"})
     */
    public function newEventAction(Request $request, Eventseries $eventseries)
    {
        $event = new Event();
        $event->setSeries($eventseries);
        return parent::edit($request, $event,
            ['eventseries' => $eventseries]
    );
    }

    /**
     * @Route("admin/eventseries/{seriesId}/event/{eventId}/edit", name="event_edit")
     * @ParamConverter("eventseries", options={"mapping": {"seriesId"   : "id"}})
     * @ParamConverter("event", options={"mapping": {"eventId" : "id"}})
     * @Method({"GET", "POST"})
     */
    public function editEventAction(Request $request, Eventseries $eventseries, Event $event)
    {
        return parent::edit($request, $event,
            ['eventseries' => $eventseries]
        );
    }

    /**
     * @Route("admin/eventseries/{id}/events", name="event_index")
     * @Method({"GET"})
     */
    public function manageEventsAction(Request $request, Eventseries $eventseries)
    {
        return $this->render('event/index.html.twig', array_merge($this->getParams(), [
            'eventseries' => $eventseries,
        ]));
    }

    /**
     * @Route("admin/eventseries/{id}", name="event_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Event $event)
    {
        return $this->delete($request, $event);
    }
}