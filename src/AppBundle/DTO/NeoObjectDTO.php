<?php
namespace AppBundle\DTO;

class NeoObjectDTO
{
    /**
     * @var int
     */
    private $reference;

    /**
     * @var \DateTime
     *
     */
    private $date;

    /**
     * @var string
     */
    private $name;

    /**
     * @var float
     */
    private $speed;

    /**
     * @var bool
     */
    private $isHazardous;

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
     * @return NeoObjectDTO
     */
    public function setReference(int $reference): NeoObjectDTO
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
     * @return NeoObjectDTO
     */
    public function setDate(\DateTime $date): NeoObjectDTO
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
     * @return NeoObjectDTO
     */
    public function setName(string $name): NeoObjectDTO
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
     * @return NeoObjectDTO
     */
    public function setSpeed(float $speed): NeoObjectDTO
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
     * @return NeoObjectDTO
     */
    public function setIsHazardous(bool $isHazardous): NeoObjectDTO
    {
        $this->isHazardous = $isHazardous;

        return $this;
    }
}
