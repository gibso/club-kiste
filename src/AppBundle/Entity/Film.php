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
     * @ORM\Column(name="imdbId", type="string", length=255)
     */
    private $imdbId;

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
     * Set imdbId
     *
     * @param string $imdbId
     *
     * @return Film
     */
    public function setImdbId($imdbId)
    {
        $this->imdbId = $imdbId;

        return $this;
    }

    /**
     * Get imdbId
     *
     * @return string
     */
    public function getImdbId()
    {
        return $this->imdbId;
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

