<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/test")
 */
class TestController extends Controller
{
    /**
     * @Route("/", name="test_index", methods="GET")
     */
    public function index()
    {
        return $this->render('test/index.html.twig');
    }
}