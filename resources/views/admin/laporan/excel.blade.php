<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel"
    xmlns="http://www.w3.org/TR/REC-html40">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    @verbatim
        <!--[if gte mso 9]>
            <xml>
                <x:ExcelWorkbook>
                    <x:ExcelWorksheets>
                        <x:ExcelWorksheet>
                            <x:Name>Laporan SIMAKSI</x:Name>
                            <x:WorksheetOptions>
                                <x:DisplayGridlines/>
                            </x:WorksheetOptions>
                        </x:ExcelWorksheet>
                    </x:ExcelWorksheets>
                </x:ExcelWorkbook>
            </xml>
            <![endif]-->
    @endverbatim
    <style>
        table {
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #000000;
            padding: 5px;
        }

        .header {
            background-color: #eeeeee;
            font-weight: bold;
            text-align: center;
        }

        .center {
            text-align: center;
        }

        .top {
            vertical-align: top;
        }
    </style>
</head>

<body>
    <table>
        <thead>
            <tr>
                <th class="header" width="50">No</th>
                <th class="header" width="150">No Surat</th>
                <th class="header" width="200">Nama Pemohon</th>
                <th class="header" width="200">Email</th>
                <th class="header" width="150">Identitas (NIM/NIK)</th>
                <th class="header" width="150">No HP</th>
                <th class="header" width="150">Jabatan</th>
                <th class="header" width="200">Instansi</th>
                <th class="header" width="200">Jenis Kegiatan</th>
                <th class="header" width="100">Kewarganegaraan</th>
                <th class="header" width="120">Tanggal Mulai</th>
                <th class="header" width="120">Tanggal Selesai</th>
                <th class="header" width="200">Lokasi Kegiatan</th>
                <th class="header" width="300">Tujuan Kegiatan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pengajuans as $index => $pengajuan)
                <tr>
                    <td class="center top">{{ $index + 1 }}</td>
                    <td class="top">
                        {{ $pengajuan->approval ? ($pengajuan->approval->nomor_surat . '/' . $pengajuan->approval->kode_surat) : '-' }}
                    </td>
                    <td class="top">{{ $pengajuan->nama_pemohon }}</td>
                    <td class="top">{{ $pengajuan->user->email ?? '-' }}</td>
                    <td class="center top">{{ $pengajuan->identitas }}</td>
                    <td class="top">{{ $pengajuan->nomor_hp ?? '-' }}</td>
                    <td class="top">{{ $pengajuan->jabatan }}</td>
                    <td class="top">{{ $pengajuan->instansi }}</td>
                    <td class="top">{{ $pengajuan->jenisKegiatan->nama ?? '-' }}</td>
                    <td class="center top">{{ $pengajuan->kewarganegaraan }}</td>
                    <td class="center top">{{ \Carbon\Carbon::parse($pengajuan->tanggal_mulai)->format('d-m-Y') }}</td>
                    <td class="center top">{{ \Carbon\Carbon::parse($pengajuan->tanggal_selesai)->format('d-m-Y') }}</td>
                    <td class="top">{{ $pengajuan->lokasi }}</td>
                    <td class="top">{{ $pengajuan->tujuan }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>