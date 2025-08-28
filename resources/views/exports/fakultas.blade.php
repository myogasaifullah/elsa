<!DOCTYPE html>
<html>
<head>
    <title>Rekap Video Pembelajaran Dosen</title>
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
    <h2 style="text-align: center;">REKAP VIDEO PEMBELAJARAN DOSEN TETAP</h2>
    <h3 style="text-align: center;">FAKULTAS TEKNIK DAN ILMU KOMPUTER<br>UNIVERSITAS TEKNOKRAT INDONESIA</h3>
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
            @php
                // Group progress by dosen and count by jenis_kategori
                $groupedByDosen = [];
                foreach($progress as $item) {
                    $dosen = $item->jadwalBooking->dosen ?? null;
                    $jenisKategori = $item->jadwalBooking->jenis_kategori ?? null;
                    
                    if ($dosen) {
                        $dosenId = $dosen->id;
                        if (!isset($groupedByDosen[$dosenId])) {
                            $groupedByDosen[$dosenId] = [
                                'dosen' => $dosen,
                                'elearning_count' => 0,
                                'mooc_count' => 0,
                                'total_video' => 0,
                                'progres_count' => 0
                            ];
                        }
                        
                        // Count by category
                        if ($jenisKategori === 'E-learning') {
                            $groupedByDosen[$dosenId]['elearning_count']++;
                        } elseif ($jenisKategori === 'Mooc') {
                            $groupedByDosen[$dosenId]['mooc_count']++;
                        }
                        
                        // Count total videos
                        $groupedByDosen[$dosenId]['total_video']++;
                        
                        // Count progress
                        if ($item->progres === 'progres') {
                            $groupedByDosen[$dosenId]['progres_count']++;
                        }
                    }
                }
            @endphp
            
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
