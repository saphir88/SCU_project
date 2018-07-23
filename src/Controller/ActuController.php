<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/")
 */
class ActuController extends Controller
{
    /**
     * @Route("/", name="homepage", methods="GET")
     */
    public function index()
    {
        return $this->render('actu/accueil.html.twig');
    }
}