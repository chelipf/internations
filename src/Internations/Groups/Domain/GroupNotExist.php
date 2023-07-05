<?php

declare(strict_types=1);

namespace App\Internations\Groups\Domain;

use App\Internations\Groups\Domain\ValueObjects\GroupId;
use DomainException;

final class GroupNotExist extends DomainException
{
    public function __construct(private readonly GroupId $id)
    {
        parent::__construct(sprintf('The group "%s" does not exist', $this->id->value()));
    }
}