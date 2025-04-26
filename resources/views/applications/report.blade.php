@extends('layouts.app')

@section('title', 'Daily Application Status Report')

@section('content')
<style>
    .container {
        width: 90%;
        margin: 20px auto;
        padding: 20px;
    }
    .header {
        margin-bottom: 20px;
    }
    .table-container {
        background: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    table {
        width: 100%;
        border-collapse: collapse;
    }
    th, td {
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }
    th {
        background-color: #f8f9fa;
    }
    tr:hover {
        background-color: #f5f5f5;
    }
</style>

<div class="container">
    <div class="header">
        <h1>Daily Application Status Report - {{ $today->format('Y-m-d') }}</h1>
    </div>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Applicant</th>
                    <th>Job Position</th>
                    <th>Status</th>
                    <th>Review Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($applications as $application)
                <tr>
                    <td>{{ $application->applicant->FirstName }} {{ $application->applicant->LastName }}</td>
                    <td>{{ $application->job->Title }}</td>
                    <td>{{ $application->ApplicationStatus }}</td>
                    <td>{{ $application->ReviewDate }}</td>
                </tr>
                @endforeach
                @if($applications->isEmpty())
                <tr>
                    <td colspan="4">No applications reviewed today.</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection