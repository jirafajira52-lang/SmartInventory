<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Barang | SmartInventory</title>

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
            background: linear-gradient(135deg, #203f87, #315fc0);
            color: white;
            padding: 25px 5%;
        }

        header h1 {
            margin: 0 0 8px;
            font-size: 30px;
        }

        header p {
            margin: 0;
            color: #e0eaff;
        }

        main {
            max-width: 1250px;
            margin: 35px auto;
            padding: 0 22px;
        }

        .panel {
            background: white;
            border-radius: 18px;
            padding: 28px;
            box-shadow: 0 8px 30px rgba(30, 64, 135, 0.08);
        }

        .top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 18px;
            margin-bottom: 25px;
        }

        .top h2 {
            margin: 0 0 8px;
            font-size: 27px;
        }

        .subtitle {
            margin: 0;
            color: #64748b;
        }

        .btn {
            display: inline-block;
            padding: 11px 16px;
            border: none;
            border-radius: 9px;
            color: white;
            text-decoration: none;
            font-size: 14px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.2s;
        }

        .btn:hover {
            transform: translateY(-1px);
            opacity: 0.9;
        }

        .btn-primary {
            background: #3478f6;
        }

        .btn-edit {
            background: #e0edff;
            color: #2457a7;
        }

        .btn-delete {
            background: #fee2e2;
            color: #b91c1c;
        }

        .toolbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            flex-wrap: wrap;
            margin-bottom: 20px;
        }

        .search {
            width: 100%;
            max-width: 350px;
            padding: 12px 15px;
            border: 1px solid #cbd5e1;
            border-radius: 9px;
            font-size: 14px;
            outline: none;
        }

        .search:focus {
            border-color: #3478f6;
            box-shadow: 0 0 0 3px #3478f620;
        }

        .count {
            color: #64748b;
            font-size: 14px;
        }

        .table-wrap {
            width: 100%;
            overflow-x: auto;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
        }

        table {
            width: 100%;
            min-width: 900px;
            border-collapse: collapse;
        }

        th, td {
            padding: 15px 14px;
            text-align: left;
            border-bottom: 1px solid #e8edf5;
        }

        th {
            background: #edf4ff;
            color: #203f87;
            font-size: 14px;
            white-space: nowrap;
        }

        td {
            font-size: 14px;
        }

        tbody tr:hover {
            background: #f8fbff;
        }

        .item-name {
            font-weight: bold;
            color: #1e3a8a;
        }

        .badge {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
            white-space: nowrap;
        }

        .stock-ok {
            background: #dcfce7;
            color: #166534;
        }

        .stock-low {
            background: #fee2e2;
            color: #b91c1c;
        }

        .actions {
            display: flex;
            align-items: center;
            gap: 7px;
        }

        .actions .btn {
            padding: 8px 11px;
            font-size: 12px;
        }

        .delete-form {
            margin: 0;
        }

        .empty {
            text-align: center;
            padding: 35px;
            color: #64748b;
        }

        .alert {
            padding: 14px 16px;
            background: #dcfce7;
            color: #166534;
            border: 1px solid #bbf7d0;
            border-radius: 9px;
            margin-bottom: 20px;
        }

        .back {
            display: inline-block;
            margin-top: 25px;
            color: #2457a7;
            text-decoration: none;
            font-weight: bold;
        }

        .back:hover {
            text-decoration: underline;
        }

        @media (max-width: 600px) {
            main {
                margin: 20px auto;
                padding: 0 12px;
            }

            .panel {
                padding: 18px;
            }

            header h1 {
                font-size: 25px;
            }

            .top h2 {
                font-size: 23px;
            }

            .search {
                max-width: none;
            }
        }
    </style>
</head>

<body>
    <header>
        <h1>📦 SmartInventory</h1>
        <p>Sistem Manajemen Toko dan Inventori</p>
    </header>

    <main>
        <section class="panel">
            <div class="top">
                <div>
                    <h2>Data Barang</h2>
                    <p class="subtitle">
                        Kelola data barang dan pantau stok toko dengan mudah.
                    </p>
                </div>

                <a href="{{ route('barang.create') }}" class="btn btn-primary">
                    + Tambah Barang
                </a>
            </div>

            @if (session('success'))
                <div class="alert">
                    ✅ {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert" style="background:#fee2e2;color:#991b1b;border-color:#fecaca">
                    Data belum berhasil diproses. Periksa kembali isian formulir.
                </div>
            @endif

            <div class="toolbar">
                <input
                    type="text"
                    id="searchBarang"
                    class="search"
                    placeholder="🔎 Cari nama atau kategori barang..."
                    aria-label="Cari barang"
                >

                <span class="count">
                    Total data: <strong id="totalBarang">{{ $barangs->count() }}</strong> barang
                </span>
            </div>

            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Kategori</th>
                            <th>Harga Beli</th>
                            <th>Harga Jual</th>
                            <th>Stok</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody id="tabelBarang">
                        @forelse ($barangs as $barang)
                            <tr class="baris-barang">
                                <td>{{ $loop->iteration }}</td>

                                <td>
                                    BRG-{{ str_pad($barang->id, 4, '0', STR_PAD_LEFT) }}
                                </td>

                                <td class="item-name">
                                    {{ $barang->nama_barang }}
                                </td>

                                <td>{{ $barang->kategori ?? '-' }}</td>

                                <td>
                                    Rp {{ number_format($barang->harga_beli ?? 0, 0, ',', '.') }}
                                </td>

                                <td>
                                    Rp {{ number_format($barang->harga_jual ?? 0, 0, ',', '.') }}
                                </td>

                                <td>{{ $barang->stok ?? 0 }}</td>

                                <td>
                                    @if (($barang->stok ?? 0) <= 5)
                                        <span class="badge stock-low">Stok Menipis</span>
                                    @else
                                        <span class="badge stock-ok">Stok Aman</span>
                                    @endif
                                </td>

                                <td>
                                    <div class="actions">
                                        <a
                                            href="{{ route('barang.edit', $barang->id) }}"
                                            class="btn btn-edit"
                                        >
                                            Edit
                                        </a>

                                        <form
                                            action="{{ route('barang.destroy', $barang->id) }}"
                                            method="POST"
                                            class="delete-form"
                                            onsubmit="return confirm('Yakin ingin menghapus barang ini?')"
                                        >
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-delete">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr id="barisKosong">
                                <td colspan="9" class="empty">
                                    <div style="font-size:35px;margin-bottom:10px">📦</div>
                                    <strong>Belum ada data barang</strong>
                                    <p>Tekan tombol Tambah Barang untuk memasukkan data pertama.</p>
                                </td>
                            </tr>
                        @endforelse

                        <tr id="hasilTidakAda" style="display:none">
                            <td colspan="9" class="empty">
                                Barang yang kamu cari tidak ditemukan.
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <a href="{{ url('/') }}" class="back">
                ← Kembali ke Dashboard
            </a>
        </section>
    </main>

    <script>
        const searchInput = document.getElementById('searchBarang');
        const rows = document.querySelectorAll('.baris-barang');
        const noResults = document.getElementById('hasilTidakAda');
        const totalBarang = document.getElementById('totalBarang');

        searchInput.addEventListener('input', function () {
            const keyword = this.value.toLowerCase().trim();
            let visibleCount = 0;

            rows.forEach(function (row) {
                const text = row.textContent.toLowerCase();
                const matches = text.includes(keyword);

                row.style.display = matches ? '' : 'none';

                if (matches) {
                    visibleCount++;
                }
            });

            totalBarang.textContent = visibleCount;

            if (noResults) {
                noResults.style.display =
                    rows.length > 0 && visibleCount === 0 ? '' : 'none';
            }
        });
    </script>
</body>
</html>
