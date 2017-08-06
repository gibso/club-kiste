<?php

namespace AppBundle\Entity;
use Symfony\Component\HttpFoundation\File\File;

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
     * @param User $user
     * @return mixed
     */
    public function setCreator(User $user);

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

    /**
     * @param string $image
     * @return ContentInterface
     */
    public function setImage($image);

    /**
     * @return File
     */
    public function getImageFile();

    /**
     * @return string
     */
    public function getModelName();
}

