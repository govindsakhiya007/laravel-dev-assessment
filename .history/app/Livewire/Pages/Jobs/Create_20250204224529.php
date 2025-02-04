<?php

namespace App\Livewire\Pages\Jobs;

use Livewire\Component;
use Livewire\WithFileUploads;

use App\Models\JobPosting;
use App\Models\Skill;

class Create extends Component
{
    use WithFileUploads;

    public $title, $description, $experience, $salary, $location, $extra_info, $company_name, $company_logo, $skills = [];
    public $postings;
    public $availableSkills = [];

    protected $rules = [
        'title' => 'required|min:3',
        'description' => 'required',
        'company_name' => 'required',
        'company_logo' => 'nullable|image',
        'skills' => 'required|array',
    ];

    public function render()
    {
        return view('livewire.pages.jobs.create');
    }

    public function mount()
    {
        $this->availableSkills = Skill::all();
        $this->loadPostings();
    }

    public function loadPostings()
    {
        $this->postings = JobPosting::all();
    }

    public function save()
    {
        $this->validate();

        $company_logo = $this->company_logo ? $this->company_logo->store('company_logos', 'public') : null;

        $JobPosting = JobPosting::create([
            'title' => $this->title,
            'description' => $this->description,
            'experience' => $this->experience,
            'salary' => $this->salary,
            'location' => $this->location,
            'extra_info' => $this->extra_info,
            'company_name' => $this->company_name,
            'company_logo' => $company_logo,
            'skills' => json_encode($this->skills),
        ]);

        

        session()->flash('success', 'Job posting created successfully!');
        return redirect('/admin/jobs');
    }

    public function delete($id)
    {
        JobPosting::findOrFail($id)->delete();

        session()->flash('success', 'Job posting deleted successfully!');
        $this->loadPostings();
    }
}
