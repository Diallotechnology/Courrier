<?php

namespace App\Http\Livewire;

use Auth;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Notif extends Component
{
    public function delete(): void
    {
        Auth::user()->notifications()->delete();
        toastr()->success('Toute les notifications ont été effacé!');
    }

    public function valid(): void
    {
        Auth::user()->unreadNotifications()->update(['read_at' => now()]);
        toastr()->success('Toute les notifications ont été marquer comme lu!');
    }

    public function render(): View
    {
        $notif = Auth::user()->unreadNotifications;

        return view('livewire.notif', compact('notif'));
    }
}
