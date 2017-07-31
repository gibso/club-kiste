<?php

namespace AppBundle\Entity;

/**
 * Interface ContentInterface
 */
interface ContentInterface
{
    /**
     * @return int
     */
    public function getId();

    /**
     * @return \DateTime
     */
    public function getCreatedAt();

    /**
     * @return \DateTime
     */
    public function getUpdatedAt();

    /**
     * @return User
     */
    public function getCreator();

    /**
     * @return string
     */
    public function getTitle();

    /**
     * @return string
     */
    public function getSubtitle();

    /**
     * @return string
     */
    public function getContent();

    /**
     * @return string
     */
    public function getImage();
}

