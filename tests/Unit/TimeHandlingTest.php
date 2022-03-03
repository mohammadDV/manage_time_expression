<?php

namespace Tests\Unit;

use App\Http\Services\TimeHandler\TimeHandlerService;
use PHPUnit\Framework\TestCase;

class TimeHandlingTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_document_sample()
    {
        $timeHandlerService = new TimeHandlerService();
        $result = $timeHandlerService->run(3069000,['2m','m','d','2h']);
        $this->assertEquals(explode('|',trim($result,'|')),
            [
                "2m = 0",
                "m = 1",
                "d = 5",
                "2h = 6.25",
            ]
        );
    }
    public function test_original_sample()
    {
        $timeHandlerService = new TimeHandlerService();
        $result = $timeHandlerService->run(5229000 ,['2m','m','d','2h']);
        $this->assertEquals(explode('|',trim($result,'|')),
            [
                "2m = 1",
                "m = 0",
                "d = 0",
                "2h = 6.25",
            ]
        );
    }
}
