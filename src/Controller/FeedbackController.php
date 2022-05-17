<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FeedbackController extends AbstractController
{
    /**
     * @Route("/")
     */
    public function index()
    {
        return new Response($this->renderView("feedbackForm.html.twig"));
    }

    /**
     * @Route("/new", methods={"POST"})
     */
    public function new()
    {
        return new Response("", 301, ["location" => "/"]);
    }
}
