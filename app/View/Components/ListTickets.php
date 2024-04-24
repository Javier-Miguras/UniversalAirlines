<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ListTickets extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $tickets = auth()->user()->tickets->sortByDesc('created_at');

        return view('components.list-tickets', [
            'tickets' => $tickets
        ]);
    }
}
