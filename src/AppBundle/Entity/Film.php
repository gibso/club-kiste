<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Film
 *
 * @ORM\Table(name="film")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\FilmRepository")
 */
class Film extends Content implements ContentInterface, EventInterface
{
    /**
     * @var string
     *
     * @ORM\Column(name="tmdbId", type="string", length=255)
     */
    private $tmdbId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="doorsopen", type="datetime")
     */
    private $doorsopen;

    /**
     * Set tmdbId
     *
     * @param string $tmdbId
     *
     * @return Film
     */
    public function setTmdbId($tmdbId)
    {
        $this->tmdbId = $tmdbId;

        return $this;
    }

    /**
     * Get tmdbId
     *
     * @return string
     */
    public function getTmdbId()
    {
        return $this->tmdbId;
    }

    /**
     * Set doorsopen
     *
     * @param \DateTime $doorsopen
     *
     * @return Film
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

    public function getSubtitle()
    {
        return $this->getDoorsopen()->format('d.m.Y') . ', ' . $this->getDoorsopen()->format('H:i') . ' Uhr.';
    }
}

