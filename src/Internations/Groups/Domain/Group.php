<?php

namespace App\Internations\Groups\Domain;

use App\Internations\Groups\Domain\ValueObjects\GroupId;
use App\Internations\Groups\Domain\ValueObjects\GroupName;

final class Group
{
    public function __construct(private readonly GroupId $id, private GroupName $name)
    {
    }

    public static function create(GroupId $id, GroupName $name): self
    {
        return new self($id, $name);
    }

    public function id(): GroupId
    {
        return $this->id;
    }

    public function name(): GroupName
    {
        return $this->name;
    }

    public function rename(GroupName $name): void
    {
        $this->name = $name;
    }
}
