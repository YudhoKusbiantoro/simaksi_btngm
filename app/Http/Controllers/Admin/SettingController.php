<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $allSettings = Setting::all()->keyBy('key');

        $pejabat = [
            'label' => 'Pengaturan Penandatangan (TTD)',
            'settings' => [
                'ttd_a' => [
                    'label' => 'Penandatangan A (Default)',
                    'fields' => [
                        $allSettings->get('kasubag_tu_nama'),
                        $allSettings->get('kasubag_tu_nip'),
                        $allSettings->get('kasubag_tu_jabatan'),
                    ]
                ],
                'ttd_b' => [
                    'label' => 'Penandatangan B',
                    'fields' => [
                        $allSettings->get('ttd_2_nama'),
                        $allSettings->get('ttd_2_nip'),
                        $allSettings->get('ttd_2_jabatan'),
                    ]
                ],
            ]
        ];

        $tarifGroups = [
            'wisata' => [
                'label' => 'Kegiatan Wisata Alam',
                'settings' => [
                    $allSettings->get('harga_berkemah'),
                    $allSettings->get('harga_mendaki'),
                    $allSettings->get('harga_caving'),
                ]
            ],
            'penelitian' => [
                'label' => 'Penelitian di Kawasan',
                'rows' => [
                    [
                        'label' => 'Penelitian < 1 Bulan',
                        'wna' => $allSettings->get('harga_penelitian_wna_1bln'),
                        'wni' => $allSettings->get('harga_penelitian_wni_1bln'),
                    ],
                    [
                        'label' => 'Penelitian 1-6 Bulan',
                        'wna' => $allSettings->get('harga_penelitian_wna_1_6bln'),
                        'wni' => $allSettings->get('harga_penelitian_wni_1_6bln'),
                    ],
                    [
                        'label' => 'Penelitian 7-12 Bulan',
                        'wna' => $allSettings->get('harga_penelitian_wna_7_12bln'),
                        'wni' => $allSettings->get('harga_penelitian_wni_7_12bln'),
                    ],
                    [
                        'label' => 'Izin Pengambilan Sampel',
                        'wna' => $allSettings->get('harga_sampel_wna'),
                        'wni' => $allSettings->get('harga_sampel_wni'),
                    ],
                ]
            ],
            'komersial' => [
                'label' => 'Pengambilan Gambar Komersial',
                'rows' => [
                    [
                        'label' => 'Videografi (Iklan, Film, Video Clip, dll)',
                        'wna' => $allSettings->get('harga_komersial_video_iklan_wna'),
                        'wni' => $allSettings->get('harga_komersial_video_iklan_wni'),
                    ],
                    [
                        'label' => 'Fotografi (Wisata, Majalah, Iklan Produk, dll)',
                        'wna' => $allSettings->get('harga_komersial_foto_wisata_wna'),
                        'wni' => $allSettings->get('harga_komersial_foto_wisata_wni'),
                    ],
                    [
                        'label' => 'Video dan Foto Prewedding',
                        'wna' => $allSettings->get('harga_komersial_prewedding_wna'),
                        'wni' => $allSettings->get('harga_komersial_prewedding_wni'),
                    ],
                    [
                        'label' => 'Drone',
                        'wna' => $allSettings->get('harga_komersial_drone_wna'),
                        'wni' => $allSettings->get('harga_komersial_drone_wni'),
                    ],
                ]
            ]
        ];

        $simaksi = [
            'label' => 'Ketentuan Masuk Kawasan (SIMAKSI)',
            'settings' => [
                $allSettings->get('simaksi_ketentuan'),
            ]
        ];

        return view('admin.settings.index', compact('pejabat', 'tarifGroups', 'simaksi'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'settings' => 'required|array',
            'settings.*' => 'nullable|string',
        ]);

        foreach ($data['settings'] as $key => $value) {
            // Sanitize: remove thousand separators (dots) for tariff keys
            if (str_starts_with($key, 'harga_')) {
                $value = str_replace('.', '', $value);
            }

            Setting::where('key', $key)->update(['value' => $value]);
        }

        return redirect()->back()->with('success', 'Pengaturan berhasil diperbarui.');
    }
}
