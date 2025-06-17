<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SeedTest extends Command
{
    protected $signature = 'seed:test';
    protected $description = 'Seed testing data';

    public function handle()
    {
        $this->call('db:seed', [
            '--class' => 'ProductSampleSeeder'
        ]);

        $this->info('✅ Data testing berhasil disimpan.');
    }
}
