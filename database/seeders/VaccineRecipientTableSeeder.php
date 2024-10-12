<?php

namespace Database\Seeders;

use App\Models\VaccineCenter;
use App\Models\VaccineRecipient;
use Illuminate\Database\Seeder;

class VaccineRecipientTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vaccineCenterIds = VaccineCenter::active()->get()->pluck('id')->toArray();

        VaccineRecipient::factory(5000)->create([
            'vaccine_center_id' => function () use ($vaccineCenterIds) {
                return $vaccineCenterIds[array_rand($vaccineCenterIds)];
            },
        ]);
    }
}
