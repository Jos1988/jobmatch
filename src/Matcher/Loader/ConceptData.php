<?php

namespace App\Matcher\Loader;

use App\Entity\Job;
use App\Entity\Pattern;

/**
 * Class ConceptData
 * @package App\Matcher\Loader
 */
class ConceptData
{
    /**
     * @var array
     */
    public static $roughData = [
        ['Grafisch vormgever', 1, 7, 6, 10, 1, 10, 1, 9, 1, 6, 0, 2,],
        ['Woordvoerder', 6, 10, 1, 10, 6, 10, 3, 10, 6, 10, 1, 2,],
        ['Programmeur', 1, 5, 4, 10, 1, 6, 1, 10, 1, 7, 1, 2,],
        ['Ondernemer', 3, 10, 3, 10, 1, 8, 2, 10, 4, 10, 0, 2,],
        ['Toezichthouder', 3, 10, 1, 5, 1, 5, 1, 7, 5, 10, 0, 0,],
        ['Luchtverkeersleider', 1, 10, 1, 5, 1, 7, 6, 10, 6, 10, 1, 2,],
        ['Jurist', 1, 10, 1, 5, 1, 5, 5, 10, 4, 10, 1, 2,],
        ['Machinist', 1, 5, 1, 6, 1, 5, 1, 6, 4, 10, 0, 0,],
        ['Schrijver', 1, 5, 4, 10, 6, 10, 3, 10, 1, 7, 1, 2,],
        ['brandweerman', 3, 10, 1, 10, 1, 10, 1, 6, 7, 10, 0, 0,],
        ['chirurg', 1, 6, 1, 10, 1, 6, 6, 10, 7, 10, 2, 2,],
        ['politicus', 5, 10, 2, 8, 1, 8, 2, 10, 4, 10, 0, 2,],
        ['Bankier', 1, 10, 1, 8, 1, 6, 1, 10, 3, 10, 1, 2,],
        ['auditor', 1, 5, 1, 7, 1, 5, 5, 10, 1, 10, 1, 2,],
        ['Kledingontwerper', 1, 7, 1, 6, 5, 10, 1, 7, 1, 7, 0, 2,],
        ['Therapeut', 1, 5, 5, 10, 6, 10, 1, 10, 1, 10, 1, 2,],
        ['Salesmanager', 6, 10, 1, 10, 4, 10, 4, 10, 4, 10, 0, 2,],
        ['Tandarts', 1, 5, 1, 6, 3, 9, 4, 10, 3, 10, 1, 2,],
        ['Advocaat', 5, 10, 1, 10, 1, 6, 6, 10, 1, 10, 2, 2,],
        ['Detective', 3, 10, 1, 5, 1, 5, 1, 6, 1, 10, 0, 2,],
    ];

    /**
     * Convert rough data to entities.
     *
     * @param array $roughData
     *
     * @return array
     */
    public function refineRoughData(array $roughData): array
    {
        $refinedData = [];
        foreach ($roughData as $data) {
            $parameters = [
                ['name' => 'IE', 'range_low' => 0, 'range_high' => 9, 'min' => $data[1], 'max' => $data[2]],
                ['name' => 'SN', 'range_low' => 0, 'range_high' => 9, 'min' => $data[3], 'max' => $data[4]],
                ['name' => 'TF', 'range_low' => 0, 'range_high' => 9, 'min' => $data[5], 'max' => $data[6]],
                ['name' => 'PJ', 'range_low' => 0, 'range_high' => 9, 'min' => $data[7], 'max' => $data[8]],
                ['name' => 'TS', 'range_low' => 0, 'range_high' => 9, 'min' => $data[9], 'max' => $data[10]],
                ['name' => 'MHW', 'range_low' => 0, 'range_high' => 2, 'min' => $data[11], 'max' => $data[12]],
            ];

            $pattern = new Pattern();
            $pattern->setMetadata('IE|SN|TF|PJ|TS|MHW')
                ->setParameters($parameters);

            $job = new Job;
            $job->setName($data[0]);
            $job->addPattern($pattern);
            $pattern->setJob($job);

            $refinedData[] = $job;
        }

        return $refinedData;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->refineRoughData(self::$roughData);
    }
}



