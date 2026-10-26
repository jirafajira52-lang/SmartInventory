
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Distributor - SmartInventory</title>
    <style>
        * { box-sizing: border-box; }
        body {
            margin: 0;
            padding: 30px;
            font-family: Arial, sans-serif;
            background: #f1f5f9;
            color: #1e293b;
        }
        .container {
            max-width: 1100px;
            margin: auto;
            background: white;
            padding: 28px;
            border-radius: 16px;
            box-shadow: 0 5px 20px #0000000d;
        }
        h1 { margin-top: 0; color: #1d4ed8; }
        .btn {
            display: inline-block;
            padding: 10px 15px;
            border: none;
            border-radius: 8px;
            text-decoration: none;
            color: white;
            cursor: pointer;
            font-size: 14px;
        }
        .primary { background: #2563eb; }
        .edit { background: #f59e0b; }
        .delete { background: #ef4444; }
        .back { background: #64748b; margin-bottom: 20px; }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 22px;
        }
        th, td {
            padding: 13px;
            text-align: left;
            border-bottom: 1px solid #e2e8f0;
        }
        th { background: #eff6ff; }
        .success {
            padding: 12px;
            margin: 15px 0;
            background: #dcfce7;
            color: #166534;
            border-radius: 8px;
        }
        .actions { display: flex; gap: 7px; }
        @media (max-width: 700px) {
            body { padding: 12px; }
            .container { padding: 16px; overflow-x: auto; }
        }
    </style>
</head>
<body>
<div class="container">
    <a href="{{ route('dashboard') }}" class="btn back">← Dashboard</a>

    <h1>Data Distributor</h1>
    <p>Kelola data distributor pada sistem SmartInventory.</p>

    @if(session('success'))
        <div class="success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('distributor.create') }}" class="btn primary">
        + Tambah Distributor
    </a>

    <table>
        <thead>
        <tr>
            <th>No.</th>
            <th>Nama Distributor</th>
            <th>Alamat</th>
            <th>Telepon</th>
            <th>Email</th>
            <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
        @forelse($distributors as $distributor)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $distributor->nama_distributor }}</td>
                <td>{{ $distributor->alamat ?? '-' }}</td>
                <td>{{ $distributor->telepon ?? '-' }}</td>
                <td>{{ $distributor->email ?? '-' }}</td>
                <td>
                    <div class="actions">
                        <a class="btn edit"
                           href="{{ route('distributor.edit', $distributor->id_distributor) }}">
                            Edit
                        </a>

                        <form action="{{ route('distributor.destroy', $distributor->id_distributor) }}"
                              method="POST"
                              onsubmit="return confirm('Yakin ingin menghapus distributor ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn delete" type="submit">Hapus</button>
                        </form>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" style="text-align:center;padding:25px">
                    Belum ada data distributor.
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>
</body>
</html>
