<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PanitiaController extends Controller
{
    /**
     * Fitur 1: Pengajuan Acara (Event Submission)
     * Data ini nantinya akan divalidasi oleh Tora (Admin)
     */
    public function store(Request $request) 
    {
        // Validasi agar data tidak kosong
        $request->validate([
            'title' => 'required',
            'location' => 'required',
            'quota' => 'required|numeric',
        ]);

        // Simpan ke database tabel 'events'
        Event::create([
            'user_id' => Auth::id() ?? 1, // Default ke ID 1 jika sistem login belum siap
            'title' => $request->title,
            'description' => $request->description,
            'location' => $request->location,
            'quota' => $request->quota,
            'status' => 0 // Status 0 = Pending (Syarat kompleksitas dari Bapak)
        ]);

        return "Acara berhasil diajukan! Sekarang Tora bisa memverifikasi data ini.";
    }

    /**
     * Fitur 2: Verifikasi Profil (Upload KTP)
     * Agar platform terlihat lebih aman dan profesional sesuai saran Bapak
     */
    public function uploadKtp(Request $request) 
    {
        // Validasi file harus gambar dan maksimal 2MB
        $request->validate([
            'ktp_image' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        // 1. Simpan file ke folder storage/app/public/ktp
        $path = $request->file('ktp_image')->store('public/ktp');

        // 2. Update path KTP di data user yang sedang login
        $user = User::find(Auth::id() ?? 1);
        if ($user) {
            $user->ktp_path = $path;
            $user->save();
            return "Foto KTP berhasil diunggah! Sekarang Admin (Tora) bisa memverifikasi akunmu.";
        }

        return "Gagal mengunggah KTP: User tidak ditemukan.";
    }
}