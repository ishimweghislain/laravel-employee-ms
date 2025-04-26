<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ApplicantController extends Controller
{
    public function index()
    {
        $applicants = Applicant::latest()->paginate(10);
        return view('applicants.index', compact('applicants'));
    }
    
    public function create()
    {
        return view('applicants.create');
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:applicants,Email',
            'contact_number' => 'required|numeric|digits_between:10,15',
            'application_date' => 'required|date|before_or_equal:today',
        ]);
        
        Applicant::create([
            'FirstName' => $validated['first_name'],
            'LastName' => $validated['last_name'],
            'Email' => $validated['email'],
            'ContactNumber' => $validated['contact_number'],
            'ApplicationDate' => $validated['application_date'],
        ]);
        return redirect()->route('applicants.index')->with('success', 'Applicant added successfully');
    }
    
    public function edit(Applicant $applicant)
    {
        return view('applicants.edit', compact('applicant'));
    }
    
    public function update(Request $request, Applicant $applicant)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:applicants,Email,'.$applicant->ApplicantId.',ApplicantId',
            'contact_number' => 'required|numeric|digits_between:10,15',
            'application_date' => 'required|date|before_or_equal:today',
        ]);
        
        $applicant->update([
            'FirstName' => $validated['first_name'],
            'LastName' => $validated['last_name'],
            'Email' => $validated['email'],
            'ContactNumber' => $validated['contact_number'],
            'ApplicationDate' => $validated['application_date'],
        ]);
        return redirect()->route('applicants.index')->with('success', 'Applicant updated successfully');
    }
    
    public function destroy(Applicant $applicant)
    {
        try {
            $applicant->delete();
            return redirect()->route('applicants.index')->with('success', 'Applicant deleted successfully');
        } catch (\Exception $e) {
            return redirect()->route('applicants.index')->with('error', 'Failed to delete applicant: ' . $e->getMessage());
        }
    }
}