<?php

namespace App\Controller;

use App\StackOverflow\ApplicationService\DTO\QuestionGetterRequest;
use App\StackOverflow\ApplicationService\QuestionGetter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class StackOverflowApiController extends AbstractController
{
    private QuestionGetter $questionGetter;

    public function __construct(QuestionGetter $questionGetter)
    {
        $this->questionGetter = $questionGetter;
    }

    /**
     * @Route("/api", name="app_stack_overflow_api", methods={"GET"})
     */
    public function index(Request $request): JsonResponse
    {
        $tagged = $request->query->get('tagged') === null ? '' : $request->query->get('tagged');
        $fromDate = $request->query->get('from_date') === null ? '' : $request->query->get('from_date');
        $toDate = $request->query->get('to_date') === null ? '' : $request->query->get('to_date');

        $questionCollection = ($this->questionGetter)(
            new QuestionGetterRequest(
                $tagged,
                $fromDate,
                $toDate
            )
        );

        return new JsonResponse(
            $questionCollection
        );
    }
}
