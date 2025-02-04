<?php

namespace App\Livewire\Pages\Skills;

use Livewire\Component;
use App\Models\Skill;

class Index extends Component
{
    public $skills = [];
    public $name = '';
    public $editSkillId = null;

    protected $rules = [
        'name' => 'required|min:3|max:50',
    ];

    public function render()
    {
        return view('livewire.pages.skills.index');
    }

    public function mount()
    {
        $this->loadSkills();
    }

    public function loadSkills()
    {
        $this->skills = Skill::orderBy('id', 'desc')->get();
    }

    public function saveSkill()
    {
        // Validate before processing


        print_r($this->validate())
        $this->validate();

        if ($this->editSkillId) {
            $skill = Skill::findOrFail($this->editSkillId);
            $skill->update(['name' => $this->name]);
            session()->flash('message', 'Skill updated successfully!');
        } else {
            Skill::create(['name' => $this->name]);
            session()->flash('message', 'Skill created successfully!');
        }

        // Reset form inputs and refresh skill list
        $this->resetInputFields();
        $this->loadSkills();
    }

    public function editSkill($id)
    {
        $skill = Skill::findOrFail($id);
        $this->editSkillId = $skill->id;
        $this->name = $skill->name;
    }

    public function deleteSkill($id)
    {
        Skill::findOrFail($id)->delete();
        session()->flash('message', 'Skill deleted successfully!');
        $this->loadSkills();
    }

    private function resetInputFields()
    {
        $this->name = '';
        $this->editSkillId = null;
    }
}
