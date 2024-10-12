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
                'name' => 'National Institute of Neurosciences & Hospital',
                'address' => 'Sher-E-Bangla Nagar, Dhaka-1207',
            ],
            [
                'name' => 'Bangabandhu Sheikh Mujib Medical University (BSMMU)',
                'address' => 'Shahbag, Dhaka-1000',
            ],
            [
                'name' => 'BIRDEM General Hospital',
                'address' => '122 Kazi Nazrul Islam Avenue, Shahbagh, Dhaka-1000',
            ],
            [
                'name' => 'United Hospital Limited',
                'address' => 'Plot 15, Road 71, Gulshan, Dhaka-1212',
            ],
            [
                'name' => 'Holy Family Red Crescent Medical College Hospital',
                'address' => '1 Eskaton Garden Road, Dhaka-1000',
            ],
            [
                'name' => 'Shaheed Suhrawardy Medical College Hospital',
                'address' => 'Sher-E-Bangla Nagar, Dhaka-1207',
            ],
            [
                'name' => 'Square Hospital',
                'address' => '18/F, Bir Uttam Qazi Nuruzzaman Sarak, Dhaka-1205',
            ],
            [
                'name' => 'Popular Medical College & Hospital',
                'address' => 'House 25, Road 2, Dhanmondi, Dhaka-1205',
            ],
            [
                'name' => 'Labaid Hospital',
                'address' => 'House 1, Road 4, Dhanmondi, Dhaka-1205',
            ],
            [
                'name' => 'Ahsania Mission Cancer & General Hospital',
                'address' => 'Plot No. M-1/C, Mirpur-14, Dhaka-1206',
            ],
            [
                'name' => 'Sir Salimullah Medical College and Mitford Hospital',
                'address' => 'Mitford, Dhaka-1100',
            ],
        ];
    }
}
