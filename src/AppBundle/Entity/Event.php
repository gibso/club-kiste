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
class Event extends Entity implements ContentInterface
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
        $this->getSeries()->getTitle();
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
    public function getContent()
    {
        $this->getSeries()->getContent();
    }

    /**
     * @return string
     */
    public function getImage()
    {
        $this->getSeries()->getImage();
    }

    /**
     * @param string $image
     * @return ContentInterface
     */
    public function setImage($image)
    {
        $this->getSeries()->setImage($image);
    }

    /**
     * @return File
     */
    public function getImageFile()
    {
        $this->getSeries()->getImage();
    }
}
