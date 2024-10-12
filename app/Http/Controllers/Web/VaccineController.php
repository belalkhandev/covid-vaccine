<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\CheckStatusRequest;
use App\Repositories\VaccineRecipient\Contracts\VaccineRecipientRepositoryInterface;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class VaccineController extends Controller
{
    public function __construct(
        protected VaccineRecipientRepositoryInterface $vaccineRecipientRepository,
    ) {}

    public function checkStatus(CheckStatusRequest $request)
    {
        $nid = $request->input('nid');

        $vaccineRecipient = $this->vaccineRecipientRepository->findByNID($nid);

        if (! $vaccineRecipient) {
            return Redirect::back()->withErrors([
                'message' => 'No vaccine registration record found, Please register for vaccine!',
            ]);
        }

        return Inertia::render('Vaccine/CheckStatus', [
            'vaccineRecipient' => $vaccineRecipient,
        ]);
    }
}
