@extends('layouts.app')

@section('title', 'Edit Application')

@section('content')
<style>
    .container {
        width: 80%;
        max-width: 800px;
        margin: 20px auto;
        padding: 20px;
    }
    .form-card {
        background: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    .card-header {
        border-bottom: 1px solid #ddd;
        margin-bottom: 20px;
        padding-bottom: 10px;
    }
    .form-group {
        margin-bottom: 15px;
    }
    .form-label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }
    .form-input {
        width: 100%;
        padding: 8px;
        border: 1px solid #ddd;
        border-radius: 4px;
        margin-bottom: 10px;
    }
    .btn {
        padding: 8px 16px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        text-decoration: none;
        color: white;
    }
    .btn-primary {
        background-color: #007bff;
    }
    .btn-secondary {
        background-color: #6c757d;
    }
    .button-group {
        display: flex;
        justify-content: space-between;
        margin-top: 20px;
    }
    .error-message {
        background-color: #f8d7da;
        color: #721c24;
        padding: 12px;
        margin-bottom: 20px;
        border-radius: 4px;
    }
</style>

<div class="container">
    <div class="form-card">
        <div class="card-header">
            <h2>Edit Application</h2>
        </div>

        @if ($errors->any())
            <div class="error-message">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('applications.update', $application->ApplicationId) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label class="form-label">Applicant</label>
                <select name="applicant_id" class="form-input" required>
                    <option value="">Select Applicant</option>
                    @foreach($applicants as $applicant)
                        <option value="{{ $applicant->ApplicantId }}" {{ $application->ApplicantId == $applicant->ApplicantId ? 'selected' : '' }}>
                            {{ $applicant->FirstName }} {{ $applicant->LastName }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label class="form-label">Job Position</label>
                <select name="job_id" class="form-input" required>
                    <option value="">Select Job Position</option>
                    @foreach($jobPositions as $jobPosition)
                        <option value="{{ $jobPosition->JobId }}" {{ $application->JobId == $jobPosition->JobId ? 'selected' : '' }}>
                            {{ $jobPosition->Title }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label class="form-label">Application Status</label>
                <input type="text" name="application_status" class="form-input" value="{{ old('application_status', $application->ApplicationStatus) }}" required>
            </div>

            <div class="form-group">
                <label class="form-label">Review Date</label>
                <input type="date" name="review_date" class="form-input" value="{{ old('review_date', $application->ReviewDate) }}">
            </div>

            <div class="button-group">
                <a href="{{ route('applications.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Update Application</button>
            </div>
        </form>
    </div>
</div>
@endsection