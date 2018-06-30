<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class JobTrackerController extends Controller
{
    public function indexAction(Request $request)
    {
        $jobs = $this->getDoctrine()->getRepository('App:TakenJob')->findBy([
            'driverToken' => $this->getUser()->getDriverTokens()->toArray()
        ]);

        return $this->render(
            'jobTracker/index.html.twig',
            [
                'jobs' => $jobs,
            ]
        );
    }
}
