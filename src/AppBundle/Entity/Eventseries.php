<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Event;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Eventseries
 *
 * @ORM\Table(name="eventseries")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EventseriesRepository")
 */
class Eventseries extends Content implements ContentInterface
{
    /**
     * @var Event
     *
     * @ORM\OneToMany(targetEntity="Event", mappedBy="series")
     */
    private $events;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->events = new ArrayCollection();
    }

    /**
     * Add event
     *
     * @param Event $event
     *
     * @return Eventseries
     */
    public function addEvent(Event $event)
    {
        $this->events[] = $event;

        return $this;
    }

    /**
     * Remove event
     *
     * @param Event $event
     */
    public function removeEvent(Event $event)
    {
        $this->events->removeElement($event);
    }

    /**
     * Get events
     *
     * @return Collection
     */
    public function getEvents()
    {
        return $this->events;
    }

    /**
     * @return string
     */
    public function getSubtitle()
    {
        return null;
    }

    /**
     * @return string
     */
    public function getModelName()
    {
        return 'eventseries';
    }
}
