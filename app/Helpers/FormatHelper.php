<?php

namespace App\Helpers;

use Carbon\Carbon;

class FormatHelper
{
    /**
     * Format late duration with days, hours, and minutes
     * 
     * @param Carbon $targetDate Target return date
     * @param Carbon $currentDate Current date for comparison
     * @return array{days: int, hours: int, minutes: int, formatted: string}
     */
    public static function formatLateDuration(Carbon $targetDate, ?Carbon $currentDate = null): array
    {
        $currentDate = $currentDate ?? now();

        if ($currentDate->lte($targetDate)) {
            return [
                'days' => 0,
                'hours' => 0,
                'minutes' => 0,
                'formatted' => 'Tepat waktu'
            ];
        }

        $diff = $targetDate->diff($currentDate);

        $days = (int)($diff->days ?? 0);
        $hours = (int)($diff->h ?? 0);
        $minutes = (int)($diff->i ?? 0);

        // Build formatted string
        $parts = [];
        
        if ($days > 0) {
            $parts[] = $days . ' hari';
        }
        if ($hours > 0) {
            $parts[] = $hours . ' jam';
        }
        if ($minutes > 0) {
            $parts[] = $minutes . ' menit';
        }

        $formatted = count($parts) > 0 ? implode(' ', $parts) : '0 menit';

        return [
            'days' => $days,
            'hours' => $hours,
            'minutes' => $minutes,
            'formatted' => $formatted
        ];
    }

    /**
     * Calculate total minutes from late duration
     * 
     * @param int $days
     * @param int $hours
     * @param int $minutes
     * @return int Total minutes
     */
    public static function totalMinutes(int $days, int $hours, int $minutes): int
    {
        return ($days * 24 * 60) + ($hours * 60) + $minutes;
    }
}
