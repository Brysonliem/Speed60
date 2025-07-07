<?php

namespace App\Livewire\Pages\Reviews;

use App\Models\Reviews;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.admin')]
class Index extends Component
{
    public $reviews;

    public function loadReviews()
    {
        return Reviews::with(['product', 'user'])->latest()->get();
    }

    public function mount()
    {
        $this->reviews = $this->loadReviews();
    }

    public function render()
    {
        return view('livewire.pages.reviews.index');
    }
}
