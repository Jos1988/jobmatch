<?php

namespace App\Controller;

use App\Repository\JobRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class DataController
 * @Route("/data")
 * @package App\Controller
 */
class DataController extends Controller
{
    /**
     * @Route("/", name="data")
     * @param \App\Repository\JobRepository $repo
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(JobRepository $repo)
    {
        $jobs = $repo->findAll();

        return $this->render(
            'data/index.html.twig',
            [
                'jobs' => $jobs,
            ]
        );
    }
}
