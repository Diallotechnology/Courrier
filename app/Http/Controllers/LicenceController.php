<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Licence;
use App\Enum\LicenceEnum;
use App\Models\Structure;
use App\Helper\LicenceCode;
use App\Helper\OrderAPI;
use App\Jobs\LicenceMailJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Enum;
use App\Notifications\LicenceNotification;
use App\Http\Requests\ReviewLicenceRequest;

class LicenceController extends Controller
{
    use OrderAPI;

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
        // $url = $this->create_order($order->id, $order->montant);
        // $order->update(['token' => $url['token']]);

        // return redirect($url['response_text']);
        // $notif = new LicenceNotification();
        // LicenceMailJob::dispatch($notif, Auth::user());
        toastr()->success('Licence renouvelé avec succès!');
        });

        return to_route('dashboard');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function valid(int $id)
    {
        // $order = Order::findOrFail($id);
        // // verfiy paiement statut
        // $etat = $this->order_etat($order->token);
        // if ($etat['status'] === 'completed') {
        //     $order->update([
        //         'trans_etat' => 'completed', 'mode' => $etat->operator_name,
        //         'contact' => $etat->customer,
        //         'trans_id' => $etat->transaction_id,
        //     ]);

        //     return view('order.valide', compact(['order']));
        // } else {
        //     return view('order.cancel');
        // }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function cancel(int $id)
    {
        // $order = Order::with('orderable')->whereNotNull('token')->where('id', $id)->where('token', $_GET['token']);
        // // update order etat
        // $etat = $order->update(['trans_etat' => 'notcompleted', 'etat' => 'Annulé']);
        // // update appart etat
        // $item = $order->first();
        // $item->orderable->update(['etat' => AppartementEnum::DISPONIBLE]);

        // return view('order.cancel');

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
