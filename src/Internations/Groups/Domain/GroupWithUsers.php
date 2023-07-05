<?php

declare(strict_types=1);

namespace App\Internations\Groups\Domain;

use App\Internations\Groups\Domain\ValueObjects\GroupId;
use DomainException;

final class GroupWithUsers extends DomainException
{
    public function __construct(private readonly GroupId $id)
    {
        parent::__construct(sprintf('The group "%s" cannot be removed because it has some users', $this->id->value()));
    }
}