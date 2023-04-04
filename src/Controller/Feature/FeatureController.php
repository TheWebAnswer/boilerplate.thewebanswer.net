<?php

namespace App\Controller\Feature;

use App\Entity\Feature;
use App\Form\FeatureType;
use App\Repository\FeatureRepository;
use App\Service\CrudService;
use Exception;
use Knp\Component\Pager\PaginatorInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Contracts\Translation\TranslatorInterface;

#[Route('/feature')]
class FeatureController extends AbstractController
{
    private LoggerInterface $logger;
    private PaginatorInterface $paginator;
    private TranslatorInterface $translator;

    public function __construct(LoggerInterface $logger, PaginatorInterface $paginator, TranslatorInterface $translator)
    {
        $this->logger = $logger;
        $this->paginator = $paginator;
        $this->translator = $translator;
    }


    #[Route('/', name: 'app_feature_index', methods: ['GET'])]
    public function index(FeatureRepository $featureRepository, Request $request): Response
    {
        $query = $featureRepository->createQueryBuilder('f')->getQuery();
        $pagination = $this->paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            10 // Nombre d'éléments par page
        );

        return $this->render('feature/index.html.twig', [
            'pagination' => $pagination,
        ]);
    }

    #[Route('/new', name: 'app_feature_new', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_ADMIN')]
    public function new(Request $request, CrudService $crudService): Response
    {
        $feature = new Feature();

        try {
            $result = $crudService->createEntity($request, $feature, FeatureType::class);

            if ($result['success']) {
                $this->addFlash('success', $this->translator->trans('feature.new.success', [], 'messages'));
                return $this->redirectToRoute('app_feature_new', [], Response::HTTP_SEE_OTHER);
            }
        } catch (Exception $e) {
            $this->logger->error('Error in FeatureController::new : ' . $e->getMessage());
            $this->addFlash('error', $this->translator->trans('feature.error.generic', [], 'messages'));
        }
        return $this->render('feature/new.html.twig', [
            'feature' => $feature,
            'form' => $result['form']->createView(),
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
    public function edit(Request $request, Feature $feature, CrudService $crudService): Response
    {
        try {
            $result = $crudService->updateEntity($request, $feature, FeatureType::class);

            if ($result['success']) {
                $this->addFlash('success', $this->translator->trans('feature.edit.success', [], 'messages'));
                return $this->redirectToRoute('app_feature_index', [], Response::HTTP_SEE_OTHER);
            }
        } catch (Exception $e) {
            $this->logger->error('Error in FeatureController::edit : ' . $e->getMessage());
            $this->addFlash('error', $this->translator->trans('feature.error.generic', [], 'messages'));
        }

        return $this->render('feature/edit.html.twig', [
            'feature' => $feature,
            'form' => $result['form']->createView(),
        ]);
    }

    #[Route('/{id}', name: 'app_feature_delete', methods: ['POST'])]
    #[IsGranted('ROLE_ADMIN')]
    public function delete(Request $request, Feature $feature, CrudService $crudService): Response
    {
        if ($this->isCsrfTokenValid('delete' . $feature->getId(), $request->request->get('_token'))) {
            try {
                $crudService->deleteEntity($feature);
                $this->addFlash('success', $this->translator->trans('feature.delete.success', [], 'messages'));
            } catch (Exception $e) {
                $this->logger->error('Error in FeatureController::delete : ' . $e->getMessage());
                $this->addFlash('error', $this->translator->trans('feature.error.generic', [], 'messages'));
            }
        }

        return $this->redirectToRoute('app_feature_index', [], Response::HTTP_SEE_OTHER);
    }
}
