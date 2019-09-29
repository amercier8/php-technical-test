<?php
declare(strict_types=1);

namespace App\Service;

use App\Entity\RunningSession;
use App\Entity\User;
use Symfony\Component\Security\Core\User\UserInterface;

class RunningSessionService
{
    public function save(RunningSession $runningSession)
    {
        $duration = $runningSession->getDuration();
        $distance = $runningSession->getDistance();

        $runningSession
            ->setAverageSpeed($this->calculateAverageSpeed($duration, $distance))
            ->setPace($this->calculatePace($duration, $distance))
//            ->setUser(new User());
        ;
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