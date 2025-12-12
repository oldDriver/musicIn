<?php

namespace App\Tests\Unit\Controller\Admin;

use App\Controller\Admin\GenreCrudController;
use PHPUnit\Framework\TestCase;

class GenreCrudControllerTest extends TestCase
{
    /**
     * @test
     */
    public function getEntityFqcn(): void
    {
        $this->assertEquals('App\Entity\Genre', GenreCrudController::getEntityFqcn());
    }
}
