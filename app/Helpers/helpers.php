<?php

use App\Helpers\FormatHelper;
use App\Models\Denda;

if (!function_exists('formatLateDuration')) {
    /**
     * Format late duration with days, hours, and minutes
     * 
     * @param \Carbon\Carbon $targetDate Target return date
     * @param \Carbon\Carbon|null $currentDate Current date for comparison
     * @return array{days: int, hours: int, minutes: int, formatted: string}
     */
    function formatLateDuration($targetDate, $currentDate = null) {
        return FormatHelper::formatLateDuration($targetDate, $currentDate);
    }
}

if (!function_exists('totalMinutes')) {
    /**
     * Calculate total minutes from late duration
     * 
     * @param int $days
     * @param int $hours
     * @param int $minutes
     * @return int Total minutes
     */
    function totalMinutes($days, $hours, $minutes) {
        return FormatHelper::totalMinutes($days, $hours, $minutes);
    }
}

if (!function_exists('getTarifDendaAktif')) {
    /**
     * Get active denda tariff per day
     * 
     * @return float Denda per day in Rupiah
     */
    function getTarifDendaAktif() {
        try {
            // Ambil denda aktif pertama (tidak peduli ID berapa)
            $denda = Denda::where('is_active', true)
                         ->orderBy('created_at', 'desc')
                         ->first();
            
            if ($denda && isset($denda->jumlah_denda)) {
                return (float)$denda->jumlah_denda;
            }
            
            // Jika tidak ada denda aktif, coba ambil denda terbaru apapun statusnya
            $latestDenda = Denda::orderBy('created_at', 'desc')->first();
            if ($latestDenda && isset($latestDenda->jumlah_denda)) {
                return (float)$latestDenda->jumlah_denda;
            }
            
            // Fallback ke konstanta default jika benar-benar tidak ada data
            return 1000;
        } catch (\Exception $e) {
            // Jika ada error, gunakan default
            return 1000;
        }
    }
}

if (!function_exists('hitungDendaKeterlambatan')) {
    /**
     * Calculate fine based on late duration
     * 
     * @param int $days Days late
     * @param int $hours Hours late
     * @param int $minutes Minutes late
     * @return float Total fine
     */
    function hitungDendaKeterlambatan($days, $hours, $minutes) {
        $tarifPerHari = getTarifDendaAktif();
        
        // Hitung total jam
        $totalJam = ($days * 24) + $hours + ($minutes / 60);
        
        // Denda dihitung per jam
        $dendaPerJam = $tarifPerHari / 24;
        
        // Total denda
        return ceil($totalJam) * $dendaPerJam;
    }
}
