<!DOCTYPE html>
<html>

<head>
    <title>Laporan MOOC</title>
    <style>
        @page {
            margin: 20mm;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 10pt;
            color: #000;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        h4 {
            margin-top: 20px;
            margin-bottom: 8px;
            font-size: 11pt;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }

        table,
        th,
        td {
            border: 1px solid #333;
        }

        th,
        td {
            padding: 5px 6px;
            text-align: left;
            vertical-align: top;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
            text-align: center;
        }

        .text-center {
            text-align: center;
        }

        .no-data {
            text-align: center;
            font-style: italic;
            color: #666;
        }

        a {
            color: #000;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <h2>LAPORAN MOOC</h2>

    @forelse($grouped as $fakultas => $progressItems)
    <h4>{{ $fakultas }}</h4>
    <table>
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 25%;">Nama Dosen</th>
                <th style="width: 20%;">Kategori Mooc</th>
                <th style="width: 25%;">Judul Course</th>
                <th style="width: 25%;">Tautan Video</th>
            </tr>
        </thead>
        <tbody>
            @forelse($progressItems as $index => $item)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $item->jadwalBooking->dosen->nama_dosen ?? '-' }}</td>
                <td>{{ $item->jadwalBooking->kategori_mooc ?? '-' }}</td>
                <td>{{ $item->jadwalBooking->judul_course ?? '-' }}</td>
                <td>
                    @if($item->publish_link_youtube)
                    <a href="{{ $item->publish_link_youtube }}">{{ $item->publish_link_youtube }}</a>
                    @else
                    -
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="no-data">Tidak ada data MOOC dengan tautan video yang ditemukan.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    @empty
    <p class="no-data">Tidak ada data MOOC dengan tautan video yang ditemukan.</p>
    @endforelse
</body>

</html>