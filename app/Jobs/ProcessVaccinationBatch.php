<?php

namespace App\Jobs;

use App\Enums\VaccineStatus;
use App\Models\VaccineRecipient;
use App\Repositories\Vaccine\Contracts\VaccineRepositoryInterface;
use App\Repositories\VaccineCenter\Contracts\VaccineCenterRepositoryInterface;
use App\Repositories\VaccineRecipient\Contracts\VaccineRecipientRepositoryInterface;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class ProcessVaccinationBatch implements ShouldQueue
{
    use Queueable;

    protected $recipientIds;

    protected $vaccinationApplicableDate;

    /**
     * Create a new job instance.
     */
    public function __construct(
        array $recipientIds, string $vaccinationApplicableDate
    ) {
        $this->recipientIds = $recipientIds;
        $this->vaccinationApplicableDate = $vaccinationApplicableDate;
    }

    /**
     * Execute the job.
     */
    public function handle(
        VaccineCenterRepositoryInterface $vaccineCenterRepository,
        VaccineRecipientRepositoryInterface $vaccineRecipientRepository,
        VaccineRepositoryInterface $vaccineRepository
    ): void {
        $vaccinationApplicableDate = $this->vaccinationApplicableDate;
        $vaccineCenters = $vaccineCenterRepository->getAll();

        $centersCapacity = $vaccineCenters->mapWithKeys(function ($center) {
            return [$center->id => $center->daily_vaccination_capacity];
        });

        $vaccineRecipientRepository->getByIds($this->recipientIds)
            ->each(function (VaccineRecipient $vaccineRecipient) use ($vaccinationApplicableDate, $vaccineRepository, $centersCapacity, $vaccineCenters) {

                $preferredCenter = $vaccineRecipient->vaccine_center_id;

                if ($centersCapacity[$preferredCenter] > 0) {
                    $centerId = $preferredCenter;
                } else {
                    $centerId = $vaccineCenters->first(function ($center) use ($centersCapacity) {
                        return $centersCapacity[$center->id] > 0;
                    })->id;
                }

                $centersCapacity->put($centerId, $centersCapacity->get($centerId) - 1);

                $vaccineRepository->store([
                    'vaccine_recipient_id' => $vaccineRecipient->id,
                    'vaccine_center_id' => $centerId,
                    'vaccine_dosage_id' => $vaccineCenters->firstWhere('id', $centerId)->vaccineDosages->first()->id,
                    'vaccination_date' => $vaccinationApplicableDate,
                ]);

                $vaccineRecipient->update([
                    'status' => VaccineStatus::SCHEDULED,
                ]);
            }
            );
    }
}
