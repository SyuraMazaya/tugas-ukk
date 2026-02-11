<?php

namespace App\Console\Commands;

use App\Models\Pengembalian;
use Illuminate\Console\Command;

class FixNegativeDenda extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'denda:fix-negative';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fix negative denda values in pengembalian table';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Memperbaiki nilai denda negatif...');
        
        $negativeDenda = Pengembalian::where('denda', '<', 0)->get();
        
        if ($negativeDenda->isEmpty()) {
            $this->info('✓ Tidak ada denda negatif yang perlu diperbaiki!');
            return 0;
        }
        
        $count = 0;
        foreach ($negativeDenda as $pengembalian) {
            $oldValue = $pengembalian->denda;
            $newValue = abs($oldValue);
            
            $pengembalian->update(['denda' => $newValue]);
            
            $this->line("ID {$pengembalian->id}: {$oldValue} → {$newValue}");
            $count++;
        }
        
        $this->newLine();
        $this->info("✓ Berhasil memperbaiki {$count} data denda!");
        
        // Show current total
        $totalDenda = Pengembalian::sum('denda');
        $this->info("Total denda sekarang: Rp " . number_format($totalDenda, 0, ',', '.'));
        
        return 0;
    }
}
