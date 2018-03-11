<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MatchingController extends Controller
{
    /**
     * @Route("/match", name="matching")
     */
    public function index()
    {
        die('123');

        return $this->render('matching/index.html.twig', [
            'controller_name' => 'MatchingController',
        ]);
    }
}
