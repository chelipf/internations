<?php

declare(strict_types=1);

namespace App\Internations\Users\Domain;

use App\Internations\Users\Domain\ValueObjects\UserId;

interface UserRepository
{
    public function search(UserId $id): ?User;

    public function save(User $user): void;

    public function remove(User $user): void;
}
