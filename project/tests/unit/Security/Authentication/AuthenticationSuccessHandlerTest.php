<?php

namespace App\Tests\Unit\Security\Authentification;

use App\Entity\User;
use App\Security\Authentication\AuthenticationSuccessHandler;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class AuthenticationSuccessHandlerTest extends TestCase
{
    /**
     * @test
     */
    public function onAuthenticationSuccessAdmin(): void
    {
        $router = $this->createMock(RouterInterface::class);
        $user = $this->createMock(User::class);
        $request = $this->createMock(Request::class);
        $token = $this->createMock(TokenInterface::class);

        $token->expects($this->once())
            ->method('getUser')
            ->willReturn($user);
        $user->expects($this->once())
            ->method('getRoles')
            ->willReturn(['ROLE_ADMIN', 'ROLE_USER']);
        $router->expects($this->once())
            ->method('generate')
            ->with('admin_dashboard')
            ->willReturn('admin_dashboard');

        $handler = new AuthenticationSuccessHandler($router);
        $actual = $handler->onAuthenticationSuccess($request, $token);
        $this->assertInstanceOf(RedirectResponse::class, $actual);
        $this->assertEquals('admin_dashboard', $actual->getTargetUrl());
    }

    /**
     * @test
     */
    public function onAuthenticationSuccessUser(): void
    {
        $router = $this->createMock(RouterInterface::class);
        $user = $this->createMock(User::class);
        $request = $this->createMock(Request::class);
        $token = $this->createMock(TokenInterface::class);

        $token->expects($this->once())
            ->method('getUser')
            ->willReturn($user);
        $user->expects($this->once())
            ->method('getRoles')
            ->willReturn(['ROLE_USER']);
        $router->expects($this->once())
            ->method('generate')
            ->with('user_profile_view')
            ->willReturn('user_profile_view');

        $handler = new AuthenticationSuccessHandler($router);
        $actual = $handler->onAuthenticationSuccess($request, $token);
        $this->assertInstanceOf(RedirectResponse::class, $actual);
        $this->assertEquals('user_profile_view', $actual->getTargetUrl());
    }
}
