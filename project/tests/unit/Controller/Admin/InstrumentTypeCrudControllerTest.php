<?php

namespace App\Tests\Unit\Controller\Admin;

use App\Controller\Admin\InstrumentTypeCrudController;
use PHPUnit\Framework\TestCase;

class InstrumentTypeCrudControllerTest extends TestCase
{
    /**
     * @test
     */
    public function getEntityFqcn(): void
    {
        $this->assertEquals('App\Entity\InstrumentType', InstrumentTypeCrudController::getEntityFqcn());
    }
}
