<?php

namespace Database\Seeders;

use App\Models\CampusFacility;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CampusFacilitySeeder extends Seeder
{
    /**
     * Replaces the current mock facility records with the curated KPMB list.
     * This seeder only changes campus_facilities and facility_images.
     * Run it only when the existing campus_facilities rows are mock data.
     */
    public function run(): void
    {
        $facilities = [
            [
                'facility_name' => 'Bilik Kuliah',
                'facility_type' => 'Akademik & Pembelajaran',
                'location' => 'Kampus KPMB Beranang',
                'description' => 'Ruang pembelajaran untuk sesi kuliah dan aktiviti akademik.',
                'operating_hours' => null,
                'slug' => 'bilik-kuliah',
                'images' => [
                    'bilik-kuliah-1.jpg', 'bilik-kuliah-2.jpg', 'bilik-kuliah-3.jpg',
                    'bilik-kuliah-3_V2.jpg', 'bilik-kuliah-5.jpg',
                ],
            ],
            [
                'facility_name' => 'Lecturer Theater',
                'facility_type' => 'Akademik & Pembelajaran',
                'location' => 'Kampus KPMB Beranang',
                'description' => 'Ruang pengajaran berbentuk teater untuk aktiviti pembelajaran.',
                'operating_hours' => null,
                'slug' => 'lecturer-theater',
                'images' => ['lt-1.jpg', 'lt-1.V2.jpg', 'lt-2.jpg', 'lt-2_V2.jpg'],
            ],
            [
                'facility_name' => 'Perpustakaan Za\'Ba',
                'facility_type' => 'Akademik & Pembelajaran',
                'location' => 'Kampus KPMB Beranang',
                'description' => 'Kemudahan perpustakaan untuk rujukan dan pembelajaran kendiri.',
                'operating_hours' => null,
                'slug' => 'perpustakaan-zaba',
                'images' => ['zaba.jpg', 'zaba_V2.jpg', 'zaba_V3.jpg'],
            ],
            [
                'facility_name' => 'Smart Classroom',
                'facility_type' => 'Akademik & Pembelajaran',
                'location' => 'Kampus KPMB Beranang',
                'description' => 'Bilik darjah untuk menyokong aktiviti pengajaran dan pembelajaran.',
                'operating_hours' => null,
                'slug' => 'smart-classroom',
                'images' => ['smartclass.jpg', 'smartclass_V2.jpg'],
            ],
            [
                'facility_name' => 'DreamGate',
                'facility_type' => 'Akademik & Pembelajaran',
                'location' => 'Kampus KPMB Beranang',
                'description' => null,
                'operating_hours' => null,
                'slug' => 'dreamgate',
                'images' => ['dreamgate.jpg', 'dreamgate_V2.jpg'],
            ],
            [
                'facility_name' => 'Makmal & Bengkel ICT',
                'facility_type' => 'ICT & Teknologi',
                'location' => 'Kampus KPMB Beranang',
                'description' => 'Kemudahan makmal dan bengkel untuk aktiviti pembelajaran ICT.',
                'operating_hours' => null,
                'slug' => 'makmal-ict',
                'images' => ['makmal1.jpg', 'makmal1_V2.jpg', 'makmal2.jpg', 'makmal2_V2.jpg'],
            ],
            [
                'facility_name' => 'eSport',
                'facility_type' => 'ICT & Teknologi',
                'location' => 'Kampus KPMB Beranang',
                'description' => 'Kemudahan untuk aktiviti e-sukan.',
                'operating_hours' => null,
                'slug' => 'esport',
                'images' => ['esport.jpg', 'esport_V2.jpg'],
            ],
            [
                'facility_name' => 'Kamsis Pelajar',
                'facility_type' => 'Penginapan',
                'location' => 'Kampus KPMB Beranang',
                'description' => 'Kemudahan penginapan pelajar.',
                'operating_hours' => null,
                'slug' => 'kamsis-pelajar',
                'images' => ['kamsisfarabi.jpg', 'kamsisfarabi_V2.jpg'],
            ],
            [
                'facility_name' => 'Ladang Horticulture',
                'facility_type' => 'Pertanian & Horticulture',
                'location' => 'Kampus KPMB Beranang',
                'description' => 'Kawasan ladang untuk aktiviti berkaitan pertanian dan hortikultur.',
                'operating_hours' => null,
                'slug' => 'ladang-horticulture',
                'images' => ['ladangagro1.jpg', 'ladangagro1_V2.jpg', 'ladangagro2.jpg', 'ladangagro2_V2.jpg'],
            ],
            [
                'facility_name' => 'Makmal Horticulture',
                'facility_type' => 'Pertanian & Horticulture',
                'location' => 'Kampus KPMB Beranang',
                'description' => 'Kemudahan makmal untuk aktiviti berkaitan hortikultur.',
                'operating_hours' => null,
                'slug' => 'makmal-horticulture',
                'images' => ['makmal-1.jpg', 'makmal-1_V2.jpg', 'makmal-1_V3.jpg'],
            ],
            [
                'facility_name' => 'Dewan Gemilang',
                'facility_type' => 'Kemudahan Umum',
                'location' => 'Kampus KPMB Beranang',
                'description' => 'Kemudahan dewan untuk kegunaan warga kolej.',
                'operating_hours' => null,
                'slug' => 'dewan-gemilang',
                'images' => ['dewan.jpg', 'dewan_V2.jpg', 'dewan_V3.jpg'],
            ],
            [
                'facility_name' => 'Surau',
                'facility_type' => 'Kemudahan Umum',
                'location' => 'Kampus KPMB Beranang',
                'description' => 'Kemudahan solat untuk warga kolej.',
                'operating_hours' => null,
                'slug' => 'surau',
                'images' => ['surau.jpg', 'surau_V2.jpg'],
            ],
            [
                'facility_name' => 'Gimnasium',
                'facility_type' => 'Sukan & Rekreasi',
                'location' => 'Kampus KPMB Beranang',
                'description' => 'Kemudahan senaman dan kecergasan.',
                'operating_hours' => null,
                'slug' => 'gimnasium',
                'images' => ['gym.jpg', 'gym_V2.jpg'],
            ],
            [
                'facility_name' => 'Padang',
                'facility_type' => 'Sukan & Rekreasi',
                'location' => 'Kampus KPMB Beranang',
                'description' => 'Kawasan padang untuk aktiviti sukan dan rekreasi.',
                'operating_hours' => null,
                'slug' => 'padang',
                'images' => ['padang.jpg'],
            ],
            [
                'facility_name' => 'Giant Chess',
                'facility_type' => 'Sukan & Rekreasi',
                'location' => 'Kampus KPMB Beranang',
                'description' => 'Kemudahan catur gergasi untuk aktiviti rekreasi.',
                'operating_hours' => null,
                'slug' => 'giant-chess',
                'images' => ['giantchess.jpg', 'giantchess_V2.jpg'],
            ],
        ];

        DB::transaction(function () use ($facilities): void {
            // Clear child rows first, then replace only facility records.
            DB::table('facility_images')->delete();
            CampusFacility::query()->delete();

            foreach ($facilities as $sort => $data) {
                $images = $data['images'];
                unset($data['images'], $data['slug']);

                $facility = CampusFacility::create($data);
                $slug = $facilities[$sort]['slug'];

                foreach ($images as $imageOrder => $filename) {
                    DB::table('facility_images')->insert([
                        'facility_id' => $facility->facility_id,
                        'image_path' => "facilities/{$slug}/{$filename}",
                        'is_primary' => $imageOrder === 0,
                        'sort_order' => $imageOrder,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        });
    }
}
