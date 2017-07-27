<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Film
 *
 * @ORM\Table(name="film")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\FilmRepository")
 */
class Film
{
    const MODEL_NAME = 'film';
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="tmdbId", type="string", length=255)
     */
    private $tmdbId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="showtime", type="datetime")
     */
    private $showtime;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

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
     * Set showtime
     *
     * @param \DateTime $showtime
     *
     * @return Film
     */
    public function setShowtime($showtime)
    {
        $this->showtime = $showtime;

        return $this;
    }

    /**
     * Get showtime
     *
     * @return \DateTime
     */
    public function getShowtime()
    {
        return $this->showtime;
    }
}

