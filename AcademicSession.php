<?php

namespace App\Support;

/**
 * Shared academic-session validation and compatibility helpers.
 */
class AcademicSession
{
    public const CURRENT = '2 2026/2027';

    /**
     * Validation rules for new academic-session values.
     * An unchanged legacy value may be allowed when editing an old record,
     * so historical data can still be maintained without silently rewriting it.
     */
    public static function rules(?string $allowExistingLegacyValue = null): array
    {
        return [
            'required',
            'string',
            'max:20',
            function ($attribute, $value, $fail) use ($allowExistingLegacyValue) {
                $value = trim((string) $value);
                $isCanonical = preg_match('/^[12] \d{4}\/\d{4}$/', $value) === 1;
                $isUnchangedLegacyValue = $allowExistingLegacyValue !== null
                    && $value === $allowExistingLegacyValue;

                if (!$isCanonical && !$isUnchangedLegacyValue) {
                    $fail('Format sesi akademik mesti seperti 2 2026/2027.');
                }
            },
        ];
    }

    /**
     * Normalize the two known legacy spellings for the current session.
     * This is used for old GET filter URLs and timetable synchronization only.
     */
    public static function normalizeKnownAlias(?string $session): ?string
    {
        if ($session === null) {
            return null;
        }

        $session = trim($session);

        if (in_array($session, ['2026/2027', 'Session 2 2026/2027'], true)) {
            return self::CURRENT;
        }

        return $session;
    }
}
