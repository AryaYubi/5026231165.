<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') - BANK GALUNGGUNG</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
        body { display: flex; min-height: 100vh; background-color: #f8f9fa; }
        .sidebar { width: 250px; background-color: #2c3e50; color: white; flex-shrink: 0; }
        .sidebar a { color: #bdc3c7; text-decoration: none; display: block; padding: 10px 15px; }
        .sidebar a:hover, .sidebar a.active { background-color: #34495e; color: white; }
        .sidebar .nav-label { padding: 15px 15px 5px; font-size: 0.8em; text-transform: uppercase; color: #95a5a6; }
        .main-content { flex-grow: 1; display: flex; flex-direction: column; }
        .top-navbar { background-color: white; box-shadow: 0 2px 4px rgba(0,0,0,.1); padding: 0.75rem 1.5rem; }
        .content-area { padding: 2rem; flex-grow: 1; }
        .dropdown-toggle::after { display: none; }
    </style>
</head>
<body>

    <div class="sidebar p-3">
        <h4 class="text-center mb-4">
            <img src="{{ asset('images/logoGalunggung.png') }}" alt="Logo Bank" style="max-width: 200px; height: auto;">

        </h4>
       <nav>
            <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2 me-2"></i> Dashboard
            </a>

            <div class="nav-label">Laporan</div>
            <a href="{{ route('admin.pengaduan.index') }}" class="{{ request()->routeIs('admin.pengaduan.index') ? 'active' : '' }}">
                <i class="bi bi-folder me-2"></i> Semua Laporan
            </a>
            <a href="{{ route('admin.laporan.verifikasi') }}" class="{{ request()->routeIs('admin.laporan.verifikasi') ? 'active' : '' }}">
                <i class="bi bi-hourglass-split me-2"></i> Menunggu Verifikasi
            </a>
            <a href="{{ route('admin.laporan.diproses') }}" class="{{ request()->routeIs('admin.laporan.diproses') ? 'active' : '' }}">
                <i class="bi bi-arrow-repeat me-2"></i> Sedang Diproses
            </a>
            <a href="{{ route('admin.laporan.selesai') }}" class="{{ request()->routeIs('admin.laporan.selesai') ? 'active' : '' }}">
                <i class="bi bi-check2-circle me-2"></i> Selesai
            </a>

            <div class="nav-label">Manajemen</div>
            <a href="{{ route('admin.users.index') }}" class="{{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                <i class="bi bi-people me-2"></i> Pengguna
            </a>

            {{-- PERUBAHAN 1: Logout di Sidebar --}}
            <div class="nav-label">Akun</div>
            <a href="#" onclick="confirmLogout(event, 'logout-form-sidebar')">
                <i class="bi bi-box-arrow-left me-2"></i> Logout
            </a>
            <form id="logout-form-sidebar" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </nav>
    </div>

    <div class="main-content">
        <header class="top-navbar d-flex justify-content-end align-items-center">

            <div class="dropdown">
                <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="text-end me-3 d-none d-md-block">
                        <div class="fw-bold">{{ Auth::user()->name }}</div>
                        <small class="text-muted">{{ ucfirst(Auth::user()->role) }}</small>
                    </div>
                    <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; font-weight: bold;">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                    <li>
                        <a class="dropdown-item" href="{{ route('admin.users.edit', auth()->id()) }}">
                            <i class="bi bi-person-circle me-2"></i> Profil
                        </a>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        {{-- PERUBAHAN 2: Logout di Header --}}
                        <a class="dropdown-item" href="#" onclick="confirmLogout(event, 'logout-form-header')">
                            <i class="bi bi-box-arrow-right me-2"></i> Logout
                        </a>
                        <form id="logout-form-header" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>

        </header>

        <main class="content-area">
            @yield('content')
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- PERUBAHAN 3: Script Logout yang Dibuat Fleksibel --}}
    <script>
        function confirmLogout(event, formId) {
            event.preventDefault();

            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Anda akan keluar dari sesi ini.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#0d6efd',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, keluar!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(formId).submit();
                }
            });
        }
    </script>

    @stack('scripts')
</body>
</html>
