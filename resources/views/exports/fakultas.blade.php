<!DOCTYPE html>
<html>

<head>
    <title>Rekap Video Pembelajaran Dosen</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <h2 style="text-align: center;">REKAP VIDEO PEMBELAJARAN DOSEN TETAP</h2>
    <h3 style="text-align: center;"></h3>
    <table>
        <thead>
            <tr>
                <th rowspan="2">No.</th>
                <th rowspan="2">NUPTK</th>
                <th rowspan="2">Nama Dosen</th>
                <th rowspan="2">Prog Edit</th>
                <th colspan="2">Jumlah Video</th>
                <th rowspan="2">Total</th>
                <th rowspan="2">Target</th>
            </tr>
            <tr>
                <th>Pembelajaran</th>
                <th>MOOC</th>
            </tr>
        </thead>
        <tbody>
            @foreach($groupedByDosen as $index => $data)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $data['dosen']->nuptk_dosen ?? '-' }}</td>
                <td>{{ $data['dosen']->nama_dosen ?? '-' }}</td>
                <td>{{ $data['progres_count'] }}</td>
                <td>{{ $data['elearning_count'] }}</td>
                <td>{{ $data['mooc_count'] }}</td>
                <td>{{ $data['total_video'] }}</td>
                <td>{{ $data['dosen']->target_video_dosen ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>