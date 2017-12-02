<?php

namespace AppBundle\Services;

use AppBundle\Interfaces\Service\NasaInterface;
use AppBundle\DTO\NeoObjectDTO;
use AppBundle\Entity\NearEarthObject;
use DateTime;
use Doctrine\ORM\EntityManager;
use GuzzleHttp\Client as Guzzle;
use AppBundle\DTO\ParamRequestDTO;

class Nasa implements NasaInterface
{

    /**
     * @var  EntityManager
     */
    private $em;

    /**
     * Nasa constructor.
     *
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }


    /**
     * @param ParamRequestDTO $paramRequestDTO
     *
     * @return string
     */
    public function getRoute(ParamRequestDTO $paramRequestDTO)
    {

        $url = 'https://api.nasa.gov/neo/rest/v1/feed?'
            . 'start_date=' . $paramRequestDTO->getStartDate()->format('Y-m-d')
            . '&end_date=' . $paramRequestDTO->getEndDate()->format('Y-m-d')
            . '&detailed=' . $paramRequestDTO->getDetailed()
            . '&api_key=' . $paramRequestDTO->getApiKey()
        ;

        return $url;
    }

    /**
     * @param string $url
     *
     * @return string|array
     */
    public function getResponse(string $url)
    {

        $client = new Guzzle;
        $response = $client->request('GET', $url);

        if ($response->getStatusCode() !== 200) {
            return "NASA API error: Status code " . $response->getStatusCode();
        }

        $response = json_decode($response->getBody());

        if (!property_exists($response, "near_earth_objects")) {
            return "NASA API error: near_earth_objects not found in response";
        }

        $response = (array) $response->near_earth_objects;

        return (array) $response;
    }

    /**
     * @param array $response
     */
    public function synchronizeResponseNASA(array $response)
    {
        foreach ($response as $keyDay => $responseDay) {
            foreach ($responseDay as $neo) {
                $neoObjectDTO = $this->createdNeoObjectDTO($neo);
                $this->saveNeoObject($neoObjectDTO);
            }
        }
    }

    /**
     * @param NeoObjectDTO $neoObjectDTO
     */
    public function saveNeoObject(NeoObjectDTO $neoObjectDTO)
    {
        $neo = $this->em->getRepository(NearEarthObject::class)->getNeoByReferenceId($neoObjectDTO->getReference());

        $nearEarthObject =  $neo ?? new NearEarthObject();

        $nearEarthObject->setReference($neoObjectDTO->getReference())
                        ->setName($neoObjectDTO->getName())
                        ->setSpeed($neoObjectDTO->getSpeed())
                        ->setDate($neoObjectDTO->getDate())
                        ->setIsHazardous($neoObjectDTO->isHazardous());

        $this->em->persist($nearEarthObject);
        $this->em->flush();
    }

    /**
     * @param $neoObject
     *
     * @return NeoObjectDTO
     */
    public function createdNeoObjectDTO($neoObject)
    {

        $neoObjectDTO = new NeoObjectDTO();
        $neoObjectDTO->setReference($neoObject->neo_reference_id)
                     ->setName($neoObject->name)
                     ->setSpeed($neoObject->close_approach_data[0]->relative_velocity->kilometers_per_hour)
                     ->setDate(new DateTime($neoObject->close_approach_data[0]->close_approach_date))
                     ->setIsHazardous($neoObject->is_potentially_hazardous_asteroid);

        return $neoObjectDTO;
    }
}