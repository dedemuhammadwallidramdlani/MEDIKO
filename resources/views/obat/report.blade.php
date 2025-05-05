<!DOCTYPE html>
<html>
<head>
    <title>Laporan Data Obat - PDF</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #ddd; padding: 6px; text-align: left; }
        th { background-color: #f2f2f2; }
        .header { text-align: center; margin-bottom: 15px; }
        .title { font-size: 16px; font-weight: bold; }
        .date { font-size: 10px; color: #555; }
        .footer { font-size: 10px; text-align: right; margin-top: 20px; }
    </style>
</head>
<body>
    <div class="header">
        <div class="title">LAPORAN DATA OBAT</div>
        <div class="date">Dicetak pada: {{ date('d F Y H:i:s') }}</div>
    </div>
    
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Obat</th>
                <th>Deskripsi</th>
                <th>Stok</th>
                <th>Harga</th>
            </tr>
        </thead>
        <tbody>
            @foreach($dataobat as $index => $obat)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $obat->nama_obat }}</td>
                <td>{{ $obat->deskripsi }}</td>
                <td>{{ $obat->stok }}</td>
                <td>Rp {{ number_format($obat->harga, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Dicetak oleh: {{ Auth::user()->name }}<br>
        Aplikasi Manajemen Obat
    </div>
</body>
</html>