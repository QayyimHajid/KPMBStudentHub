<?php

namespace Database\Seeders;

use App\Models\Announcement;
use App\Models\Event;
use Illuminate\Database\Seeder;

class AnnouncementEventSeeder extends Seeder
{
    public function run(): void
    {
        $announcements = [
            [
                'title' => 'Jadual Bertugas Felo November 2026',
                'content' => 'Jadual bertugas felo bagi bulan November 2026 yang terkini untuk makluman pelajar-pelajar residensi Kolej Profesional MARA Beranang.',
                'date_published' => '2026-11-02',
                'status' => 'published',
                'image_path' => 'jadual_bertugas_felo.jpeg',
            ],
            [
                'title' => 'AI Graphic Design Challenge – Smart Nation 2026',
                'content' => 'Pelajar KPMB dijemput menyertai pertandingan AI Graphic Design Challenge anjuran MyDIGITAL Corporation. Hasilkan poster AI bertemakan “What Does a Smart Nation Look Like to You?”. Tarikh tutup penyertaan: 10 November 2026. Hadiah termasuk tiket VIP ke Smart Nation Expo 2026.',
                'date_published' => '2026-11-01',
                'status' => 'published',
                'image_path' => 'pertandingan_ai.jpeg',
            ],
            [
                'title' => 'Revision Days Sesi 3 2026/2027',
                'content' => 'Revision Days untuk pelajar KPMB berlangsung pada 31 Oktober hingga 4 November 2026. Gunakan tempoh ini untuk membuat persediaan peperiksaan, mengulang kaji dan menjaga kesihatan.',
                'date_published' => '2026-10-31',
                'status' => 'published',
                'image_path' => 'revision.jpeg',
            ],
        ];

        foreach ($announcements as $announcement) {
            Announcement::updateOrCreate(
                ['title' => $announcement['title']],
                $announcement
            );
        }

        $events = [
            [
                'event_name' => 'Movie Night – Project Hail Mary',
                'description' => 'Movie Night untuk pelajar yang telah mendapatkan tempat di LT2. Pendaftaran bermula pada jam 8.00 malam. Walk-in payment turut diterima tertakluk kepada kekosongan.',
                'event_date' => '2026-10-09',
                'start_time' => '20:00:00',
                'end_time' => null,
                'venue' => 'LT2',
                'image_path' => 'hail_mary.jpeg',
            ],
            [
                'event_name' => 'Video Tayangan Sirah Nabi',
                'description' => 'Persatuan Dakwah Islamiah KPMB mengadakan tayangan video Sirah Nabi. Kehadiran pelajar dialu-alukan untuk mengisi masa antara Maghrib dan Isyak dengan pengisian rohani.',
                'event_date' => '2026-10-12',
                'start_time' => null,
                'end_time' => null,
                'venue' => 'Surau An-Nur KPMB',
                'image_path' => 'perdiqma.jpeg',
            ],
            [
                'event_name' => 'Ijtima’ Jumaat – Human Bingo',
                'description' => 'Aktiviti Human Bingo untuk berkenalan dengan rakan-rakan dan mengeratkan ukhuwah. Hadiah RM10 menanti 10 orang pemenang terawal. Pelajar Muslimat Semester 1 dan 3 diwajibkan hadir; pelajar semester lain turut digalakkan menyertai. Bawa pen sendiri.',
                'event_date' => '2026-10-09',
                'start_time' => '12:30:00',
                'end_time' => '14:00:00',
                'venue' => 'Surau An-Nur, KPM Beranang',
                'image_path' => 'ijtima.jpeg',
            ],
        ];

        foreach ($events as $event) {
            Event::updateOrCreate(
                ['event_name' => $event['event_name']],
                $event
            );
        }
    }
}
