<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Barang | SmartInventory</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f1f5f9;
            margin: 0;
            padding: 30px;
            color: #1e293b;
        }

        .container {
            max-width: 650px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 15px #0000000d;
        }

        h1 { color: #1e3a8a; }

        label {
            display: block;
            margin-top: 16px;
            margin-bottom: 7px;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 12px;
            border: 1px solid #cbd5e1;
            border-radius: 7px;
            box-sizing: border-box;
        }

        .btn {
            display: inline-block;
            padding: 12px 18px;
            margin-top: 22px;
            border: none;
            border-radius: 7px;
            text-decoration: none;
            cursor: pointer;
            font-size: 15px;
        }

        .simpan {
            background: #2563eb;
            color: white;
        }

        .kembali {
            background: #e2e8f0;
            color: #1e293b;
        }

        .error {
            background: #fee2e2;
            color: #991b1b;
            padding: 12px;
            border-radius: 7px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>➕ Tambah Barang</h1>
        <p>Masukkan informasi barang yang akan disimpan.</p>

        @if ($errors->any())
            <div class="error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('barang.store') }}" method="POST">
            @csrf

            <label>Nama Barang</label>
            <input type="text" name="nama_barang"
                   value="{{ old('nama_barang') }}" required>

            <label>Kategori</label>
            <input type="text" name="kategori"
                   value="{{ old('kategori') }}">

            <label>Harga Beli (Rp)</label>
            <input type="number" name="harga_beli" min="0"
                   step="0.01" value="{{ old('harga_beli', 0) }}" required>

            <label>Harga Jual (Rp)</label>
            <input type="number" name="harga_jual" min="0"
                   step="0.01" value="{{ old('harga_jual', 0) }}" required>

            <label>Stok Barang</label>
            <input type="number" name="stok" min="0"
                   value="{{ old('stok', 0) }}" required>

            <br>

            <button type="submit" class="btn simpan">
                Simpan Barang
            </button>

            <a href="{{ route('barang.index') }}" class="btn kembali">
                Kembali
            </a>
        </form>
    </div>
</body>
</html>
