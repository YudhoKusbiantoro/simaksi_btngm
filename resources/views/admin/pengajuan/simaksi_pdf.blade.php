<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>SIMAKSI - {{ $approval->nomor_surat }}</title>
    <style>
        @page {
            size: A4;
            margin: 1cm 1.5cm 1cm 1.5cm;
        }

        body {
            font-family: 'Arial', sans-serif;
            font-size: 9pt;
            line-height: 1.2;
            color: #000;
            margin: 0;
            padding: 0;
        }

        /* Container for each page */
        .page-container {
            width: 100%;
            position: relative;
            page-break-after: always;
            clear: both;
        }

        .page-container:last-child {
            page-break-after: avoid;
        }

        .header {
            text-align: center;
            position: relative;
            margin-bottom: 5px;
            padding-bottom: 5px;
            border-bottom: 2px solid #000;
        }

        .header img.logo {
            position: absolute;
            left: 0;
            top: 0;
            width: 60px;
        }

        .header .agency-name {
            font-weight: bold;
            font-size: 11pt;
            margin: 0;
        }

        .header .sub-agency {
            font-weight: bold;
            font-size: 9.5pt;
            margin: 0;
            text-transform: uppercase;
        }

        .header .office-name {
            font-weight: bold;
            font-size: 13pt;
            margin: 0;
            text-transform: uppercase;
        }

        .header .address {
            font-size: 8pt;
            margin: 1px 0 0 0;
        }

        .title-box {
            text-align: center;
            margin: 10px 0;
        }

        .title-box h3 {
            text-decoration: underline;
            margin: 0;
            font-size: 10.5pt;
            text-transform: uppercase;
        }

        .title-box p {
            margin: 0;
            font-size: 10pt;
        }

        .content-section {
            margin-bottom: 8px;
        }

        .table-full {
            width: 100%;
            border-collapse: collapse;
        }

        .table-full td {
            vertical-align: top;
            padding: 1px 0;
        }

        .label-wide {
            width: 110px;
        }

        .colon {
            width: 15px;
            text-align: center;
        }

        .signature-table {
            width: 100%;
            margin-top: 10px;
            border-collapse: collapse;
        }

        .signature-table td {
            width: 50%;
            vertical-align: top;
            text-align: center;
        }


        .signature-box {
            text-align: center;
            font-size: 9.5pt;
        }

        .signature-space {
            height: 50px;
        }

        .lampiran-header {
            text-align: center;
            margin-bottom: 15px;
            border-bottom: 1px solid #000;
            padding-bottom: 5px;
        }

        .lampiran-header p {
            margin: 0;
            font-size: 9.5pt;
            font-weight: bold;
        }

        .table-peserta {
            width: 100%;
            border-collapse: collapse;
            font-size: 9pt;
            margin-top: 10px;
        }

        .table-peserta th,
        .table-peserta td {
            border: 1px solid #000;
            padding: 5px;
            text-align: left;
        }

        .table-peserta th {
            text-align: center;
            background-color: #f2f2f2;
        }

        .laporan-table {
            width: 100%;
            border-collapse: collapse;
        }

        .laporan-table th,
        .laporan-table td {
            border: 1px solid #000;
            padding: 8px;
            vertical-align: top;
        }

        .laporan-label {
            width: 30px;
            text-align: center;
        }

        .laporan-title {
            width: 160px;
        }

        .list-ketentuan li {
            margin-bottom: 12px;
            line-height: 1.5;
            text-align: justify;
        }
    </style>
</head>

<body>
    <div class="page-container">
        <!-- PAGE 1: MAIN SIMAKSI -->
        <div class="header">
            <img src="{{ public_path('images/logo-kementerian.png') }}" class="logo" alt="Logo">
            <p class="agency-name">KEMENTERIAN KEHUTANAN</p>
            <p class="sub-agency">DIREKTORAT JENDERAL KONSERVASI SUMBER DAYA ALAM DAN EKOSISTEM</p>
            <p class="office-name">BALAI TAMAN NASIONAL GUNUNG MERAPI</p>
            <p class="address">Jl. Kaliurang Km 22,6 Hargobinangun Pakem Sleman, D.I.Yogyakarta Telp./Fax (0274)
                4478664/4478665</p>
        </div>

        <div class="title-box">
            <h3>SURAT IZIN MASUK KAWASAN KONSERVASI (SIMAKSI)</h3>
            <p>Nomor : {{ $approval->nomor_surat }}</p>
        </div>

        <div class="content-section">
            <table class="table-full">
                <tr>
                    <td style="width: 55px;">1. Dasar :</td>
                    <td style="width: 20px;">a.</td>
                    <td>Peraturan Pemerintah (PP) No. 36 Tahun 2024 Tentang Jenis dan Tarif Penerimaan Negara Bukan
                        Pajak yang Berlaku Pada Kementerian Kehutanan;</td>
                </tr>
                <tr>
                    <td></td>
                    <td>b.</td>
                    <td>Peraturan Menteri Kehutanan Republik Indonesia No. 12 Tahun 2025 tentang Persyaratan dan Tata
                        Cara Pengenaan Tarif atas Jenis Penerimaan Negara Bukan Pajak Bidang Konservasi Sumber Daya Alam
                        dan Ekosistem;</td>
                </tr>
                <tr>
                    <td></td>
                    <td>c.</td>
                    <td>Peraturan Menteri Kehutanan Republik Indonesia Nomor: P.38/Menhut-II/2014 Tentang Tata Cara dan
                        Persyaratan kegiatan Tertentu Pengenaan Tarif RP.0,00 (0 Rupiah) di KSA, KPA, Taman Buru dan
                        Hutan Alam;</td>
                </tr>
                <tr>
                    <td></td>
                    <td>d.</td>
                    <td>Peraturan Direktur Jenderal PHKA Nomor : P. 7/IV-SET/2011 tanggal 9 Desember 2011 Tentang Tata
                        Cara Masuk KSA, KPA dan Taman Buru;</td>
                </tr>
                <tr>
                    <td></td>
                    <td>e.</td>
                    <td>{{ $approval->keterangan_surat_pengantar }}</td>
                </tr>
            </table>
        </div>

        <div class="content-section" style="margin-top: 5px;">
            <p style="margin-bottom: 2px;">2. Dengan ini memberikan ijin masuk kawasan konservasi kepada :</p>
            <table class="table-full" style="margin-left: 15px; width: calc(100% - 15px);">
                <tr>
                    <td class="label-wide">Nama</td>
                    <td class="colon">:</td>
                    <td>{{ $pengajuan->nama_pemohon }}, dkk</td>
                </tr>
                <tr>
                    <td class="label-wide">No. Identitas (NIM/NIK)</td>
                    <td class="colon">:</td>
                    <td>{{ $pengajuan->identitas }}</td>
                </tr>
                <tr>
                    <td class="label-wide">Jabatan</td>
                    <td class="colon">:</td>
                    <td>{{ $pengajuan->jabatan }}</td>
                </tr>
                <tr>
                    <td class="label-wide">Kelompok</td>
                    <td class="colon">:</td>
                    <td>{{ $pengajuan->instansi }}</td>
                </tr>
                <tr>
                    <td class="label-wide">Tujuan</td>
                    <td class="colon">:</td>
                    <td>{{ $pengajuan->tujuan }}</td>
                </tr>
                <tr>
                    <td class="label-wide">Lokasi</td>
                    <td class="colon">:</td>
                    <td>{{ $pengajuan->lokasi }}</td>
                </tr>
                <tr>
                    <td class="label-wide">Waktu</td>
                    <td class="colon">:</td>
                    <td>{{ \Carbon\Carbon::parse($pengajuan->tanggal_mulai)->translatedFormat('d F Y') }} s.d
                        {{ \Carbon\Carbon::parse($pengajuan->tanggal_selesai)->translatedFormat('d F Y') }}
                    </td>
                </tr>
                <tr>
                    <td class="label-wide">Peserta</td>
                    <td class="colon">:</td>
                    <td>{{ $pengajuan->anggotas->count() + 1 }} Orang (Termasuk Penanggung Jawab)</td>
                </tr>
                <tr>
                    <td class="label-wide">Tarif PNBP</td>
                    <td class="colon">:</td>
                    <td>Rp. {{ number_format($approval->tarif_pnbp, 0, ',', '.') }},-</td>
                </tr>
                <tr>
                    <td class="label-wide">Catatan</td>
                    <td class="colon">:</td>
                    <td><strong>{{ $approval->catatan_admin }}</strong></td>
                </tr>
            </table>
        </div>

        <div class="content-section">
            <p style="margin-bottom: 2px;">3. Dengan ketentuan :</p>
            <table class="table-full" style="margin-left: 15px; width: calc(100% - 15px);">
                <tr>
                    <td style="width: 20px;">a.</td>
                    <td>Sebelum memasuki lokasi Kawasan Taman Nasional Gunung Merapi wajib melapor kepada Petugas Resor
                        Pengelolaan TN wilayah setempat;</td>
                </tr>
                <tr>
                    <td>b.</td>
                    <td>Selama memasuki kawasan TN Gunung Merapi, dapat didampingi petugas dari Balai TNGM;</td>
                </tr>
                <tr>
                    <td>c.</td>
                    <td>Jika Kegiatan dilaksanakan di Radius 5 (lima) Kilometer dari Merapi, berkoordinasi dengan
                        BPPTKG;</td>
                </tr>
                <tr>
                    <td>d.</td>
                    <td>Segala resiko yang terjadi and timbul menjadi tanggung jawab pemegang ijin;</td>
                </tr>
                <tr>
                    <td>e.</td>
                    <td>Ijin ini tidak disalahgunakan untuk tujuan yang dapat mengganggu kestabilan Pemerintah;</td>
                </tr>
                <tr>
                    <td>f.</td>
                    <td>Bersedia Mematuhi semua peraturan perundangan yang berlaku;</td>
                </tr>
                <tr>
                    <td>g.</td>
                    <td>Wajib memberikan laporan hasil kegiatan, paling lambat 14 hari setelah kegiatan selesai;</td>
                </tr>
                <tr>
                    <td>h.</td>
                    <td>Wajib menyerahkan laporan hasil penelitian / kegiatan ke tngm_jogja@yahoo.com;</td>
                </tr>
                <tr>
                    <td>i.</td>
                    <td>Dokumentasi yang dipublikasikan wajib mencantumkan logo Kementerian Kehutanan / Balai TNGM;</td>
                </tr>
                <tr>
                    <td>j.</td>
                    <td>Simaksi ini berlaku setelah pemegang ijin membubuhkan tanda tangan di atas materai Rp. 10.000,-.
                    </td>
                </tr>
            </table>
        </div>

        <p style="margin-top: 2px;">Demikian surat ijin ini dibuat untuk digunakan sebagaimana mestinya.</p>

        <table class="signature-table" style="margin-top:20px;">
            <tr>

                <!-- KOLOM KIRI -->
                <td style="width:50%; vertical-align: top; text-align: left; padding-left: 60px;">

                    <div style="height:42px;"></div>

                    <p style="margin:0 0 0 25px;">Pemegang Simaksi</p>

                    <div style="
                        border:1px dashed #ccc;
                        width:80px;
                        height:40px;
                        margin:10px 0 10px -30px;
                        line-height:40px;
                        font-size:8pt;
                        text-align:center;">
                        MATERAI
                    </div>

                    <div style="text-align:center; margin-top:5px; margin-left:-100px;">
                        <strong>{{ $pengajuan->nama_pemohon }}</strong><br>
                        {{ $pengajuan->jabatan }}
                    </div>

                </td>

                <!-- KOLOM KANAN -->
                <td style="width:50%; vertical-align: top; text-align: center;">

                    <p style="margin:0;">Dikeluarkan di : Sleman</p>

                    <p style="margin:0;">Pada tanggal : {{ $tanggal_cetak }}</p>

                    <div style="margin-top:10px;">
                        <p style="margin:0;">A.n Kepala Balai</p>
                        <p style="margin:0;">Kepala Sub Bagian TU</p>
                    </div>

                    <div style="height:50px;"></div>

                    <strong>{{ $kasubagNama }}</strong><br>
                    NIP. {{ $kasubagNip }}

                </td>

            </tr>
        </table>


        <div class="tembusan-section" style="font-size: 8pt; margin-top: 5px;">
            <p style="margin: 0;"><strong>Tembusan :</strong></p>
            <div style="margin-left: 10px; line-height: 1.1;">
                {!! nl2br(e($approval->tembusan)) !!}
            </div>
        </div>
    </div>

    <div class="page-container">
        <!-- PAGE 2: LAMPIRAN 1 (DAFTAR PESERTA) -->
        <div class="lampiran-header">
            <p>Lampiran 1</p>
            <p>Surat Ijin Masuk Kawasan Konservasi (SIMAKSI)</p>
            <p>Balai Taman Nasional Gunung Merapi</p>
            <p>Nomor : {{ $approval->nomor_surat }}</p>
            <p>Tanggal : {{ $tanggal_cetak }}</p>
        </div>

        <h4 style="text-align: center; text-decoration: underline; margin-bottom: 10px;">Daftar Anggota</h4>

        <table class="table-peserta">
            <thead>
                <tr>
                    <th style="width: 30px;">No</th>
                    <th style="width: 200px;">Nama</th>
                    <th style="width: 150px;">No Identitas</th>
                    <th>Tema/ Judul Magang</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="text-align: center;">1</td>
                    <td>{{ $pengajuan->nama_pemohon }}</td>
                    <td>{{ $pengajuan->identitas }}</td>
                    <td>{{ $pengajuan->tujuan }}</td>
                </tr>
                @foreach($pengajuan->anggotas as $index => $agt)
                    <tr>
                        <td style="text-align: center;">{{ $index + 2 }}</td>
                        <td>{{ $agt->nama }}</td>
                        <td>{{ $agt->identitas }}</td>
                        <td>{{ $pengajuan->tujuan }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <table class="signature-table" style="margin-top: 30px;">
            <tr>
                <td></td>
                <td>
                    <div class="signature-box">
                        <p>Kepala Sub Bagian TU</p>
                        <div class="signature-space"></div>
                        <div>
                            <strong>{{ $kasubagNama }}</strong><br>
                            NIP. {{ $kasubagNip }}
                        </div>
                    </div>
                </td>
            </tr>
        </table>
    </div>

    <div class="page-container">
        <!-- PAGE 3: LAMPIRAN 2 (KETENTUAN UMUM) -->
        <div class="lampiran-header">
            <p>Lampiran 2</p>
            <p>Surat Ijin Masuk Kawasan Konservasi (SIMAKSI)</p>
            <p>Balai Taman Nasional Gunung Merapi</p>
            <p>Nomor : {{ $approval->nomor_surat }}</p>
            <p>Tanggal : {{ $tanggal_cetak }}</p>
        </div>

        <h4 style="text-align: center; text-decoration: underline; margin-bottom: 20px;">Ketentuan Umum Masuk Kawasan
            Konservasi :</h4>

        <div class="list-ketentuan" style="font-size: 9pt;">
            <ol>
                <li>Dilarang merusak, membunuh, melukai tumbuhan dan satwa liar dan habitatnya di dalam kawasan taman
                    nasional.</li>
                <li>Dilarang melakukan pengrusakan terhadap habitat tumbuhan dan satwa liar.</li>
                <li>Dilarang mengambil / membawa specimen dari tumbuhan dan satwa liar dan bagian - bagiannya di dalam
                    kawasan taman nasional ke luar dari kawasan taman nasional kecuali dengan ijin khusus.</li>
                <li>Dilarang membawa senjata tajam, senjata api atau alat lainnya yang dapat menimbulkan gangguan dan
                    kerusakan terhadap jenis tumbuhan dan satwa liar serta habitatnya di dalam kawasan taman nasional.
                </li>
                <li>Dokumentasi kegiatan yang dipublikasikan wajib mencantumkan logo dan nama Kementerian Kehutanan /
                    Balai
                    Taman Nasional Gunung Merapi.</li>
                <li>Dilarang membuang sampah sembarangan.</li>
                <li>Dilarang membuat kegiatan yang membuat gaduh.</li>
                <li>Dilarang membuat api dan api unggun.</li>
                <li>Menaati dan menghormati adat istiadat setempat/lokal.</li>
                <li>Dilarang merusak sarana dan prasarana yang ada di Taman Nasional Gunung Merapi.</li>
                <li>Penggunaan / pemanfaatan sarana prasarana (bangunan dan lain-lain) untuk kegiatan harus mendapat
                    ijin
                    dari pengelola Taman Nasional Gunung Merapi.</li>
                <li>Menaati petunjuk dari Petugas dan atau Pendamping dari Balai Taman Nasional Gunung Merapi.</li>
            </ol>
        </div>

        <table class="signature-table" style="margin-top: 30px;">
            <tr>
                <td></td>
                <td>
                    <div class="signature-box">
                        <p>Kepala Sub Bagian TU</p>
                        <div class="signature-space"></div>
                        <div>
                            <strong>{{ $kasubagNama }}</strong><br>
                            NIP. {{ $kasubagNip }}
                        </div>
                    </div>
                </td>
            </tr>
        </table>
    </div>

    <div class="page-container">
        <!-- PAGE 4: LAMPIRAN 3 (LAPORAN HASIL KEGIATAN) -->
        <div class="lampiran-header">
            <p>Lampiran 3</p>
            <p>Surat Ijin Masuk Kawasan Konservasi (SIMAKSI)</p>
            <p>Balai Taman Nasional Gunung Merapi</p>
            <p>Nomor : {{ $approval->nomor_surat }}</p>
            <p>Tanggal : {{ $tanggal_cetak }}</p>
        </div>

        <h4 style="text-align: center; text-decoration: underline; margin-bottom: 10px;">LAPORAN HASIL KEGIATAN</h4>

        <table class="laporan-table">
            <tr>
                <td class="laporan-label">I</td>
                <td class="laporan-title">Nama</td>
                <td>:</td>
            </tr>
            <tr>
                <td></td>
                <td class="laporan-title">Pemegang</td>
                <td>:</td>
            </tr>
            <tr>
                <td></td>
                <td class="laporan-title">Nomor SIMAKSI</td>
                <td>:</td>
            </tr>
            <tr>
                <td></td>
                <td class="laporan-title">Tanggal</td>
                <td>:</td>
            </tr>
            <tr>
                <td></td>
                <td class="laporan-title">Asal/Alamat</td>
                <td>:</td>
            </tr>
            <tr>
                <td class="laporan-label">II</td>
                <td colspan="2">Uraian Singkat Kegiatan :<br><br><br><br><br><br></td>
            </tr>
            <tr>
                <td class="laporan-label">III</td>
                <td colspan="2">Kendala/Permasalahan dalam Kegiatan :<br><br><br></td>
            </tr>
            <tr>
                <td class="laporan-label">IV</td>
                <td colspan="2">Saran kepada Pemangku Kawasan :<br><br><br></td>
            </tr>
            <tr>
                <td class="laporan-label">V</td>
                <td colspan="2">Akan menyerahkan Laporan Kegiatan beserta dokumentasi dalam bentuk Softcopy and Hardcopy
                    pada tanggal :<br><br></td>
            </tr>
        </table>

        <table class="signature-table" style="margin-top: 20px;">
            <tr>
                <td></td>
                <td>
                    <div class="signature-box" style="float: right; margin-right: 50px;">
                        <p>Yogyakarta, .............................</p>
                        <p>Pemegang SIMAKSI</p>
                        <div class="signature-space"></div>
                        <div>
                            ..........................................
                        </div>
                    </div>
                </td>
            </tr>
        </table>
    </div>

    <div class="page-container">
        <!-- PAGE 5: LAMPIRAN 4 (LEMBAR ISIAN PETUGAS PENDAMPING) -->
        <div class="lampiran-header">
            <p>Lampiran 4</p>
            <p>Surat Ijin Masuk Kawasan Konservasi (SIMAKSI)</p>
            <p>Balai Taman Nasional Gunung Merapi</p>
            <p>Nomor : {{ $approval->nomor_surat }}</p>
            <p>Tanggal : {{ $tanggal_cetak }}</p>
        </div>

        <h4 style="text-align: center; text-decoration: underline; margin-bottom: 15px;">Lembar Isian Petugas Pendamping
        </h4>

        <table class="laporan-table">
            <tr>
                <td class="laporan-label" style="width: 30px;">I</td>
                <td style="width: 160px;">Nama Petugas</td>
                <td style="width: 15px;">:</td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td>NIP</td>
                <td>:</td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td>Pangkat / Gol.</td>
                <td>:</td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td>Jabatan</td>
                <td>:</td>
                <td></td>
            </tr>
            <tr>
                <td class="laporan-label" style="vertical-align: top;">II</td>
                <td colspan="3">Telah melaksanakan pendampingan kegiatan kepada :</td>
            </tr>
            <tr>
                <td></td>
                <td>Nama</td>
                <td>:</td>
                <td>{{ $pengajuan->nama_pemohon }}, dkk</td>
            </tr>
            <tr>
                <td></td>
                <td>Nomor SIMAKSI</td>
                <td>:</td>
                <td>{{ $approval->nomor_surat }}</td>
            </tr>
            <tr>
                <td></td>
                <td>Asal / Alamat</td>
                <td>:</td>
                <td>{{ $pengajuan->instansi }}</td>
            </tr>
            <tr>
                <td></td>
                <td>Tanggal</td>
                <td>:</td>
                <td>{{ \Carbon\Carbon::parse($pengajuan->tanggal_mulai)->translatedFormat('d F Y') }} s.d
                    {{ \Carbon\Carbon::parse($pengajuan->tanggal_selesai)->translatedFormat('d F Y') }}
                </td>
            </tr>
            <tr>
                <td class="laporan-label" style="height: 250px;">III</td>
                <td colspan="3" style="vertical-align: top;">Catatan Petugas :</td>
            </tr>
        </table>

        <table class="signature-table" style="margin-top: 30px;">
            <tr>
                <td></td>
                <td>
                    <div class="signature-box" style="float: right; margin-right: 50px;">
                        <p>Yogyakarta, .............................</p>
                        <p>Petugas Pendamping</p>
                        <div class="signature-space"></div>
                        <div>
                            ..........................................
                        </div>
                    </div>
                </td>
            </tr>
        </table>
    </div>
</body>

</html>