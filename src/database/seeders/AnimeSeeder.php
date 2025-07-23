<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Anime;

class AnimeSeeder extends Seeder
{
    public function run(): void
    {
        $animes = [
            [
                'title' => 'Attack on Titan',
                'cover_url' => 'https://upload.wikimedia.org/wikipedia/en/5/5a/Shingeki_no_Kyojin_manga_volume_1.jpg',
            ],
            [
                'title' => 'Demon Slayer',
                'cover_url' => 'https://upload.wikimedia.org/wikipedia/en/6/65/Kimetsu_no_Yaiba_vol_1.jpg',
            ],
            [
                'title' => 'Jujutsu Kaisen',
                'cover_url' => 'https://upload.wikimedia.org/wikipedia/en/8/8e/Jujutsu_Kaisen_volume_1_cover.jpg',
            ],
            [
                'title' => 'My Hero Academia',
                'cover_url' => 'https://upload.wikimedia.org/wikipedia/en/0/0c/My_Hero_Academia_Volume_1.png',
            ],
            [
                'title' => 'One Piece',
                'cover_url' => 'https://upload.wikimedia.org/wikipedia/en/2/29/One_Piece_volume_1.jpg',
            ],
            [
                'title' => 'Naruto',
                'cover_url' => 'https://upload.wikimedia.org/wikipedia/en/9/94/NarutoCoverTankobon1.jpg',
            ],
            [
                'title' => 'Bleach',
                'cover_url' => 'https://upload.wikimedia.org/wikipedia/en/3/36/Bleachanime.png',
            ],
            [
                'title' => 'Chainsaw Man',
                'cover_url' => 'https://upload.wikimedia.org/wikipedia/en/1/1f/Chainsaw_Man_volume_1_cover.jpg',
            ],
            [
                'title' => 'Tokyo Ghoul',
                'cover_url' => 'https://upload.wikimedia.org/wikipedia/en/b/b6/TokyoGhoulVolume1.jpg',
            ],
            [
                'title' => 'Death Note',
                'cover_url' => 'https://upload.wikimedia.org/wikipedia/en/6/6f/Death_Note_Vol_1.jpg',
            ],
        ];

        $videoUrl = 'https://samplelib.com/lib/preview/mp4/sample-5s.mp4';
        $videoPath = 'videos/sample.mp4';

        // Download video once
        if (!Storage::disk('public')->exists($videoPath)) {
            $video = @file_get_contents($videoUrl);
            if ($video) {
                Storage::disk('public')->put($videoPath, $video);
                $this->command->info("✅ Video berhasil diunduh.");
            } else {
                $this->command->warn("❌ Gagal mengunduh video dari $videoUrl.");
            }
        }

        // Ensure default cover exists
        $defaultPublicPath = public_path('default.jpg');
        $defaultCoverStoragePath = 'covers/default.jpg';
        if (file_exists($defaultPublicPath) && !Storage::disk('public')->exists($defaultCoverStoragePath)) {
            Storage::disk('public')->put($defaultCoverStoragePath, file_get_contents($defaultPublicPath));
            $this->command->info("✅ Default cover berhasil disalin.");
        }

        // Process each anime
        foreach ($animes as $index => $anime) {
            $title = $anime['title'];
            $description = "$title adalah anime populer yang wajib ditonton.";
            $coverPath = "covers/anime-{$index}.jpg";

            $image = @file_get_contents($anime['cover_url']);
            if ($image) {
                Storage::disk('public')->put($coverPath, $image);
                $this->command->info("✅ Cover berhasil diunduh: $title");
            } else {
                $coverPath = $defaultCoverStoragePath;
                $this->command->warn("❌ Gagal mengunduh cover $title, pakai default.");
            }

            Anime::create([
                'title' => $title,
                'description' => $description,
                'cover_image' => $coverPath,
                'video_path' => $videoPath,
            ]);

            $this->command->info("🎬 Anime berhasil dibuat: $title");
        }
    }
}
