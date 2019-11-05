<?php

namespace App\Handler;

use App\Entity\User;
use Doctrine\Common\Persistence\ObjectManager;

class UserHandler
{
    private $om;
    private $entityManager;
    private $userManager;

    public function __construct(
        ObjectManager $om
    ) {
        $this->om = $om;
        $this->entityManager = $om->getRepository(User::class);
    }

    public function getUserList()
    {
        $users = $this->entityManager->findAll();
        return $users;
    }
}
