<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobRequest;
use Illuminate\Http\Request;
use App\Models\Job;
use Illuminate\Support\Facades\Gate;

class MyJobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('viewAnyEmployer',Job::class);
        return view(
            'my_job.index',
            [
                'jobs' => auth()->user()->employer
                ->jobs()
                ->with(['employer','jobApplications','jobApplications.user'])
                ->withTrashed()
                ->get()
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('create',Job::class);
        return view('my_job.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(JobRequest $request)
    {
        Gate::authorize('create',Job::class);
        auth()->user()->employer->jobs()->create($request->validated());

        return redirect()->route('my-jobs.index')
        ->with('success','Job Was Created Successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Job $MyJob)
    {
        Gate::authorize('update',$MyJob);
        return view('my_job.edit',['job' => $MyJob]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(JobRequest $request, Job $MyJob)
    {
        Gate::authorize('update',$MyJob);
        $MyJob->update($request->validated());

        return redirect()->route('my-jobs.index')
        ->with('success', 'Job Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Job $MyJob)
    {
        $MyJob->delete();

        return redirect()->route('my-jobs.index')
        ->with('success','Job Deleted Successfully');
    }
}
