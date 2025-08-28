<!DOCTYPE html>
<html>
<head>
    <title>Laporan Jadwal Booking</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2 style="text-align: center;">LAPORAN JADWAL BOOKING</h2>
    <h3 style="text-align: center;">UNIVERSITAS TEKNOKRAT INDONESIA</h3>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Dosen</th>
                <th>Judul Course</th>
                <th>Jenis Kategori</th>
                <th>Waktu</th>
                <th>Studio</th>
            </tr>
        </thead>
        <tbody>
            @foreach($jadwal as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->dosen->nama_dosen ?? '-' }}</td>
                    <td>{{ $item->judul_course ?? '-' }}</td>
                    <td>{{ $item->jenis_kategori ?? '-' }}</td>
                    <td>{{ $item->jam ?? '-' }}</td>
                    <td>{{ $item->studio->nama_studio ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
