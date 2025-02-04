<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Skill;

class JobPosting extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'experience', 'salary', 'location', 'extra_info', 'company_name', 'logo_path', 'skills'];

    public function jobkills()
    {
        return $this->belongsToMany(Skill::class, 'job_skill');
    }
}
