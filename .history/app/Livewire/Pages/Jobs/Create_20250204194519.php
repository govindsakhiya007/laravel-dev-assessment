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

    protected $rules = [
        'title' => 'required|min:3',
        'description' => 'required',
        'company_name' => 'required',
        'logo' => 'nullable|image|max:2048',
        'skills' => 'required|array',
    ];

    public function render()
    {
        return view('livewire.pages.jobs.create');
    }
}
