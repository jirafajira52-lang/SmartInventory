
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan SmartInventory</title>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: 'Segoe UI', Arial, sans-serif;
            background: #f3f6fc;
            color: #24324b;
        }

        .container {
            max-width: 1400px;
            margin: auto;
            padding: 28px;
        }

        .hero {
            background: linear-gradient(120deg, #172554, #1d4ed8);
            color: white;
            padding: 28px;
            border-radius: 18px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            flex-wrap: wrap;
            margin-bottom: 25px;
        }

        .hero h1 { margin: 0 0 8px; font-size: 28px; }
        .hero p { margin: 0; color: #dbeafe; }

        .hero-actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .btn {
            display: inline-block;
            padding: 11px 16px;
            border: 0;
            border-radius: 9px;
            background: #2563eb;
            color: white;
            text-decoration: none;
            cursor: pointer;
            font-weight: 600;
            font-size: 13px;
        }

        .btn-white { background: white; color: #1d4ed8; }
        .btn-gray { background: #64748b; }

        .stats {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 18px;
            margin-bottom: 25px;
        }

        .stat-card {
            background: white;
            border: 1px solid #e5eaf4;
            border-radius: 15px;
            padding: 22px;
            box-shadow: 0 5px 20px #17255408;
        }

        .stat-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
        }

        .stat-icon {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            display: grid;
            place-items: center;
            font-size: 23px;
        }

        .blue { background: #dbeafe; }
        .green { background: #dcfce7; }
        .orange { background: #ffedd5; }
        .purple { background: #ede9fe; }

        .stat-label { color: #64748b; font-size: 13px; }

        .stat-value {
            font-size: 28px;
            font-weight: 750;
            margin-top: 17px;
            color: #172554;
            overflow-wrap: anywhere;
        }

        .stat-note {
            font-size: 12px;
            color: #94a3b8;
            margin-top: 6px;
        }

        .panel {
            background: white;
            border: 1px solid #e5eaf4;
            border-radius: 15px;
            padding: 23px;
            margin-bottom: 23px;
            box-shadow: 0 5px 20px #17255408;
            min-width: 0;
        }

        .panel-heading {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
            margin-bottom: 20px;
        }

        .panel-heading h2 {
            margin: 0;
            font-size: 18px;
            color: #172554;
        }

        .panel-heading p {
            margin: 7px 0 0;
            font-size: 13px;
            color: #94a3b8;
        }

        .charts {
            display: grid;
            grid-template-columns: minmax(0, 1.6fr) minmax(0, 1fr);
            gap: 22px;
        }

        .chart-box {
            height: 300px;
            position: relative;
        }

        .filter-form {
            display: flex;
            gap: 13px;
            align-items: end;
            flex-wrap: wrap;
        }

        .field {
            display: flex;
            flex-direction: column;
            gap: 7px;
        }

        .field label { font-size: 13px; font-weight: 600; }

        .field input {
            padding: 11px;
            border: 1px solid #dbe3f0;
            border-radius: 8px;
            font: inherit;
        }

        .table-wrap { overflow-x: auto; }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 650px;
        }

        th, td {
            padding: 13px 12px;
            border-bottom: 1px solid #edf0f7;
            text-align: left;
            font-size: 13px;
        }

        th {
            background: #f5f8ff;
            color: #475569;
            white-space: nowrap;
        }

        tbody tr:hover { background: #f8faff; }

        .badge {
            display: inline-block;
            padding: 5px 9px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
        }

        .healthy { background: #dcfce7; color: #15803d; }
        .low { background: #fef3c7; color: #a16207; }
        .out { background: #fee2e2; color: #b91c1c; }

        .empty {
            text-align: center;
            color: #94a3b8;
            padding: 24px;
        }

        .print-only { display: none; }

        footer {
            text-align: center;
            color: #94a3b8;
            padding: 10px;
            font-size: 12px;
        }

        @media (max-width: 950px) {
            .stats { grid-template-columns: repeat(2, minmax(0, 1fr)); }
            .charts { grid-template-columns: 1fr; }
        }

        @media (max-width: 550px) {
            .container { padding: 14px; }
            .hero { padding: 22px; }
            .hero h1 { font-size: 23px; }
            .stats { gap: 10px; }
            .stat-card { padding: 14px; }
            .stat-value { font-size: 23px; }
            .panel { padding: 15px; }
            .chart-box { height: 250px; }
        }

        @media print {
            @page { size: landscape; margin: 12mm; }

            body { background: white; color: black; }
            .container { max-width: none; padding: 0; }
            .no-print { display: none !important; }
            .print-only { display: block; }

            .hero {
                background: white;
                color: black;
                border: 1px solid #ccc;
                border-radius: 0;
                padding: 12px;
            }

            .hero p { color: #444; }
            .stats { grid-template-columns: repeat(4, 1fr); gap: 8px; }

            .stat-card, .panel {
                box-shadow: none;
                border: 1px solid #ccc;
                break-inside: avoid;
            }

            .stat-card { padding: 12px; }
            .stat-value { font-size: 20px; }
            .charts { grid-template-columns: 1.4fr 1fr; gap: 12px; }
            .chart-box { height: 220px; }
            table { min-width: 0; }
            th, td { font-size: 9px; padding: 7px; }
            th { background: #edf2f7 !important; }
            .panel-heading h2, h1 { color: black; }
            footer { color: black; }
        }
    </style>
</head>

<body>
<div class="container">

    <header class="hero">
        <div>
            <h1>📦 SmartInventory</h1>
            <p>Laporan Manajemen Toko dan Inventori</p>
        </div>

        <div class="hero-actions no-print">
            <a href="{{ route('dashboard') }}" class="btn btn-white">
                ← Dashboard
            </a>
            <button type="button" class="btn btn-white"
                    onclick="window.print()">
                🖨 Cetak / Simpan PDF
            </button>
        </div>
    </header>

    <div class="print-only">
        <p>
            Periode transaksi:
            {{ $mulai ?: 'Semua tanggal' }}
            s.d. {{ $selesai ?: 'Sekarang' }}
        </p>
    </div>

    <section class="stats">
        <div class="stat-card">
            <div class="stat-top">
                <span class="stat-label">Jenis Barang</span>
                <span class="stat-icon blue">📦</span>
            </div>
            <div class="stat-value">{{ number_format($totalJenisBarang) }}</div>
            <div class="stat-note">Jenis barang terdaftar</div>
        </div>

        <div class="stat-card">
            <div class="stat-top">
                <span class="stat-label">Total Stok</span>
                <span class="stat-icon green">🗃️</span>
            </div>
            <div class="stat-value">{{ number_format($totalStok) }}</div>
            <div class="stat-note">Akumulasi unit stok saat ini</div>
        </div>

        <div class="stat-card">
            <div class="stat-top">
                <span class="stat-label">Barang Masuk</span>
                <span class="stat-icon purple">📈</span>
            </div>
            <div class="stat-value">{{ number_format($totalBarangMasuk) }}</div>
            <div class="stat-note">Unit pada periode terpilih</div>
        </div>

        <div class="stat-card">
            <div class="stat-top">
                <span class="stat-label">Barang Keluar</span>
                <span class="stat-icon orange">📉</span>
            </div>
            <div class="stat-value">{{ number_format($totalBarangKeluar) }}</div>
            <div class="stat-note">Unit pada periode terpilih</div>
        </div>
    </section>

    <section class="panel no-print">
        <div class="panel-heading">
            <div>
                <h2>Filter Periode Transaksi</h2>
                <p>Pilih tanggal untuk menyaring transaksi dan grafik.</p>
            </div>
        </div>

        <form action="{{ route('laporan.index') }}" method="GET"
              class="filter-form">
            <div class="field">
                <label for="tanggal_mulai">Tanggal Mulai</label>
                <input type="date" id="tanggal_mulai"
                       name="tanggal_mulai" value="{{ $mulai }}">
            </div>

            <div class="field">
                <label for="tanggal_selesai">Tanggal Selesai</label>
                <input type="date" id="tanggal_selesai"
                       name="tanggal_selesai" value="{{ $selesai }}">
            </div>

            <button type="submit" class="btn">Terapkan Filter</button>
            <a href="{{ route('laporan.index') }}" class="btn btn-gray">Reset</a>
        </form>

        @if ($errors->any())
            <div style="color:#b91c1c; margin-top:12px">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif
    </section>

    <section class="charts">
        <div class="panel">
            <div class="panel-heading">
                <div>
                    <h2>📊 Barang Masuk & Keluar</h2>
                    <p>Perbandingan jumlah unit per bulan sesuai filter.</p>
                </div>
            </div>
            <div class="chart-box">
                <canvas id="grafikTransaksi"></canvas>
            </div>
        </div>

        <div class="panel">
            <div class="panel-heading">
                <div>
                    <h2>🥧 Kondisi Stok</h2>
                    <p>Jumlah jenis barang menurut kondisi stok.</p>
                </div>
            </div>
            <div class="chart-box">
                <canvas id="grafikStok"></canvas>
            </div>
        </div>
    </section>

    <section class="panel">
        <div class="panel-heading">
            <div>
                <h2>1. Laporan Data Barang</h2>
                <p>Informasi barang dan stok terkini.</p>
            </div>
        </div>

        <div class="table-wrap">
            <table>
                <thead>
                <tr>
                    <th>No.</th>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Kategori</th>
                    <th>Harga Beli</th>
                    <th>Harga Jual</th>
                    <th>Stok</th>
                    <th>Status</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($barangs as $barang)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>BRG-{{ str_pad($barang->id, 4, '0', STR_PAD_LEFT) }}</td>
                        <td>{{ $barang->nama_barang }}</td>
                        <td>{{ $barang->kategori }}</td>
                        <td>Rp {{ number_format($barang->harga_beli, 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($barang->harga_jual, 0, ',', '.') }}</td>
                        <td>{{ $barang->stok }}</td>
                        <td>
                            @if ($barang->stok <= 0)
                                <span class="badge out">Habis</span>
                            @elseif ($barang->stok <= 5)
                                <span class="badge low">Menipis</span>
                            @else
                                <span class="badge healthy">Sehat</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="8" class="empty">Belum ada data barang.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </section>

    <section class="panel">
        <div class="panel-heading">
            <div>
                <h2>2. Laporan Barang Masuk</h2>
                <p>Riwayat penambahan stok barang.</p>
            </div>
        </div>

        <div class="table-wrap">
            <table>
                <thead>
                <tr>
                    <th>No.</th>
                    <th>Tanggal</th>
                    <th>Nama Barang</th>
                    <th>Jumlah Masuk</th>
                    <th>Keterangan</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($barangMasuks as $transaksi)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ \Carbon\Carbon::parse($transaksi->tanggal_masuk)->format('d-m-Y') }}</td>
                        <td>{{ $transaksi->barang->nama_barang ?? 'Barang tidak ditemukan' }}</td>
                        <td>{{ number_format($transaksi->jumlah) }}</td>
                        <td>{{ $transaksi->keterangan ?: '-' }}</td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="empty">Tidak ada transaksi barang masuk.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </section>

    <section class="panel">
        <div class="panel-heading">
            <div>
                <h2>3. Laporan Barang Keluar</h2>
                <p>Riwayat pengurangan stok barang.</p>
            </div>
        </div>

        <div class="table-wrap">
            <table>
                <thead>
                <tr>
                    <th>No.</th>
                    <th>Tanggal</th>
                    <th>Nama Barang</th>
                    <th>Jumlah Keluar</th>
                    <th>Keterangan</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($barangKeluars as $transaksi)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ \Carbon\Carbon::parse($transaksi->tanggal_keluar)->format('d-m-Y') }}</td>
                        <td>{{ $transaksi->barang->nama_barang ?? 'Barang tidak ditemukan' }}</td>
                        <td>{{ number_format($transaksi->jumlah) }}</td>
                        <td>{{ $transaksi->keterangan ?: '-' }}</td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="empty">Tidak ada transaksi barang keluar.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </section>

    <footer>© {{ date('Y') }} SmartInventory — Laporan Inventori Toko</footer>

</div>

<script>
    const bulan = @json($namaBulan);
    const dataMasuk = @json($grafikMasuk);
    const dataKeluar = @json($grafikKeluar);

    // Plugin angka di atas batang grafik
    const labelBatang = {
        id: 'labelBatang',
        afterDatasetsDraw(chart) {
            const { ctx } = chart;

            chart.data.datasets.forEach((dataset, index) => {
                const meta = chart.getDatasetMeta(index);

                meta.data.forEach((bar, i) => {
                    const nilai = dataset.data[i];

                    if (nilai > 0) {
                        ctx.save();
                        ctx.fillStyle = '#334155';
                        ctx.font = 'bold 11px Arial';
                        ctx.textAlign = 'center';
                        ctx.fillText(nilai, bar.x, bar.y - 7);
                        ctx.restore();
                    }
                });
            });
        }
    };

    new Chart(document.getElementById('grafikTransaksi'), {
        type: 'bar',
        data: {
            labels: bulan,
            datasets: [
                {
                    label: 'Barang Masuk',
                    data: dataMasuk,
                    backgroundColor: '#c4b5fd',
                    borderRadius: 5,
                    maxBarThickness: 22
                },
                {
                    label: 'Barang Keluar',
                    data: dataKeluar,
                    backgroundColor: '#7c3aed',
                    borderRadius: 5,
                    maxBarThickness: 22
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            layout: { padding: { top: 22 } },
            interaction: { mode: 'index', intersect: false },
            plugins: {
                legend: { position: 'bottom' },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return context.dataset.label + ': ' +
                                context.parsed.y + ' unit';
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grace: '10%',
                    ticks: { precision: 0 }
                }
            }
        },
        plugins: [labelBatang]
    });

    // Data kondisi stok
    const dataStok = [
        {{ $stokSehat }},
        {{ $stokMenipis }},
        {{ $stokHabis }}
    ];

    // Plugin persentase di dalam diagram lingkaran
    const labelPersentase = {
        id: 'labelPersentase',
        afterDatasetsDraw(chart) {
            const { ctx } = chart;
            const dataset = chart.data.datasets[0];
            const total = dataset.data.reduce((sum, value) => sum + value, 0);

            if (total === 0) return;

            const meta = chart.getDatasetMeta(0);

            meta.data.forEach((slice, i) => {
                const nilai = dataset.data[i];

                if (nilai <= 0) return;

                const posisi = slice.tooltipPosition();
                const persen = Math.round((nilai / total) * 100);

                ctx.save();
                ctx.fillStyle = '#17324d';
                ctx.font = 'bold 13px Arial';
                ctx.textAlign = 'center';
                ctx.textBaseline = 'middle';
                ctx.fillText(persen + '%', posisi.x, posisi.y);
                ctx.restore();
            });
        }
    };

    new Chart(document.getElementById('grafikStok'), {
        type: 'pie',
        data: {
            labels: ['Stok Sehat', 'Stok Menipis', 'Stok Habis'],
            datasets: [{
                data: dataStok,
                backgroundColor: ['#86efac', '#fde68a', '#fca5a5'],
                borderColor: '#ffffff',
                borderWidth: 3
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { position: 'bottom' },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            const total = context.dataset.data.reduce(
                                (sum, value) => sum + value, 0
                            );
                            const nilai = context.raw;
                            const persen = total > 0
                                ? ((nilai / total) * 100).toFixed(1)
                                : 0;

                            return context.label + ': ' + nilai +
                                ' jenis barang (' + persen + '%)';
                        }
                    }
                }
            }
        },
        plugins: [labelPersentase]
    });

    window.addEventListener('beforeprint', function() {
        if (typeof Chart !== 'undefined') {
            Chart.getChart('grafikTransaksi')?.resize();
            Chart.getChart('grafikStok')?.resize();
        }
    });
</script>

</body>
</html>
