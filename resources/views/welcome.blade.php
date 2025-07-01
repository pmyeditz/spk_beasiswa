<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZtrixDev Dashboard</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        :root {
            --ztrix-primary: #00ff9d;
            --ztrix-primary-dark: #00c974;
            --ztrix-primary-light: #6bffc6;
            --ztrix-glass: rgba(255, 255, 255, 0.15);
            --ztrix-glass-border: rgba(255, 255, 255, 0.25);
            --ztrix-text: #f8f9fa;
            --ztrix-bg: #121826;
        }

        body {
            background-color: var(--ztrix-bg);
            color: var(--ztrix-text);
            min-height: 100vh;
            overflow-x: hidden;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* Custom Glass Card */
        .ztrix-glass-card {
            background: var(--ztrix-glass);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid var(--ztrix-glass-border);
            border-radius: 12px;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            position: relative;
            overflow: hidden;
        }

        /* Hover Animation with Glossy Effect */
        .ztrix-glass-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 255, 157, 0.2);
        }

        .ztrix-glass-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(90deg, var(--ztrix-primary), var(--ztrix-primary-light));
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.4s ease;
        }

        .ztrix-glass-card:hover::before {
            transform: scaleX(1);
        }

        /* Glossy Nav Link */
        .ztrix-nav-link {
            position: relative;
            overflow: hidden;
            border-radius: 8px;
            margin-bottom: 5px;
            transition: all 0.3s ease;
        }

        .ztrix-nav-link::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(0, 255, 157, 0.1), transparent);
            transition: all 0.5s ease;
        }

        .ztrix-nav-link:hover::before {
            left: 100%;
        }

        .ztrix-nav-link:hover {
            transform: translateX(5px);
            background-color: rgba(0, 255, 157, 0.1);
        }

        .ztrix-nav-link.active {
            background-color: rgba(0, 255, 157, 0.15);
            box-shadow: 0 0 15px rgba(0, 255, 157, 0.2);
        }

        /* Glossy Gradient Text */
        .ztrix-gradient-text {
            background: linear-gradient(to right, var(--ztrix-primary), var(--ztrix-primary-light));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        /* Custom Glossy Button */
        .ztrix-btn {
            background: linear-gradient(135deg, var(--ztrix-primary), var(--ztrix-primary-dark));
            border: none;
            color: #121826;
            font-weight: 600;
            border-radius: 8px;
            padding: 8px 20px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 255, 157, 0.3);
        }

        .ztrix-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 7px 20px rgba(0, 255, 157, 0.4);
            color: #121826;
        }

        /* Glossy Avatar Animation */
        .ztrix-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--ztrix-primary), var(--ztrix-primary-dark));
            display: flex;
            align-items: center;
            justify-content: center;
            color: #121826;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .ztrix-avatar::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.3) 0%, transparent 70%);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .ztrix-avatar:hover {
            transform: scale(1.1);
            box-shadow: 0 0 20px rgba(0, 255, 157, 0.4);
        }

        .ztrix-avatar:hover::after {
            opacity: 1;
        }

        /* Custom Chart Container */
        .ztrix-chart-container {
            position: relative;
            overflow: hidden;
        }

        .ztrix-chart-container::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(90deg, var(--ztrix-primary), var(--ztrix-primary-light));
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.8s ease;
        }

        .ztrix-chart-container:hover::after {
            transform: scaleX(1);
        }

        /* Pulse Animation for Notifications */
        @keyframes ztrix-pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(0, 255, 157, 0.7);
            }
            70% {
                box-shadow: 0 0 0 10px rgba(0, 255, 157, 0);
            }
            100% {
                box-shadow: 0 0 0 0 rgba(0, 255, 157, 0);
            }
        }

        .ztrix-pulse {
            animation: ztrix-pulse 2s infinite;
            border-radius: 50%;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #1e293b;
        }

        ::-webkit-scrollbar-thumb {
            background: var(--ztrix-primary);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--ztrix-primary-light);
        }

        /* Custom Breakpoints */
        @media (max-width: 992px) {
            .ztrix-sidebar {
                position: fixed;
                z-index: 1000;
                height: 100vh;
                transform: translateX(-100%);
                transition: transform 0.3s ease;
            }
            .ztrix-sidebar.show {
                transform: translateX(0);
            }
            .ztrix-content {
                margin-left: 0 !important;
            }
        }
    </style>
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="ztrix-sidebar d-flex flex-column flex-shrink-0 p-3 bg-dark" style="width: 280px; background: linear-gradient(135deg, rgba(0, 255, 136, 0.1), rgba(0, 204, 106, 0.2)) !important; backdrop-filter: blur(10px);">
            <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                <div class="d-flex align-items-center">
                    <div class="me-2 rounded p-2" style="background: linear-gradient(135deg, var(--ztrix-primary), var(--ztrix-primary-dark));">
                        <i class="bi bi-code-square" style="color: #121826;"></i>
                    </div>
                    <span class="fs-4 fw-bold ztrix-gradient-text">ZtrixDev</span>
                </div>
            </a>
            <hr>
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item">
                    <a href="#" class="nav-link ztrix-nav-link active text-white" style="background: transparent;">
                        <i class="bi bi-speedometer2 me-2"></i>
                        Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link ztrix-nav-link text-white">
                        <i class="bi bi-kanban me-2"></i>
                        Projects
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link ztrix-nav-link text-white">
                        <i class="bi bi-people me-2"></i>
                        Team
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link ztrix-nav-link text-white">
                        <i class="bi bi-graph-up me-2"></i>
                        Analytics
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link ztrix-nav-link text-white">
                        <i class="bi bi-envelope me-2"></i>
                        Messages
                        <span class="position-absolute translate-middle badge rounded-circle bg-danger ztrix-pulse" style="right: 20px; top: 10px; padding: 5px;">
                            <span class="visually-hidden">New alerts</span>
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link ztrix-nav-link text-white">
                        <i class="bi bi-gear me-2"></i>
                        Settings
                    </a>
                </li>
            </ul>
            <hr>
            <div class="dropdown">
                <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="ztrix-avatar me-2">ZD</div>
                    <strong>Ztrix Developer</strong>
                </a>
                <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                    <li><a class="dropdown-item" href="#">Profile</a></li>
                    <li><a class="dropdown-item" href="#">Settings</a></li>
                    <li><a class="dropdown-item" href="#">Activity log</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="#">Sign out</a></li>
                </ul>
            </div>
        </div>

        <!-- Main Content -->
        <div class="ztrix-content flex-grow-1 p-4" style="margin-left: 280px;">
            <!-- Mobile Toggle Button -->
            <button class="btn ztrix-btn d-lg-none mb-3" type="button" id="sidebarToggle">
                <i class="bi bi-list"></i>
            </button>

            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 ztrix-gradient-text mb-0">Dashboard Overview</h1>
                <div class="d-flex align-items-center">
                    <div class="input-group" style="max-width: 250px;">
                        <input type="text" class="form-control bg-dark border-dark text-white" placeholder="Search...">
                        <button class="btn ztrix-btn" type="button">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="row g-4 mb-4">
                <div class="col-md-6 col-lg-3">
                    <div class="ztrix-glass-card p-4 h-100">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <p class="mb-2 text-muted">Total Projects</p>
                                <h2 class="mb-0 ztrix-gradient-text">24</h2>
                            </div>
                            <div class="bg-primary bg-opacity-10 p-3 rounded">
                                <i class="bi bi-folder text-primary fs-4"></i>
                            </div>
                        </div>
                        <div class="mt-3">
                            <span class="badge bg-success bg-opacity-10 text-success">
                                <i class="bi bi-arrow-up me-1"></i> 12%
                            </span>
                            <span class="text-muted ms-2">vs last month</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="ztrix-glass-card p-4 h-100">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <p class="mb-2 text-muted">Active Users</p>
                                <h2 class="mb-0 ztrix-gradient-text">1,258</h2>
                            </div>
                            <div class="bg-success bg-opacity-10 p-3 rounded">
                                <i class="bi bi-people text-success fs-4"></i>
                            </div>
                        </div>
                        <div class="mt-3">
                            <span class="badge bg-success bg-opacity-10 text-success">
                                <i class="bi bi-arrow-up me-1"></i> 8%
                            </span>
                            <span class="text-muted ms-2">vs last month</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="ztrix-glass-card p-4 h-100">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <p class="mb-2 text-muted">Tasks Completed</p>
                                <h2 class="mb-0 ztrix-gradient-text">156</h2>
                            </div>
                            <div class="bg-info bg-opacity-10 p-3 rounded">
                                <i class="bi bi-check-circle text-info fs-4"></i>
                            </div>
                        </div>
                        <div class="mt-3">
                            <span class="badge bg-danger bg-opacity-10 text-danger">
                                <i class="bi bi-arrow-down me-1"></i> 3%
                            </span>
                            <span class="text-muted ms-2">vs last month</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="ztrix-glass-card p-4 h-100">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <p class="mb-2 text-muted">Revenue</p>
                                <h2 class="mb-0 ztrix-gradient-text">$12,345</h2>
                            </div>
                            <div class="bg-warning bg-opacity-10 p-3 rounded">
                                <i class="bi bi-currency-dollar text-warning fs-4"></i>
                            </div>
                        </div>
                        <div class="mt-3">
                            <span class="badge bg-success bg-opacity-10 text-success">
                                <i class="bi bi-arrow-up me-1"></i> 24%
                            </span>
                            <span class="text-muted ms-2">vs last month</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts & Activity -->
            <div class="row g-4 mb-4">
                <div class="col-lg-8">
                    <div class="ztrix-glass-card ztrix-chart-container p-4 h-100">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h5 class="mb-0">Performance Analytics</h5>
                            <div class="dropdown">
                                <button class="btn btn-sm btn-dark dropdown-toggle" type="button" id="chartDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    This Month
                                </button>
                                <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="chartDropdown">
                                    <li><a class="dropdown-item" href="#">Today</a></li>
                                    <li><a class="dropdown-item" href="#">This Week</a></li>
                                    <li><a class="dropdown-item" href="#">This Month</a></li>
                                    <li><a class="dropdown-item" href="#">This Year</a></li>
                                </ul>
                            </div>
                        </div>
