<?php

namespace App\Controller;

use App\Repository\Project\ProjectTodoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class StatusController
 * @package App\Controller
 */
class StatusController extends Controller
{
    /**
     * @Route("/", name="status")
     * @param \App\Repository\Project\ProjectTodoRepository $repo
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(ProjectTodoRepository $repo): Response
    {
        $todos = $repo->findAll();

        return $this->render(
            'status/index.html.twig',
            [
                'todos' => $todos,
            ]
        );
    }
}
