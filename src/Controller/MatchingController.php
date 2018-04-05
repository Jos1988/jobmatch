<?php

namespace App\Controller;

use App\Matcher\Model\Profile;
use App\Matcher\Type\ProfileType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class MatchingController
 * @Route("/algorithm")
 * @package App\Controller
 */
class MatchingController extends Controller
{
    /**
     * @Route("/", name="matching")
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request): Response
    {
        $profile = new Profile();

        $form = $this->createForm(ProfileType::class,  $profile);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            dump($data);
            die;
        }

        return $this->render('matching/index.html.twig', ['form' => $form->createView()]);
    }
}
