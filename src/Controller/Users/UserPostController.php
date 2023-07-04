<?php
declare(strict_types=1);

namespace App\Controller\Users;

use App\Internations\Users\Application\UserCreator;
use App\Internations\Users\Domain\ValueObjects\UserId;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class UserPostController extends AbstractController
{
    #[Route('/users', methods: ['POST'])]
    public function __invoke(Request $request, UserCreator $userCreator): Response
    {
        $id = UserId::random()->value();
        $name = $request->get('name');
        $userCreator->__invoke($id, $name);

        return new Response('', Response::HTTP_CREATED);
    }
}