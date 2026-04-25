<!DOCTYPE html>
<html>

<head>
    <title>Rekap Video Pembelajaran Dosen</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
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

        h3 {
            margin-top: 20px;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <h2 style="text-align: center;">REKAP VIDEO PEMBELAJARAN DOSEN TETAP</h2>
    <h3 style="text-align: center;">UNIVERSITAS TEKNOKRAT INDONESIA</h3>

    @foreach($groupedByFakultas as $fakultas => $groupedByDosen)
    <h3>{{ $fakultas }}</h3>
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
            @php $no = 1; @endphp
            @foreach($groupedByDosen as $index => $data)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $data['dosen']->nuptk_dosen ?? '-' }}</td>
                <td>{{ $data['dosen']->nama_dosen ?? '-' }}</td>
                <td>{{ $data['progres_count'] }}</td>
                <td>{{ $data['elearning_count'] }}</td>
                <td>{{ $data['mooc_count'] }}</td>
                <td>{{ $data['total_video'] }}</td>
                <td>{{ $data['dosen']->target_video_dosen ?? '-' }}</td>
            </tr>
            @endforeach
            <tr style="font-weight: bold;">
                <td colspan="3">TOTAL</td>
                <td>{{ array_sum(array_column($groupedByDosen, 'progres_count')) }}</td>
                <td>{{ array_sum(array_column($groupedByDosen, 'elearning_count')) }}</td>
                <td>{{ array_sum(array_column($groupedByDosen, 'mooc_count')) }}</td>
                <td>{{ array_sum(array_column($groupedByDosen, 'total_video')) }}</td>
                <td></td>
            </tr>
        </tbody>
    </table>
    @endforeach
</body>

</html>