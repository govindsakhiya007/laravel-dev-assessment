<?php

namespace App\Livewire\Pages\Jobs;

use Livewire\Component;
use Livewire\WithFileUploads;

use App\Models\JobPosting;

class Create extends Component
{
    use WithFileUploads;

    public $title, $description, $experience, $salary, $location, $extra_info, $company_name, $logo, $skills = [];
    public $postings;
    
    public function render()
    {
        return view('livewire.pages.jobs.create');
    }
}
