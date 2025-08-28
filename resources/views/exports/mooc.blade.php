<!DOCTYPE html>
<html>
<head>
    <title>List Tautan Video Dosen MOOC</title>
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
    <h2 style="text-align: center;">LIST TAUTAN VIDEO DOSEN MOOC</h2>
    <table>
        <thead>
            <tr>
                @php
                    $colspan = 5; // jumlah kolom per fakultas
                @endphp

                @foreach($grouped as $fakultas => $items)
                    <th colspan="{{ $colspan }}">{{ $fakultas }}</th>
                @endforeach
            </tr>
            <tr>
                @foreach($grouped as $fakultas => $items)
                    <th>No</th>
                    <th>Nama Dosen</th>
                    <th>Kategori MOOC</th>
                    <th>Judul Course</th>
                    <th>Tautan Video</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @php
                $maxRows = $grouped->map->count()->max();
            @endphp

            @for ($i = 0; $i < $maxRows; $i++)
                <tr>
                    @foreach($grouped as $fakultas => $items)
                        @php $item = $items[$i] ?? null; @endphp
                        <td>{{ $item ? $i+1 : '-' }}</td>
                        <td>{{ $item->jadwalBooking->dosen->nama_dosen ?? '-' }}</td>
                        <td>{{ $item->jadwalBooking->kategori_mooc ?? '-' }}</td>
                        <td>{{ $item->jadwalBooking->judul_course ?? '-' }}</td>
                        <td>
                            @if($item && !empty($item->publish_link_youtube))
                                {{ $item->publish_link_youtube }}
                            @else
                                -
                            @endif
                        </td>
                    @endforeach
                </tr>
            @endfor
