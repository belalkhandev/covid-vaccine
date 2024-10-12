<?php

namespace App\Console\Commands;

use App\Mail\SendScheduleMailToVaccineRecipient;
use App\Models\VaccineRecipient;
use App\Repositories\VaccineRecipient\Contracts\VaccineRecipientRepositoryInterface;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendScheduleEmailToVaccineRecipients extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'vaccine:send-schedule-mail-to-recipients';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send schedule of vaccine';

    /**
     * Execute the console command.
     */
    public function handle(
        VaccineRecipientRepositoryInterface $vaccineRecipientRepository
    )
    {
        $recipients = $vaccineRecipientRepository->getScheduledVaccineRecipients(['vaccine', 'vaccine.vaccineCenter', 'vaccine.vaccineDosage']);

        $recipients->each(function (VaccineRecipient $vaccineRecipient) {
            if (!$vaccineRecipient->email) {
                return;
            }

            Mail::to($vaccineRecipient->email)->queue(new SendScheduleMailToVaccineRecipient($vaccineRecipient));
        });
    }
}
