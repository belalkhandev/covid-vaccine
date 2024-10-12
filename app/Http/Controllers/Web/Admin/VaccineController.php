<?php

namespace App\Http\Controllers\Web\Admin;

use App\Enums\VaccineStatus;
use App\Http\Controllers\Controller;
use App\Repositories\VaccineCenter\Contracts\VaccineCenterRepositoryInterface;
use App\Repositories\VaccineRecipient\Contracts\VaccineRecipientRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Inertia\Inertia;

class VaccineController extends Controller
{
    public function __construct(
        protected VaccineRecipientRepositoryInterface $vaccineRecipientRepository,
        protected VaccineCenterRepositoryInterface $vaccineCenterRepository,
    ) {}

    public function index(Request $request)
    {
        $vaccineCenters = Cache::remember('vaccineCenters', 60 * 10, function () {
            return $this->vaccineCenterRepository->getAll();
        });

        $filterOptions = [
            'nid' => $request->get('nid'),
            'status' => $request->get('status'),
            'vaccine_date' => $request->get('vaccine_date'),
            'vaccine_center' => $request->get('vaccine_center'),
        ];

        $vaccineRecipients = $this->vaccineRecipientRepository->getByPaginate(
            filterOptions: $filterOptions,
            perPage: 20
        );

        return Inertia::render('Vaccine/List', [
            'filterOptions' => $filterOptions,
            'vaccineStatuses' => VaccineStatus::values(),
            'vaccineCenters' => $vaccineCenters,
            'vaccineRecipients' => $vaccineRecipients,
        ]);
    }
}
