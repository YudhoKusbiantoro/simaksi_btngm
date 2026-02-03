<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Upload Dokumen - SIMAKSI</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-gray-100 font-sans">

<div class="min-h-screen py-8">
    <div class="max-w-4xl mx-auto px-4">
        <h1 class="text-3xl font-bold mb-6">Upload Dokumen Wajib</h1>

        <form action="{{ route('ajukan.upload') }}" method="POST" enctype="multipart/form-data">
            @csrf

            @foreach($persyaratans as $index => $dokumen)
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2">{{ $dokumen }}</label>
                    <input type="file" name="dokumen[{{ $index }}]" class="w-full border border-gray-300 rounded px-3 py-2" required>
                    <input type="hidden" name="nama_dokumen[{{ $index }}]" value="{{ $dokumen }}">
                </div>
            @endforeach

            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg">
                Submit Pengajuan
            </button>
            <a href="{{ route('ajukan') }}" class="ml-4 text-blue-600">← Kembali</a>
        </form>
    </div>
</body>
</html>