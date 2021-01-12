<?php

namespace App\Controller;

use App\Entity\Project;
use App\Repository\ProjectRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProjectsController extends AbstractController
{
    /**
     * @Route("/projets", name="projects")
     */
    public function index(ProjectRepository $repo): Response
    {
        

        return $this->render('projects/index.html.twig', [
            'controller_name' => 'ProjectsController',
            'projects' => $projects = $repo->findAll()
        ]);
    }

    /**
     *
     * @Route("/projets/{id}", name="projects_show")
     */
    public function showByPk(Project $project)
    {
        return $this->render('projects/show.html.twig', [
            'project' => $project
        ]);
    }
}
