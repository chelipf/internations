<?php

declare(strict_types=1);

namespace App\Internations\Groups\Application;

use App\Internations\Groups\Domain\GroupNotExist;
use App\Internations\Groups\Domain\GroupRepository;
use App\Internations\Groups\Domain\ValueObjects\GroupId;

final class GroupRemover
{
    public function __construct(private readonly GroupRepository $repository)
    {
    }

    public function __invoke(string $id): void
    {
        $id = new GroupId($id);
        $group = $this->repository->search($id);

        if (null === $group) {
            throw new GroupNotExist($id);
        }

        $this->repository->remove($group);
    }
}