<?php

namespace App\DataFixtures\ORM;

use App\Entity\Job;
use App\Entity\Pattern;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Nelmio\Alice\Loader\NativeLoader;

class JobFixtures extends Fixture
{
    private static $jobPrefixes = ['sr.', 'jr.', 'supervisor', 'Lead', 'hoofd', 'assistent', 'allround'];

    private static $jobNames = [
        'Aannemer',
        'Aartsbisschop',
        'Accountant',
        'Acrobaat',
        'Acteur',
        'Activiteitenbegeleider',
        'Chefkok',
        'Chemicus',
        'Chirurg',
        'Clown',
        'Componist',
        'Computerprogrammeur',
        'Conciërge',
        'Conducteur',
        'Edelsmid',
        'Elektromonteur',
        'Etaleur',
        'Fietsenmaker',
        'Fijnbankwerker',
        'Fotograaf',
        'Fruitteler',
        'Fysicus',
        'Garnalenpeller',
        'Gemeentesecretaris',
        'Generaal',
        'Geograaf',
        'Geoloo',
        'IJzervlechter',
        'Illusionist',
        'Imker',
        'Komiek',
        'Koster',
        'Kostuumontwerper',
        'Kraamverzorger',
        'Naaister',
        'Nachtwaker',
        'Fysicus',
        'Neuroloog',
        'Nieuwslezer',
        'Pijpfitter',
        'Piloot',
        'Poelier',
        'Poffertjesbakker',
        'Politieagent',
        'Portier',
        'Postbode',
        'Chemicus',
        'Schipper',
        'Schoenmaker',
        'Schooldecaan',
        'Veehouder',
        'Verhuizer',
        'Verkoper',
        'Verloskundige',
        'Verpleegkundige',
        'Zeefdrukker',
        'Zilversmid',
    ];

    private static $indicatorsData = [
        ['name' => 'IE', 'range_low' => 0, 'range_high' => 9],
        ['name' => 'SN', 'range_low' => 0, 'range_high' => 9],
        ['name' => 'TF', 'range_low' => 0, 'range_high' => 9],
        ['name' => 'PJ', 'range_low' => 0, 'range_high' => 9],
        ['name' => 'TS', 'range_low' => 0, 'range_high' => 9],
        ['name' => 'MHW', 'range_low' => 0, 'range_high' => 2],
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
        } elseif ($object instanceof Job) {
            $this->setName($object);
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
     * @param Job $job
     */
    private function setName(Job $job): void
    {
        $rand1 = rand(0, 9);
        $rand2 = rand(0, 9);
        $name = '';
        if ($rand1 > 3) {
            $name .= self::$jobPrefixes[array_rand(self::$jobPrefixes)].' ';
        }

        if ($rand2 > 3) {
            $name .= $job->getName().' ';
        }

        $name .= self::$jobNames[array_rand(self::$jobNames)];
        $job->setName($name);
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
