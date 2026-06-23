<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Retribusi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <style>
        .sidebar {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body class="bg-gray-50 font-sans">
    <!-- Navbar -->
    <nav class="bg-gradient-to-r from-blue-600 to-indigo-700 shadow-lg">
        <div class="container mx-auto px-4 py-3 flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <button id="sidebarToggle" class="text-white hover:text-blue-200 focus:outline-none">
                    <i class="fas fa-bars text-xl"></i>
                </button>
                <div class="text-2xl font-bold text-white">RetribusiApp</div>
                <div class="hidden md:flex items-center space-x-2 text-sm text-blue-100">
                    <a href="#" class="hover:text-white">Dashboard</a>
                    <span>/</span>
                    <a href="#" class="hover:text-white">Retribusi</a>
                    <span>/</span>
                    <span class="text-white font-medium">Data Retribusi</span>
                </div>
            </div>
            <div class="flex items-center space-x-4">
                <div class="relative">
                    <button
                        class="flex items-center space-x-2 bg-white/20 hover:bg-white/30 text-white px-4 py-2 rounded-lg backdrop-blur-sm transition">
                        <i class="fas fa-user-circle"></i>
                        <span>Admin</span>
                        <i class="fas fa-chevron-down text-xs"></i>
                    </button>
                </div>
                <button class="p-2 text-white hover:text-blue-200">
                    <i class="fas fa-cog text-xl"></i>
                </button>
            </div>
        </div>
    </nav>

    <!-- Navigation Bar -->
    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 border-b shadow-md">
        <div class="container mx-auto px-4 py-4">
            <div class="flex flex-wrap items-center justify-between">
                <h2 class="text-xl font-bold text-gray-800 flex items-center">
                    <i class="fas fa-bolt text-yellow-500 mr-2"></i>
                    Navigasi Cepat
                </h2>
                <div class="flex space-x-4">
                    <a href="#"
                        class="flex items-center space-x-2 bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white px-6 py-3 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300">
                        <i class="fas fa-user text-lg"></i>
                        <span class="font-semibold">User</span>
                    </a>
                    <a href="#"
                        class="flex items-center space-x-2 bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white px-6 py-3 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300">
                        <i class="fas fa-money-bill-wave text-lg"></i>
                        <span class="font-semibold">Retribusi</span>
                    </a>
                    <a href="#"
                        class="flex items-center space-x-2 bg-gradient-to-r from-purple-500 to-purple-600 hover:from-purple-600 hover:to-purple-700 text-white px-6 py-3 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300">
                        <i class="fas fa-qrcode text-lg"></i>
                        <span class="font-semibold">Scan Nomor</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="flex">
        <!-- Sidebar -->
        <aside id="sidebar"
            class="sidebar hidden lg:block bg-gradient-to-b from-gray-900 to-gray-800 w-64 min-h-screen border-r shadow-xl py-8 px-5">
            <div class="mb-10">
                <h2 class="text-xl font-bold text-white mb-6 flex items-center">
                    <i class="fas fa-compass text-blue-300 mr-3"></i>
                    Navigasi
                </h2>
                <ul class="space-y-3">
                    <li>
                        <a href="#"
                            class="flex items-center space-x-4 p-4 rounded-xl bg-blue-500/20 text-blue-100 border border-blue-400/30 hover:bg-blue-500/30 transition group">
                            <i class="fas fa-tachometer-alt text-blue-300 group-hover:text-white"></i>
                            <span class="font-medium">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="#"
                            class="flex items-center space-x-4 p-4 rounded-xl hover:bg-gray-700/50 text-gray-300 hover:text-white border border-transparent hover:border-gray-600 transition group">
                            <i class="fas fa-users text-gray-400 group-hover:text-white"></i>
                            <span class="font-medium">User Management</span>
                        </a>
                    </li>
                    <li>
                        <a href="#"
                            class="flex items-center space-x-4 p-4 rounded-xl hover:bg-gray-700/50 text-gray-300 hover:text-white border border-transparent hover:border-gray-600 transition group">
                            <i class="fas fa-money-bill-wave text-gray-400 group-hover:text-white"></i>
                            <span class="font-medium">Retribusi</span>
                        </a>
                    </li>
                    <li>
                        <a href="#"
                            class="flex items-center space-x-4 p-4 rounded-xl hover:bg-gray-700/50 text-gray-300 hover:text-white border border-transparent hover:border-gray-600 transition group">
                            <i class="fas fa-qrcode text-gray-400 group-hover:text-white"></i>
                            <span class="font-medium">Scan Nomor</span>
                        </a>
                    </li>
                    <li>
                        <a href="#"
                            class="flex items-center space-x-4 p-4 rounded-xl hover:bg-gray-700/50 text-gray-300 hover:text-white border border-transparent hover:border-gray-600 transition group">
                            <i class="fas fa-chart-bar text-gray-400 group-hover:text-white"></i>
                            <span class="font-medium">Laporan</span>
                        </a>
                    </li>
                    <li>
                        <a href="#"
                            class="flex items-center space-x-4 p-4 rounded-xl hover:bg-gray-700/50 text-gray-300 hover:text-white border border-transparent hover:border-gray-600 transition group">
                            <i class="fas fa-cog text-gray-400 group-hover:text-white"></i>
                            <span class="font-medium">Pengaturan</span>
                        </a>
                    </li>
                </ul>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-4 md:p-6">
            <!-- Breadcrumb -->
            <div class="mt-8 mb-8">
                <nav class="flex" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-2 md:space-x-4">
                        <li class="inline-flex items-center">
                            <a href="#"
                                class="inline-flex items-center text-sm font-medium text-gray-600 hover:text-blue-600 bg-white/80 backdrop-blur-sm px-4 py-2 rounded-lg shadow-sm border">
                                <i class="fas fa-home mr-2 text-blue-500"></i>
                                Home
                            </a>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <i class="fas fa-chevron-right text-gray-300 text-sm"></i>
                                <a href="#"
                                    class="ml-2 text-sm font-medium text-gray-600 hover:text-blue-600 bg-white/80 backdrop-blur-sm px-4 py-2 rounded-lg shadow-sm border">Retribusi</a>
                            </div>
                        </li>
                        <li aria-current="page">
                            <div class="flex items-center">
                                <i class="fas fa-chevron-right text-gray-300 text-sm"></i>
                                <span
                                    class="ml-2 text-sm font-medium text-gray-800 bg-blue-50 px-4 py-2 rounded-lg border border-blue-100">Data
                                    Retribusi</span>
                            </div>
                        </li>
                    </ol>
                </nav>
                <div class="mt-6">
                    <h1 class="text-4xl font-bold text-gray-900">Data Retribusi <span
                            class="text-blue-600">Dashboard</span></h1>
                    <p class="text-gray-600 mt-2 flex items-center">
                        <i class="fas fa-info-circle text-blue-400 mr-2"></i>
                        Kelola data retribusi dengan mudah dan efisien
                    </p>
                </div>
            </div>


            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div
                    class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-2xl shadow-lg p-6 text-white transform hover:-translate-y-1 transition duration-300">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-blue-100 text-sm font-medium">Total Retribusi</p>
                            <h3 class="text-3xl font-bold mt-2">Rp 845.000</h3>
                            <p class="text-blue-200 text-xs mt-1"><i class="fas fa-arrow-up mr-1"></i> 12% dari bulan
                                lalu</p>
                        </div>
                        <div class="bg-white/20 p-3 rounded-full">
                            <i class="fas fa-wallet text-2xl"></i>
                        </div>
                    </div>
                </div>
                <div
                    class="bg-gradient-to-r from-green-500 to-green-600 rounded-2xl shadow-lg p-6 text-white transform hover:-translate-y-1 transition duration-300">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-green-100 text-sm font-medium">Transaksi Lunas</p>
                            <h3 class="text-3xl font-bold mt-2">42</h3>
                            <p class="text-green-200 text-xs mt-1"><i class="fas fa-check-circle mr-1"></i> 80%
                                berhasil</p>
                        </div>
                        <div class="bg-white/20 p-3 rounded-full">
                            <i class="fas fa-check-circle text-2xl"></i>
                        </div>
                    </div>
                </div>
                <div
                    class="bg-gradient-to-r from-purple-500 to-purple-600 rounded-2xl shadow-lg p-6 text-white transform hover:-translate-y-1 transition duration-300">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-purple-100 text-sm font-medium">Pending</p>
                            <h3 class="text-3xl font-bold mt-2">8</h3>
                            <p class="text-purple-200 text-xs mt-1"><i class="fas fa-clock mr-1"></i> Butuh tindakan
                            </p>
                        </div>
                        <div class="bg-white/20 p-3 rounded-full">
                            <i class="fas fa-clock text-2xl"></i>
                        </div>
                    </div>
                </div>
                <div
                    class="bg-gradient-to-r from-amber-500 to-amber-600 rounded-2xl shadow-lg p-6 text-white transform hover:-translate-y-1 transition duration-300">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-amber-100 text-sm font-medium">Rata-rata per Hari</p>
                            <h3 class="text-3xl font-bold mt-2">Rp 28.166</h3>
                            <p class="text-amber-200 text-xs mt-1"><i class="fas fa-chart-line mr-1"></i> Naik 5%</p>
                        </div>
                        <div class="bg-white/20 p-3 rounded-full">
                            <i class="fas fa-chart-line text-2xl"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- DataTable Card -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-200">
                <div class="px-6 py-4 border-b">
                    <h2 class="text-xl font-semibold text-gray-800">Daftar Retribusi</h2>
                    <p class="text-gray-600 text-sm">Menampilkan 5 data terbaru</p>
                </div>
                <div class="p-6">
                    <table id="dataTable" class="display min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr class="bg-gradient-to-r from-blue-50 to-indigo-50">
                                <th
                                    class="px-8 py-4 text-left text-xs font-semibold text-blue-700 uppercase tracking-wider border-b">
                                    <div class="flex items-center">
                                        <i class="fas fa-hashtag mr-2"></i> No
                                    </div>
                                </th>
                                <th
                                    class="px-8 py-4 text-left text-xs font-semibold text-blue-700 uppercase tracking-wider border-b">
                                    <div class="flex items-center">
                                        <i class="fas fa-store mr-2"></i> Nama
                                    </div>
                                </th>
                                <th
                                    class="px-8 py-4 text-left text-xs font-semibold text-blue-700 uppercase tracking-wider border-b">
                                    <div class="flex items-center">
                                        <i class="fas fa-tag mr-2"></i> Jenis
                                    </div>
                                </th>
                                <th
                                    class="px-8 py-4 text-left text-xs font-semibold text-blue-700 uppercase tracking-wider border-b">
                                    <div class="flex items-center">
                                        <i class="fas fa-money-bill-wave mr-2"></i> Nominal
                                    </div>
                                </th>
                                <th
                                    class="px-8 py-4 text-left text-xs font-semibold text-blue-700 uppercase tracking-wider border-b">
                                    <div class="flex items-center">
                                        <i class="fas fa-calendar-alt mr-2"></i> Tanggal
                                    </div>
                                </th>
                                <th
                                    class="px-8 py-4 text-left text-xs font-semibold text-blue-700 uppercase tracking-wider border-b">
                                    <div class="flex items-center">
                                        <i class="fas fa-flag mr-2"></i> Status
                                    </div>
                                </th>
                                <th
                                    class="px-8 py-4 text-left text-xs font-semibold text-blue-700 uppercase tracking-wider border-b">
                                    <div class="flex items-center">
                                        <i class="fas fa-cogs mr-2"></i> Aksi
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr class="hover:bg-blue-50/50 transition duration-200 even:bg-gray-50/50">
                                <td class="px-8 py-5 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <span
                                            class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-blue-100 text-blue-800 font-bold">1</span>
                                    </div>
                                </td>
                                <td class="px-8 py-5 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="ml-4">
                                            <div class="text-sm font-semibold text-gray-900">Toko Sumber Rejeki</div>
                                            <div class="text-xs text-gray-500">Pasar Induk</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-5 whitespace-nowrap">
                                    <span
                                        class="px-3 py-1 text-xs rounded-full bg-blue-100 text-blue-800 font-medium">Retribusi
                                        Pasar</span>
                                </td>
                                <td class="px-8 py-5 whitespace-nowrap text-sm font-semibold text-gray-900">Rp 150.000
                                </td>
                                <td class="px-8 py-5 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">02 Des 2025</div>
                                    <div class="text-xs text-gray-500">10:30 WIB</div>
                                </td>
                                <td class="px-8 py-5 whitespace-nowrap">
                                    <span
                                        class="px-4 py-1.5 text-xs rounded-full bg-gradient-to-r from-green-100 to-green-200 text-green-800 font-bold border border-green-300">
                                        <i class="fas fa-check-circle mr-1"></i> Lunas
                                    </span>
                                </td>
                                <td class="px-8 py-5 whitespace-nowrap text-sm font-medium">
                                    <div class="flex space-x-3">
                                        <a href="#"
                                            class="text-blue-600 hover:text-blue-800 bg-blue-50 hover:bg-blue-100 p-2 rounded-lg transition">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="#"
                                            class="text-red-600 hover:text-red-800 bg-red-50 hover:bg-red-100 p-2 rounded-lg transition">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                        <a href="#"
                                            class="text-green-600 hover:text-green-800 bg-green-50 hover:bg-green-100 p-2 rounded-lg transition">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr class="hover:bg-blue-50/50 transition duration-200 even:bg-gray-50/50">
                                <td class="px-8 py-5 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <span
                                            class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-yellow-100 text-yellow-800 font-bold">2</span>
                                    </div>
                                </td>
                                <td class="px-8 py-5 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="ml-4">
                                            <div class="text-sm font-semibold text-gray-900">Warung Makan Sederhana
                                            </div>
                                            <div class="text-xs text-gray-500">UMKM Kuliner</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-5 whitespace-nowrap">
                                    <span
                                        class="px-3 py-1 text-xs rounded-full bg-yellow-100 text-yellow-800 font-medium">Retribusi
                                        UMKM</span>
                                </td>
                                <td class="px-8 py-5 whitespace-nowrap text-sm font-semibold text-gray-900">Rp 75.000
                                </td>
                                <td class="px-8 py-5 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">01 Des 2025</div>
                                    <div class="text-xs text-gray-500">14:20 WIB</div>
                                </td>
                                <td class="px-8 py-5 whitespace-nowrap">
                                    <span
                                        class="px-4 py-1.5 text-xs rounded-full bg-gradient-to-r from-yellow-100 to-yellow-200 text-yellow-800 font-bold border border-yellow-300">
                                        <i class="fas fa-clock mr-1"></i> Pending
                                    </span>
                                </td>
                                <td class="px-8 py-5 whitespace-nowrap text-sm font-medium">
                                    <div class="flex space-x-3">
                                        <a href="#"
                                            class="text-blue-600 hover:text-blue-800 bg-blue-50 hover:bg-blue-100 p-2 rounded-lg transition">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="#"
                                            class="text-red-600 hover:text-red-800 bg-red-50 hover:bg-red-100 p-2 rounded-lg transition">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                        <a href="#"
                                            class="text-green-600 hover:text-green-800 bg-green-50 hover:bg-green-100 p-2 rounded-lg transition">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr class="hover:bg-blue-50/50 transition duration-200 even:bg-gray-50/50">
                                <td class="px-8 py-5 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <span
                                            class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-green-100 text-green-800 font-bold">3</span>
                                    </div>
                                </td>
                                <td class="px-8 py-5 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="ml-4">
                                            <div class="text-sm font-semibold text-gray-900">Bengkel Jaya Motor</div>
                                            <div class="text-xs text-gray-500">Bengkel Kendaraan</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-5 whitespace-nowrap">
                                    <span
                                        class="px-3 py-1 text-xs rounded-full bg-green-100 text-green-800 font-medium">Retribusi
                                        Bengkel</span>
                                </td>
                                <td class="px-8 py-5 whitespace-nowrap text-sm font-semibold text-gray-900">Rp 200.000
                                </td>
                                <td class="px-8 py-5 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">30 Nov 2025</div>
                                    <div class="text-xs text-gray-500">09:15 WIB</div>
                                </td>
                                <td class="px-8 py-5 whitespace-nowrap">
                                    <span
                                        class="px-4 py-1.5 text-xs rounded-full bg-gradient-to-r from-green-100 to-green-200 text-green-800 font-bold border border-green-300">
                                        <i class="fas fa-check-circle mr-1"></i> Lunas
                                    </span>
                                </td>
                                <td class="px-8 py-5 whitespace-nowrap text-sm font-medium">
                                    <div class="flex space-x-3">
                                        <a href="#"
                                            class="text-blue-600 hover:text-blue-800 bg-blue-50 hover:bg-blue-100 p-2 rounded-lg transition">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="#"
                                            class="text-red-600 hover:text-red-800 bg-red-50 hover:bg-red-100 p-2 rounded-lg transition">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                        <a href="#"
                                            class="text-green-600 hover:text-green-800 bg-green-50 hover:bg-green-100 p-2 rounded-lg transition">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr class="hover:bg-blue-50/50 transition duration-200 even:bg-gray-50/50">
                                <td class="px-8 py-5 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <span
                                            class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-red-100 text-red-800 font-bold">4</span>
                                    </div>
                                </td>
                                <td class="px-8 py-5 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="ml-4">
                                            <div class="text-sm font-semibold text-gray-900">Kios Buah Segar</div>
                                            <div class="text-xs text-gray-500">Pasar Tradisional</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-5 whitespace-nowrap">
                                    <span
                                        class="px-3 py-1 text-xs rounded-full bg-red-100 text-red-800 font-medium">Retribusi
                                        Pasar</span>
                                </td>
                                <td class="px-8 py-5 whitespace-nowrap text-sm font-semibold text-gray-900">Rp 120.000
                                </td>
                                <td class="px-8 py-5 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">29 Nov 2025</div>
                                    <div class="text-xs text-gray-500">16:45 WIB</div>
                                </td>
                                <td class="px-8 py-5 whitespace-nowrap">
                                    <span
                                        class="px-4 py-1.5 text-xs rounded-full bg-gradient-to-r from-red-100 to-red-200 text-red-800 font-bold border border-red-300">
                                        <i class="fas fa-exclamation-triangle mr-1"></i> Terlambat
                                    </span>
                                </td>
                                <td class="px-8 py-5 whitespace-nowrap text-sm font-medium">
                                    <div class="flex space-x-3">
                                        <a href="#"
                                            class="text-blue-600 hover:text-blue-800 bg-blue-50 hover:bg-blue-100 p-2 rounded-lg transition">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="#"
                                            class="text-red-600 hover:text-red-800 bg-red-50 hover:bg-red-100 p-2 rounded-lg transition">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                        <a href="#"
                                            class="text-green-600 hover:text-green-800 bg-green-50 hover:bg-green-100 p-2 rounded-lg transition">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr class="hover:bg-blue-50/50 transition duration-200 even:bg-gray-50/50">
                                <td class="px-8 py-5 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <span
                                            class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-green-100 text-green-800 font-bold">5</span>
                                    </div>
                                </td>
                                <td class="px-8 py-5 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="ml-4">
                                            <div class="text-sm font-semibold text-gray-900">Toko Elektronik Maju</div>
                                            <div class="text-xs text-gray-500">Elektronik Retail</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-5 whitespace-nowrap">
                                    <span
                                        class="px-3 py-1 text-xs rounded-full bg-green-100 text-green-800 font-medium">Retribusi
                                        Toko</span>
                                </td>
                                <td class="px-8 py-5 whitespace-nowrap text-sm font-semibold text-gray-900">Rp 300.000
                                </td>
                                <td class="px-8 py-5 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">28 Nov 2025</div>
                                    <div class="text-xs text-gray-500">11:10 WIB</div>
                                </td>
                                <td class="px-8 py-5 whitespace-nowrap">
                                    <span
                                        class="px-4 py-1.5 text-xs rounded-full bg-gradient-to-r from-green-100 to-green-200 text-green-800 font-bold border border-green-300">
                                        <i class="fas fa-check-circle mr-1"></i> Lunas
                                    </span>
                                </td>
                                <td class="px-8 py-5 whitespace-nowrap text-sm font-medium">
                                    <div class="flex space-x-3">
                                        <a href="#"
                                            class="text-blue-600 hover:text-blue-800 bg-blue-50 hover:bg-blue-100 p-2 rounded-lg transition">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="#"
                                            class="text-red-600 hover:text-red-800 bg-red-50 hover:bg-red-100 p-2 rounded-lg transition">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                        <a href="#"
                                            class="text-green-600 hover:text-green-800 bg-green-50 hover:bg-green-100 p-2 rounded-lg transition">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Footer Note -->
            <div class="mt-8 text-center text-gray-500 text-sm">
                <p>&copy; 2025 RetribusiApp. Data ditampilkan per {{ date('d M Y') }}.</p>
            </div>
        </main>
    </div>

    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                pageLength: 5,
                lengthMenu: [
                    [5, 10, 25, 50],
                    [5, 10, 25, 50]
                ],
                language: {
                    search: "Cari:",
                    lengthMenu: "Tampilkan _MENU_ data",
                    info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    paginate: {
                        first: "Pertama",
                        last: "Terakhir",
                        next: "Selanjutnya",
                        previous: "Sebelumnya"
                    }
                }
            });

            // Sidebar toggle
            $('#sidebarToggle').click(function() {
                $('#sidebar').toggleClass('hidden');
                $('#sidebar').toggleClass('w-64');
                $('#sidebar').toggleClass('w-0');
            });
        });
    </script>
</body>

</html>
