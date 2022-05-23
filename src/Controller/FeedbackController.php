<?php

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

        return new Response($this->renderView("feedbackForm.html.twig", ["feedbacks" => $feedbacks, "form" => $form->createView()]));
    }

    /**
     * @Route("/new", methods={"POST"})
     */
    public function new()
    {
        
    }
}
