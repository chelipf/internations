<?php

declare(strict_types=1);

namespace App\Internations\Shared\Infrastructure\Symfony;

use App\Internations\Groups\Domain\GroupNotExist;
use App\Internations\Users\Domain\UserNotExist;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

class ExceptionListener
{
    public function __invoke(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();

        $response = new Response();
        $response->setContent($exception->getMessage());

        $statusCode = match(get_class($exception)) {
            UserNotExist::class => Response::HTTP_NOT_FOUND,
            GroupNotExist::class => Response::HTTP_NOT_FOUND,
            default => Response::HTTP_INTERNAL_SERVER_ERROR
        };

        $response->setStatusCode($statusCode);

        $event->setResponse($response);
    }
}