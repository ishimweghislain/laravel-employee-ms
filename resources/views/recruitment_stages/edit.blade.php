@extends('layouts.app')

@section('title', 'Edit Recruitment Stage')

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
            <h2>Edit Recruitment Stage</h2>
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

        <form action="{{ route('recruitment_stages.update', $recruitmentStage->StageId) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label class="form-label">Application</label>
                <select name="application_id" class="form-input" required>
                    <option value="">Select Application</option>
                    @foreach($applications as $application)
                        <option value="{{ $application->ApplicationId }}" {{ $recruitmentStage->ApplicationId == $application->ApplicationId ? 'selected' : '' }}>
                            {{ $application->applicant->FirstName }} {{ $application->applicant->LastName }} - {{ $application->job->Title }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label class="form-label">Stage Name</label>
                <input type="text" name="stage_name" class="form-input" value="{{ old('stage_name', $recruitmentStage->StageName) }}" required>
            </div>

            <div class="form-group">
                <label class="form-label">Stage Status</label>
                <input type="text" name="stage_status" class="form-input" value="{{ old('stage_status', $recruitmentStage->StageStatus) }}" required>
            </div>

            <div class="form-group">
                <label class="form-label">Completion Date</label>
                <input type="date" name="completion_date" class="form-input" value="{{ old('completion_date', $recruitmentStage->CompletionDate) }}">
            </div>

            <div class="button-group">
                <a href="{{ route('recruitment_stages.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Update Recruitment Stage</button>
            </div>
        </form>
    </div>
</div>
@endsection