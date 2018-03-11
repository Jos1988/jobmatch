<?php

namespace App\Matcher;

/**
 * Created by PhpStorm.
 * User: Jos
 * Date: 10-3-2018
 * Time: 17:51
 */

use App\Entity\Job;
use App\Entity\Pattern;
use App\Matcher\Exception\MatchingException;
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
    public function startProcess(): int
    {
        if (false === isset($this->profile)) {
            throw MatchingException::CandidateProfileNotSet();
        }

        $first = 0;

        //start loop
        do {
            $batch = $this->patternRepository->getBatch($first, self::$batchSize);
            $first += self::$batchSize;

            //check if last batch.
            $run = $this->checkKeepRunningAfterBatch($batch);

            //loop over job profiles
            foreach ($batch as $pattern) {
                //compare meta data if matching is possible.
                if (false === $this->checkPatternMetaData($pattern)) {
                    continue;
                }

                $candidateProfile = self::getProfile();
                $isMatch = true;
                //loop over profile parameters
                foreach ($pattern->getParameters() as $parameter) {
                    $paramName = $parameter['name'];

                    //get corresponding parameter from candidate profile.
                    $candidateParamValue = $candidateProfile[$paramName];

                    // if match: continue matching parameters else stop matching parameters
                    if ($candidateParamValue < $parameter['min'] || $candidateParamValue > $parameter['max']) {
                        $isMatch = false;
                        break;
                    }
                }

                if (false === $isMatch) {
                    continue;
                }

                //if all parameters match store job in array with matches.
                $this->matches[] = $pattern->getJob();
            }

        } while (true === $run);

        //return status
        return 1;
    }

    /**
     * @param Pattern $pattern
     *
     * @return bool
     */
    protected function checkPatternMetaData(Pattern $pattern): bool
    {
        $paramNames = array_keys(self::getProfile());
        $profileMetaData = implode('|', $paramNames);
        if ($profileMetaData !== $pattern->getMetadata()) {
            return false;
        }

        return true;
    }

    /**
     * @param array|Pattern[] $batch
     *
     * @return bool
     */
    protected function checkKeepRunningAfterBatch(array $batch): bool
    {
        if (count($batch) < self::$batchSize) {
            return false;
        }

        return true;
    }

    /**
     * get Matches
     *
     * @return array|Job[]
     */
    public function getMatches(): array
    {
        return $this->matches;
    }

    /**
     * set Matches
     *
     * @param array $matches
     *
     * @return $this
     */
    public function setMatches(array $matches): self
    {
        $this->matches = $matches;

        return $this;
    }
}