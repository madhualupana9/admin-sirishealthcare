<?php

namespace App\Console\Commands;

use App\Models\Doctor;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class GenerateDoctorSlotsCommand extends Command
{
    protected $signature = 'slots:generate';

    protected $description = 'Generate availability slots for all active doctors for the next 2 days';

    public function handle(): void
    {
        Log::info('Starting slots generation for all active doctors');

        $this->components->info('Generating availability slots for all active doctors...');

        try {
            Doctor::generateSlotsForAllActiveDoctors();
            $this->components->info('Successfully generated availability slots!');
            Log::info('Successfully generated availability slots for all active doctors');
        } catch (\Exception $e) {
            $this->components->error('Error generating slots: ' . $e->getMessage());
            Log::error('Error generating doctor slots: ' . $e->getMessage());
        }
    }
}
