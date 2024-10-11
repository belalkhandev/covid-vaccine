<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\VaccineRegisterRequest;
use App\Repositories\VaccineCenter\Contracts\VaccineCenterRepositoryInterface;
use App\Repositories\VaccineRecipient\Contracts\VaccineRecipientRepositoryInterface;
use Inertia\Inertia;

class VaccineRegistrationController extends Controller
{
    public function __construct(
        protected VaccineCenterRepositoryInterface $vaccineCenterRepository,
        protected VaccineRecipientRepositoryInterface $vaccineRecipientRepository
    )
    {
    }

    public function index()
    {
        $vaccineCenters = $this->vaccineCenterRepository->getAll();

        return Inertia::render('Vaccine/Register', [
            'vaccineCenters' => $vaccineCenters
        ]);
    }

    public function store(VaccineRegisterRequest $request)
    {
        $this->vaccineRecipientRepository->store($request->all());

        return to_route('register')
            ->with('success', 'Thank you for register for vaccine.');
    }
}
