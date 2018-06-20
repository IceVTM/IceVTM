<?php

namespace App\Controller;

use App\Entity\TakenJobRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AppController extends Controller
{
    /**
     * @param Request $request
     * @return Response
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine();
        /** @var TakenJobRepository $takenJobRepo */
        $takenJobRepo = $em->getManager()->getRepository('App:TakenJob');

        $myCriteria = [
            'driverToken' => array_map(
                function($a) {
                    return $a->getToken();
                },
                $this->getUser()->getDriverTokens()->toArray()
            )
        ];

        $totalJobs = $takenJobRepo->count([]);
        $myJobs = $takenJobRepo->count($myCriteria);

        $totalIncome = $takenJobRepo->sumOf('estimatedIncome');
        $myIncome = $takenJobRepo->sumOf('estimatedIncome', $myCriteria);

        return $this->render(
            'app/index.html.twig',
            [
                'stats' => [
                    'Company Stats' => [
                        'jobs' => $totalJobs,
                        'income' => $totalIncome,
                    ],
                    'My Stats' => [
                        'jobs' => $myJobs,
                        'income' => $myIncome,
                    ]
                ]
            ]
        );
    }
}
