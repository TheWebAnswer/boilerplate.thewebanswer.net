<?php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;

class CrudService
{
    private $entityManager;
    private $formFactory;

    public function __construct(EntityManagerInterface $entityManager, FormFactoryInterface $formFactory)
    {
        $this->entityManager = $entityManager;
        $this->formFactory = $formFactory;
    }

    public function createEntity(Request $request, $entity, string $formType): array
    {
        $form = $this->formFactory->create($formType, $entity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->saveEntity($entity, true);

            return [
                'success' => true,
                'form' => $form,
            ];
        }

        return [
            'success' => false,
            'form' => $form,
        ];
    }

    public function updateEntity(Request $request, $entity, string $formType): array
    {
        $form = $this->formFactory->create($formType, $entity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->saveEntity($entity, true);

            return [
                'success' => true,
                'form' => $form,
            ];
        }

        return [
            'success' => false,
            'form' => $form,
        ];
    }

    public function deleteEntity($entity, bool $flush = true): void
    {
        $this->entityManager->remove($entity);

        if ($flush) {
            $this->entityManager->flush();
        }
    }

    public function saveEntity($entity, bool $flush = true): void
    {
        $this->entityManager->persist($entity);

        if ($flush) {
            $this->entityManager->flush();
        }
    }

}