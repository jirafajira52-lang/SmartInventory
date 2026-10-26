
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Barang Keluar - SmartInventory</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f3f6fc;
            color: #26344d;
            padding: 30px;
            margin: 0;
        }
        .container {
            max-width: 1050px;
            margin: auto;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 12px;
        }
        h1 { color: #204b91; }
        .btn {
            display: inline-block;
            background: #2459b3;
            color: white;
            padding: 11px 15px;
            border-radius: 8px;
            text-decoration: none;
            margin: 3px;
        }
        .back { background: #64748b; }
        .card {
            background: white;
            padding: 20px;
            border-radius: 14px;
            margin-top: 20px;
            overflow-x: auto;
            box-shadow: 0 4px 18px #26344d10;
        }
        table { width: 100%; border-collapse: collapse; }
        th, td {
            text-align: left;
            padding: 13px;
            border-bottom: 1px solid #e5eaf3;
        }
        th { background: #edf3ff; color: #214b92; }
        .success {
            background: #dcfce7;
            color: #166534;
            padding: 12px;
            border-radius: 8px;
        }
        .empty { text-align: center; padding: 25px; color: #64748b; }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <div>
            <h1>📤 Data Barang Keluar</h1>
            <p>Riwayat pengurangan stok barang toko.</p>
        </div>
        <div>
            <a href="{{ route('dashboard') }}" class="btn back">Dashboard</a>
            <a href="{{ route('barang-keluar.create') }}" class="btn">+ Tambah Barang Keluar</a>
        </div>
    </div>

    @if(session('success'))
        <p class="success">{{ session('success') }}</p>
    @endif

    <div class="card">
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
                @forelse($barangKeluars as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->tanggal_keluar?->format('d-m-Y') }}</td>
                        <td>{{ $item->barang?->nama_barang ?? 'Barang tidak ditemukan' }}</td>
                        <td>{{ number_format($item->jumlah, 0, ',', '.') }}</td>
                        <td>{{ $item->keterangan ?: '-' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="empty">
                            Belum ada catatan barang keluar.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
