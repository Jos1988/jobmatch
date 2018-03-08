<?php

namespace App\DataFixtures\ORM;

use App\Entity\Pattern;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Nelmio\Alice\Loader\NativeLoader;

class JobFixtures extends Fixture
{
    private static $indicatorsData = [
        ['name' => 'a', 'range_low' => 0, 'range_high' => 1000],
        ['name' => 'b', 'range_low' => 0, 'range_high' => 1000],
        ['name' => 'c', 'range_low' => 0, 'range_high' => 1000],
        ['name' => 'd', 'range_low' => 0, 'range_high' => 1000],
        ['name' => 'e', 'range_low' => 0, 'range_high' => 1000],
    ];

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager): void
    {

        $loader = new NativeLoader();
        $objectSet = $loader->loadFile(__DIR__.'/jobs.yaml')->getObjects();

        foreach ($objectSet as $object) {
            $this->handleCustom($object);
            $manager->persist($object);
        }

        $manager->flush();
    }

    /**
     * Handle Custom data manipulation.
     *
     * @param $object
     */
    private function handleCustom($object): void
    {
        if ($object instanceof Pattern) {
            $this->handlePattern($object);
        }
    }

    /**
     * @param Pattern $pattern
     */
    private function handlePattern(Pattern $pattern): void
    {
        $pattern->setParameters($this->generateParameters());
    }

    /**
     * @return array
     */
    private function generateParameters(): array
    {
        $pattern = [];
        foreach (self::$indicatorsData as $indicatorData) {
            $intA = rand($indicatorData['range_low'], $indicatorData['range_high']);
            $intB = rand($indicatorData['range_low'], $indicatorData['range_high']);
            $values = [$intA, $intB];
            sort($values);
            $indicatorData['min'] = $values[0];
            $indicatorData['max'] = $values[1];
            $pattern[] = $indicatorData;
        }

        return $pattern;
    }
}
