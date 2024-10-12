<?php

namespace App\Console\Commands;

use App\Enums\VaccineStatus;
use App\Models\VaccineRecipient;
use App\Repositories\VaccineRecipient\Contracts\VaccineRecipientRepositoryInterface;
use Illuminate\Console\Command;

class UpdateVaccineRecipientStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'vaccine:update-recipient-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update vaccine status of vaccine recipient';

    /**
     * Execute the console command.
     */
    public function handle(
        VaccineRecipientRepositoryInterface $vaccineRecipientRepository,
    )
    {
        $recipients = $vaccineRecipientRepository->getScheduledVaccineRecipientsForUpdateStatus();

        $recipients->each(function (VaccineRecipient $vaccineRecipient) {
            $vaccineRecipient->update([
                'status' => VaccineStatus::VACCINATED->value,
            ]);
        });
    }
}
