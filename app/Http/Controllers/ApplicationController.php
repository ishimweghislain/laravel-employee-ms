<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Applicant;
use App\Models\JobPosition;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ApplicationController extends Controller
{
    public function index()
    {
        $applications = Application::with(['applicant', 'job'])->latest()->paginate(10);
        return view('applications.index', compact('applications'));
    }
    
    public function create()
    {
        $applicants = Applicant::all();
        $jobPositions = JobPosition::all();
        return view('applications.create', compact('applicants', 'jobPositions'));
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'applicant_id' => 'required|exists:applicants,ApplicantId',
            'job_id' => 'required|exists:job_positions,JobId',
            'application_status' => 'required|string|max:255',
            'review_date' => 'nullable|date',
        ]);
        
        Application::create([
            'ApplicantId' => $validated['applicant_id'],
            'JobId' => $validated['job_id'],
            'ApplicationStatus' => $validated['application_status'],
            'ReviewDate' => $validated['review_date'],
        ]);
        return redirect()->route('applications.index')->with('success', 'Application added successfully');
    }
    
    public function edit(Application $application)
    {
        $applicants = Applicant::all();
        $jobPositions = JobPosition::all();
        return view('applications.edit', compact('application', 'applicants', 'jobPositions'));
    }
    
    public function update(Request $request, Application $application)
    {
        $validated = $request->validate([
            'applicant_id' => 'required|exists:applicants,ApplicantId',
            'job_id' => 'required|exists:job_positions,JobId',
            'application_status' => 'required|string|max:255',
            'review_date' => 'nullable|date',
        ]);
        
        $application->update([
            'ApplicantId' => $validated['applicant_id'],
            'JobId' => $validated['job_id'],
            'ApplicationStatus' => $validated['application_status'],
            'ReviewDate' => $validated['review_date'],
        ]);
        return redirect()->route('applications.index')->with('success', 'Application updated successfully');
    }
    
    public function destroy(Application $application)
    {
        try {
            $application->delete();
            return redirect()->route('applications.index')->with('success', 'Application deleted successfully');
        } catch (\Exception $e) {
            return redirect()->route('applications.index')->with('error', 'Failed to delete application: ' . $e->getMessage());
        }
    }


    public function dailyReport()
    {
        $today = Carbon::today();
        $applications = Application::whereDate('ReviewDate', $today)
            ->with(['applicant', 'job'])
            ->get();
        return view('applications.report', compact('applications', 'today'));
    }
}