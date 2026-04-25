<!DOCTYPE html>
<html>

<head>
    <title>Rekap MOOC Dosen</title>
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
    <h2 style="text-align: center;">REKAPITULASI VIDEO DOSEN</h2>

    @php
    $groupedByFakultas = [];
    foreach ($progress as $item) {
    $dosen = $item->jadwalBooking->dosen ?? null;
    $dosenName = $dosen->nama_dosen ?? 'N/A';
    $fakultasName = $dosen->fakultas->nama_fakultas ?? 'Tidak Diketahui';

    if (!isset($groupedByFakultas[$fakultasName])) {
    $groupedByFakultas[$fakultasName] = [];
    }

    if (!isset($groupedByFakultas[$fakultasName][$dosenName])) {
    $groupedByFakultas[$fakultasName][$dosenName] = [
    'target' => $dosen->target_video_dosen ?? 0,
    'sudah' => 0,
    'proses' => 0,
    'belum' => 0,
    'terbit' => 0,
    'keterangan_shooting' => '-',
    'keterangan_video' => '-',
    ];
    }

    if ($item->jadwalBooking->status == 'sudah shooting') {
    $groupedByFakultas[$fakultasName][$dosenName]['sudah']++;
    }
    if ($item->progres == 'progres') {
    $groupedByFakultas[$fakultasName][$dosenName]['proses']++;
    }
    if ($item->jadwalBooking->status == 'approved') {
    $groupedByFakultas[$fakultasName][$dosenName]['belum']++;
    }
    if ($item->progres == 'selesai') {
    $groupedByFakultas[$fakultasName][$dosenName]['terbit']++;
    }

    if ($groupedByFakultas[$fakultasName][$dosenName]['target'] == $groupedByFakultas[$fakultasName][$dosenName]['sudah']) {
    $groupedByFakultas[$fakultasName][$dosenName]['keterangan_shooting'] = 'sudah shooting';
    } else {
    $groupedByFakultas[$fakultasName][$dosenName]['keterangan_shooting'] = 'belum selesai';
    }

    if ($groupedByFakultas[$fakultasName][$dosenName]['target'] == $groupedByFakultas[$fakultasName][$dosenName]['terbit']) {
    $groupedByFakultas[$fakultasName][$dosenName]['keterangan_video'] = 'selesai terbit';
    } else {
    $groupedByFakultas[$fakultasName][$dosenName]['keterangan_video'] = 'belum terbit';
    }
    }
    @endphp

    @foreach($groupedByFakultas as $fakultas => $groupedProgress)
    <h3>{{ $fakultas }}</h3>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Dosen</th>
                <th>Target Shooting</th>
                <th>Sudah Shooting</th>
                <th>Proses Edit</th>
                <th>Belum Shooting</th>
                <th>Sudah Terbit</th>
                <th>Keterangan Shooting</th>
                <th>Keterangan Video</th>
            </tr>
        </thead>
        <tbody>
            @foreach($groupedProgress as $dosen => $data)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $dosen }}</td>
                <td>{{ $data['target'] }}</td>
                <td>{{ $data['sudah'] }}</td>
                <td>{{ $data['proses'] }}</td>
                <td>{{ $data['belum'] }}</td>
                <td>{{ $data['terbit'] }}</td>
                <td>{{ $data['keterangan_shooting'] }}</td>
                <td>{{ $data['keterangan_video'] }}</td>
            </tr>
            @endforeach
            <tr style="font-weight: bold;">
                <td colspan="2">TOTAL</td>
                <td>{{ array_sum(array_column($groupedProgress, 'target')) }}</td>
                <td>{{ array_sum(array_column($groupedProgress, 'sudah')) }}</td>
                <td>{{ array_sum(array_column($groupedProgress, 'proses')) }}</td>
                <td>{{ array_sum(array_column($groupedProgress, 'belum')) }}</td>
                <td>{{ array_sum(array_column($groupedProgress, 'terbit')) }}</td>
                <td colspan="2"></td>
            </tr>
        </tbody>
    </table>
    @endforeach
</body>

</html>