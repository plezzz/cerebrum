<?php

namespace App\Controller;


use App\Entity\Role;
use App\Entity\User;
use App\Form\RegisterType;
use App\Form\RoleType;
use App\Service\Role\RoleServiceInterface;
use App\Service\User\UserServiceInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use SlopeIt\BreadcrumbBundle\Annotation\Breadcrumb;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    private UserServiceInterface $userService;
    private RoleServiceInterface $roleService;

    public function __construct(UserServiceInterface $userService, RoleServiceInterface $roleService)
    {
        $this->userService = $userService;
        $this->roleService = $roleService;
    }

    /**
     * @Breadcrumb({"label" = "home", "route" = "home"},{"label" = "Регистрация", "route" = "register"})
     * @param Request $request
     * @Security ("is_granted('ROLE_ADMIN')")
     * @return Response
     */
    #[Route('/register', name: 'register')]
    public function index(Request $request): Response
    {
        $user = new User();
        $form = $this->createForm(RegisterType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
            $this->userService->save($user);
        }

        return $this->render('user/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Breadcrumb({"label" = "home", "route" = "home"},{"label" = "Роли", "route" = "role"})
     * @param Request $request
     * @return Response
     */
    #[Route('/role', name: 'role')]
    public function roles(Request $request): Response
    {
        $role = new Role();
        $form = $this->createForm(RoleType::class, $role);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $role = $form->getData();
            $this->roleService->save($role);
            print_r($role);


            // return $this->redirectToRoute('home');
        }

        return $this->render('user/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
