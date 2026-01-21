<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Bukti Peminjaman Alat</title>
    <style>
        body {
            font-family: DejaVu Sans, Arial, sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .header {
            text-align: center;
            border-bottom: 3px solid #4CAF50;
            padding: 10px 0;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
            color: #4CAF50;
        }

        .header p {
            margin: 2px 0;
            font-size: 14px;
            color: #555;
        }

        .content {
            padding: 20px;
        }

        .info {
            margin-bottom: 20px;
        }

        .info p {
            margin: 5px 0;
            font-size: 14px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table, th, td {
            border: 1px solid #888;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #4CAF50;
            color: #fff;
        }

        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 12px;
            color: #777;
        }

        .signature {
            margin-top: 50px;
            display: flex;
            justify-content: space-between;
        }

        .signature div {
            width: 40%;
            text-align: center;
        }

        .signature-line {
            margin-top: 50px;
            border-top: 1px solid #000;
            width: 100%;
        }
    </style>
</head>
<body>

<div class="header">
    <h1>PT. Safety First</h1>
    <p>Jl. Industri No.123, Jakarta</p>
    <p>Bukti Peminjaman Alat Safety</p>
</div>

<div class="content">
    <div class="info">
        <p><strong>Nama Pengaju:</strong> {{ $peminjaman->user->name }}</p>
        <p><strong>Jabatan:</strong> {{ $peminjaman->user->role }}</p>
        <p><strong>Tanggal Pengajuan:</strong> {{ $peminjaman->created_at->format('d-m-Y H:i') }}</p>
        <p><strong>Status:</strong> {{ ucfirst($peminjaman->status) }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Alat</th>
                <th>Jumlah</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>{{ $peminjaman->alat->nama_alat }}</td>
                <td>{{ $peminjaman->jumlah }}</td>
                <td>{{ $peminjaman->tgl_pinjam ?? '-' }}</td>
                <td>{{ $peminjaman->tgl_kembali ?? '-' }}</td>
            </tr>
        </tbody>
    </table>
</div>

<div class="footer">
    <p>Dokumen ini dicetak secara elektronik dan sah tanpa tanda tangan basah</p>
</div>

</body>
</html>
