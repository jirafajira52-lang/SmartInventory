
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Barang Masuk - SmartInventory</title>
    <style>
        body{font-family:Arial,sans-serif;background:#f3f6fc;color:#26344d;margin:0;padding:30px}
        .container{max-width:650px;margin:auto}
        .card{background:white;padding:28px;border-radius:14px;box-shadow:0 4px 18px #26344d10}
        h1{color:#204b91}
        label{display:block;margin:17px 0 8px;font-weight:bold}
        input,select,textarea{width:100%;padding:12px;border:1px solid #ccd5e5;border-radius:8px;box-sizing:border-box}
        .btn{display:inline-block;background:#2459b3;color:white;padding:12px 18px;border:0;border-radius:8px;text-decoration:none;cursor:pointer;margin-top:20px}
        .back{background:#64748b}
        .error{color:#b91c1c;font-size:13px;margin-top:5px}
    </style>
</head>
<body>
<div class="container">
    <div class="card">
        <h1>📥 Tambah Barang Masuk</h1>
        <p>Isi formulir untuk menambahkan stok.</p>

        @if($errors->any())
            <div class="error">Periksa kembali data yang kamu masukkan.</div>
        @endif

        <form action="{{ route('barang-masuk.store') }}" method="POST">
            @csrf

            <label>Nama Barang</label>
            <select name="barang_id" required>
                <option value="">-- Pilih Barang --</option>
                @foreach($barangs as $barang)
                    <option value="{{ $barang->getKey() }}" @selected(old('barang_id') == $barang->getKey())>
                        {{ $barang->nama_barang }} (Stok: {{ $barang->stok }})
                    </option>
                @endforeach
            </select>
            @error('barang_id') <div class="error">{{ $message }}</div> @enderror

            <label>Jumlah Barang Masuk</label>
            <input type="number" name="jumlah" min="1" value="{{ old('jumlah') }}" required>
            @error('jumlah') <div class="error">{{ $message }}</div> @enderror

            <label>Tanggal Masuk</label>
            <input type="date" name="tanggal_masuk" value="{{ old('tanggal_masuk', date('Y-m-d')) }}" required>
            @error('tanggal_masuk') <div class="error">{{ $message }}</div> @enderror

            <label>Keterangan</label>
            <textarea name="keterangan" rows="3" placeholder="Contoh: stok tambahan dari supplier">{{ old('keterangan') }}</textarea>

            <button type="submit" class="btn">Simpan Barang Masuk</button>
            <a href="{{ route('barang-masuk.index') }}" class="btn back">Kembali</a>
        </form>
    </div>
</div>
</body>
</html>
