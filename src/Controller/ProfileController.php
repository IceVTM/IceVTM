<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ProfileController extends Controller
{
    public function securityAction(Request $request)
    {
        return $this->render('profile/security.html.twig');
    }
}
