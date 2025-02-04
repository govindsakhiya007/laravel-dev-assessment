<?php

namespace App\Livewire\Pages\Jobs;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\JobPosting;

class Create extends Component
{
    public function render()
    {
        return view('livewire.pages.jobs.create');
    }
}
