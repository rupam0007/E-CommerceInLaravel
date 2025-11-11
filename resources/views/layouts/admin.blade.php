<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>

    <!-- Bootstrap & Font Awesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        :root {
            --dark-bg: #1a1a2e;
            --dark-card: #16213e;
            --dark-text: #e0e0e0;
            --dark-secondary-text: #a0a0a0;
            --primary-color: #0f3460;
            --accent-color: #e94560;
            --hover-bg: #0c1a2e;
            --border-color: #0f3460;
        }

        body {
            display: flex;
            min-height: 100vh;
            background-color: var(--dark-bg);
            color: var(--dark-text);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
        }

        /* Sidebar */
        .sidebar {
            width: 260px;
            background: var(--dark-card);
            color: var(--dark-text);
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            padding-top: 20px;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.5);
        }

        .sidebar-header {
            padding: 15px;
            text-align: center;
            border-bottom: 1px solid var(--border-color);
        }

        .sidebar-header h3 {
            color: var(--accent-color);
            font-size: 1.6rem;
            margin: 0;
            font-weight: bold;
        }

        .sidebar .nav-link {
            color: var(--dark-secondary-text);
            padding: 12px 20px;
            display: flex;
            align-items: center;
            border-left: 4px solid transparent;
        }

        .sidebar .nav-link i {
            margin-right: 12px;
        }

        .sidebar .nav-link:hover {
            color: var(--dark-text);
            background-color: var(--hover-bg);
            border-left-color: var(--accent-color);
        }

        .sidebar .nav-link.active {
            background-color: var(--primary-color);
            color: var(--dark-text);
            border-left-color: var(--accent-color);
        }

        /* Navbar */
        .navbar-admin {
            position: fixed;
            top: 0;
            left: 260px;
            right: 0;
            background-color: var(--dark-card);
            border-bottom: 1px solid var(--border-color);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.4);
            padding: 15px 25px;
            z-index: 1000;
        }

        .navbar-admin .navbar-brand {
            color: var(--accent-color);
            font-weight: bold;
            font-size: 1.5rem;
        }

        /* Main content */
        .main-content {
            margin-left: 260px;
            padding: 100px 25px 25px 25px;
            flex: 1;
        }

        .card {
            background-color: var(--dark-card);
            border: 1px solid var(--border-color);
            color: var(--dark-text);
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 0 15px rgba(233, 69, 96, 0.3);
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header">
            <h3>Nexora Admin</h3>
        </div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                    href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}"
                    href="{{ route('admin.products.index') }}">
                    <i class="fas fa-boxes"></i> Products
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}"
                    href="{{ route('admin.orders.index') }}">
                    <i class="fas fa-shopping-cart"></i> Orders
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.customers.*') ? 'active' : '' }}"
                    href="{{ route('admin.customers.index') }}">
                    <i class="fas fa-users"></i> Customers
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.reports.*') ? 'active' : '' }}"
                    href="{{ route('admin.reports.index') }}">
                    <i class="fas fa-chart-bar"></i> Reports
                </a>
            </li>
        </ul>
    </div>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-admin">
        <div class="container-fluid">
            <span class="navbar-brand">Admin Dashboard</span>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">@csrf</form>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Main -->
    <main class="main-content">
