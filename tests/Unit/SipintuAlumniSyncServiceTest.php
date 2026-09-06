<?php

namespace Tests\Unit;

use App\Services\SipintuAlumniSyncService;
use App\Services\SipintuGatewayService;
use Illuminate\Database\DatabaseManager;
use Tests\TestCase;

class SipintuAlumniSyncServiceTest extends TestCase
{
    public function test_filter_only_keeps_students_with_null_classroom(): void
    {
        $service = new SipintuAlumniSyncService(
            $this->createMock(SipintuGatewayService::class),
            $this->createMock(DatabaseManager::class)
        );

        $records = [
            [
                'id' => 1,
                'nis' => '1001',
                'nama' => 'Student 1 (Alumni)',
                'classroom_id' => null,
                'classroom' => null,
            ],
            [
                'id' => 2,
                'nis' => '1002',
                'nama' => 'Student 2 (Active)',
                'classroom_id' => 59,
                'classroom' => ['id' => 59, 'name' => 'XII TO 1'],
            ],
            [
                'id' => 3,
                'nis' => '1003',
                'nama' => 'Student 3 (Active without classroom relation)',
                'classroom_id' => 60,
                'classroom' => null,
            ],
            [
                'id' => 4,
                'nis' => '1004',
                'nama' => 'Student 4 (Alumni 2)',
                'classroom_id' => null,
                'classroom' => null,
            ],
        ];

        $filtered = $service->filterOnlyNullClassroom($records);

        $this->assertCount(2, $filtered);
        $this->assertSame('1001', $filtered[0]['nis']);
        $this->assertSame('1004', $filtered[1]['nis']);
    }

    public function test_extract_records_handles_data_key(): void
    {
        $service = new SipintuAlumniSyncService(
            $this->createMock(SipintuGatewayService::class),
            $this->createMock(DatabaseManager::class)
        );

        $reflection = new \ReflectionClass($service);
        $method = $reflection->getMethod('extractRecords');
        $method->setAccessible(true);

        $result = $method->invoke($service, ['data' => [['id' => 1]]]);
        $this->assertSame([['id' => 1]], $result);
    }
}
