<?php

declare(strict_types=1);

namespace Users\Application;

use App\Internations\Users\Application\UserRemover;
use App\Internations\Users\Domain\User;
use App\Internations\Users\Domain\UserNotExist;
use App\Internations\Users\Domain\UserRepository;
use App\Internations\Users\Domain\ValueObjects\UserId;
use App\Internations\Users\Domain\ValueObjects\UserName;
use InvalidArgumentException;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class RemoveUserTest extends KernelTestCase
{
    const UUID = '0ef4076c-3824-451a-ae83-6bcfa45c9819';
    const USER_NAME = 'cheli';
    private UserRepository $repository;

    /** @test */
    public function it_should_remove_a_valid_user(): void
    {
        $userId = new UserId(self::UUID);
        $name = new UserName(self::USER_NAME);
        $user = new User($userId, $name);

        $this->shouldSearch($userId);
        $this->shouldRemove($user);

        $userRemover = new UserRemover($this->repository);
        $userRemover->__invoke(self::UUID);
    }

    /** @test */
    public function it_should_throw_uuid_exception_when_removing_a_user(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $userId = new UserId('');
        $name = new UserName(self::USER_NAME);
        $user = new User($userId, $name);

        $this->shouldSearch($userId);
        $this->shouldRemove($user);

        $userRemover = new UserRemover($this->repository);
        $userRemover->__invoke('');
    }

    /** @test */
    public function it_should_throw_user_not_exists_exception_when_removing_a_user(): void
    {
        $userId = new UserId(self::UUID);

        $this->shouldSearchReturningNull($userId);

        $this->expectException(UserNotExist::class);
        $userRemover = new UserRemover($this->repository);
        $userRemover->__invoke(self::UUID);
    }

    protected function shouldSearch(UserId $userId): void
    {
        $this->repository()->expects(self::once())
            ->method('search')
            ->with($userId)
            ->willReturn(new User($userId, new UserName(self::USER_NAME)));
    }

    protected function shouldSearchReturningNull(UserId $userId): void
    {
        $this->repository()->expects(self::once())
            ->method('search')
            ->with($userId)
            ->willReturn(null);
    }

    protected function shouldRemove(User $user): void
    {
        $this->repository()->expects(self::once())
            ->method('remove')
            ->with($user);
    }

    protected function repository()
    {
        return $this->repository = $this->repository ?? $this->createMock(UserRepository::class);
    }
}