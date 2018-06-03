<?php

namespace App\Controller;

use App\Entity\TakenJob;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller
{
    public function indexAction()
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
            'home/index.html.twig',
            [
                'takenJobs' => $jobs
            ]
        );
    }

}
