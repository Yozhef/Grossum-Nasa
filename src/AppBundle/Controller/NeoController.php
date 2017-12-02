<?php

namespace AppBundle\Controller;

use AppBundle\Entity\NearEarthObject;
use FOS\RestBundle\Controller\Annotations\Route;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class NeoController
 * @Route("/neo")
 */
class NeoController extends FOSRestController
{
    /**
     * @Rest\Get("/hazardous")
     * @Rest\View(statusCode=200, serializerGroups={"neo"})
     *
     * @return array
     */
    public function getAllHazardousAction()
    {
        $neoHazardous = $this->getDoctrine()->getRepository(NearEarthObject::class)
            ->findHazardous();

        return $neoHazardous;
    }

    /**
     * @param Request $request
     *
     * @Rest\Get("/fastest")
     * @Rest\View(statusCode=200, serializerGroups={"neo"})
     *
     * @return array
     */
    public function getFastestAndHazardousAction(Request $request)
    {
        $hazardous = $hazardous = $request->get('hazardous') == 'true' ? true : false;

        $neo = $this->getDoctrine()->getRepository(NearEarthObject::class)->getFastestAndHazardous($hazardous);

        return $neo;
    }
}
