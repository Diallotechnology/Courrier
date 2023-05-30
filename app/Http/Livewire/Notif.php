<?php

namespace App\Http\Livewire;

use Auth;
use Livewire\Component;

class Notif extends Component
{
    public function delete() {
        Auth::user()->notifications->delete();
        toastr()->success('Toute les notifications ont été effacé!');
    }

    public function  valid() {
        Auth::user()->unreadNotifications()->update(['read_at' => now()]);
        toastr()->success('Toute les notifications ont été marquer comme lu!');
    }
    public function render()
    {
        $notif = Auth::user()->unreadNotifications;
        return view('livewire.notif', compact('notif'));
    }
}
