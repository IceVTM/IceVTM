<?php

namespace App\Controller;

use App\Entity\DriverToken;
use App\Entity\User;
use App\Form\Type\ConfirmTfaTokenType;
use App\Form\Type\ConfirmPasswordType;
use App\Model\ConfirmTfaToken;
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
        $tfaForm = $this->createForm(ConfirmPasswordType::class, null, ['action' => $this->generateUrl('profile_generate_tfa')]);

        return $this->render(
            'profile/security.html.twig',
            [
                'tfaForm' => $tfaForm->createView()
            ]
        );
    }

    public function generateTfaAction(Request $request)
    {
        $googleAuth = $this->get('scheb_two_factor.security.google_authenticator');

        $tfaForm = $this->createForm(ConfirmPasswordType::class);
        $tfaForm->handleRequest($request);

        $confirmToken = new ConfirmTfaToken($this->getUser()->getUsername(), $googleAuth->generateSecret());
        $confirmTokenForm = $this->createForm(ConfirmTfaTokenType::class, $confirmToken);
        $confirmTokenForm->handleRequest($request);

        if ($confirmTokenForm->isSubmitted() || ($tfaForm->isSubmitted() && $tfaForm->isValid())) {
            if ($confirmTokenForm->isSubmitted() && $confirmTokenForm->isValid()) {
                /** @var User $user */
                $user = $this->getUser();
                $user->setGoogleAuthenticatorSecret($confirmToken->getGoogleAuthenticatorSecret());

                $this->getDoctrine()->getManager()->flush();

                return $this->redirectToRoute('profile_security');
            }

            return $this->render(
                'profile/security.html.twig',
                [
                    'confirmToken' => $confirmToken,
                    'secretQrToken' => $googleAuth->getQRContent($confirmToken),
                    'confirmTokenForm' => $confirmTokenForm->createView(),
                    'focusConfirmTfaTokenModal' => true,
                ]
            );
        }

        if (!$tfaForm->isSubmitted()) {
            return $this->redirectToRoute('profile_security');
        }

        return $this->render(
            'profile/security.html.twig',
            [
                'tfaForm' => $tfaForm->createView(),
                'focusEnableTfaForm' => true,
            ]
        );
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
