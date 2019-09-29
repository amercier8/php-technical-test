<?php

namespace App\Controller;

use App\Entity\RunningSession;
use App\Entity\User;
use App\Repository\RunningSessionRepository;
use App\Service\RunningSessionService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
class ApiController
{
    /**
     * @Route("/api/runningsessions/{id}", name="get_running_session")
     *
     * @param RunningSession $runningSession
     * @param RunningSessionService $runningSessionService
     *
     * @return JsonResponse
     */
    public function getRunningSession(?RunningSession $runningSession, RunningSessionService $runningSessionService): JsonResponse
    {
        if ($runningSession instanceof RunningSession === false) {
            return new JsonResponse([
                'code' => 404,
                'message' => 'Running Session not found',
            ]);
        }

        $arrayCollection[] = $runningSessionService->getRunningSessionsAsArray($runningSession);

        return new JsonResponse($arrayCollection);
    }

    /**
     * @Route("/api/runningsessions", name="get_running_sessions")
     *
     * @param RunningSessionRepository $runningSessionRepository
     * @param RunningSessionService $runningSessionService
     *
     * @return JsonResponse
     */
    public function getRunningSessions(RunningSessionRepository $runningSessionRepository, RunningSessionService $runningSessionService): JsonResponse
    {
        $runningSessions = $runningSessionRepository->findAll();

        $arrayCollection = [];
        foreach ($runningSessions as $runningSession) {
            $arrayCollection[] = $runningSessionService->getRunningSessionsAsArray($runningSession);
        }

        return new JsonResponse($arrayCollection);
    }

    /**
     * @Route("/api/users/{id}/runningsessions", name="get_running_sessions_by_user")
     *
     * @param User|null $user
     * @param RunningSessionService $runningSessionService
     *
     * @return JsonResponse
     */
    public function getRunningSessionsByUser(?User $user, RunningSessionService $runningSessionService): JsonResponse
    {
        if ($user instanceof User === false) {
            return new JsonResponse([
                'code' => 404,
                'message' => 'Running Session not found',
            ]);
        }

        $runningSessions = $user->getRunningSessions();

        $arrayCollection = [];
        foreach ($runningSessions as $runningSession) {
            $arrayCollection[] = $runningSessionService->getRunningSessionsAsArray($runningSession);
        }

        return new JsonResponse($arrayCollection);
    }

}