<?php
declare(strict_types=1);

namespace App\Service;

use App\Entity\RunningSession;
use Symfony\Component\Security\Core\User\UserInterface;

class RunningSessionService
{
    public function save(RunningSession $runningSession, UserInterface $user): void
    {
        $duration = $runningSession->getDuration();
        $distance = $runningSession->getDistance();

        $runningSession
            ->setAverageSpeed($this->calculateAverageSpeed($duration, $distance))
            ->setPace($this->calculatePace($duration, $distance))
            ->setUser($user);
        ;
    }

    public function getRunningSessionsAsArray(RunningSession $runningSession): array
    {
        return [
            'userId' => $runningSession->getUser()->getId(),
            'id' => $runningSession->getId(),
            'type' => $runningSession->getType(),
            'start_time' => $runningSession->getStartTime(),
            'duration' => $runningSession->getDuration(),
            'distance' => $runningSession->getDistance(),
            'comment' => $runningSession->getComment(),
            'average_speed' => $runningSession->getAverageSpeed(),
            'pace' => $runningSession->getPace(),
        ];
    }

    protected function calculateAverageSpeed(int $duration, float $distance): float
    {
        return round($distance / ($duration / 60), 1);
    }

    protected function calculatePace(int $duration, float $distance): int
    {
        return (int)round($duration * 60 / ($distance), 0);
    }
}