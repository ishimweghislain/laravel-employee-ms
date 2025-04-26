<?php

namespace App\Http\Controllers;

use App\Models\RecruitmentStage;
use App\Models\Application;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class RecruitmentStageController extends Controller
{
    public function index()
    {
        $recruitmentStages = RecruitmentStage::with('application')->latest()->paginate(10);
        return view('recruitment_stages.index', compact('recruitmentStages'));
    }
    
    public function create()
    {
        $applications = Application::all();
        return view('recruitment_stages.create', compact('applications'));
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'application_id' => 'required|exists:applications,ApplicationId',
            'stage_name' => 'required|string|max:255',
            'stage_status' => 'required|string|max:255',
            'completion_date' => 'nullable|date',
        ]);
        
        RecruitmentStage::create([
            'ApplicationId' => $validated['application_id'],
            'StageName' => $validated['stage_name'],
            'StageStatus' => $validated['stage_status'],
            'CompletionDate' => $validated['completion_date'],
        ]);
        return redirect()->route('recruitment_stages.index')->with('success', 'Recruitment stage added successfully');
    }
    
    public function edit(RecruitmentStage $recruitmentStage)
    {
        $applications = Application::all();
        return view('recruitment_stages.edit', compact('recruitmentStage', 'applications'));
    }
    
    public function update(Request $request, RecruitmentStage $recruitmentStage)
    {
        $validated = $request->validate([
            'application_id' => 'required|exists:applications,ApplicationId',
            'stage_name' => 'required|string|max:255',
            'stage_status' => 'required|string|max:255',
            'completion_date' => 'nullable|date',
        ]);
        
        $recruitmentStage->update([
            'ApplicationId' => $validated['application_id'],
            'StageName' => $validated['stage_name'],
            'StageStatus' => $validated['stage_status'],
            'CompletionDate' => $validated['completion_date'],
        ]);
        return redirect()->route('recruitment_stages.index')->with('success', 'Recruitment stage updated successfully');
    }
    
    public function destroy(RecruitmentStage $recruitmentStage)
    {
        try {
            $recruitmentStage->delete();
            return redirect()->route('recruitment_stages.index')->with('success', 'Recruitment stage deleted successfully');
        } catch (\Exception $e) {
            return redirect()->route('recruitment_stages.index')->with('error', 'Failed to delete recruitment stage: ' . $e->getMessage());
        }
    }
}