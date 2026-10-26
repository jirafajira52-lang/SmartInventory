
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Distributor - SmartInventory</title>
    <style>
        body {
            margin: 0;
            padding: 30px;
            font-family: Arial, sans-serif;
            background: #f1f5f9;
            color: #1e293b;
        }
        .container {
            max-width: 650px;
            margin: auto;
            padding: 30px;
            background: white;
            border-radius: 16px;
            box-shadow: 0 5px 20px #0000000d;
        }
        h1 { color: #1d4ed8; }
        label {
            display: block;
            margin-top: 18px;
            margin-bottom: 7px;
            font-weight: bold;
        }
        input, textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            box-sizing: border-box;
            font-size: 15px;
        }
        textarea { resize: vertical; }
        .btn {
            display: inline-block;
            margin-top: 22px;
            padding: 12px 18px;
            border: none;
            border-radius: 8px;
            color: white;
            text-decoration: none;
            cursor: pointer;
            font-size: 14px;
        }
        .save { background: #2563eb; }
        .back { background: #64748b; }
        .error {
            color: #b91c1c;
            font-size: 13px;
            margin-top: 5px;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Edit Distributor</h1>
    <p>Perbarui informasi distributor.</p>

    <form action="{{ route('distributor.update', $distributor->id_distributor) }}"
          method="POST">
        @csrf
        @method('PUT')

        <label>Nama Distributor *</label>
        <input type="text" name="nama_distributor"
               value="{{ old('nama_distributor', $distributor->nama_distributor) }}"
               required>
        @error('nama_distributor')
            <div class="error">{{ $message }}</div>
        @enderror

        <label>Alamat</label>
        <textarea name="alamat" rows="3">{{ old('alamat', $distributor->alamat) }}</textarea>
        @error('alamat')
            <div class="error">{{ $message }}</div>
        @enderror

        <label>Nomor Telepon</label>
        <input type="text" name="telepon"
               value="{{ old('telepon', $distributor->telepon) }}">
        @error('telepon')
            <div class="error">{{ $message }}</div>
        @enderror

        <label>Email</label>
        <input type="email" name="email"
               value="{{ old('email', $distributor->email) }}">
        @error('email')
            <div class="error">{{ $message }}</div>
        @enderror

        <button type="submit" class="btn save">Simpan Perubahan</button>
        <a href="{{ route('distributor.index') }}" class="btn back">Kembali</a>
    </form>
</div>
</body>
</html>
