<?php

namespace App\Controller;

use App\Entity\Feature;
use App\Form\FeatureType;
use App\Repository\FeatureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/feature')]
class FeatureController extends AbstractController
{
    #[Route('/', name: 'app_feature_index', methods: ['GET'])]
    public function index(FeatureRepository $featureRepository): Response
    {
        return $this->render('feature/index.html.twig', [
            'features' => $featureRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_feature_new', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_ADMIN')]
    public function new(Request $request, FeatureRepository $featureRepository): Response
    {
        $feature = new Feature();
        $form = $this->createForm(FeatureType::class, $feature);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $featureRepository->save($feature, true);

            return $this->redirectToRoute('app_feature_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('feature/new.html.twig', [
            'feature' => $feature,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_feature_show', methods: ['GET'])]
    #[IsGranted('ROLE_USER')]
    public function show(Feature $feature): Response
    {
        return $this->render('feature/show.html.twig', [
            'feature' => $feature,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_feature_edit', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_ADMIN')]
    public function edit(Request $request, Feature $feature, FeatureRepository $featureRepository): Response
    {
        $form = $this->createForm(FeatureType::class, $feature);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $featureRepository->save($feature, true);

            return $this->redirectToRoute('app_feature_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('feature/edit.html.twig', [
            'feature' => $feature,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_feature_delete', methods: ['POST'])]
    #[IsGranted('ROLE_ADMIN')]
    public function delete(Request $request, Feature $feature, FeatureRepository $featureRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$feature->getId(), $request->request->get('_token'))) {
            $featureRepository->remove($feature, true);
        }

        return $this->redirectToRoute('app_feature_index', [], Response::HTTP_SEE_OTHER);
    }
}
