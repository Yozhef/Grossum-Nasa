<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\NearEarthObject;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class LoadNEOData extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $neos = [
            [
                'neo_reference_id' => '1',
                'date' => '2017-04-05',
                'name' => 'Neo 1',
                'kilometers_per_hour' => '65605.672292416',
                'is_potentially_hazardous_asteroid' => true,
            ],
            [
                'neo_reference_id' => '2',
                'date' => '2017-04-07',
                'name' => 'Neo 2',
                'kilometers_per_hour' => '34593.094094041',
                'is_potentially_hazardous_asteroid' => true,
            ],
            [
                'neo_reference_id' => '3',
                'date' => '2017-04-11',
                'name' => 'Neo 3',
                'kilometers_per_hour' => '112463.65754211',
                'is_potentially_hazardous_asteroid' => false,
            ],
            [
                'neo_reference_id' => '4',
                'date' => '2017-04-10',
                'name' => 'Neo 4',
                'kilometers_per_hour' => '38575.298953023',
                'is_potentially_hazardous_asteroid' => false,
            ],
        ];

        foreach ($neos as $item) {
            $neo = new NearEarthObject();

            $neo->setDate(new DateTime($item['date']))
                ->setReference($item['neo_reference_id'])
                ->setSpeed($item['kilometers_per_hour'])
                ->setName($item['name'])
                ->setIsHazardous($item['is_potentially_hazardous_asteroid']);

            $manager->persist($neo);
        }
        $manager->flush();
    }

    public function getOrder()
    {
        return 1;
    }
}
