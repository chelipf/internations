<?php

declare(strict_types=1);

namespace App\Internations\Users\Application;

use App\Internations\Groups\Domain\GroupNotExist;
use App\Internations\Groups\Domain\GroupRepository;
use App\Internations\Groups\Domain\ValueObjects\GroupId;
use App\Internations\Users\Domain\UserNotExist;
use App\Internations\Users\Domain\UserRepository;
use App\Internations\Users\Domain\ValueObjects\UserId;

final class UserGroupAdder
{
    public function __construct(private readonly UserRepository $userRepository, private readonly GroupRepository $groupRepository)
    {
    }

    public function __invoke(string $userId, string $groupId): void
    {
        $userId = new UserId($userId);
        $user = $this->userRepository->search($userId);

        if (null === $user) {
            throw new UserNotExist($userId);
        }

        $groupId = new GroupId($groupId);
        $group = $this->groupRepository->search($groupId);

        if (null === $group) {
            throw new GroupNotExist($groupId);
        }

        $user->addGroup($group);

        $this->userRepository->save($user);
    }
}