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

    public function mount()
    {
        $this->loadPostings();
    }

    public function loadPostings()
    {
        $this->postings = JobPosting::all();
    }

    public function saveJob()
    {
        $this->validate();

        $logoPath = $this->logo ? $this->logo->store('logos', 'public') : null;

        JobPosting::create([
            'title' => $this->title,
            'description' => $this->description,
            'experience' => $this->experience,
            'salary' => $this->salary,
            'location' => $this->location,
            'extra_info' => $this->extra_info,
            'company_name' => $this->company_name,
            'logo_path' => $logoPath,
            'skills' => json_encode($this->skills),
        ]);

        session()->flash('message', 'Job posting created successfully!');
        $this->resetInputFields();
        $this->loadPostings();
    }
}
