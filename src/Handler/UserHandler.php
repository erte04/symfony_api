<?php

namespace App\Handler;

use App\Entity\User;
use App\Form\UserType;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Serializer\SerializerInterface;

class UserHandler
{
    private $om;
    private $entityManager;
    private $serializer;
    private $userManager;

    public function __construct(
        ObjectManager $om,
        SerializerInterface $serializer,
        FormFactoryInterface $formFactoryInterface,
        ContainerInterface $container
    ) {
        $this->om = $om;
        $this->entityManager = $om->getRepository(User::class);
        $this->serializer = $serializer;
        $this->formFactory = $formFactoryInterface;
        $this->userManager = $container->get('fos_user.user_manager');
    }

    public function getUserList(): ?array
    {
        return $this->entityManager->findAll();
    }

    public function getUser(int $id): ?User
    {
        return $this->entityManager->find($id);
    }

    public function createUser($data)
    {
        $User = $this->userManager->createUser();
        $form = $this->formFactory->create(UserType::class, $User);
        $form->submit($data, false);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->userManager->updateUser($User);
            return $User;
        }

        return $form->getErrors();
    }
}
