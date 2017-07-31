<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Party
 *
 * @ORM\Table(name="party")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PartyRepository")
 */
class Party extends Content implements ContentInterface
{
    const MODEL_NAME = 'party';
    public $modelName = 'party';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="doorsopen", type="datetime")
     */
    private $doorsopen;

    /**
     * @var float
     *
     * @ORM\Column(name="admission", type="float", nullable=true)
     */
    private $admission;

    /**
     * @var bool
     *
     * @ORM\Column(name="boxoffice", type="boolean", nullable=true)
     */
    private $boxoffice;

    /**
     * @var bool
     *
     * @ORM\Column(name="preselling", type="boolean", nullable=true)
     */
    private $preselling;

    /**
     * Set doorsopen
     *
     * @param \DateTime $doorsopen
     *
     * @return Party
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
     * Set admission
     *
     * @param float $admission
     *
     * @return Party
     */
    public function setAdmission($admission)
    {
        $this->admission = $admission;

        return $this;
    }

    /**
     * Get admission
     *
     * @return float
     */
    public function getAdmission()
    {
        return $this->admission;
    }

    /**
     * Set boxoffice
     *
     * @param boolean $boxoffice
     *
     * @return Party
     */
    public function setBoxoffice($boxoffice)
    {
        $this->boxoffice = $boxoffice;

        return $this;
    }

    /**
     * Get boxoffice
     *
     * @return bool
     */
    public function getBoxoffice()
    {
        return $this->boxoffice;
    }

    /**
     * Set preselling
     *
     * @param boolean $preselling
     *
     * @return Party
     */
    public function setPreselling($preselling)
    {
        $this->preselling = $preselling;

        return $this;
    }

    /**
     * Get preselling
     *
     * @return bool
     */
    public function getPreselling()
    {
        return $this->preselling;
    }

    public function getSubtitle()
    {
        return $this->getDoorsopen()->format('d.m.Y') . ', ' . $this->getDoorsopen()->format('H:i') . ' Uhr.';
    }
}

