<!DOCTYPE html>
<html>
<head>
    <title>Rekapitulasi Shooting MOOC Dosen</title>
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
    <h2 style="text-align: center;">REKAPITULASI SHOOTING MOOC DOSEN</h2>
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
            @php
                $groupedProgress = [];
                foreach ($progress as $item) {
                    $dosenName = $item->jadwalBooking->dosen->nama_dosen ?? 'N/A';
                    if (!isset($groupedProgress[$dosenName])) {
                        $groupedProgress[$dosenName] = [
                            'target' => $item->jadwalBooking->dosen->target_video_dosen ?? 0,
                            'sudah' => 0,
                            'proses' => 0,
                            'belum' => 0,
                            'terbit' => 0,
                            'keterangan_shooting' => '-',
                            'keterangan_video' => '-',
                        ];
                    }
                    
                    // Hitung jumlah target, sudah shooting, dan sudah terbit
                    if ($item->jadwalBooking->status == 'sudah shooting') {
                        $groupedProgress[$dosenName]['sudah']++;
                    }
                    if ($item->progres == 'progres') {
                        $groupedProgress[$dosenName]['proses']++;
                    }
                    if ($item->jadwalBooking->status == 'belum shooting') {
                        $groupedProgress[$dosenName]['belum']++;
                    }
                    if ($item->progres == 'selesai') {
                        $groupedProgress[$dosenName]['terbit']++;
                    }
                    
                    // Tentukan keterangan shooting
                    if ($groupedProgress[$dosenName]['target'] == $groupedProgress[$dosenName]['sudah']) {
                        $groupedProgress[$dosenName]['keterangan_shooting'] = 'sudah shooting';
                    } else {
                        $groupedProgress[$dosenName]['keterangan_shooting'] = 'belum selesai';
                    }
                    
                    // Tentukan keterangan video
                    if ($groupedProgress[$dosenName]['target'] == $groupedProgress[$dosenName]['terbit']) {
                        $groupedProgress[$dosenName]['keterangan_video'] = 'selesai terbit';
                    } else {
                        $groupedProgress[$dosenName]['keterangan_video'] = 'belum terbit';
                    }
                }
            @endphp
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
            <tr>
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
</body>
</html>
