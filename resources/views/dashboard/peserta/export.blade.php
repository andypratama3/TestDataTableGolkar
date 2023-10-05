
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Export</title>

</head>
<body>
    <table class="" id="">
        <thead class="thead-light">
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Nik</th>
                <th>Hp</th>
                <th>Tanggal Lahir</th>
                <th>Umur</th>
                <th>Alamat</th>
                <th>Kecamatan</th>
                <th>Desa</th>
                <th>Tps</th>
                <th>Warna</th>
                <th>Perekrut</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @php
            $no = 0;
            @endphp
            @foreach ($pesertas as $peserta)
            <tr>
                <td>{{ ++$no }}</td>
                <td>{{ $peserta->name }}</td>
                <td>{{ $peserta->nik }}</td>
                <td>{{ $peserta->hp }}</td>
                <td>{{ date('d-M-Y', strtotime($peserta->tgl_lahir)) }}</td>
                <td>{{ $peserta->umur }} Thn</td>
                <td>{{ $peserta->alamat }}</td>
                @foreach ($peserta->kecamatan_pesertas as $kecamatan)
                <td>{{ $kecamatan->name }}</td>
                @endforeach
                @foreach ($peserta->desa_pesertas as $desa)
                <td>{{ $desa->name }}</td>
                @endforeach
                @foreach ($peserta->tps_pesertas as $tps)
                <td>{{ $tps->name }}</td>
                @endforeach
                <td>{{ $peserta->warna }}</td>
                <td>{{ $peserta->perekrut }}</td>
                <td>{{ $peserta->status }}</td>

            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>

