<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Skill;

class JobPosting extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'experience', 'salary', 'location', 'extra_info', 'company_name', 'logo_path', 'skills'];

    public function jobSkills()
    {
        return $this->belongsToMany(Skill::class, 'job_skill');
    }

    public function getCompanyLogoUrlAttribute()
    {
        return $this->company_logo ? asset('storage/company_logos/' . $this->company_logo) : asset('images/default-logo.png');
    }
}
