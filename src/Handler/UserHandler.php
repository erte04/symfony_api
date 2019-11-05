<?php

namespace App\Handler;

use App\Entity\User;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Serializer\SerializerInterface;

class UserHandler
{
    private $om;
    private $entityManager;
    private $serializer;

    public function __construct(
        ObjectManager $om,
        SerializerInterface $serializer
    ) {
        $this->om = $om;
        $this->entityManager = $om->getRepository(User::class);
        $this->serializer = $serializer;
    }

    public function getUserList(): ?array
    {
        return $this->entityManager->findAll();
    }
}
