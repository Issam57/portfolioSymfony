<?php

namespace App\Controller;

use App\Entity\Project;
use App\Form\ProjectType;
use App\Repository\ProjectRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin/login", name="admin_login")
     */
    public function login(AuthenticationUtils $auth)
    {
        $error = $auth->getLastAuthenticationError();

        return $this->render('admin/login.html.twig', [
            "error" => $error !== null
        ]);
    }

    /**
     * @Route("/admin/logout", name="admin_logout")
     */
    public function logout()
    {

    }

    /**
     * @Route("admin/projects", name="admin_projects")
     */
    public function projects(ProjectRepository $repo)
    {
        return $this->render('admin/projects.html.twig', [
            'projects' => $repo->findAll()
        ]);
    }

    /**
     * @Route("admin/projects/new", name="admin_projects_new")
     */
    public function new(Request $request, EntityManagerInterface $manager)
    {
        $project = new Project();
        $form = $this->createForm(ProjectType::class, $project);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $manager->persist($project);
            $manager->flush();
            return $this->redirectToRoute('admin_projects');
        }


        return $this->render('admin/new.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/projects/{id}/delete", name="admin_projects_delete")
     */
    public function delete(Project $project, EntityManagerInterface $manager)
    {
        $manager->remove($project);
        $manager->flush();
        return $this->redirectToRoute('admin_projects');
    }

    /**
     * @Route("/admin/projects/{id}/edit", name="admin_projects_edit")
     */
    public function edit(Project $project, Request $request, EntityManagerInterface $manager)
    {
        $form = $this->createForm(ProjectType::class, $project);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $manager->persist($project);
            $manager->flush();
            return $this->redirectToRoute('admin_projects');
        }

        return $this->render('admin/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
