<?php

namespace AppBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;

/**
 * Neo
 *
 * @ORM\Table(name="near_earth_object")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\NearEarthObjectRepository")
 *
 */
class NearEarthObject
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     * @JMS\Groups({"neo"})
     * @ORM\Column(name="neo_reference_id", type="integer", unique=true)
     */
    private $reference;

    /**
     * @var \DateTime
     * @JMS\Groups({"neo"})
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @var string
     * @JMS\Groups({"neo"})
     * @ORM\Column( type="string", length=255)
     */
    private $name;

    /**
     * @var float
     * @JMS\Groups({"neo"})
     * @ORM\Column(name="kilometers_per_hour", type="float")
     */
    private $speed;

    /**
     * @var bool
     * @JMS\Groups({"neo"})
     * @ORM\Column(name="is_potentially_hazardous_asteroid", type="boolean")
     */
    private $isHazardous;

    /**
     * @var \DateTime
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     * @Gedmo\Timestampable(on="update")
     */
    private $updatedAt;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getReference(): int
    {
        return $this->reference;
    }

    /**
     * @param int $reference
     *
     * @return NearEarthObject
     */
    public function setReference(int $reference): NearEarthObject
    {
        $this->reference = $reference;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDate(): \DateTime
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     *
     * @return NearEarthObject
     */
    public function setDate(\DateTime $date): NearEarthObject
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return NearEarthObject
     */
    public function setName(string $name): NearEarthObject
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return float
     */
    public function getSpeed(): float
    {
        return $this->speed;
    }

    /**
     * @param float $speed
     *
     * @return NearEarthObject
     */
    public function setSpeed(float $speed): NearEarthObject
    {
        $this->speed = $speed;

        return $this;
    }

    /**
     * @return bool
     */
    public function isHazardous(): bool
    {
        return $this->isHazardous;
    }

    /**
     * @param bool $isHazardous
     *
     * @return NearEarthObject
     */
    public function setIsHazardous(bool $isHazardous): NearEarthObject
    {
        $this->isHazardous = $isHazardous;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt(): \DateTime
    {
        return $this->updatedAt;
    }
}
