<?php

declare(strict_types=1);

namespace App\Internations\Users\Application;

use App\Internations\Users\Domain\User;
use App\Internations\Users\Domain\UserRepository;
use App\Internations\Users\Domain\ValueObjects\UserId;
use App\Internations\Users\Domain\ValueObjects\UserName;

final class UserCreator
{
    public function __construct(private readonly UserRepository $repository)
    {
    }

    public function __invoke(string $id, string $name): void
    {
        $id = new UserId($id);
        $name = new UserName($name);

        $user = User::create($id, $name);

        $this->repository->save($user);
    }
}