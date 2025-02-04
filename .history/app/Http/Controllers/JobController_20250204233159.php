<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

use App\Models\JobPosting;


class JobController extends Controller
{
    public function index()
    {
        $jobs = Job::all();

        return Inertia::render('Jobs/Index', [
            'jobs' => $jobs,
        ]);
    }
}
