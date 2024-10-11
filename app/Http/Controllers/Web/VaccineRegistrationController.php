<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\VaccineRegisterRequest;
use App\Repositories\VaccineCenter\Contracts\VaccineCenterRepositoryInterface;
use Illuminate\Http\Request;
use Inertia\Inertia;

class VaccineRegistrationController extends Controller
{
    public function __construct(
        protected VaccineCenterRepositoryInterface $vaccineCenterRepository
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

    }
}
