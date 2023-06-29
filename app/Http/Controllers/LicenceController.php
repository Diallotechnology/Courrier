<?php

namespace App\Http\Controllers;

use App\Models\Licence;
use App\Enum\LicenceEnum;
use App\Models\Structure;
use App\Helper\LicenceCode;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Enum;

class LicenceController extends Controller
{
    use LicenceCode;

    public function licence_review(Request $request, Licence $licence) {
        $request->validate([
            'version' => 'required',
            'temps' => 'required|integer'
        ]);
        $licence->updateOrFail([
            'version' => $request->version,
            'temps' => $request->temps,
            'fin' => now()->addMonth($request->temps),
        ]);
        toastr()->success('Licence renouvelé avec succès!');
        return back();
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
