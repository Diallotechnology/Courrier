<?php

namespace App\Observers;

use App\Models\Imputation;

class ImputationObserver
{
    /**
     * Handle the Imputation "created" event.
     */
    public function created(Imputation $imputation): void
    {
        \dd($imputation);
    }

    /**
     * Handle the Imputation "updated" event.
     */
    public function updated(Imputation $imputation): void
    {
        //
    }

    /**
     * Handle the Imputation "deleted" event.
     */
    public function deleted(Imputation $imputation): void
    {
        //
    }

    /**
     * Handle the Imputation "restored" event.
     */
    public function restored(Imputation $imputation): void
    {
        //
    }

    /**
     * Handle the Imputation "force deleted" event.
     */
    public function forceDeleted(Imputation $imputation): void
    {
        //
    }
}
