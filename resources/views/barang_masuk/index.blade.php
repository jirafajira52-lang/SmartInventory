
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Barang Masuk - SmartInventory</title>
    <style>
        body{font-family:Arial,sans-serif;background:#f3f6fc;color:#26344d;margin:0;padding:30px}
        .container{max-width:1050px;margin:auto}
        .header{display:flex;justify-content:space-between;align-items:center;gap:15px;flex-wrap:wrap}
        h1{color:#204b91}
        .btn{display:inline-block;background:#2459b3;color:white;padding:11px 16px;border-radius:8px;text-decoration:none;border:0;cursor:pointer}
        .back{background:#64748b}
        .card{background:white;padding:22px;border-radius:14px;margin-top:20px;box-shadow:0 4px 18px #26344d10;overflow-x:auto}
        table{width:100%;border-collapse:collapse}
        th,td{text-align:left;padding:13px;border-bottom:1px solid #e5eaf3}
        th{background:#edf3ff;color:#214b92}
        .success{background:#dcfce7;color:#166534;padding:12px;border-radius:8px;margin-top:15px}
        .empty{text-align:center;color:#64748b;padding:25px}
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <div>
            <h1>📥 Data Barang Masuk</h1>
            <p>Riwayat penambahan stok barang toko.</p>
        </div>
        <div>
            <a href="{{ route('dashboard') }}" class="btn back">Dashboard</a>
            <a href="{{ route('barang-masuk.create') }}" class="btn">+ Tambah Barang Masuk</a>
        </div>
    </div>

    @if(session('success'))
        <div class="success">{{ session('success') }}</div>
    @endif

    <div class="card">
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
                @forelse($barangMasuks as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->tanggal_masuk?->format('d-m-Y') }}</td>
                        <td>{{ $item->barang?->nama_barang ?? 'Barang tidak ditemukan' }}</td>
                        <td>{{ number_format($item->jumlah, 0, ',', '.') }}</td>
                        <td>{{ $item->keterangan ?: '-' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="empty">Belum ada catatan barang masuk.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
