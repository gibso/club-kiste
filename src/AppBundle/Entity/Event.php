<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Eventseries;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;

/**
 * Event
 *
 * @ORM\Table(name="event")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EventRepository")
 */
class Event extends Entity implements ContentInterface, EventInterface
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="doorsopen", type="datetime")
     */
    private $doorsopen;

    /**
     * @var Eventseries
     *
     * @ORM\ManyToOne(targetEntity="Eventseries", inversedBy="events")
     */
    private $series;

    /**
     * Set doorsopen
     *
     * @param \DateTime $doorsopen
     *
     * @return Event
     */
    public function setDoorsopen($doorsopen)
    {
        $this->doorsopen = $doorsopen;

        return $this;
    }

    /**
     * Get doorsopen
     *
     * @return \DateTime
     */
    public function getDoorsopen()
    {
        return $this->doorsopen;
    }

    /**
     * Set series
     *
     * @param Eventseries $series
     *
     * @return Event
     */
    public function setSeries(Eventseries $series = null)
    {
        $this->series = $series;

        return $this;
    }

    /**
     * Get series
     *
     * @return Eventseries
     */
    public function getSeries()
    {
        return $this->series;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->getSeries()->getTitle();
    }

    /**
     * @return string
     */
    public function getSubtitle()
    {
        $date = $this->getDoorsopen()->format('d.m.y');
        $time = $this->getDoorsopen()->format('H:i');
        return $date . ', ' . $time . ' Uhr';
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->getSeries()->getContent();
    }

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->getSeries()->getImage();
    }

    /**
     * @param string $image
     * @return ContentInterface
     */
    public function setImage($image)
    {
        $this->getSeries()->setImage($image);

        return $this;
    }

    /**
     * @return File
     */
    public function getImageFile()
    {
        return null;
    }
}
