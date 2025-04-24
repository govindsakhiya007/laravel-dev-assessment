<?php

namespace App\Livewire\Pages\Jobs;

use Livewire\Component;

use App\Models\JobPosting;

class Index extends Component
{
    // List of job postings
    public $jobs;

    /**
     * Lifecycle hook: executed when the component is mounted.
     */
    public function mount()
    {
        $this->getJobs();
    }

    /**
     * Deletes a job posting by ID and refreshes the job list.
     *
     * @param int $id
     */
    public function delete($id)
    {
        JobPosting::findOrFail($id)->delete();

        session()->flash('success', 'Job posting deleted successfully.');

        $this->getJobs();
    }

    /**
     * Fetch all job postings with their related skills.
     */
    private function getJobs()
    {
        $this->jobs = JobPosting::with('jobSkills')->get();
    }

    /**
     * Render the job postings index view.
     */
    public function render()
    {
        return view('livewire.pages.jobs.index');
    }
}