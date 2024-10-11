<?php

namespace Database\Seeders;

use App\Models\VaccineDosage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VaccineDosageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vaccineDosages = $this->getVaccineDosageData();

        foreach ($vaccineDosages as $vaccineDosage) {
            VaccineDosage::create([
                'name' => $vaccineDosage['name'],
            ]);
        }
    }

    private function getVaccineDosageData(): array
    {
        return [
            [
                'name' => 'Sinopharm',
            ],
            [
                'name' => 'Pfizer',
            ],
            [
                'name' => 'Moderna',
            ],
            [
                'name' => 'Covaxin',
            ],
            [
                'name' => 'Novavax',
            ]
        ];
    }
}
