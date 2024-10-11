<?php

namespace Database\Seeders;

use App\Models\VaccineCenter;
use App\Models\VaccineDosage;
use Illuminate\Database\Seeder;

class VaccineCenterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->getVaccineCenterData() as $vaccineCenter) {
            $vaccineCenter = VaccineCenter::create([
                'name' => $vaccineCenter['name'],
                'address' => $vaccineCenter['address'],
                'daily_vaccination_capacity' => rand(50, 100),
            ]);

            $vaccineDosage = VaccineDosage::inRandomOrder()->first();
            $vaccineCenter->vaccineDosages()->attach($vaccineDosage);
        }
    }

    private function getVaccineCenterData(): array
    {
        return [
            [
                'name' => 'Dhaka Medical College Hospital',
                'address' => '64 Mitford Road, Dhaka-1000',
            ],
            [
                'name' => 'Ibn Sina Hospital',
                'address' => 'House 48, Road 9/A, Dhanmondi, Dhaka-1209',
            ],
            [
                'name' => 'Kurmitola General Hospital',
                'address' => 'New Airport Road, Dhaka Cantonment, Dhaka-1206',
            ],
            [
                'name' => 'Apollo Hospital Dhaka',
                'address' => 'Plot 81, Block E, Bashundhara R/A, Dhaka-1229',
            ],
            [
                'name' => 'National Institute of Neurosciences & Hospital	',
                'address' => 'Sher-E-Bangla Nagar, Dhaka-1207',
            ],
        ];
    }
}
