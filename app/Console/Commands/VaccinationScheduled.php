<?php

namespace App\Console\Commands;

use App\Jobs\ProcessVaccinationBatch;
use App\Repositories\Settings\Contracts\SettingsRepositoryInterface;
use App\Repositories\VaccineCenter\Contracts\VaccineCenterRepositoryInterface;
use App\Repositories\VaccineRecipient\Contracts\VaccineRecipientRepositoryInterface;
use Illuminate\Console\Command;

class VaccinationScheduled extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'vaccine:assign-scheduled';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    public function __construct(
        protected SettingsRepositoryInterface $settingsRepository,
        protected VaccineCenterRepositoryInterface $vaccineCenterRepository,
        protected VaccineRecipientRepositoryInterface $vaccineRecipientRepository,
    ) {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $vaccinationApplicableDate = $this->getVaccinationApplicableDate();

        if (! $vaccinationApplicableDate) {
            $this->info('Unavailable date');

            return;
        }

        $dailyTotalVaccinationCapacity = $this->vaccineCenterRepository->countDailyVaccinationCapacity();
        $totalProcessed = 0;

        $this->vaccineRecipientRepository->getUnassignedRecipients()
            ->chunk(100, function ($recipients) use ($vaccinationApplicableDate, &$totalProcessed, $dailyTotalVaccinationCapacity) {
                $remainingCapacity = $dailyTotalVaccinationCapacity - $totalProcessed;

                if ($remainingCapacity <= 0) {
                    return false;
                }

                $recipientIds = $recipients->pluck('id')->take($remainingCapacity)->toArray();

                ProcessVaccinationBatch::dispatch($recipientIds, $vaccinationApplicableDate);

                $totalProcessed += count($recipientIds);

                if ($totalProcessed >= $dailyTotalVaccinationCapacity) {
                    return false;
                }

                return true;
            });
    }

    private function getVaccinationApplicableDate(): ?string
    {
        $availableDays = json_decode($this->settingsRepository->getValueByName('vaccination_available_days'));

        if (empty($availableDays)) {
            return null;
        }

        $date = now()->addDay();
        $dayName = $date->format('l');

        if (! in_array($dayName, $availableDays)) {
            return null;
        }

        return $date->format('Y-m-d');
    }
}
