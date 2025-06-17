<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class UserAvatar extends Component
{
    public $user;
    public $size;

    /**
     * Create a new component instance.
     */

    public function __construct($user, $size = 'w-8 h-8')
    {
        $this->user = $user;
        $this->size = $size;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.user-avatar');
    }
}
