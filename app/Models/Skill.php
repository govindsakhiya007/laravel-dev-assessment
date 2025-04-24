<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\JobPosting;

class Skill extends Model
{
    use HasFactory;

    // Fillable fields for mass assignment
    protected $fillable = ['name'];

    /**
     * Define many-to-many relationship with JobPosting
     * Each skill can be associated with multiple job postings
     */
    public function jobs()
    {
        return $this->belongsToMany(JobPosting::class, 'job_skill');
    }
}