<?php

namespace spec\AppBundle\Services;

use AppBundle\DTO\NeoObjectDTO;
use AppBundle\DTO\ParamRequestDTO;
use AppBundle\Entity\NearEarthObject;
use AppBundle\Repository\NearEarthObjectRepository;
use DateTime;
use Doctrine\ORM\EntityManager;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class NasaSpec extends ObjectBehavior
{

    function let(EntityManager $em)
    {

        $this->beConstructedWith($em);

    }

    function it_is_initializable()
    {
        $this->shouldHaveType('AppBundle\Services\Nasa');
    }


    function it_is_save_neo_object(EntityManager $em, NearEarthObjectRepository $earthObjectRepository)
    {
        $em->getRepository(Argument::exact(NearEarthObject::class))->willReturn($earthObjectRepository);
    }

    function it_is_created_neo_object_dto($neoObject, NeoObjectDTO $neoObjectDTO)
    {
        $neoObject->neo_reference_id = 123213;
        $neoObject->name = 'Yozhef';
        $neoObject->is_potentially_hazardous_asteroid = true;
        $neoObject->close_approach_data[0]->close_approach_date = new DateTime('2017-11-30');
        $neoObject->close_approach_data[0]->relative_velocity->kilometers_per_hour = 123.21;

        $this->createdNeoObjectDTO($neoObject)->willReturn($neoObjectDTO);
    }


}
