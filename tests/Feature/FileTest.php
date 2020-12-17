<?php

namespace Tests\Feature;

use App\Models\File as ModelsFile;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FileTest extends TestCase
{
    /** @test */
    public function it_should_be_store_in_database()
    {
        Carbon::setTestNow(now());
        //$this->withoutExceptionHandling();

        $file = ModelsFile::factory()->make();
        $this->assertNotEmpty($file);
    }
}
