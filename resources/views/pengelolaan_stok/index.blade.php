
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengelolaan Stok - SmartInventory</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: #f3f6fc;
            color: #26344d;
        }

        .container {
            max-width: 1200px;
            margin: auto;
            padding: 30px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
            margin-bottom: 25px;
        }

        h1 {
            color: #193d7c;
            font-size: 27px;
        }

        .subtitle {
            color: #718096;
            margin-top: 8px;
        }

        .btn {
            display: inline-block;
            background: #2459b3;
            color: white;
            padding: 12px 18px;
            border-radius: 9px;
            text-decoration: none;
            font-weight: 600;
        }

        .summary {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 18px;
            margin-bottom: 25px;
        }

        .card {
            background: white;
            border: 1px solid #e8edf7;
            border-radius: 14px;
            padding: 23px;
            box-shadow: 0 4px 18px rgba(40, 65, 110, 0.05);
        }

        .card p {
            color: #718096;
            font-size: 14px;
            margin-bottom: 12px;
        }

        .card h2 {
            font-size: 30px;
            color: #2459b3;
        }

        .table-box {
            background: white;
            border-radius: 14px;
            border: 1px solid #e8edf7;
            padding: 22px;
            overflow-x: auto;
        }

        .table-box h2 {
            color: #263e67;
            font-size: 20px;
            margin-bottom: 18px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 700px;
        }

        th, td {
            padding: 15px 12px;
            text-align: left;
            border-bottom: 1px solid #edf0f7;
            font-size: 14px;
        }

        th {
            background: #edf3ff;
            color: #214b92;
        }

        .badge {
            display: inline-block;
            padding: 7px 11px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
        }

        .aman {
            background: #dcfce7;
            color: #166534;
        }

        .menipis {
            background: #fef3c7;
            color: #92400e;
        }

        .habis {
            background: #fee2e2;
            color: #991b1b;
        }

        .aksi a {
            display: inline-block;
            margin: 3px;
            text-decoration: none;
            font-size: 13px;
            font-weight: bold;
            color: #2459b3;
        }

        .back {
            display: inline-block;
            margin-top: 24px;
            color: #2459b3;
            text-decoration: none;
            font-weight: bold;
        }

        .footer {
            text-align: center;
            color: #929db0;
            font-size: 12px;
            margin-top: 30px;
        }

        @media (max-width: 700px) {
            .container {
                padding: 18px 12px;
            }

            .summary {
                grid-template-columns: 1fr;
            }

            h1 {
                font-size: 23px;
            }
        }
    </style>
</head>

<body>
<div class="container">

    <header class="header">
        <div>
            <h1>📊 Pengelolaan Stok</h1>
            <p class="subtitle">
                Pantau persediaan dan status stok barang toko.
            </p>
        </div>

        <a href="{{ route('dashboard') }}" class="btn">
            ← Dashboard
        </a>
    </header>

    <section class="summary">
        <div class="card">
            <p>Total Jenis Barang</p>
            <h2>{{ $totalBarang }}</h2>
        </div>

        <div class="card">
            <p>Barang Stok Menipis</p>
            <h2>{{ $stokMenipis }}</h2>
        </div>

        <div class="card">
            <p>Barang Stok Habis</p>
            <h2>{{ $stokHabis }}</h2>
        </div>
    </section>

    <section class="table-box">
        <h2>Daftar Persediaan Barang</h2>

        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Kategori</th>
                    <th>Stok</th>
                    <th>Status</th>
                    <th>Transaksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($barangs as $barang)
                    <tr>
                        <td>{{ $loop->iteration }}</td>

                        <td>
                            BRG-{{ str_pad($barang->id, 4, '0', STR_PAD_LEFT) }}
                        </td>

                        <td>{{ $barang->nama_barang }}</td>
                        <td>{{ $barang->kategori }}</td>
                        <td><strong>{{ $barang->stok }}</strong></td>

                        <td>
                            @if ($barang->stok <= 0)
                                <span class="badge habis">Stok Habis</span>
                            @elseif ($barang->stok <= 5)
                                <span class="badge menipis">Stok Menipis</span>
                            @else
                                <span class="badge aman">Stok Aman</span>
                            @endif
                        </td>

                        <td class="aksi">
                            <a href="{{ route('barang-masuk.create') }}">
                                + Barang Masuk
                            </a>

                            <a href="{{ route('barang-keluar.create') }}">
                                - Barang Keluar
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">Belum ada data barang.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </section>

    <a href="{{ route('dashboard') }}" class="back">
        ← Kembali ke Dashboard
    </a>

    <footer class="footer">
        © {{ date('Y') }} SmartInventory
    </footer>

</div>
</body>
</html>
