<?php

namespace App\Tests\Entity;


use App\Entity\Report;
use PHPUnit\Framework\TestCase;

class ReportTest extends TestCase
{
    public function testGetDetail()
    {
        // we create an instance of Report
        $report = new Report();

        // we assign a string to this instance
        $report->setDetail('Lorem ipsum');

        // We check that the method returns the correct value
        $this->assertEquals('Lorem ipsum', $report->getDetail());
    }
}
