<?php

declare(strict_types=1);

namespace Meetup\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Film
 *
 * Attention : Doctrine génère des classes proxy qui étendent les entités, celles-ci ne peuvent donc pas être finales !
 *
 * @package Meetup\Entity
 * @ORM\Entity(repositoryClass="\Meetup\Repository\FilmRepository")
 * @ORM\Table(name="meetups")
 */
class Film
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer", length=36)
     **/
    private $id;

    /**
     * @ORM\Column(type="string", length=50, nullable=false)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=2000, nullable=false)
     */
    private $description = '';

    /**
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $startTime;

    /**
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $endTime;


    
    public function __construct(string $title, string $description = '', $startTime, $endTime)
    {
        if($this->startTime < $this->endTime) {
            $this->title = $title;
            $this->description = $description;
            $this->startTime = $startTime;
            $this->endTime = $endTime;    
        }
        
    }

    /**
     * @return integer
     */
    public function getId() : integer
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getTitle() : string
    {
        return $this->title;
    }

    public function setTitle(string $title) : void
    {
        $this->title = $title;
    }

    public function getDescription() : string
    {
        return $this->description;
    }

    public function setDescription(string $description) : void
    {
        $this->description = $description;
    }

    public function getStartTime() : datetime
    {
        return $this->startTime;
    }

    public function setStartTime(datetime $startTime) : void
    {
        $this->startTime = $startTime;
    }

    public function getEndTime() : datetime
    {
        return $this->endTime;
    }

    public function setEndTime(datetime $endTime) : void
    {
        $this->endTime = $endTime;
    }
}

?>