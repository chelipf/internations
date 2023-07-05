<?php
declare(strict_types=1);

namespace App\Controller\Users;

use App\Internations\Users\Application\UserGroupAdder;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Requirement\Requirement;

final class UserAddGroupController extends AbstractController
{
    #[Route('/users/{userId}/{groupId}', methods: ['PUT'], requirements: ['userId' => Requirement::UUID_V4, 'groupId' => Requirement::UUID_V4])]
    public function __invoke(string $userId, string $groupId, Request $request, UserGroupAdder $userGroupAdder): Response
    {
        $userGroupAdder->__invoke($userId, $groupId);

        return new Response('', Response::HTTP_CREATED);
    }
}