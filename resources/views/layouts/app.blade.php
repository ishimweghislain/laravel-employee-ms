<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - NYANZA TSS</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f7fa;
            color: #2c3e50;
        }

        .navbar {
            background: #3498db;
            padding: 1rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .navbar-container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar-brand {
            color: white;
            font-size: 1.5rem;
            text-decoration: none;
            font-weight: bold;
        }

        .navbar-menu {
            display: flex;
            gap: 1.5rem;
        }

        .navbar-link {
            color: white;
            text-decoration: none;
            font-size: 1rem;
            transition: opacity 0.3s ease;
        }

        .navbar-link:hover {
            opacity: 0.8;
        }

        .content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .logout-form {
            display: inline;
        }

        .logout-button {
            background: none;
            border: none;
            color: white;
            font-size: 1rem;
            cursor: pointer;
            transition: opacity 0.3s ease;
        }

        .logout-button:hover {
            opacity: 0.8;
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="navbar-container">
            <a href="{{ route('dashboard') }}" class="navbar-brand">NYANZA TSS</a>
            <div class="navbar-menu">
                @auth
                    <a href="{{ route('job_positions.index') }}" class="navbar-link">Job Positions</a>
                    <a href="{{ route('applicants.index') }}" class="navbar-link">Applicants</a>
                    <a href="{{ route('applications.index') }}" class="navbar-link">Applications</a>
                    <a href="{{ route('recruitment_stages.index') }}" class="navbar-link">Recruitment Stages</a>
                    <form action="{{ route('logout') }}" method="POST" class="logout-form">
                        @csrf
                        <button type="submit" class="logout-button">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="navbar-link">Login</a>
                    <a href="{{ route('register') }}" class="navbar-link">Register</a>
                @endauth
            </div>
        </div>
    </nav>

    <div class="content">
        @yield('content')
    </div>
</body>
</html>