<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard SmartInventory</title>

    <script>
        (function () {
            try {
                if (localStorage.getItem('smartinventory-theme') === 'dark') {
                    document.documentElement.classList.add('dark-mode');
                }
            } catch (e) {}
        })();
    </script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            color-scheme: light;
            --bg: #f3f6fc;
            --surface: #ffffff;
            --text: #26344d;
            --heading: #193d7c;
            --muted: #718096;
            --border: #e3eaf5;
            --icon-bg: #eaf1ff;
            --link: #2863c4;
            --shadow: 0 4px 18px rgba(40, 65, 110, 0.06);
            --row-hover: #f4f7fc;
        }

        html.dark-mode {
            color-scheme: dark;
            --bg: #0b1220;
            --surface: #151f32;
            --text: #e5edf9;
            --heading: #a9c8ff;
            --muted: #a0aec4;
            --border: #2b3950;
            --icon-bg: #263b5e;
            --link: #93c5fd;
            --shadow: 0 8px 24px rgba(0, 0, 0, 0.16);
            --row-hover: #202d43;
        }

        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
            transition: background .25s, color .25s;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        button {
            font-family: inherit;
        }

        .sidebar {
            width: 255px;
            height: 100vh;
            background: linear-gradient(180deg, #173b80, #2459b3);
            color: white;
            position: fixed;
            top: 0;
            left: 0;
            padding: 28px 18px;
            overflow-y: auto;
            z-index: 10;
        }

        .brand {
            font-size: 23px;
            font-weight: bold;
            margin-bottom: 8px;
        }

        .brand-desc {
            font-size: 12px;
            line-height: 1.6;
            color: #dbeafe;
            margin-bottom: 25px;
        }

        .menu-title {
            font-size: 11px;
            color: #c2d7ff;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            margin: 22px 12px 12px;
        }

        .menu a {
            display: block;
            padding: 13px 12px;
            margin-bottom: 7px;
            border-radius: 9px;
            font-size: 14px;
            transition: .2s;
        }

        .menu a:hover {
            background: rgba(255, 255, 255, .18);
            transform: translateX(3px);
        }

        .main {
            margin-left: 255px;
            padding: 32px;
            min-width: 0;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            margin-bottom: 25px;
            flex-wrap: wrap;
        }

        .topbar h1 {
            font-size: 27px;
            color: var(--heading);
        }

        .date {
            color: var(--muted);
            font-size: 13px;
            margin-top: 7px;
        }

        .theme-toggle {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
            padding: 11px 16px;
            border: 1px solid var(--border);
            border-radius: 12px;
            background: var(--surface);
            color: var(--text);
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            box-shadow: var(--shadow);
        }

        .theme-toggle:hover {
            transform: translateY(-2px);
        }

        .theme-icon {
            font-size: 18px;
        }

        .welcome {
            background: linear-gradient(120deg, #2459b3, #5289eb);
            color: white;
            border-radius: 18px;
            padding: 30px;
            margin-bottom: 28px;
            box-shadow: 0 8px 25px rgba(36, 89, 179, .15);
        }

        .welcome h2 {
            font-size: 24px;
            margin-bottom: 12px;
        }

        .welcome p {
            line-height: 1.8;
            max-width: 680px;
            font-size: 14px;
            color: #edf4ff;
        }

        .section-title {
            font-size: 19px;
            margin-bottom: 18px;
            color: var(--text);
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 18px;
            margin-bottom: 32px;
        }

        .stat-card {
            background: var(--surface);
            padding: 23px 20px;
            border-radius: 15px;
            box-shadow: var(--shadow);
            border: 1px solid var(--border);
            transition: transform .2s, background .25s;
        }

        .stat-card:hover,
        .quick-card:hover,
        .produk-card:hover {
            transform: translateY(-4px);
        }

        .stat-icon {
            width: 47px;
            height: 47px;
            display: flex;
            justify-content: center;
            align-items: center;
            background: var(--icon-bg);
            border-radius: 12px;
            font-size: 23px;
            margin-bottom: 17px;
        }

        .stat-card p {
            color: var(--muted);
            font-size: 13px;
            margin-bottom: 8px;
        }

        .stat-card h3 {
            font-size: 29px;
            color: var(--heading);
        }

        /* KARTU FOTO PRODUK */
        .produk-intro {
            color: var(--muted);
            font-size: 13px;
            line-height: 1.7;
            margin-top: -8px;
            margin-bottom: 18px;
        }

        .produk-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 18px;
            margin-bottom: 32px;
        }

        .produk-card {
            min-width: 0;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 15px;
            overflow: hidden;
            box-shadow: var(--shadow);
            transition: transform .2s;
        }

        .produk-card img {
            display: block;
            width: 100%;
            height: 160px;
            object-fit: cover;
            background: var(--icon-bg);
        }

        .produk-info {
            padding: 16px;
        }

        .produk-info h3 {
            color: var(--heading);
            font-size: 15px;
            margin-bottom: 8px;
        }

        .produk-info p {
            color: var(--muted);
            font-size: 13px;
            line-height: 1.6;
            min-height: 40px;
            margin-bottom: 12px;
        }

        .produk-link,
        .quick-link {
            display: inline-block;
            color: var(--link);
            font-size: 13px;
            font-weight: 600;
        }

        .produk-link:hover,
        .quick-link:hover {
            text-decoration: underline;
        }

        .charts {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 20px;
            margin-bottom: 32px;
        }

        .chart-card {
            background: var(--surface);
            padding: 22px;
            border-radius: 15px;
            border: 1px solid var(--border);
            box-shadow: var(--shadow);
            min-width: 0;
        }

        .chart-card h3 {
            color: var(--heading);
            font-size: 16px;
            margin-bottom: 20px;
        }

        .chart-box {
            position: relative;
            width: 100%;
            height: 280px;
        }

        .quick-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 18px;
        }

        .quick-card {
            background: var(--surface);
            padding: 23px;
            border-radius: 15px;
            border: 1px solid var(--border);
            box-shadow: var(--shadow);
            transition: transform .2s;
        }

        .quick-icon {
            font-size: 27px;
            margin-bottom: 15px;
        }

        .quick-card h3 {
            color: var(--heading);
            font-size: 16px;
            margin-bottom: 9px;
        }

        .quick-card p {
            color: var(--muted);
            font-size: 13px;
            line-height: 1.7;
            margin-bottom: 15px;
        }

        .footer {
            margin-top: 35px;
            text-align: center;
            color: var(--muted);
            font-size: 12px;
            padding: 20px 0;
        }

        @media (max-width: 1100px) {
            .stats {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .produk-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .quick-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .charts {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 700px) {
            .sidebar {
                position: relative;
                width: 100%;
                height: auto;
                padding: 20px;
            }

            .brand-desc {
                margin-bottom: 15px;
            }

            .menu-title {
                margin-top: 15px;
            }

            .menu {
                display: grid;
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 5px;
            }

            .menu a {
                padding: 11px 9px;
                margin-bottom: 0;
                font-size: 12px;
            }

            .main {
                margin-left: 0;
                padding: 20px 15px;
            }

            .topbar {
                align-items: flex-start;
                flex-direction: column;
            }

            .topbar h1 {
                font-size: 23px;
            }

            .welcome {
                padding: 23px;
            }

            .welcome h2 {
                font-size: 21px;
            }

            .quick-grid {
                grid-template-columns: 1fr;
            }

            .chart-box {
                height: 250px;
            }
        }

        @media (max-width: 450px) {
            .stats,
            .produk-grid {
                grid-template-columns: 1fr;
            }

            .produk-card img {
                height: 200px;
            }

            .stat-card h3 {
                font-size: 25px;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            *,
            *::before,
            *::after {
                transition-duration: .01ms !important;
                animation-duration: .01ms !important;
            }
        }
    </style>
</head>

<body>

    <!-- SIDEBAR -->
    <aside class="sidebar">
        <div class="brand">📦 SmartInventory</div>

        <div class="brand-desc">
            Sistem Manajemen Toko<br>
            dan Inventori Berbasis Web
        </div>

        <div class="menu-title">Menu Utama</div>

        <nav class="menu">
            <a href="{{ route('dashboard') }}">🏠 Dashboard</a>
            <a href="{{ route('barang.index') }}">📦 Data Barang</a>
            <a href="{{ route('barang.create') }}">➕ Tambah Barang</a>
            <a href="{{ route('supplier.index') }}">🚚 Data Supplier</a>
            <a href="{{ route('distributor.index') }}">🚛 Data Distributor</a>
            <a href="{{ route('agen.index') }}">🤝 Data Agen</a>
            <a href="{{ route('barang-masuk.index') }}">📥 Barang Masuk</a>
            <a href="{{ route('barang-keluar.index') }}">📤 Barang Keluar</a>
            <a href="{{ route('riwayat-stok.index') }}">📋 Riwayat Stok</a>
        </nav>

        <div class="menu-title">Informasi</div>

        <nav class="menu">
            <a href="#produk">🛒 Produk Sembako</a>
            <a href="#fitur">📊 Ringkasan Sistem</a>
            <a href="#grafik">📈 Grafik Inventori</a>
        </nav>

        <div class="menu-title">Akun</div>

        <nav class="menu">
            <a href="#keluar" onclick="event.preventDefault(); document.getElementById('logoutForm').submit();">
                🚪 Logout
            </a>
        </nav>

        <form id="logoutForm" action="{{ route('logout') }}" method="POST" hidden>
            @csrf
        </form>
    </aside>

    <main class="main">

        <header class="topbar">
            <div>
                <h1>Dashboard</h1>
                <div class="date">
                    📅 {{ now()->translatedFormat('l, d F Y') }}
                </div>
            </div>

            <button
                type="button"
                id="themeToggle"
                class="theme-toggle"
                aria-label="Ganti tema"
                aria-pressed="false"
            >
                <span id="themeIcon" class="theme-icon">🌙</span>
                <span id="themeText">Mode Gelap</span>
            </button>
        </header>

        <section class="welcome">
            <h2>Halo, Selamat Datang! 👋</h2>
            <p>
                Kelola data barang, supplier, distributor, agen,
                serta transaksi barang masuk dan barang keluar
                dengan lebih mudah melalui SmartInventory.
            </p>
        </section>

        <!-- RINGKASAN DATA -->
        <section id="fitur">
            <h2 class="section-title">Ringkasan Data</h2>

            <div class="stats">
                <div class="stat-card">
                    <div class="stat-icon">📦</div>
                    <p>Total Data Barang</p>
                    <h3>{{ $totalBarang }}</h3>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">📊</div>
                    <p>Total Stok Barang</p>
                    <h3>{{ number_format($totalStok, 0, ',', '.') }}</h3>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">🚚</div>
                    <p>Total Supplier</p>
                    <h3>{{ $totalSupplier }}</h3>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">🚛</div>
                    <p>Total Distributor</p>
                    <h3>{{ $totalDistributor }}</h3>
                </div>
            </div>
        </section>

        <!-- PRODUK SEMBAKO: FOTO DIPERBAIKI -->
        <section id="produk">
            <h2 class="section-title">🛒 Produk Sembako</h2>

            <p class="produk-intro">
                Berbagai kebutuhan pokok yang dikelola dalam inventori toko.
                Klik untuk melihat daftar barang.
            </p>

            <div class="produk-grid">

                <!-- BERAS PREMIUM -->
                <article class="produk-card">
                    <img
                        src="https://images.unsplash.com/photo-1586201375761-83865001e31c?auto=format&fit=crop&w=600&q=80"
                        alt="Beras Premium"
                        loading="lazy"
                        onerror="this.onerror=null;this.src='https://placehold.co/600x400/f5f0df/665c40?text=Beras+Premium';"
                    >

                    <div class="produk-info">
                        <h3>Beras Premium</h3>
                        <p>Bahan pokok untuk kebutuhan sehari-hari.</p>
                        <a class="produk-link" href="{{ route('barang.index') }}">
                            Lihat Data Barang →
                        </a>
                    </div>
                </article>

                <!-- MINYAK GORENG -->
                <article class="produk-card">
                    <img
                        src="https://images.unsplash.com/photo-1474979266404-7eaacbcd87c5?auto=format&fit=crop&w=600&q=80"
                        alt="Minyak Goreng"
                        loading="lazy"
                        onerror="this.onerror=null;this.src='https://placehold.co/600x400/faf0d0/795548?text=Minyak+Goreng';"
                    >

                    <div class="produk-info">
                        <h3>Minyak Goreng</h3>
                        <p>Kebutuhan memasak untuk pelanggan toko.</p>
                        <a class="produk-link" href="{{ route('barang.index') }}">
                            Lihat Data Barang →
                        </a>
                    </div>
                </article>

                <!-- GULA PASIR -->
<article class="produk-card">
    <img
        src="https://placehold.co/600x400/faf3dd/795548?text=Gula+Pasir"
        alt="Gula Pasir"
        loading="lazy"
    >

    <div class="produk-info">
        <h3>Gula Pasir</h3>
        <p>Salah satu kebutuhan pokok di toko.</p>
        <a class="produk-link" href="{{ route('barang.index') }}">
            Lihat Data Barang →
        </a>
    </div>
</article>
                <!-- TELUR AYAM: FOTO TELUR -->
                <article class="produk-card">
                    <img
                        src="https://images.unsplash.com/photo-1506976785307-8732e854ad03?auto=format&fit=crop&w=600&q=80"
                        alt="Telur Ayam"
                        loading="lazy"
                        onerror="this.onerror=null;this.src='https://placehold.co/600x400/fff8e7/795548?text=Telur+Ayam';"
                    >

                    <div class="produk-info">
                        <h3>Telur Ayam</h3>
                        <p>Bahan makanan yang banyak digunakan.</p>
                        <a class="produk-link" href="{{ route('barang.index') }}">
                            Lihat Data Barang →
                        </a>
                    </div>
                </article>

            </div>
        </section>

        <!-- GRAFIK INVENTORI -->
        <section id="grafik">
            <h2 class="section-title">Grafik Inventori</h2>

            <div class="charts">
                <div class="chart-card">
                    <h3>Barang Masuk dan Barang Keluar per Bulan</h3>
                    <div class="chart-box">
                        <canvas id="grafikTransaksi"></canvas>
                    </div>
                </div>

                <div class="chart-card">
                    <h3>Perbandingan Data Inventori</h3>
                    <div class="chart-box">
                        <canvas id="grafikStok"></canvas>
                    </div>
                </div>
            </div>
        </section>

        <!-- AKSES CEPAT -->
        <section>
            <h2 class="section-title">Akses Cepat</h2>

            <div class="quick-grid">

                <div class="quick-card">
                    <div class="quick-icon">📦</div>
                    <h3>Data Barang</h3>
                    <p>Lihat dan kelola stok barang toko.</p>
                    <a class="quick-link" href="{{ route('barang.index') }}">Lihat Data →</a>
                </div>

                <div class="quick-card">
                    <div class="quick-icon">➕</div>
                    <h3>Tambah Barang</h3>
                    <p>Masukkan barang baru ke inventori.</p>
                    <a class="quick-link" href="{{ route('barang.create') }}">Tambah Sekarang →</a>
                </div>

                <div class="quick-card">
                    <div class="quick-icon">🚚</div>
                    <h3>Data Supplier</h3>
                    <p>Kelola informasi pemasok barang.</p>
                    <a class="quick-link" href="{{ route('supplier.index') }}">Lihat Data →</a>
                </div>

                <div class="quick-card">
                    <div class="quick-icon">🚛</div>
                    <h3>Data Distributor</h3>
                    <p>Kelola informasi distributor toko.</p>
                    <a class="quick-link" href="{{ route('distributor.index') }}">Lihat Data →</a>
                </div>

                <div class="quick-card">
                    <div class="quick-icon">🤝</div>
                    <h3>Data Agen</h3>
                    <p>Kelola informasi agen toko.</p>
                    <a class="quick-link" href="{{ route('agen.index') }}">Lihat Data →</a>
                </div>

                <div class="quick-card">
                    <div class="quick-icon">📥</div>
                    <h3>Barang Masuk</h3>
                    <p>Catat barang yang masuk ke inventori.</p>
                    <a class="quick-link" href="{{ route('barang-masuk.index') }}">Lihat Barang Masuk →</a>
                </div>

                <div class="quick-card">
                    <div class="quick-icon">📤</div>
                    <h3>Barang Keluar</h3>
                    <p>Catat barang yang keluar dari inventori.</p>
                    <a class="quick-link" href="{{ route('barang-keluar.index') }}">Lihat Barang Keluar →</a>
                </div>

                <div class="quick-card">
                    <div class="quick-icon">📋</div>
                    <h3>Riwayat Stok</h3>
                    <p>Lihat catatan barang masuk dan barang keluar.</p>
                    <a class="quick-link" href="{{ route('riwayat-stok.index') }}">Lihat Riwayat Stok →</a>
                </div>

            </div>
        </section>

        <footer class="footer">
            © {{ date('Y') }} SmartInventory —
            Sistem Manajemen Toko dan Inventori
        </footer>

    </main>

    <!-- MODE GELAP / TERANG DAN GRAFIK -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const themeToggle = document.getElementById('themeToggle');
            const themeIcon = document.getElementById('themeIcon');
            const themeText = document.getElementById('themeText');

            function isDarkMode() {
                return document.documentElement.classList.contains('dark-mode');
            }

            function updateChartsTheme() {
                const dark = isDarkMode();
                const textColor = dark ? '#e5edf9' : '#526078';
                const gridColor = dark ? '#344157' : '#e5eaf3';

                if (typeof Chart === 'undefined') return;

                Chart.defaults.color = textColor;
                Chart.defaults.borderColor = gridColor;

                ['grafikTransaksi', 'grafikStok'].forEach(function (id) {
                    const canvas = document.getElementById(id);
                    const chart = canvas && Chart.getChart(canvas);

                    if (!chart) return;

                    if (chart.options.plugins.legend) {
                        chart.options.plugins.legend.labels.color = textColor;
                    }

                    if (chart.options.scales) {
                        Object.values(chart.options.scales).forEach(function (scale) {
                            if (scale.ticks) scale.ticks.color = textColor;
                            if (scale.title) scale.title.color = textColor;
                            if (scale.grid) scale.grid.color = gridColor;
                        });
                    }

                    chart.update();
                });
            }

            function applyTheme(theme) {
                const dark = theme === 'dark';

                document.documentElement.classList.toggle('dark-mode', dark);
                themeIcon.textContent = dark ? '☀️' : '🌙';
                themeText.textContent = dark ? 'Mode Terang' : 'Mode Gelap';
                themeToggle.setAttribute('aria-pressed', dark ? 'true' : 'false');

                updateChartsTheme();
            }

            themeToggle.addEventListener('click', function () {
                const newTheme = isDarkMode() ? 'light' : 'dark';
                applyTheme(newTheme);

                try {
                    localStorage.setItem('smartinventory-theme', newTheme);
                } catch (e) {}
            });

            applyTheme(isDarkMode() ? 'dark' : 'light');

            if (typeof Chart === 'undefined') {
                console.warn('Chart.js belum tersedia. Periksa koneksi internet.');
                return;
            }

            new Chart(document.getElementById('grafikTransaksi'), {
                type: 'bar',
                data: {
                    labels: @json($namaBulan),
                    datasets: [
                        {
                            label: 'Barang Masuk',
                            data: @json($grafikMasuk),
                            backgroundColor: '#3b82f6',
                            borderRadius: 5
                        },
                        {
                            label: 'Barang Keluar',
                            data: @json($grafikKeluar),
                            backgroundColor: '#f59e0b',
                            borderRadius: 5
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { position: 'bottom' }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: { precision: 0 },
                            title: {
                                display: true,
                                text: 'Jumlah Barang'
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Bulan'
                            }
                        }
                    }
                }
            });

            new Chart(document.getElementById('grafikStok'), {
                type: 'doughnut',
                data: {
                    labels: ['Barang', 'Supplier', 'Distributor', 'Agen'],
                    datasets: [{
                        data: [
                            {{ $totalBarang }},
                            {{ $totalSupplier }},
                            {{ $totalDistributor }},
                            {{ $totalAgen }}
                        ],
                        backgroundColor: [
                            '#3b82f6',
                            '#10b981',
                            '#f59e0b',
                            '#8b5cf6'
                        ],
                        borderWidth: 2,
                        borderColor: isDarkMode() ? '#151f32' : '#ffffff'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { position: 'bottom' }
                    }
                }
            });

            updateChartsTheme();
        });
    </script>

</body>
</html>