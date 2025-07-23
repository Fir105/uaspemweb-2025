<?php

namespace App\Http\Controllers;

use App\Models\Anime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AnimeController extends Controller
{
    // Tampilkan semua anime (jika digunakan di halaman public)
    public function index()
    {
        $animes = Anime::latest()->get();
        return view('animes.index', compact('animes'));
    }

    // Tampilkan form tambah (opsional)
    public function create()
    {
        return view('animes.create');
    }

    // Simpan data anime dari form upload
    public function store(Request $request)
    {
        $data = $request->validate([
            'title'        => 'required|string|max:255',
            'description'  => 'required|string',
            'cover_image'  => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'video_path'   => 'required|file|mimes:mp4,mkv|max:51200',
        ]);

        // Simpan file cover dan video ke storage/public
        $data['cover_image'] = $request->file('cover_image')->store('covers', 'public');
        $data['video_path']  = $request->file('video_path')->store('videos', 'public');

        // Simpan ke DB
        Anime::create($data);

        return redirect()->back()->with('success', 'Anime berhasil disimpan.');
    }

    // Menampilkan satu anime (opsional)
    public function show(Anime $anime)
    {
        return view('animes.show', compact('anime'));
    }

    // Edit & Update bisa ditambahkan sesuai kebutuhan
}
