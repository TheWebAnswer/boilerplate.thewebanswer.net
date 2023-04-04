<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserEditType;
use App\Repository\FeatureRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Contracts\Translation\TranslatorInterface;

#[Route('/profil')]
class UserController extends AbstractController
{
    private LoggerInterface $logger;
    private PaginatorInterface $paginator;
    private TranslatorInterface $translator;
    private EntityManagerInterface $em;

    public function __construct(LoggerInterface $logger, PaginatorInterface $paginator, TranslatorInterface $translator, EntityManagerInterface $em)
    {
        $this->logger = $logger;
        $this->paginator = $paginator;
        $this->translator = $translator;
        $this->em = $em;
    }

    #[Route('/', name: 'app_user_index', methods: ['GET'])]
    #[isGranted('ROLE_ADMIN')]
    public function index(FeatureRepository $featureRepository, Request $request): Response
    {
        $query = $featureRepository->createQueryBuilder('u')->getQuery();
        $pagination = $this->paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            10 // Nombre d'éléments par page
        );

        return $this->render('user/index.html.twig', [
            'pagination' => $pagination,
        ]);
    }

    #[Route('/{id}', name: 'app_user_show', methods: ['GET'])]
    #[IsGranted('ROLE_USER')]
    public function show(User $user): Response
    {
        if ($this->getUser() === $user) {
            return $this->render('user/show.html.twig', [
                'user' => $user,
            ]);
        }
        $this->logger->error('Error in UserController::show : User try to access other user');
        $this->addFlash('error', $this->translator->trans('feature.error.generic', [], 'messages'));

        return $this->redirectToRoute('app_home');
    }

    #[Route('/{id}/edit', name: 'app_user_edit', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_USER')]
    public function edit(Request $request, User $user, UserRepository $userRepository): Response
    {
        if ($this->getUser() !== $user) {
            $this->logger->error('Error in UserController::edit : User try to access other user');
            $this->addFlash('error', $this->translator->trans('feature.error.generic', [], 'messages'));

            return $this->redirectToRoute('app_home');
        }

        $form = $this->createForm(UserEditType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userTemp = $user;
            $userRepository->save($userTemp, true);


            $this->addFlash('success', $this->translator->trans('user.edit.success', [], 'messages'));

            return $this->redirectToRoute('app_user_show', ['id' => $user->getId()]);
        }

        return $this->render('user/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }
}
