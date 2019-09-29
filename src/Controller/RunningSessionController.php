<?php

namespace App\Controller;

use App\Entity\RunningSession;
use App\Form\RunningSessionType;
use App\Service\RunningSessionService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
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
     * @param UserInterface $user
     * @return Response
     */
    public function add(EntityManagerInterface $manager, Request $request, RunningSessionService $runningSessionService, UserInterface $user)
    {
        $form = $this->createForm(RunningSessionType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $runningSession = $form->getData();

            $runningSessionService->save($runningSession, $user);
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

    /**
     * @Route("/running/consult", name="running_session_consult")
     *
     * @param Request $request
     * @param UserInterface $user
     *
     * @return Response
     */
    public function consult(Request $request, UserInterface $user): Response
    {
        $runningSessions = $user->getRunningSessions();

        return $this->render('running_session/consult.html.twig', [
            'controller_name' => 'RunningSessionController',
            'runningSessions' => $runningSessions,
        ]);
    }

    /**
     * @Route("/running/{id}/edit", name="running_session_edit")
     *
     * @param RunningSession $runningSession
     * @param EntityManagerInterface $manager
     * @param Request $request
     * @param RunningSessionService $runningSessionService
     * @param UserInterface $user
     *
     * @return Response
     */
    public function edit(RunningSession $runningSession, EntityManagerInterface $manager, Request $request, RunningSessionService $runningSessionService, UserInterface $user): Response
    {
        $form = $this->createForm(RunningSessionType::class, $runningSession);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $runningSessionService->save($runningSession, $user);

            $manager->persist($runningSession);
            $manager->flush($runningSession);

            $this->addFlash(
                'notice',
                'Votre session a bien été modifiée.'
            );

            return $this->redirectToRoute('running_session_consult');
        }

        return $this->render('running_session/update.html.twig', [
            'controller_name' => 'RunningSessionController',
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/running/{id}/delete", name="running_session_delete")
     *
     * @param RunningSession $runningSession
     * @param EntityManagerInterface $manager
     *
     * @return RedirectResponse
     */
    public function delete(RunningSession $runningSession, EntityManagerInterface $manager): RedirectResponse
    {
        $manager->remove($runningSession);
        $manager->flush();

        $this->addFlash(
            'notice',
            'Votre session a bien été supprimée.'
        );

        return $this->redirectToRoute('running_session_consult');
    }
}