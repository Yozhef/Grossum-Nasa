<?php

namespace AppBundle\Interfaces\Service;

use AppBundle\DTO\NeoObjectDTO;
use AppBundle\DTO\ParamRequestDTO;

interface NasaInterface
{
    /**
     * Generate url in nasa api
     *
     * @param ParamRequestDTO $paramRequestDTO
     * @return string
     */
    public function getRoute(ParamRequestDTO $paramRequestDTO);

    /**
     * Receive data from nasa api
     *
     * @param string $url
     * @return string|array
     */
    public function getResponse(string $url);

    /**
     * synchronize response data on db
     *
     * @param array $response
     */
    public function synchronizeResponseNASA(array $response);

    /**
     * save and update data in db
     *
     * @param NeoObjectDTO $neoObjectDTO
     */
    public function saveNeoObject(NeoObjectDTO $neoObjectDTO);

    /**
     * Created DTO for save object
     *
     * @param $neoObject
     * @return NeoObjectDTO
     */
    public function createdNeoObjectDTO($neoObject);
}
