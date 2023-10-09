<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class StarRating extends Component
{
    public readonly ?float $rating;
    /**
     * Create a new component instance.
     */
    public function __construct($rating)
    {
        $this->rating = $rating;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.star-rating');
    }
}
