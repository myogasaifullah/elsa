<!DOCTYPE html>
<html>
<head>
    <title>Laporan Dosen MOOC</title>
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
    <h2 style="text-align: center;">UNIVERSITAS TEKNOKRAT INDONESIA</h2>
    <h3 style="text-align: center;">SEMESTER GANJIL 2024/2025<br>DOSEN MOOC</h3>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Dosen</th>
                <th>Judul Video MOOC</th>
                <th>Link Video YouTube</th>
                <th>Durasi</th>
                <th>Tanggal Upload YouTube</th>
            </tr>
        </thead>
        <tbody>
            @foreach($progress as $index => $item)
                @if($item->jadwalBooking && 
                    $item->jadwalBooking->judul_course && 
                    $item->progres === 'selesai' && 
                    $item->jadwalBooking->jenis_kategori === 'Mooc')
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->jadwalBooking->dosen->nama_dosen ?? '-' }}</td>
                        <td>{{ $item->jadwalBooking->judul_course ?? '-' }}</td>
                        <td>
                            @if($item->publish_link_youtube)
                                {{ $item->publish_link_youtube }}
                            @else
                                -
                            @endif
                        </td>
                        <td>{{ $item->durasi ?? '-' }}</td>
                        <td>{{ $item->tanggal_upload_youtube ? \Carbon\Carbon::parse($item->tanggal_upload_youtube)->format('d M Y') : '-' }}</td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
</body>
</html>
