<!DOCTYPE html>
<html>
<head>
    <title>Laporan Progress Editor</title>
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
    <h2 style="text-align: center;">LAPORAN PROGRESS EDITOR</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Dosen</th>
                <th>FAK</th>
                <th>Mata Kuliah / Tema</th>
                <th>Judul Course</th>
                <th>Lokasi</th>
                <th>Tanggal Shooting</th>
                <th>Jenis Shooting</th>
                <th>Target Upload</th>
                <th>Editor</th>
                <th>Progres</th>
                <th>Durasi (Menit)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($progress as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->jadwalBooking->dosen->nama_dosen ?? '-' }}</td>
                    <td>{{ $item->jadwalBooking->user->fakultas->nama_fakultas ?? '-' }}</td>
                    <td>{{ $item->jadwalBooking->nama_mata_kuliah ?? '-' }}</td>
                    <td>{{ $item->jadwalBooking->judul_course ?? '-' }}</td>
                    <td>{{ $item->jadwalBooking->studio->nama_studio ?? '-' }}</td>
                    <td>{{ $item->jadwalBooking->tanggal ? \Carbon\Carbon::parse($item->jadwalBooking->tanggal)->format('d F Y') : '-' }}</td>
                    <td>{{ $item->jadwalBooking->jenis_kategori ?? '-' }}</td>
                    <td>{{ $item->target_upload ? \Carbon\Carbon::parse($item->target_upload)->format('d F Y') : '-' }}</td>
                    <td>{{ $item->editor->nama ?? '-' }}</td>
                    <td>
                        @if($item->progres == 'Belum')
                            Belum
                        @elseif($item->progres == 'Progres')
                            Progres
                        @elseif($item->progres == 'Selesai')
                            Selesai
                        @else
                            {{ $item->progres }}
                        @endif
                    </td>
                    <td>{{ $item->durasi ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
