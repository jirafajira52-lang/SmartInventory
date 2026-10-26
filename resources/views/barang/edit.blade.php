<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Barang - SmartInventory</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f1f5f9;
            color: #1e293b;
        }

        header {
            background: #203f87;
            color: white;
            padding: 24px 30px;
        }

        header h1 {
            margin: 0 0 8px;
        }

        main {
            max-width: 900px;
            margin: 35px auto;
            padding: 0 20px;
        }

        .panel {
            background: white;
            border-radius: 16px;
            padding: 30px;
            box-shadow: 0 5px 20px #0000000d;
        }

        h2 {
            margin-top: 0;
            color: #203f87;
        }

        .description {
            color: #64748b;
            margin-bottom: 25px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 8px;
        }

        input {
            width: 100%;
            padding: 13px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            font-size: 15px;
        }

        input:focus {
            outline: none;
            border-color: #3478f6;
            box-shadow: 0 0 0 3px #3478f622;
        }

        .error {
            color: #dc2626;
            font-size: 13px;
            margin-top: 6px;
        }

        .actions {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            margin-top: 25px;
        }

        .btn {
            display: inline-block;
            padding: 12px 20px;
            border: none;
            border-radius: 8px;
            font-size: 15px;
            text-decoration: none;
            cursor: pointer;
        }

        .btn-primary {
            background: #3478f6;
            color: white;
        }

        .btn-primary:hover {
            background: #245fce;
        }

        .btn-secondary {
            background: #e2e8f0;
            color: #334155;
        }

        @media (max-width: 600px) {
            .panel {
                padding: 20px;
            }
        }
    </style>
</head>

<body>
    <header>
        <h1>📦 SmartInventory</h1>
        <div>Sistem Manajemen Toko dan Inventori</div>
    </header>

    <main>
        <section class="panel">
            <h2>✏️ Edit Data Barang</h2>
            <p class="description">
                Perbarui informasi barang yang tersimpan di inventori toko.
            </p>

            <form action="{{ route('barang.update', $barang->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="nama_barang">Nama Barang</label>
                    <input
                        type="text"
                        id="nama_barang"
                        name="nama_barang"
                        value="{{ old('nama_barang', $barang->nama_barang) }}"
                        required
                    >
                    @error('nama_barang')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="kategori">Kategori</label>
                    <input
                        type="text"
                        id="kategori"
                        name="kategori"
                        value="{{ old('kategori', $barang->kategori) }}"
                    >
                    @error('kategori')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="harga_beli">Harga Beli (Rp)</label>
                    <input
                        type="number"
                        id="harga_beli"
                        name="harga_beli"
                        min="0"
                        step="0.01"
                        value="{{ old('harga_beli', $barang->harga_beli) }}"
                        required
                    >
                    @error('harga_beli')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="harga_jual">Harga Jual (Rp)</label>
                    <input
                        type="number"
                        id="harga_jual"
                        name="harga_jual"
                        min="0"
                        step="0.01"
                        value="{{ old('harga_jual', $barang->harga_jual) }}"
                        required
                    >
                    @error('harga_jual')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="stok">Jumlah Stok</label>
                    <input
                        type="number"
                        id="stok"
                        name="stok"
                        min="0"
                        value="{{ old('stok', $barang->stok) }}"
                        required
                    >
                    @error('stok')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="actions">
                    <button type="submit" class="btn btn-primary">
                        💾 Simpan Perubahan
                    </button>

                    <a href="{{ route('barang.index') }}"
                       class="btn btn-secondary">
                        Batal
                    </a>
                </div>
            </form>
        </section>
    </main>
</body>
</html>
