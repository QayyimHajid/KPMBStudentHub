<?php

namespace Tests\Unit;

use App\Support\AcademicSession;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class AcademicSessionTest extends TestCase
{
    public function test_canonical_session_format_is_accepted(): void
    {
        $validator = Validator::make(
            ['academic_session' => '2 2026/2027'],
            ['academic_session' => AcademicSession::rules()]
        );

        $this->assertTrue($validator->passes());
    }

    public function test_legacy_bare_session_format_is_rejected_for_new_records(): void
    {
        $validator = Validator::make(
            ['academic_session' => '2026/2027'],
            ['academic_session' => AcademicSession::rules()]
        );

        $this->assertFalse($validator->passes());
    }

    public function test_unchanged_historical_session_can_be_kept_when_editing(): void
    {
        $validator = Validator::make(
            ['academic_session' => '2025/2026'],
            ['academic_session' => AcademicSession::rules('2025/2026')]
        );

        $this->assertTrue($validator->passes());
    }

    public function test_known_legacy_current_session_aliases_are_normalized(): void
    {
        $this->assertSame('2 2026/2027', AcademicSession::normalizeKnownAlias('2026/2027'));
        $this->assertSame('2 2026/2027', AcademicSession::normalizeKnownAlias('Session 2 2026/2027'));
        $this->assertSame('2025/2026', AcademicSession::normalizeKnownAlias('2025/2026'));
    }
}
