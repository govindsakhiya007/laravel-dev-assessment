<?php

namespace App\Livewire\Pages\Skills;

use Livewire\Component;

use App\Models\Skill;

class Index extends Component
{
    public $skills = [];
    public $name = '';
    public $skillId = null;

    // Validations
    protected $rules = [
        'name' => 'required|min:3|max:50',
    ];

    /**
     * Lifecycle method: loads data when component mounts
     */
    public function mount()
    {
        $this->loadSkills();
    }

    /**
     * Load all skills from the database
     */
    public function loadSkills()
    {
        $this->skills = Skill::orderBy('id', 'desc')->get();
    }

    /**
     * Save or update skill
     */
    public function save()
    {
        // Validations
        $this->validate();

        if ($this->skillId) {
            // Update existing skill
            $skill = Skill::findOrFail($this->skillId);
            $skill->update(['name' => $this->name]);
            session()->flash('success', 'Skill updated successfully.');
        } else {
            // Create new skill
            Skill::create(['name' => $this->name]);
            session()->flash('success', 'Skill created successfully.');
        }

        $this->resetInputFields();
        $this->loadSkills();
    }

    /**
     * Load skill data into form for editing
     *
     * @param int $id
     */
    public function editSkill($id)
    {
        $skill = Skill::findOrFail($id);
        $this->skillId = $skill->id;
        $this->name = $skill->name;
    }

    /**
     * Delete a skill by ID
     *
     * @param int $id
     */
    public function deleteSkill($id)
    {
        Skill::findOrFail($id)->delete();
        session()->flash('success', 'Skill deleted successfully.');
        $this->loadSkills();
    }

    /**
     * Reset form input fields
     */
    private function resetInputFields()
    {
        $this->name = '';
        $this->skillId = null;
    }

    /**
     * Render the component view
     */
    public function render()
    {
        return view('livewire.pages.skills.index');
    }
}