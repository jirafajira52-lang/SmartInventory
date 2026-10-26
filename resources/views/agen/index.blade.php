
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Agen - SmartInventory</title>
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
        h1 { color: #1d4ed8; margin-top: 0; }
        .btn {
            display: inline-block;
            padding: 10px 14px;
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

    <h1>Data Agen</h1>
    <p>Kelola informasi agen pada sistem SmartInventory.</p>

    @if(session('success'))
        <div class="success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('agen.create') }}" class="btn primary">
        + Tambah Agen
    </a>

    <table>
        <thead>
        <tr>
            <th>No.</th>
            <th>Nama Agen</th>
            <th>Alamat</th>
            <th>Telepon</th>
            <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
        @forelse($agens as $agen)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $agen->nama_agen }}</td>
                <td>{{ $agen->alamat ?? '-' }}</td>
                <td>{{ $agen->telepon ?? '-' }}</td>
                <td>
                    <div class="actions">
                        <a class="btn edit"
                           href="{{ route('agen.edit', $agen->id_agen) }}">
                            Edit
                        </a>

                        <form action="{{ route('agen.destroy', $agen->id_agen) }}"
                              method="POST"
                              onsubmit="return confirm('Yakin ingin menghapus agen ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn delete" type="submit">Hapus</button>
                        </form>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" style="text-align:center;padding:25px">
                    Belum ada data agen.
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>
</body>
</html>
