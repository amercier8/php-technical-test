<?php

namespace App\Controller;

use App\Form\RunningSessionType;
use App\Service\RunningSessionService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class RunningSessionController extends AbstractController
{
    /**
     * @Route("/running/add", name="running_session_add")
     *
     * @param EntityManagerInterface $manager
     * @param Request $request
     *
     * @param RunningSessionService $runningSessionService
     * @return Response
     */
    public function add(EntityManagerInterface $manager, Request $request, RunningSessionService $runningSessionService)
    {
        $form = $this->createForm(RunningSessionType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $runningSession = $form->getData();

            $runningSessionService->save($runningSession);

            $manager->persist($runningSession);
            $manager->flush($runningSession);

            $this->addFlash(
                'notice',
                'Votre session a bien été enregistrée.'
            );

            return $this->redirectToRoute('running_session_add');
        }

        return $this->render('running_session/add.html.twig', [
            'controller_name' => 'RunningSessionController',
            'form' => $form->createView(),
        ]);
    }
}