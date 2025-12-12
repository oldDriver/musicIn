<?php

namespace App\Tests\Unit\Controller\Admin;

use App\Controller\Admin\InstrumentCrudController;
use PHPUnit\Framework\TestCase;

class InstrumentCrudControllerTest extends TestCase
{
    /**
     * @test
     */
    public function getEntityFqcn(): void
    {
        $this->assertEquals('App\Entity\Instrument', InstrumentCrudController::getEntityFqcn());
    }
}
