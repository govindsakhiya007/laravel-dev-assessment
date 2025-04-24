<?php

namespace App\Livewire\Pages\Jobs;

use Livewire\Component;
use Livewire\WithFileUploads;

use App\Models\JobPosting;
use App\Models\Skill;

class Create extends Component
{
    use WithFileUploads;

    // --
    // Job form input fields
    public $title, $description, $experience, $salary, $location, $extra_info;
    public $company_name, $company_logo, $skills = [];

    // 
    // Store all job postings and available skills
    public $postings;
    public $availableSkills = [];

    // Validations
    protected $rules = [
        'title' => 'required|min:3',
        'description' => 'required',
        'company_name' => 'required',
        'company_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'skills' => 'required|array',
    ];

    /**
     * Render the create job view.
     */
    public function render()
    {
        return view('livewire.pages.jobs.create');
    }

    /**
     * Called on component mount.
     * Load available skills and existing job postings.
     */
    public function mount()
    {
        $this->availableSkills = Skill::all();
        $this->loadPostings();
    }

    /**
     * Fetch all job postings from the database.
     */
    public function loadPostings()
    {
        $this->postings = JobPosting::all();
    }

    /**
     * Save a new job posting.
     */
    public function save()
    {
        // Validations
        $this->validate();

        // Upload company logo if provided
        if ($this->company_logo) {
            $this->company_logo = $this->company_logo->store('company_logos', 'public');
        }

        // Create job posting
        $jobPosting = JobPosting::create([
            'title'         => $this->title,
            'description'   => $this->description,
            'experience'    => $this->experience,
            'salary'        => $this->salary,
            'location'      => $this->location,
            'extra_info'    => $this->extra_info,
            'company_name'  => $this->company_name,
            'company_logo'  => $this->company_logo,
            'skills'        => json_encode($this->skills),
        ]);

        // Attach selected skills
        $jobPosting->jobSkills()->attach($this->skills);

        session()->flash('success', 'Job posting created successfully.');
        return redirect('/admin/jobs');
    }

    /**
     * Delete a job posting by ID.
     *
     * @param int $id
     */
    public function delete($id)
    {
        JobPosting::findOrFail($id)->delete();

        session()->flash('success', 'Job posting deleted successfully.');
        $this->loadPostings();
    }
}