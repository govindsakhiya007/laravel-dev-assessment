<?php

namespace App\Livewire\Pages\Skills;

use Livewire\Component;

use App\Models\Skill;

class Index extends Component
{
    public $skills;
    public $name;
    public $editSkillId;

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
        $this->skills = Skill::all();
    }

    public function saveSkill()
    {
        $this->validate();

        if ($this->editSkillId) {
            $skill = Skill::findOrFail($this->editSkillId);
            $skill->update(['name' => $this->name]);
            session()->flash('message', 'Skill updated successfully!');
        } else {
            Skill::create(['name' => $this->name]);
            session()->flash('message', 'Skill created successfully!');
        }

        $this->resetInputFields();
        $this->loadSkills();
    }

    public function editSkill($id)
    {
        $skill = Skill::findOrFail($id);
        $this->editSkillId = $skill->id;
        $this->name = $skill->name;
    }
}
