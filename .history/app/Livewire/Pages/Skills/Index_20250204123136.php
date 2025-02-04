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
}
