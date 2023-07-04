<?php

declare(strict_types=1);

namespace App\Internations\Users\Domain;

interface UserRepository
{
    public function save(User $user): void;

    public function remove(User $user): void;
}
