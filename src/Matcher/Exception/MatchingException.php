<?php

namespace App\Matcher\Exception;

/**
 * Created by PhpStorm.
 * User: Jos
 * Date: 10-3-2018
 * Time: 17:55
 */

use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * Class MatchingException
 * @package App\Matcher\Exception
 */
class MatchingException extends HttpException
{
    /**
     * @return MatchingException
     */
    static function CandidateProfileNotSet(): self
    {
        return new MatchingException(404, 'The candidate profile has not been set in the Matching Processor.');
    }
}