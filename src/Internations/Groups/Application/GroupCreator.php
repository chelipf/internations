<?php

declare(strict_types=1);

namespace App\Internations\Groups\Application;

use App\Internations\Groups\Domain\Group;
use App\Internations\Groups\Domain\GroupRepository;
use App\Internations\Groups\Domain\ValueObjects\GroupId;
use App\Internations\Groups\Domain\ValueObjects\GroupName;

final class GroupCreator
{
    public function __construct(private readonly GroupRepository $repository)
    {
    }

    public function __invoke(string $id, string $name): void
    {
        $id = new GroupId($id);
        $name = new GroupName($name);

        $group = Group::create($id, $name);

        $this->repository->save($group);
    }
}