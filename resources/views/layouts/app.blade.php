<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'StudentPortal')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        :root {
            --primary-color: #0d6efd;
            --secondary-color: #6c757d;
            --success-color: #198754;
            --danger-color: #dc3545;
            --warning-color: #ffc107;
            --info-color: #0dcaf0;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
        }

        .navbar {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            letter-spacing: 0.5px;
        }

        .nav-link {
            margin-left: 10px;
            transition: all 0.3s ease;
        }

        .nav-link:hover {
            transform: translateY(-2px);
        }

        .sidebar {
            background: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            position: sticky;
            top: 20px;
        }

        .sidebar .nav-link {
            color: #495057;
            border-left: 3px solid transparent;
            padding-left: 15px;
            margin-left: 0;
            transition: all 0.3s ease;
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background-color: #f8f9fa;
            color: #667eea;
            border-left-color: #667eea;
        }

        .card {
            border: none;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .card:hover {
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.12);
            transform: translateY(-4px);
        }

        .btn {
            border-radius: 5px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-primary {
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>@yield('title', 'StudentPortal')</title>
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
                <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
                <link href="{{ asset('css/app.css') }}" rel="stylesheet">
                <style>
                    :root {
                        --primary-color: #0d6efd;
                        --secondary-color: #6c757d;
                        --success-color: #198754;
                        --danger-color: #dc3545;
                        --warning-color: #ffc107;
                        --info-color: #0dcaf0;
                    }

                    body {
                        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                        background-color: #f8f9fa;
                    }

                    .navbar {
                        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
                    }

                    .navbar-brand {
                        font-weight: 700;
                        font-size: 1.5rem;
                        letter-spacing: 0.5px;
                    }

                    .nav-link {
                        margin-left: 10px;
                        transition: all 0.3s ease;
                    }

                    .nav-link:hover {
                        transform: translateY(-2px);
                    }

                    .sidebar {
                        background: white;
                        border-radius: 8px;
                        padding: 20px;
                        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
                        position: sticky;
                        top: 20px;
                    }

                    .sidebar .nav-link {
                        color: #495057;
                        border-left: 3px solid transparent;
                        padding-left: 15px;
                        margin-left: 0;
                        transition: all 0.3s ease;
                    }

                    .sidebar .nav-link:hover,
                    .sidebar .nav-link.active {
                        background-color: #f8f9fa;
                        color: #667eea;
                        border-left-color: #667eea;
                    }

                    .card {
                        border: none;
                        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
                        border-radius: 8px;
                        transition: all 0.3s ease;
                    }

                    .card:hover {
                        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.12);
                        transform: translateY(-4px);
                    }

                    .btn {
                        border-radius: 5px;
                        font-weight: 500;
                        transition: all 0.3s ease;
                    }

                    .btn-primary {
                        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                        border: none;
                    }

                    .btn-primary:hover {
                        transform: translateY(-2px);
                        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
                    }

                    .alert {
                        border: none;
                        border-radius: 8px;
                    }

                    .form-control, .form-select {
                        border-radius: 5px;
                        border: 1px solid #dee2e6;
                        transition: all 0.3s ease;
                    }

                    .form-control:focus, .form-select:focus {
                        border-color: #667eea;
                        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
                    }

                    .table {
                        background: white;
                        border-radius: 8px;
                        overflow: hidden;
                    }

                    .table thead {
                        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                        color: white;
                    }

                    .table tbody tr {
                        transition: all 0.3s ease;
                    }

                    .table tbody tr:hover {
                        background-color: #f8f9fa;
                    }

                    .badge {
                        padding: 6px 12px;
                        border-radius: 20px;
                        font-weight: 500;
                    }

                    .footer {
                        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                        color: white;
                        padding: 30px 0;
                        margin-top: 40px;
                        text-align: center;
                    }

                    .stat-card {
                        text-align: center;
                        padding: 20px;
                    }

                    .stat-card .number {
                        font-size: 2.5rem;
                        font-weight: 700;
                        color: #667eea;
                    }

                    .stat-card .label {
                        color: #6c757d;
                        font-size: 0.95rem;
                    }

                    .dashboard-header {
                        padding: 30px 0;
                        margin-bottom: 30px;
                        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                        color: white;
                        border-radius: 8px;
                    }

                    .dashboard-header h1 {
                        font-weight: 700;
                        margin-bottom: 10px;
                    }

                    .form-container {
                        background: white;
                        padding: 30px;
                        border-radius: 8px;
                        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
                    }

                    .main-content {
                        min-height: calc(100vh - 200px);
                    }

                    .breadcrumb {
                        background-color: transparent;
                        padding: 0;
                    }

                    @media (max-width: 768px) {
                        .sidebar {
                            position: relative;
                            top: 0;
                            margin-bottom: 20px;
                        }

                        .stat-card .number {
                            font-size: 2rem;
                        }

                        .dashboard-header {
                            padding: 20px;
                        }
                    }
                </style>
                @yield('extra-css')
            </head>
            <body>
                <nav class="navbar navbar-expand-lg navbar-dark">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="{{ route('dashboard') }}">
                            <i class="bi bi-book"></i> StudentPortal
                        </a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNav">
                            <ul class="navbar-nav ms-auto">
                                @auth
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('dashboard') }}">
                                            <i class="bi bi-house"></i> Dashboard
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('students.index') }}">
                                            <i class="bi bi-people"></i> Students
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('courses.index') }}">
                                            <i class="bi bi-book-half"></i> Courses
                                        </a>
                                    </li>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                                            <i class="bi bi-person-circle"></i> {{ Auth::user()->name }}
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                            <li>
                                                <a class="dropdown-item" href="{{ route('students.show', Auth::user()->student->id ?? '#') }}">
                                                    <i class="bi bi-person"></i> My Profile
                                                </a>
                                            </li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li>
                                                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                                                    @csrf
                                                    <button class="dropdown-item" type="submit">
                                                        <i class="bi bi-box-arrow-right"></i> Logout
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                    </li>
                                @else
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('login') }}">
                                            <i class="bi bi-box-arrow-in-right"></i> Login
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('register') }}">
                                            <i class="bi bi-person-plus"></i> Register
                                        </a>
                                    </li>
                                @endauth
                            </ul>
                        </div>
                    </div>
                </nav>

                <div class="container-fluid main-content">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show mt-4" role="alert">
                            <i class="bi bi-check-circle"></i> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show mt-4" role="alert">
                            <i class="bi bi-exclamation-circle"></i> {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @yield('content')
                </div>
                <footer class="footer">
                    <div class="container">
                        <p>&copy; 2025 StudentPortal. All rights reserved.</p>
                        <p class="mb-0">Built with Laravel & Bootstrap</p>
                    </div>
                </footer>

                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
                @yield('extra-js')
            </body>
            </html>
