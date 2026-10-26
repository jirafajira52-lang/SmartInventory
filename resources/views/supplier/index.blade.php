
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Supplier - SmartInventory</title>
    <style>
        * { box-sizing: border-box; }
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f1f5f9;
            color: #1e293b;
        }
        .header {
            background: #1d4ed8;
            color: white;
            padding: 22px 5%;
        }
        .header h1 { margin: 0 0 6px; }
        .container { max-width: 1200px; margin: 30px auto; padding: 0 20px; }
        .card {
            background: white;
            border-radius: 14px;
            padding: 24px;
            box-shadow: 0 4px 16px #0f172a0d;
        }
        .top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
            margin-bottom: 20px;
        }
        .button {
            display: inline-block;
            text-decoration: none;
            border: 0;
            border-radius: 8px;
            padding: 11px 15px;
            font-weight: bold;
            cursor: pointer;
            font-size: 14px;
        }
        .primary { background: #2563eb; color: white; }
        .edit { background: #dbeafe; color: #1d4ed8; }
        .delete { background: #fee2e2; color: #b91c1c; }
        .back { background: #e2e8f0; color: #334155; }
        .table-wrap { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; min-width: 750px; }
        th, td { padding: 14px 12px; text-align: left; border-bottom: 1px solid #e2e8f0; }
        th { background: #eff6ff; color: #1e40af; }
        .alert { padding: 13px; background: #dcfce7; color: #166534; border-radius: 8px; margin-bottom: 18px; }
        .empty { text-align: center; padding: 30px; color: #64748b; }
        .actions { display: flex; gap: 7px; align-items: center; }
        .actions form { margin: 0; }
        .muted { color: #64748b; font-size: 14px; }
    </style>
</head>
<body>
    <header class="header">
        <h1>📦 SmartInventory</h1>
        <div>Sistem Manajemen Toko dan Inventori</div>
    </header>

    <main class="container">
        <div class="card">
            <div class="top">
                <div>
                    <h2 style="margin:0 0 8px">Data Supplier</h2>
                    <div class="muted">Kelola pemasok barang toko sembako.</div>
                </div>
                <a class="button primary" href="{{ route('supplier.create') }}">+ Tambah Supplier</a>
            </div>

            @if(session('success'))
                <div class="alert">{{ session('success') }}</div>
            @endif

            @if($errors->any())
                <div class="alert" style="background:#fee2e2;color:#991b1b">
                    Ada data yang perlu diperiksa. Silakan cek kembali formulir.
                </div>
            @endif

            <p>Total data: <strong>{{ $suppliers->count() }}</strong> supplier</p>

            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Supplier</th>
                            <th>Alamat</th>
                            <th>Telepon</th>
                            <th>Email</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($suppliers as $supplier)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><strong>{{ $supplier->nama_supplier }}</strong></td>
                                <td>{{ $supplier->alamat ?: '-' }}</td>
                                <td>{{ $supplier->telepon ?: '-' }}</td>
                                <td>{{ $supplier->email ?: '-' }}</td>
                                <td>
                                    <div class="actions">
                                        <a class="button edit" href="{{ route('supplier.edit', $supplier) }}">Edit</a>
                                        <form method="POST" action="{{ route('supplier.destroy', $supplier) }}"
                                              onsubmit="return confirm('Yakin ingin menghapus supplier ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="button delete" type="submit">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="empty">Belum ada data supplier. Klik Tambah Supplier untuk memulai.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <p style="margin-top:24px">
                <a class="button back" href="{{ route('dashboard') }}">← Kembali ke Dashboard</a>
            </p>
        </div>
    </main>
</body>
</html>
