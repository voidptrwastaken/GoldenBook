<?php

//Dear programmer:
//When I wrote this code, only god and
//I knew how it worked.
//Now only god knows it!
//
//Therefore, if you are trying to optimize
//this routine and it fails (most surely),
//please increase this counter as a
//warning for the next person:
//
//total_hours_wasted_here = 254
//

namespace App\Controller;

use App\Form\Type\FeedbackType;
use App\Repository\FeedbackRepository;
use FeedbackData;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

class FeedbackController extends AbstractController
{
    private FeedbackRepository $repository;

    public function __construct(FeedbackRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @Route("/")
     */
    public function index(Request $request, PaginatorInterface $paginator) : Response
    {
        $feedbackData = new FeedbackData();
        $form = $this->createForm(FeedbackType::class, $feedbackData);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $feedbackData = $form->getData();
            $this->repository->createFeeback($feedbackData->name, $feedbackData->message);

            return $this->redirectToRoute('app_feedback_index');
        }

        $feedbacks = $paginator->paginate(
            $this->repository->getFeedbacks(),
            $request->query->getInt('page', 1),
            5  
        );

        $feedback = $this->repository->getFeedback(1);

        return new Response($this->renderView("feedbackForm.html.twig", ["feedbacks" => $feedbacks, "form" => $form->createView()]));
    }
}
