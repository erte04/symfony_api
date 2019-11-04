<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Movie controller.
 * @Route("/api", name="api_")
 */
class TestController extends FOSRestController
{
    /**
     * Lists all Movies.
     * @Rest\Get("/test")
     *
     * @return Response
     */
    public function getTestAction(): View
    {
        $view = ['data' => 'test'];
        return View::create($view, Response::HTTP_CREATED);
    }
}
