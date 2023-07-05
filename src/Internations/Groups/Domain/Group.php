<?php

namespace App\Internations\Groups\Domain;

use App\Internations\Groups\Domain\ValueObjects\GroupId;
use App\Internations\Groups\Domain\ValueObjects\GroupName;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

final class Group
{
    private Collection $users;
    public function __construct(private readonly GroupId $id, private GroupName $name)
    {
        $this->users = new ArrayCollection();
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

    public function hasUsers()
    {
        return !$this->users->isEmpty();
    }
}
