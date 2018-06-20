<?php

namespace App\Controller;

use App\Entity\DriverToken;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ProfileController extends Controller
{
    /**
     * @param Request $request
     * @return Response
     */
    public function securityAction(Request $request)
    {
        return $this->render('profile/security.html.twig');
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function driverTokenAction(Request $request)
    {
        $form = $this->createForm(FormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $newDriverToken = new DriverToken();
            $newDriverToken->setUser($this->getUser());

            $em = $this->getDoctrine()->getManager();
            $em->persist($newDriverToken);
            $em->flush();

            return $this->redirectToRoute('profile_driver_token');
        }

        $currentDriverToken = $this->getDoctrine()->getRepository('App:DriverToken')->findActiveDriverTokenByUser($this->getUser());

        return $this->render(
            'profile/driverToken.html.twig',
            [
                'form' => $form->createView(),
                'driverToken' => $currentDriverToken
            ]
        );
    }
}
