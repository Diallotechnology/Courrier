<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Licence;
use App\Enum\LicenceEnum;
use App\Models\Structure;
use App\Helper\LicenceCode;
use App\Jobs\LicenceMailJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Enum;
use App\Notifications\LicenceNotification;
use App\Http\Requests\ReviewLicenceRequest;

class LicenceController extends Controller
{
    use LicenceCode;

        /**
     * Display the specified resource.
     */
    public function review()
    {
        return view('licence.review');
    }

    public function licence_review(ReviewLicenceRequest $request, Structure $structure) {

        DB::transaction(function () use ($structure, $request) {
        $temp = now()->addMonth($request->temps);
        $structure->licences()->create([
                'temps' => $request->temps,
                'debut' => now(),
                'fin' => $temp,
            ]);
        $structure->updateOrFail(['expire_at' => $temp]);
        $notif = new LicenceNotification();
        LicenceMailJob::dispatch($notif, Auth::user());
        toastr()->success('Licence renouvelé avec succès!');
        });
        return to_route('dashboard');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'version' => ['required',new Enum(LicenceEnum::class)],
            'structure_id'=>'required|exists:structures,id',
        ]);

        if ($request->version == LicenceEnum::TRIAL->value) {
            Licence::create([
                'structure_id' => $request->structure_id,
                'version' => $request->version,
                'temps' => 15,
                'debut' => now(),
                'fin' => now()->addDays(15),
                'active' => true,
            ]);
        } elseif($request->version === LicenceEnum::LICENCE->value) {
            Licence::create([
                'structure_id' => $request->structure_id,
                'version' => $request->version,
                'temps' => $request->temps,
                'code' => $this->generateLicenseCode(),
                'debut' => now(),
                'fin' => now()->addMonth($request->temps),
                'active' => true,
            ]);
        }

        toastr()->success('Licence ajouter avec succès!');
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Licence $licence)
    {
        return view('licence.show', compact('licence'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Licence $licence)
    {
        $structure = Structure::all();
        return view('licence.update', compact('licence','structure'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Licence $licence)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Licence $licence)
    {
        //
    }
}
