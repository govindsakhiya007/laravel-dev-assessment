<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Http\JsonResponse;

use App\Models\JobPosting;


class JobController extends Controller
{
    public function index()
    {
        $jobs = JobPosting::all();

        return Inertia::render('Jobs/Index', [
            'jobs' => $jobs,
        ]);
    }
}
