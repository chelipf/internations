<?php

namespace App\Internations\Users\Domain;

use App\Internations\Users\Domain\ValueObjects\UserId;
use App\Internations\Users\Domain\ValueObjects\UserName;

final class User
{
    public function __construct(private readonly UserId $id, private UserName $name)
    {
    }

    public static function create(UserId $id, UserName $name): self
    {
        return new self($id, $name);
    }

    public function id(): UserId
    {
        return $this->id;
    }

    public function name(): UserName
    {
        return $this->name;
    }

    public function rename(UserName $name): void
    {
        $this->name = $name;
    }
}
