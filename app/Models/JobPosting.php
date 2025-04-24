<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Skill;

class JobPosting extends Model
{
    use HasFactory;

    // Fillable fields for mass assignment
    protected $fillable = [
        'title',
        'description',
        'experience',
        'salary',
        'location',
        'extra_info',
        'company_name',
        'company_logo',
        'skills',
    ];

    /**
     * Define many-to-many relationship with Skill
     * Each job posting can have multiple skills
     */
    public function jobSkills()
    {
        return $this->belongsToMany(Skill::class, 'job_skill');
    }

    /**
     * Accessor to get full URL of company logo
     * Returns a default image if no logo is uploaded
     *
     * @return string
     */
    public function getCompanyLogoAttribute(): string
    {
        return $this->attributes['company_logo']
            ? asset('storage/' . $this->attributes['company_logo'])
            : asset('logo-2.svg');
    }
}