<?php

namespace App\Controller;

use App\Entity\TakenJob;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class LiveController extends Controller
{
    public function feedAction()
    {
        $em = $this->get('doctrine.orm.entity_manager');

        $jobs = $em->getRepository(TakenJob::class)->findBy(
            [],
            [
                'addedAt' => 'DESC'
            ],
            30
        );

        return $this->render(
            'live/jobs.html.twig',
            [
                'takenJobs' => $jobs
            ]
        );
    }
}
