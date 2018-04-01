<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
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
     */
    public function index()
    {
        return $this->render('matching/index.html.twig', [
        ]);
    }
}
