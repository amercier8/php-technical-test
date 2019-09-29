<?php

namespace App\Tests;

require('vendor/autoload.php');

use App\Entity\RunningSession;
use App\Entity\User;
use PHPUnit\Framework\TestCase;
use App\Service\RunningSessionService;
use DateTime;

class RunningSessionServiceTest extends TestCase
{
    public function testSave()
    {
        $user = new User();

        $runningSession = new runningSession();
        $runningSession
            ->setType('Rando')
            ->setStartTime(new DateTime('2000-01-01 10:12:00'))
            ->setDuration(127)
            ->setDistance(17)
            ->setComment('Super sortie !');

        $runningSessionService = new RunningSessionService();
        $runningSessionService->save($runningSession, $user);

        static::assertEquals(8.0, $runningSession->getAverageSpeed());
        static::assertEquals(448, $runningSession->getPace());
    }
}