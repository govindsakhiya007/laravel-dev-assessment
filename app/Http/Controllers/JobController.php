<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

use App\Models\JobPosting;

class JobController extends Controller
{
    /**
     * Display a listing of the job postings with filters.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $query = JobPosting::query();

        // Filter by job title
        if ($request->filled('title')) {
            $query->where('title', 'like', '%' . $request->title . '%');
        }

        // Filter by job location
        if ($request->filled('location')) {
            $query->where('location', 'like', '%' . $request->location . '%');
        }
    
        $jobs = $query->with('jobSkills')->latest()->get();

        return response()->json([
            'jobs' => $jobs,
        ]);
    }
}