<?php
namespace AppBundle\DTO;

class ParamRequestDTO
{
    /**
     * @var \DateTime
     */
    private $startDate;

    /**
     * @var \DateTime
     */
    private $endDate;

    /**
     * @var string
     */
    private $detailed = "false";

    /**
     * @var string
     */
    private $apiKey;

    /**
     * @return \DateTime
     */
    public function getStartDate(): \DateTime
    {
        return $this->startDate;
    }

    /**
     * @param \DateTime $startDate
     *
     * @return ParamRequestDTO
     */
    public function setStartDate(\DateTime $startDate): ParamRequestDTO
    {
        $this->startDate = $startDate;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getEndDate(): \DateTime
    {
        return $this->endDate;
    }

    /**
     * @param \DateTime $endDate
     *
     * @return ParamRequestDTO
     */
    public function setEndDate(\DateTime $endDate): ParamRequestDTO
    {
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * @return string
     */
    public function getApiKey(): string
    {
        return $this->apiKey;
    }

    /**
     * @param string $apiKey
     *
     * @return ParamRequestDTO
     */
    public function setApiKey(string $apiKey): ParamRequestDTO
    {
        $this->apiKey = $apiKey;

        return $this;
    }

    /**
     * @return string
     */
    public function getDetailed(): string
    {
        return $this->detailed;
    }

    /**
     * @param string $detailed
     *
     * @return ParamRequestDTO
     */
    public function setDetailed(string $detailed)
    {
        $this->detailed = $detailed;

        return $this;
    }
}
