<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CancellationReason;

class CancellationReasonsSeeder extends Seeder
{
    public function run()
    {
        $reasons = [
            ['reason' => 'Doctor Not Available', 'active' => true],
            ['reason' => 'Patient Not Available', 'active' => true],
            ['reason' => 'Emergency Situation', 'active' => true],
            ['reason' => 'Technical Issues', 'active' => true],
        ];

        foreach ($reasons as $reason) {
            CancellationReason::create($reason);
        }
    }
}
