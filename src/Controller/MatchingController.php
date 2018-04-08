<?php

namespace App\Controller;

use App\Matcher\MatchingProcessor;
use App\Matcher\Model\Profile;
use App\Matcher\Type\ProfileType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class MatchingController
 * @Route("/algorithm")
 * @package App\Controller
 */
class MatchingController extends Controller
{
    /**
     * @Route("/", name="matching")
     * @param Request                        $request
     *
     * @param \App\Matcher\MatchingProcessor $processor
     *
     * @return Response
     */
    public function index(Request $request, MatchingProcessor $processor): Response
    {
        $profile = new Profile();

        $form = $this->createForm(ProfileType::class, $profile);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $profile = $form->getData();
            $profileArray = [
                'IE' => $profile->getIE(),
                'SN' => $profile->getSN(),
                'TF' => $profile->getTF(),
                'PJ' => $profile->getPJ(),
                'TS' => $profile->getTS(),
                'MHW' => $profile->getMHW(),
            ];

            $processor->setProfile($profileArray);
            if (1 === $processor->startProcess()) {
                $jobs = $processor->getMatches();

                return $this->render('matching/index.html.twig', ['form' => $form->createView(), 'jobs' => $jobs]);
            }

        }

        return $this->render('matching/index.html.twig', ['form' => $form->createView()]);
    }
}
