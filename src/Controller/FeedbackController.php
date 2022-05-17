<?php

namespace App\Controller;

use App\Form\Type\FeedbackType;
use FeedbackData;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FeedbackController extends AbstractController
{
    /**
     * @Route("/")
     */
    public function index(Request $request)
    {
        $feedbackData = new FeedbackData();
        $form = $this->createForm(FeedbackType::class, $feedbackData);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {

        }
        return new Response($this->renderView("feedbackForm.html.twig", ["form" => $form->createView()]));
    }

    /**
     * @Route("/new", methods={"POST"})
     */
    public function new()
    {
        return new Response("", 301, ["location" => "/"]);
    }
}
