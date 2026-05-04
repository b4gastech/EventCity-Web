<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PanitiaController extends Controller
{   
    /**
     * Fitur Baru: Dashboard Panitia
     * Untuk melihat daftar acara yang sudah dibuat dan status verifikasinya
     */
    public function index()
    {
        // Mengambil semua acara milik panitia yang sedang login (atau default ID 1)
        $myEvents = Event::where('user_id', Auth::id() ?? 1)->get();
        return view('panitia.dashboard', compact('myEvents'));
    }

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
            'event_date' => 'required|date|after:today',
            'category' => 'required',
            'poster' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ]);

        // Logika Paksa Buat Folder & Simpan Poster
        $posterPath = null;
        if ($request->hasFile('poster')) {
            // Cek apakah folder 'posters' sudah ada di disk public
            if (!Storage::disk('public')->exists('posters')) {
                // Paksa buat folder posters jika belum ada
                Storage::disk('public')->makeDirectory('posters');
            }
            
            // Simpan file ke storage/app/public/posters
            $posterPath = $request->file('poster')->store('posters', 'public');
        }

        // Simpan ke database tabel 'events'
        Event::create([
            'user_id' => Auth::id() ?? 1, // Default ke ID 1 jika sistem login belum siap
            'title' => $request->title,
            'description' => $request->description,
            'location' => $request->location,
            'quota' => $request->quota,
            'event_date' => $request->event_date,
            'category' => $request->category,
            'poster_path' => $posterPath,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'status' => 0 // Status 0 = Pending (Syarat kompleksitas dari Bapak)
        ]);

        return redirect('/panitia/dashboard')->with('success', 'Acara Smart City berhasil diajukan!');
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