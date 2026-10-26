
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Stok | SmartInventory</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: #f4f7fb;
            color: #1e293b;
            padding: 30px;
        }

        .container {
            max-width: 1200px;
            margin: auto;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            flex-wrap: wrap;
            margin-bottom: 25px;
        }

        .header h1 {
            font-size: 28px;
            margin-bottom: 8px;
        }

        .header p {
            color: #64748b;
            font-size: 14px;
        }

        .btn {
            display: inline-block;
            padding: 11px 17px;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 600;
            font-size: 13px;
        }

        .btn-back {
            background: #e2e8f0;
            color: #334155;
        }

        .btn-in {
            background: #16a34a;
            color: white;
        }

        .btn-out {
            background: #2563eb;
            color: white;
        }

        .summary {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 18px;
            margin-bottom: 25px;
        }

        .card {
            background: white;
            padding: 22px;
            border-radius: 16px;
            box-shadow: 0 4px 15px rgba(15, 23, 42, 0.05);
            border: 1px solid #e8edf5;
        }

        .card p {
            color: #64748b;
            font-size: 14px;
            margin-bottom: 12px;
        }

        .card h2 {
            font-size: 28px;
        }

        .green {
            color: #16a34a;
        }

        .blue {
            color: #2563eb;
        }

        .purple {
            color: #7c3aed;
        }

        .table-card {
            background: white;
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 4px 15px rgba(15, 23, 42, 0.05);
            overflow-x: auto;
        }

        .table-header {
            margin-bottom: 22px;
        }

        .table-header h2 {
            font-size: 20px;
            margin-bottom: 7px;
        }

        .table-header p {
            color: #64748b;
            font-size: 13px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 750px;
        }

        th {
            background: #f8fafc;
            color: #64748b;
            text-align: left;
            padding: 15px 12px;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: .4px;
        }

        td {
            padding: 16px 12px;
            border-bottom: 1px solid #edf2f7;
            font-size: 14px;
        }

        tbody tr:hover {
            background: #f8fafc;
        }

        .badge {
            padding: 6px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
            white-space: nowrap;
        }

        .badge-in {
            color: #15803d;
            background: #dcfce7;
        }

        .badge-out {
            color: #1d4ed8;
            background: #dbeafe;
        }

        .empty {
            text-align: center;
            padding: 35px;
            color: #64748b;
        }

        .footer {
            text-align: center;
            margin-top: 25px;
            color: #94a3b8;
            font-size: 12px;
        }

        @media (max-width: 700px) {
            body {
                padding: 16px;
            }

            .summary {
                grid-template-columns: 1fr;
            }

            .header h1 {
                font-size: 23px;
            }
        }
    </style>
</head>

<body>
<div class="container">

    <div class="header">
        <div>
            <h1>📋 Riwayat Stok</h1>
            <p>Pantau seluruh transaksi barang masuk dan keluar.</p>
        </div>

        <a href="{{ route('dashboard') }}" class="btn btn-back">
            ← Kembali ke Dashboard
        </a>
    </div>

    <div class="summary">
        <div class="card">
            <p>📦 Total Transaksi</p>
            <h2 class="purple">{{ $riwayat->count() }}</h2>
        </div>

        <div class="card">
            <p>⬇️ Total Barang Masuk</p>
            <h2 class="green">
                {{ $riwayat->where('jenis', 'Barang Masuk')->sum('jumlah') }}
            </h2>
        </div>

        <div class="card">
            <p>⬆️ Total Barang Keluar</p>
            <h2 class="blue">
                {{ $riwayat->where('jenis', 'Barang Keluar')->sum('jumlah') }}
            </h2>
        </div>
    </div>

    <div class="table-card">
        <div class="table-header">
            <h2>Daftar Riwayat Transaksi</h2>
            <p>Data transaksi diurutkan dari tanggal terbaru.</p>
        </div>

        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Tanggal</th>
                    <th>Nama Barang</th>
                    <th>Jenis Transaksi</th>
                    <th>Jumlah</th>
                    <th>Keterangan</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($riwayat as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            {{ \Carbon\Carbon::parse($item['tanggal'])->format('d-m-Y') }}
                        </td>
                        <td><strong>{{ $item['nama_barang'] }}</strong></td>
                        <td>
                            @if ($item['jenis'] === 'Barang Masuk')
                                <span class="badge badge-in">⬇ Barang Masuk</span>
                            @else
                                <span class="badge badge-out">⬆ Barang Keluar</span>
                            @endif
                        </td>
                        <td><strong>{{ $item['jumlah'] }} unit</strong></td>
                        <td>{{ $item['keterangan'] }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="empty">
                            Belum ada riwayat transaksi stok.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="footer">
        SmartInventory © {{ date('Y') }} — Sistem Manajemen Toko dan Inventori
    </div>

</div>
</body>
</html>
