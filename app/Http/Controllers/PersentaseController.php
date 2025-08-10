<?php

namespace App\Http\Controllers;

use App\Models\Persentase;
use Illuminate\Http\Request;

class PersentaseController extends Controller
{
    /**
     * Store a newly created persentase in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_progres' => 'required|exists:progress,id',
            'catatan1' => 'nullable|string|max:255',
            'catatan2' => 'nullable|string|max:255',
            'catatan3' => 'nullable|string|max:255',
            'catatan4' => 'nullable|string|max:255',
            'catatan5' => 'nullable|string|max:255',
            'catatan6' => 'nullable|string|max:255',
            'catatan7' => 'nullable|string|max:255',
            'catatan8' => 'nullable|string|max:255',
            'catatan9' => 'nullable|string|max:255',
            'catatan10' => 'nullable|string|max:255',
            'target_publish' => 'required|date',
            'publish_link_youtube' => 'nullable|url|max:255',
            'tanggal_publish' => 'nullable|date',
            'durasi_video_menit' => 'nullable|numeric|min:0|max:9999.99',
            'persentase' => 'nullable|numeric|min:0|max:100',
        ]);

        // Hitung persentase otomatis berdasarkan catatan yang terisi
        $persentase = $this->calculatePersentase($validated);
        $validated['persentase'] = $persentase;

        // Cek apakah sudah ada data persentase untuk progress ini
        $existing = Persentase::where('id_progres', $validated['id_progres'])->first();
        
        if ($existing) {
            // Jika sudah ada, update data yang ada
            $existing->update($validated);
            return redirect()->back()->with('success', 'Data persentase berhasil diperbarui!');
        } else {
            // Jika belum ada, buat data baru
            Persentase::create($validated);
            return redirect()->back()->with('success', 'Data persentase berhasil disimpan!');
        }
    }

    /**
     * Get persentase data by progress ID
     */
    public function getByProgress($id_progres)
    {
        $persentase = Persentase::where('id_progres', $id_progres)->first();
        return response()->json($persentase);
    }

    /**
     * Update the specified persentase in storage.
     */
    public function update(Request $request, Persentase $persentase)
    {
        $validated = $request->validate([
            'catatan1' => 'nullable|string|max:255',
            'catatan2' => 'nullable|string|max:255',
            'catatan3' => 'nullable|string|max:255',
            'catatan4' => 'nullable|string|max:255',
            'catatan5' => 'nullable|string|max:255',
            'catatan6' => 'nullable|string|max:255',
            'catatan7' => 'nullable|string|max:255',
            'catatan8' => 'nullable|string|max:255',
            'catatan9' => 'nullable|string|max:255',
            'catatan10' => 'nullable|string|max:255',
            'target_publish' => 'required|date',
            'publish_link_youtube' => 'nullable|url|max:255',
            'tanggal_publish' => 'nullable|date',
            'durasi_video_menit' => 'nullable|numeric|min:0|max:9999.99',
            'persentase' => 'nullable|numeric|min:0|max:100',
        ]);

        // Hitung persentase otomatis berdasarkan catatan yang terisi
        $persentaseValue = $this->calculatePersentase($validated);
        $validated['persentase'] = $persentaseValue;

        $persentase->update($validated);

        return redirect()->back()->with('success', 'Data persentase berhasil diperbarui!');
    }

    /**
     * Calculate persentase based on catatan values.
     */
    private function calculatePersentase(array $data): float
    {
        $persentaseMap = [
            1 => 10, 6 => 10, 7 => 10,
            2 => 5, 8 => 5, 9 => 5, 10 => 5,
            3 => 15, 4 => 15,
            5 => 20,
        ];

        $total = 0;

        foreach ($persentaseMap as $key => $value) {
            if (!empty($data['catatan' . $key])) {
                $total += $value;
            }
        }

        return min($total, 100);
    }
}
