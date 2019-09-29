<?php
declare(strict_types=1);

namespace App\Service;

use App\Entity\RunningSession;
use App\Entity\User;
use Symfony\Component\Security\Core\User\UserInterface;

class RunningSessionService
{
    public function save(RunningSession $runningSession, UserInterface $user)
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
        // la vitesse moyenne (en km/h, 11.1km/h par exemple, on pourra donc enregistrer "11.1")
        // $duration en minutes et distance en km

        return round($distance / ($duration / 60), 1);
    }

    protected function calculatePace(int $duration, float $distance): int
    {
        // l'allure moyenne (en min/km, 5'24" par exemple, on pourra donc enregistrer "324")
        // On enregistre en secondes

        return (int)round($duration * 60 / ($distance), 0);
    }
}