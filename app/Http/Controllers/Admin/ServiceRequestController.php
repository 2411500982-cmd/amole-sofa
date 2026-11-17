<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ServiceRequestController extends Controller
{
    // MENAMPILKAN DAFTAR KONSULTASI PELANGGAN
    public function index()
    {
        $serviceRequests = ServiceRequest::latest()
            ->paginate(10);

        return view(
            'admin.service-requests.index',
            compact('serviceRequests')
        );
    }

    // MENAMPILKAN DETAIL KONSULTASI PELANGGAN
    public function show($id)
    {
        $serviceRequest = ServiceRequest::findOrFail($id);

        return view(
            'admin.service-requests.show',
            compact('serviceRequest')
        );
    }

    // MENGUBAH STATUS KONSULTASI
    public function updateStatus(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => [
                'required',
                'string',
                'in:Menunggu,Sedang Diproses,Selesai,Ditolak',
            ],
        ]);

        $serviceRequest = ServiceRequest::findOrFail($id);

        $serviceRequest->update([
            'status' => $validated['status'],
        ]);

        return redirect()
            ->back()
            ->with('success', 'Status konsultasi berhasil diperbarui.');
    }

    // MENGHAPUS KONSULTASI PELANGGAN
    public function destroy($id)
    {
        $serviceRequest = ServiceRequest::findOrFail($id);

        // AMBIL DAFTAR FOTO KONSULTASI
        $daftarGambar = $serviceRequest->gambar ?? [];

        // HAPUS DATA KONSULTASI DARI DATABASE
        DB::transaction(function () use ($serviceRequest) {
            $serviceRequest->delete();
        });

        // HAPUS FOTO DARI STORAGE SETELAH DATA BERHASIL DIHAPUS
        foreach ($daftarGambar as $gambar) {

            // PASTIKAN FILE BERADA DI FOLDER KONSULTASI
            if (
                is_string($gambar) &&
                str_starts_with($gambar, 'konsultasi/')
            ) {
                Storage::disk('public')->delete($gambar);
            }
        }

        return redirect()
            ->route('admin.service-requests.index')
            ->with('success', 'Data konsultasi berhasil dihapus.');
    }
}
