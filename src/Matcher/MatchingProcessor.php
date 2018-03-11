<?php

namespace App\Matcher;

/**
 * Created by PhpStorm.
 * User: Jos
 * Date: 10-3-2018
 * Time: 17:51
 */

use App\Matcher\Exception\MatchingException;
use App\Repository\JobRepository;
use App\Repository\PatternRepository;

/**
 * Class MatchingProcessor
 * @package App\Matcher
 */
class MatchingProcessor
{
    /**
     * Candidate profile.
     *
     * @var array
     */
    protected $profile;

    /**
     * jobs Matching profile.
     *
     * @var array
     */
    protected $matches = [];

    /**
     * @var PatternRepository
     */
    protected $patternRepository;

    /**
     * @var int
     */
    protected static $batchSize = 10;

    /**
     * MatchingProcessor constructor.
     *
     * @param PatternRepository $patternRepository
     */
    public function __construct(PatternRepository $patternRepository)
    {
        $this->patternRepository = $patternRepository;
    }

    /**
     * get Profile
     *
     * @return array
     */
    public function getProfile(): array
    {
        return $this->profile;
    }

    /**
     * set Profile
     *
     * @param array $profile
     *
     * @return $this
     */
    public function setProfile(array $profile): self
    {
        $this->profile = $profile;

        return $this;
    }

    /**
     * Start matching process.
     *
     * @throws MatchingException
     */
    public function startProcess(): void
    {
        if (false === isset($this->profile)) {
            throw MatchingException::CandidateProfileNotSet();
        }

        $run = true;
        $first = 0;

        //start loop
        do {
            //get first batch
            $batch = $this->patternRepository->getBatch($first, self::$batchSize);
            $first += self::$batchSize;

            //check if last batch.
            dump(count($batch), self::$batchSize, $first);
            if (count($batch) < self::$batchSize) {
                dump('stop');
                $run = false;
            }

            //loop over job profiles
            $batchString = '';
            foreach ($batch as $job) {
                $batchString = $batchString.'|'.(string)$job->getId();

                //loop over profile parameters
                //get corresponding parameter from candidate profile.
                //check parameters.
                // if match: continue matching parameters
                // else stop matching parameters
                //if all parameters match store job in array with matches.
                //end loop

            }

            dump($batchString);

        } while (true === $run);

        //return status
    }
}