<?php

namespace App\Controller;

use App\Entity\User;
use App\Handler\UserHandler;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/api/users", name="users")
 */
class UserController extends FOSRestController
{
    private $userHandler;

    public function __construct(UserHandler $UserHandler)
    {
        $this->userHandler = $UserHandler;
    }

    /**
     * @Rest\Get("/")
     */
    public function getUsers()
    {
        $users = $this->userHandler->getUserList();
        return View::create($users, Response::HTTP_OK);
    }
}
