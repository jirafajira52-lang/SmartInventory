
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Agen - SmartInventory</title>
    <style>
        body { margin: 0; padding: 30px; font-family: Arial, sans-serif; background: #f1f5f9; color: #1e293b; }
        .container { max-width: 650px; margin: auto; padding: 30px; background: white; border-radius: 16px; }
        h1 { color: #1d4ed8; }
        label { display: block; margin: 18px 0 7px; font-weight: bold; }
        input, textarea { width: 100%; padding: 12px; border: 1px solid #cbd5e1; border-radius: 8px; box-sizing: border-box; font-size: 15px; }
        .btn { display: inline-block; margin-top: 22px; padding: 12px 18px; border: none; border-radius: 8px; color: white; text-decoration: none; cursor: pointer; }
        .save { background: #2563eb; }
        .back { background: #64748b; }
        .error { color: #b91c1c; font-size: 13px; margin-top: 5px; }
    </style>
</head>
<body>
<div class="container">
    <h1>Edit Agen</h1>
    <p>Perbarui informasi agen.</p>

    <form action="{{ route('agen.update', $agen->id_agen) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Nama Agen *</label>
        <input type="text" name="nama_agen"
               value="{{ old('nama_agen', $agen->nama_agen) }}" required>
        @error('nama_agen')
            <div class="error">{{ $message }}</div>
        @enderror

        <label>Alamat</label>
        <textarea name="alamat" rows="3">{{ old('alamat', $agen->alamat) }}</textarea>
        @error('alamat')
            <div class="error">{{ $message }}</div>
        @enderror

        <label>Nomor Telepon</label>
        <input type="text" name="telepon"
               value="{{ old('telepon', $agen->telepon) }}">
        @error('telepon')
            <div class="error">{{ $message }}</div>
        @enderror

        <button type="submit" class="btn save">Simpan Perubahan</button>
        <a href="{{ route('agen.index') }}" class="btn back">Kembali</a>
    </form>
</div>
</body>
</html>
