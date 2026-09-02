<?php

namespace Tests\Feature;

use App\Http\Requests\Admin\AlumniRequest;
use Tests\TestCase;

class AlumniStatusTest extends TestCase
{
    public function test_alumni_status_rules_include_berwirausaha(): void
    {
        $rules = (new AlumniRequest())->rules();

        $this->assertArrayHasKey('status', $rules);
        $this->assertStringContainsString('Berwirausaha', implode(',', $rules['status']));
    }
}
