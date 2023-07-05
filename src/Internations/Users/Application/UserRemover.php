<?php

declare(strict_types=1);

namespace App\Internations\Users\Application;

use App\Internations\Users\Domain\UserNotExist;
use App\Internations\Users\Domain\UserRepository;
use App\Internations\Users\Domain\ValueObjects\UserId;

final class UserRemover
{
    public function __construct(private readonly UserRepository $repository)
    {
    }

    public function __invoke(string $id): void
    {
        $id = new UserId($id);
        $user = $this->repository->search($id);

        if (null === $user) {
            throw new UserNotExist($id);
        }

        $this->repository->remove($user);
    }
}