<?php

namespace App\Http\Controllers;

use App\Models\JobPosition;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class JobPositionController extends Controller
{
    public function index()
    {
        $jobPositions = JobPosition::latest()->paginate(10);
        return view('job_positions.index', compact('jobPositions'));
    }
    
    public function create()
    {
        return view('job_positions.create');
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'description' => 'required|string',
            'required_qualifications' => 'required|string',
        ]);
        
        JobPosition::create([
            'Title' => $validated['title'],
            'Department' => $validated['department'],
            'Description' => $validated['description'],
            'RequiredQualifications' => $validated['required_qualifications'],
        ]);
        return redirect()->route('job_positions.index')->with('success', 'Job position added successfully');
    }
    
    public function edit(JobPosition $jobPosition)
    {
        return view('job_positions.edit', compact('jobPosition'));
    }
    
    public function update(Request $request, JobPosition $jobPosition)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'description' => 'required|string',
            'required_qualifications' => 'required|string',
        ]);
        
        $jobPosition->update([
            'Title' => $validated['title'],
            'Department' => $validated['department'],
            'Description' => $validated['description'],
            'RequiredQualifications' => $validated['required_qualifications'],
        ]);
        return redirect()->route('job_positions.index')->with('success', 'Job position updated successfully');
    }
    
    public function destroy(JobPosition $jobPosition)
    {
        try {
            $jobPosition->delete();
            return redirect()->route('job_positions.index')->with('success', 'Job position deleted successfully');
        } catch (\Exception $e) {
            return redirect()->route('job_positions.index')->with('error', 'Failed to delete job position: ' . $e->getMessage());
        }
    }
}