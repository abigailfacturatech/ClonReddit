<?php

namespace App\View\Components;

use Illuminate\Support\Facades\Blade;
use Illuminate\View\Component;

use App\Models\PostVote;

class PostsVote extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($type)
    {
        $this->type =$type;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */



/**
 * Bootstrap your package's services.
 */
    public function boot()
    {
        Blade::component('post-vote', PostVote::class);
    }


    public function render()
    {
        return view('components.post-vote');
    }
}
