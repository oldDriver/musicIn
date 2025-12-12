<?php

namespace App\Tests\Unit\Controller\Admin;

use App\Controller\Admin\UserCrudController;
use PHPUnit\Framework\TestCase;

class UserCrudControllerTest extends TestCase
{
    /**
     * @test
     */
    public function getEntityFqcn(): void
    {
        $this->assertEquals('App\Entity\User', UserCrudController::getEntityFqcn());
    }
}
