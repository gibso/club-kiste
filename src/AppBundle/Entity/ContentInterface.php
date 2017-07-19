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
     * @param \DateTime $createdAt
     *
     * @return ContentInterface
     */
    public function setCreatedAt(\DateTime $createdAt);

    /**
     * @return \DateTime
     */
    public function getCreatedAt();

    /**
     * @param \DateTime $updatedAt
     *
     * @return ContentInterface
     */
    public function setUpdatedAt(\DateTime $updatedAt);

    /**
     * @return \DateTime
     */
    public function getUpdatedAt();

    /**
     * @param User $creator
     *
     * @return ContentInterface
     */
    public function setCreator(User $creator);

    /**
     * @return User
     */
    public function getCreator();

    /**
     * @param string $title
     *
     * @return ContentInterface
     */
    public function setTitle($title);

    /**
     * @return string
     */
    public function getTitle();

    /**
     * @param string $content
     *
     * @return ContentInterface
     */
    public function setContent($content);

    /**
     * @return string
     */
    public function getContent();

    /**
     * @param string $image
     *
     * @return ContentInterface
     */
    public function setImage($image);

    /**
     * @return string
     */
    public function getImage();

    /**
     * @param File $imageFile
     *
     * @return ContentInterface
     */
    public function setImageFile(File $imageFile);

    /**
     * @return File
     */
    public function getImageFile();
}

