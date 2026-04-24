<!DOCTYPE html>
<html>

<head>
    <title>Rekap Fakultas Gabungan</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
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

        h2,
        h3 {
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="card p-4">
        <h2>REKAP VIDEO PEMBELAJARAN DOSEN TETAP</h2>
        <h3>UNIVERSITAS TEKNOKRAT INDONESIA</h3>
        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Fakultas</th>
                    <th>Jumlah Dosen</th>
                    <th>Video Pembelajaran</th>
                    <th>Video MOOC</th>
                    <th>Proses Editing</th>
                    <th>Jumlah Video</th>
                </tr>
            </thead>
            <tbody>
                @php
                $fakultasDataTetap = [];
                foreach($progressTetap as $item) {
                $dosen = $item->jadwalBooking->dosen;
                $fakultas = $dosen->fakultas->nama_fakultas ?? 'Tidak Diketahui';
                $dosenId = $dosen->id;

                if (!isset($fakultasDataTetap[$fakultas])) {
                $fakultasDataTetap[$fakultas] = [
                'jumlah_dosen' => \App\Models\Dosen::where('fakultas_id', $dosen->fakultas_id)->count(),
                'pembelajaran' => 0,
                'mooc' => 0,
                'editing' => 0,
                'total' => 0
                ];
                }

                if($item->progres == 'selesai') {
                if(strtolower($item->jadwalBooking->jenis_kategori ?? '') === 'mooc') {
                $fakultasDataTetap[$fakultas]['mooc']++;
                } else {
                $fakultasDataTetap[$fakultas]['pembelajaran']++;
                }
                } elseif($item->progres == 'progres') {
                $fakultasDataTetap[$fakultas]['editing']++;
                }

                $fakultasDataTetap[$fakultas]['total']++;
                }

                $totalDosenTetap = 0;
                $totalPembelajaran = 0;
                $totalMooc = 0;
                $totalEditing = 0;
                $totalVideo = 0;
                @endphp

                @if(count($fakultasDataTetap) > 0)
                @foreach($fakultasDataTetap as $fakultas => $data)
                @php
                $totalDosenTetap += $data['jumlah_dosen'];
                $totalPembelajaran += $data['pembelajaran'];
                $totalMooc += $data['mooc'];
                $totalEditing += $data['editing'];
                $totalVideo += $data['total'];
                @endphp
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $fakultas }}</td>
                    <td>{{ $data['jumlah_dosen'] }}</td>
                    <td>{{ $data['pembelajaran'] }}</td>
                    <td>{{ $data['mooc'] }}</td>
                    <td>{{ $data['editing'] }}</td>
                    <td>{{ $data['total'] }}</td>
                </tr>
                @endforeach

                <tr class="fw-bold">
                    <td colspan="2">Jumlah</td>
                    <td>{{ $totalDosenTetap }}</td>
                    <td>{{ $totalPembelajaran }}</td>
                    <td>{{ $totalMooc }}</td>
                    <td>{{ $totalEditing }}</td>
                    <td>{{ $totalVideo }}</td>
                </tr>
                @else
                <tr>
                    <td colspan="7" class="text-center">Tidak ada data dosen tetap</td>
                </tr>
                @endif
            </tbody>
        </table>

        <h2>REKAP VIDEO PEMBELAJARAN DOSEN TIDAK TETAP</h2>
        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Fakultas</th>
                    <th>Jumlah Dosen</th>
                    <th>Video Pembelajaran</th>
                    <th>Video MOOC</th>
                    <th>Proses Editing</th>
                    <th>Jumlah Video</th>
                </tr>
            </thead>
            <tbody>
                @php
                $fakultasDataTidakTetap = [];
                foreach($progressTidakTetap as $item) {
                $dosen = $item->jadwalBooking->dosen;
                $fakultas = $dosen->fakultas->nama_fakultas ?? 'Tidak Diketahui';
                $dosenId = $dosen->id;

                if (!isset($fakultasDataTidakTetap[$fakultas])) {
                $fakultasDataTidakTetap[$fakultas] = [
                'jumlah_dosen' => \App\Models\Dosen::where('fakultas_id', $dosen->fakultas_id)->count(),
                'pembelajaran' => 0,
                'mooc' => 0,
                'editing' => 0,
                'total' => 0
                ];
                }

                if($item->progres == 'selesai') {
                if(strtolower($item->jadwalBooking->jenis_kategori ?? '') === 'mooc') {
                $fakultasDataTidakTetap[$fakultas]['mooc']++;
                } else {
                $fakultasDataTidakTetap[$fakultas]['pembelajaran']++;
                }
                } elseif($item->progres == 'progres') {
                $fakultasDataTidakTetap[$fakultas]['editing']++;
                }

                $fakultasDataTidakTetap[$fakultas]['total']++;
                }

                $totalDosenTidakTetap = 0;
                $totalPembelajaranTidakTetap = 0;
                $totalMoocTidakTetap = 0;
                $totalEditingTidakTetap = 0;
                $totalVideoTidakTetap = 0;
                @endphp

                @if(count($fakultasDataTidakTetap) > 0)
                @foreach($fakultasDataTidakTetap as $fakultas => $data)
                @php
                $totalDosenTidakTetap += $data['jumlah_dosen'];
                $totalPembelajaranTidakTetap += $data['pembelajaran'];
                $totalMoocTidakTetap += $data['mooc'];
                $totalEditingTidakTetap += $data['editing'];
                $totalVideoTidakTetap += $data['total'];
                @endphp
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $fakultas }}</td>
                    <td>{{ $data['jumlah_dosen'] }}</td>
                    <td>{{ $data['pembelajaran'] }}</td>
                    <td>{{ $data['mooc'] }}</td>
                    <td>{{ $data['editing'] }}</td>
                    <td>{{ $data['total'] }}</td>
                </tr>
                @endforeach

                <tr class="fw-bold">
                    <td colspan="2">Jumlah</td>
                    <td>{{ $totalDosenTidakTetap }}</td>
                    <td>{{ $totalPembelajaranTidakTetap }}</td>
                    <td>{{ $totalMoocTidakTetap }}</td>
                    <td>{{ $totalEditingTidakTetap }}</td>
                    <td>{{ $totalVideoTidakTetap }}</td>
                </tr>
                @else
                <tr>
                    <td colspan="7" class="text-center">Tidak ada data dosen tidak tetap</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</body>

</html>