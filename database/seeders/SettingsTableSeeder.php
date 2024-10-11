<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = $this->getSettingsData();

        foreach ($settings as $name => $value) {
            Setting::create(compact('name', 'value'));
        }
    }

    private function getSettingsData(): array
    {
        return [
            'vaccination_available_days' => json_encode([
                'Sunday',
                'Monday',
                'Tuesday',
                'Wednesday',
                'Thursday',
            ]),
        ];
    }
}
