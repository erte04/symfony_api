<?php

namespace App\Controller;

use App\Entity\User;
use App\Handler\UserHandler;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Swagger\Annotations as SWG;
use Nelmio\ApiDocBundle\Annotation\Model;

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
     * 
     * 
     * @SWG\Response(
     *     response=200,
     *     description="Return user list",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(ref=@Model(type=User::class, groups={"user_list"}))
     *     )
     * )
     * @SWG\Tag(name="users")
     */
    public function getUsers(): Response
    {
        $users = $this->userHandler->getUserList();
        $view = $this->view($users);
        $view->getContext()->setGroups(['user_list']);

        return $this->handleView($view);
    }
}
