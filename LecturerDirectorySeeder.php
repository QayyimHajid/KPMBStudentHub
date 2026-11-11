<?php

namespace Database\Seeders;

use App\Models\LecturerDirectory;
use Illuminate\Database\Seeder;

class LecturerDirectorySeeder extends Seeder
{
    public function run(): void
    {
        $records = [
            ['department_code' => 'DIA', 'department' => 'JABATAN PERAKAUNAN (DIA)', 'lecturer_name' => 'Mazafaton Bt Mohmad', 'position' => 'Ketua Jabatan', 'email' => 'mazafaton.mohmad@mara.gov.my', 'photo_path' => 'DIA/mazafaton.png'],
            ['department_code' => 'DIA', 'department' => 'JABATAN PERAKAUNAN (DIA)', 'lecturer_name' => 'Aniza Bt Alias', 'position' => 'Pensyarah', 'email' => 'aniza.alias@mara.gov.my', 'photo_path' => 'DIA/aniza_alias.png'],
            ['department_code' => 'DIA', 'department' => 'JABATAN PERAKAUNAN (DIA)', 'lecturer_name' => 'Atty Azanira Bt Abd Rashid', 'position' => 'Pensyarah', 'email' => 'atty.rashid@mara.gov.my', 'photo_path' => 'DIA/atty_azanira.png'],
            ['department_code' => 'DIA', 'department' => 'JABATAN PERAKAUNAN (DIA)', 'lecturer_name' => 'Eliza Yusreen Bt Abdul Razak', 'position' => 'Pensyarah', 'email' => 'eliza.razak@mara.gov.my', 'photo_path' => 'DIA/eliza_yusreen.png'],
            ['department_code' => 'DIA', 'department' => 'JABATAN PERAKAUNAN (DIA)', 'lecturer_name' => 'Kartina Bt Abd Razak', 'position' => 'Pensyarah', 'email' => 'kartina.razak@mara.gov.my', 'photo_path' => 'DIA/kartina.png'],
            ['department_code' => 'DIA', 'department' => 'JABATAN PERAKAUNAN (DIA)', 'lecturer_name' => 'Matron Daies B Abdullah', 'position' => 'Pensyarah', 'email' => 'matron.abdullah@mara.gov.my', 'photo_path' => 'DIA/matron_daeis.png'],
            ['department_code' => 'DIA', 'department' => 'JABATAN PERAKAUNAN (DIA)', 'lecturer_name' => 'Munirah Bt Mat Jusoh', 'position' => 'Pensyarah', 'email' => 'munirahjusoh@mara.gov.my', 'photo_path' => 'DIA/munirah.png'],
            ['department_code' => 'DIA', 'department' => 'JABATAN PERAKAUNAN (DIA)', 'lecturer_name' => 'Mohd Hazim B Mohd Noor', 'position' => 'Pensyarah', 'email' => 'hazim@mara.gov.my', 'photo_path' => 'DIA/mohd_hazim.png'],
            ['department_code' => 'DIA', 'department' => 'JABATAN PERAKAUNAN (DIA)', 'lecturer_name' => 'Nur Ilyani Bt Bashir', 'position' => 'Pensyarah', 'email' => 'ilyani.bashir@mara.gov.my', 'photo_path' => 'DIA/nur_ilyani.png'],
            ['department_code' => 'DIA', 'department' => 'JABATAN PERAKAUNAN (DIA)', 'lecturer_name' => 'Nurhidayah Bt Khalid', 'position' => 'Pensyarah', 'email' => 'norhidayah.khalid@mara.gov.my', 'photo_path' => 'DIA/nurhidayah_khalid.png'],
            ['department_code' => 'DIA', 'department' => 'JABATAN PERAKAUNAN (DIA)', 'lecturer_name' => 'Ratnasary Bt Yacob', 'position' => 'Pensyarah', 'email' => 'ratnasary.yacob@mara.gov.my', 'photo_path' => 'DIA/ratnasary.png'],
            ['department_code' => 'DIA', 'department' => 'JABATAN PERAKAUNAN (DIA)', 'lecturer_name' => 'Wan Marini Izayu Bt Mahat', 'position' => 'Pensyarah', 'email' => 'marini.mahat@mara.gov.my', 'photo_path' => 'DIA/wan_marini.png'],
            ['department_code' => 'DIA', 'department' => 'JABATAN PERAKAUNAN (DIA)', 'lecturer_name' => 'Syuhada Bt Khalidi', 'position' => 'Pensyarah', 'email' => 'syuhada.khalidi@mara.gov.my', 'photo_path' => 'DIA/syuhada.png'],
            ['department_code' => 'DIA', 'department' => 'JABATAN PERAKAUNAN (DIA)', 'lecturer_name' => 'Saidatol Akmar Bt Alias', 'position' => 'Pensyarah', 'email' => 'akmar.alias@mara.gov.my', 'photo_path' => 'DIA/saidatol_akmar.png'],
            ['department_code' => 'DIA', 'department' => 'JABATAN PERAKAUNAN (DIA)', 'lecturer_name' => 'Mohd Ikbal B Hashim', 'position' => 'Pensyarah', 'email' => 'mikbal@mara.gov.my', 'photo_path' => 'DIA/mohd_ikbal.png'],
            ['department_code' => 'DIA', 'department' => 'JABATAN PERAKAUNAN (DIA)', 'lecturer_name' => 'Asmahwati Bt Abdol Rahim', 'position' => 'Pensyarah', 'email' => 'asmahwati@mara.gov.my', 'photo_path' => 'DIA/asmahwati.png'],
            ['department_code' => 'DSC', 'department' => 'JABATAN SAINS KUANTITATIF (DSC)', 'lecturer_name' => 'Noor Aisyah Bt Mohd Baharuddin', 'position' => 'Ketua Jabatan', 'email' => 'aisyah.baharuddin@mara.gov.my', 'photo_path' => 'DSC/noor_aisyah.png'],
            ['department_code' => 'DSC', 'department' => 'JABATAN SAINS KUANTITATIF (DSC)', 'lecturer_name' => 'Muhammad Munzir B Abd Halim', 'position' => 'Pensyarah', 'email' => 'munzir@mara.gov.my', 'photo_path' => 'DSC/munzir.png'],
            ['department_code' => 'DSC', 'department' => 'JABATAN SAINS KUANTITATIF (DSC)', 'lecturer_name' => 'Mohd Zulhilmi B Mohamad Zaki', 'position' => 'Pensyarah', 'email' => 'mohdzulhilmi@mara.gov.my', 'photo_path' => 'DSC/zulhilmi.png'],
            ['department_code' => 'DSC', 'department' => 'JABATAN SAINS KUANTITATIF (DSC)', 'lecturer_name' => 'Siti Farhana Bt Johari', 'position' => 'Pensyarah', 'email' => 'farhana.johari@mara.gov.my', 'photo_path' => 'DSC/siti_farhana.png'],
            ['department_code' => 'DSC', 'department' => 'JABATAN SAINS KUANTITATIF (DSC)', 'lecturer_name' => 'Mawarwiduri Bt Ab Halik', 'position' => 'Pensyarah', 'email' => 'mawarwiduri@mara.gov.my', 'photo_path' => 'DSC/mawarwiduri.png'],
            ['department_code' => 'DSC', 'department' => 'JABATAN SAINS KUANTITATIF (DSC)', 'lecturer_name' => 'Zalina Bt Ayob', 'position' => 'Pensyarah', 'email' => 'zalina.ayob@mara.gov.my', 'photo_path' => 'DSC/zalina_ayob.png'],
            ['department_code' => 'DSC', 'department' => 'JABATAN SAINS KUANTITATIF (DSC)', 'lecturer_name' => 'Nini Aniza Bt Zakaria', 'position' => 'Pensyarah', 'email' => 'aniza.zakaria@mara.gov.my', 'photo_path' => 'DSC/nini_aniza.png'],
            ['department_code' => 'DSC', 'department' => 'JABATAN SAINS KUANTITATIF (DSC)', 'lecturer_name' => 'Noorfazliani Bt Shamshudin', 'position' => 'Pensyarah', 'email' => 'fazliani.shamshudin@mara.gov.my', 'photo_path' => 'DSC/fazliani.png'],
            ['department_code' => 'DSC', 'department' => 'JABATAN SAINS KUANTITATIF (DSC)', 'lecturer_name' => 'Norazimah Bt Nasir', 'position' => 'Pensyarah', 'email' => 'norazimah.nasir@mara.gov.my', 'photo_path' => 'DSC/norazimah.png'],
            ['department_code' => 'DSC', 'department' => 'JABATAN SAINS KUANTITATIF (DSC)', 'lecturer_name' => 'Siti Aminah Bt Said', 'position' => 'Pensyarah', 'email' => 'aminah.said@mara.gov.my', 'photo_path' => 'DSC/siti_aminah.png'],
            ['department_code' => 'DSC', 'department' => 'JABATAN SAINS KUANTITATIF (DSC)', 'lecturer_name' => 'Nur Akmal Hafizan Bt Kamal Iqbal', 'position' => 'Pensyarah', 'email' => 'akmal.hafizan@mara.gov.my', 'photo_path' => 'DSC/norakmal_hafizan.png'],
            ['department_code' => 'DSC', 'department' => 'JABATAN SAINS KUANTITATIF (DSC)', 'lecturer_name' => 'Nur Azyan Bt Ahmad', 'position' => 'Pensyarah', 'email' => 'azyan.ahmad@mara.gov.my', 'photo_path' => 'DSC/nur_azyan.png'],
            ['department_code' => 'DSC', 'department' => 'JABATAN SAINS KUANTITATIF (DSC)', 'lecturer_name' => 'Nurhannanie Bt Bujang', 'position' => 'Pensyarah', 'email' => 'nurhannanie@mara.gov.my', 'photo_path' => 'DSC/nurhannanie.png'],
            ['department_code' => 'DSC', 'department' => 'JABATAN SAINS KUANTITATIF (DSC)', 'lecturer_name' => 'Raja Mahani Bt Raja Mohamed Ali', 'position' => 'Pensyarah', 'email' => 'mahani.ali@mara.gov.my', 'photo_path' => 'DSC/raja_mahani.png'],
            ['department_code' => 'DSC', 'department' => 'JABATAN SAINS KUANTITATIF (DSC)', 'lecturer_name' => 'Rozana Bt Suman', 'position' => 'Pensyarah', 'email' => 'rozana.suman@mara.gov.my', 'photo_path' => 'DSC/rozana.png'],
            ['department_code' => 'DSC', 'department' => 'JABATAN SAINS KUANTITATIF (DSC)', 'lecturer_name' => 'Suriana Bt Supaan', 'position' => 'Pensyarah', 'email' => 'suriana.supaan@mara.gov.my', 'photo_path' => 'DSC/suriana.png'],
            ['department_code' => 'DSC', 'department' => 'JABATAN SAINS KUANTITATIF (DSC)', 'lecturer_name' => 'Siti Azeyrah Bt Ramli', 'position' => 'Pensyarah', 'email' => 'azeyrah.ramli@mara.gov.my', 'photo_path' => 'DSC/azeyrah_ramli.png'],
            ['department_code' => 'DSC', 'department' => 'JABATAN SAINS KUANTITATIF (DSC)', 'lecturer_name' => 'Mohd Syahril B Che Saari', 'position' => 'Pensyarah', 'email' => 'syahril@mara.gov.my', 'photo_path' => 'DSC/syahril.png'],
            ['department_code' => 'DSC', 'department' => 'JABATAN SAINS KUANTITATIF (DSC)', 'lecturer_name' => 'Nur Shahellin Bt Mansor', 'position' => 'Pensyarah', 'email' => 'nurshahellin@mara.gov.my', 'photo_path' => 'DSC/shahellin.png'],
            ['department_code' => 'DLH', 'department' => 'JABATAN LANDSKAP DAN HORTIKULTUR (DLH)', 'lecturer_name' => 'Mohd Zaidan B Zahari', 'position' => 'Ketua Jabatan', 'email' => 'zaidan@mara.gov.my', 'photo_path' => 'DLH/zaidan_zahari.png'],
            ['department_code' => 'DLH', 'department' => 'JABATAN LANDSKAP DAN HORTIKULTUR (DLH)', 'lecturer_name' => 'Marini Masrurah Bt Abdul Manan', 'position' => 'Pensyarah', 'email' => 'masrurah@mara.gov.my', 'photo_path' => 'DLH/marini_masrurah.png'],
            ['department_code' => 'DLH', 'department' => 'JABATAN LANDSKAP DAN HORTIKULTUR (DLH)', 'lecturer_name' => 'Mohd Khidir B Omar', 'position' => 'Pensyarah', 'email' => 'khidir@mara.gov.my', 'photo_path' => 'DLH/mohd_khidir.png'],
            ['department_code' => 'DLH', 'department' => 'JABATAN LANDSKAP DAN HORTIKULTUR (DLH)', 'lecturer_name' => 'Siti Fatimah Bt Hanifah', 'position' => 'Pensyarah', 'email' => 'fatimah.hanifah@mara.gov.my', 'photo_path' => 'DLH/siti_fatimah.png'],
            ['department_code' => 'DLH', 'department' => 'JABATAN LANDSKAP DAN HORTIKULTUR (DLH)', 'lecturer_name' => 'Muhammad Saizam B Mat Jusoff', 'position' => 'Pensyarah', 'email' => 'saizam.jusoff@mara.gov.my', 'photo_path' => 'DLH/saizam.png'],
            ['department_code' => 'DLH', 'department' => 'JABATAN LANDSKAP DAN HORTIKULTUR (DLH)', 'lecturer_name' => 'Noor Qamariah Bt Md Sah', 'position' => 'Pensyarah', 'email' => 'qamariah.sah@mara.gov.my', 'photo_path' => 'DLH/noor_qamariah.png'],
            ['department_code' => 'DLH', 'department' => 'JABATAN LANDSKAP DAN HORTIKULTUR (DLH)', 'lecturer_name' => 'Nor Baizura Bt Mohd Ismail', 'position' => 'Pensyarah', 'email' => 'baizura.ismail@mara.gov.my', 'photo_path' => 'DLH/nor_baizura.png'],
            ['department_code' => 'DLH', 'department' => 'JABATAN LANDSKAP DAN HORTIKULTUR (DLH)', 'lecturer_name' => 'Norahani Bt Ghani', 'position' => 'Pensyarah', 'email' => 'norahani.ghani@mara.gov.my', 'photo_path' => 'DLH/norahani.png'],
            ['department_code' => 'DLH', 'department' => 'JABATAN LANDSKAP DAN HORTIKULTUR (DLH)', 'lecturer_name' => 'Shahrizal B Hanafi', 'position' => 'Pensyarah', 'email' => 'shahrizal.hanapi@mara.gov.my', 'photo_path' => 'DLH/shahrizal.png'],
            ['department_code' => 'DLH', 'department' => 'JABATAN LANDSKAP DAN HORTIKULTUR (DLH)', 'lecturer_name' => 'Wan Intan Saadah Bt Wan Rosdi', 'position' => 'Pensyarah', 'email' => 'saadah.rosdi@mara.gov.my', 'photo_path' => 'DLH/intan_saadah.png'],
            ['department_code' => 'DLH', 'department' => 'JABATAN LANDSKAP DAN HORTIKULTUR (DLH)', 'lecturer_name' => 'Wan Norhamizah Bt Wan Zakaria', 'position' => 'Pensyarah', 'email' => 'nurhamizah.zakaria@mara.gov.my', 'photo_path' => 'DLH/wan_norhamizah.png'],
            ['department_code' => 'DBS', 'department' => 'JABATAN PENGURUSAN PERNIAGAAN (DBS)', 'lecturer_name' => 'Mohd Zaidan B Zahari', 'position' => 'Ketua Jabatan', 'email' => 'zaidan@mara.gov.my', 'photo_path' => 'DLH/zaidan_zahari.png'],
            ['department_code' => 'DBS', 'department' => 'JABATAN PENGURUSAN PERNIAGAAN (DBS)', 'lecturer_name' => 'Nor Farah Hani Bt Yahaya', 'position' => 'Pensyarah', 'email' => 'farah.yahaya@mara.gov.my', 'photo_path' => 'DBS/farah_hani.png'],
            ['department_code' => 'DBS', 'department' => 'JABATAN PENGURUSAN PERNIAGAAN (DBS)', 'lecturer_name' => 'Faizah Bt Idris', 'position' => 'Pensyarah', 'email' => 'faizah.idris@mara.gov.my', 'photo_path' => 'DBS/faizah_idris.png'],
            ['department_code' => 'DBS', 'department' => 'JABATAN PENGURUSAN PERNIAGAAN (DBS)', 'lecturer_name' => 'Intan Zeline Bt Nordin', 'position' => 'Pensyarah', 'email' => 'zeline@mara.gov.my', 'photo_path' => 'DBS/intan_zeline.png'],
            ['department_code' => 'DBS', 'department' => 'JABATAN PENGURUSAN PERNIAGAAN (DBS)', 'lecturer_name' => 'Nurdiyana B Mohd Hashim', 'position' => 'Pensyarah', 'email' => 'nurdiyana.hashim@mara.gov.my', 'photo_path' => 'DBS/nurdiyana.png'],
            ['department_code' => 'DBS', 'department' => 'JABATAN PENGURUSAN PERNIAGAAN (DBS)', 'lecturer_name' => 'Dr. Sharul Azlan B Maulod', 'position' => 'Pensyarah', 'email' => 'sharul.maulod@mara.gov.my', 'photo_path' => 'DBS/sharul_azlan.png'],
            ['department_code' => 'DBS', 'department' => 'JABATAN PENGURUSAN PERNIAGAAN (DBS)', 'lecturer_name' => 'Mohd Sabri B Jaafar', 'position' => 'Pensyarah', 'email' => 'sabri.jaffar@mara.gov.my', 'photo_path' => 'DBS/sabri_jaafar.png'],
            ['department_code' => 'DBS', 'department' => 'JABATAN PENGURUSAN PERNIAGAAN (DBS)', 'lecturer_name' => 'Norzelawati Bt Umar', 'position' => 'Pensyarah', 'email' => 'norzelawati.umar@mara.gov.my', 'photo_path' => 'DBS/norzelawati.png'],
            ['department_code' => 'DBS', 'department' => 'JABATAN PENGURUSAN PERNIAGAAN (DBS)', 'lecturer_name' => 'Zainal Abidin B Mustafa', 'position' => 'Pensyarah', 'email' => 'zainal.mustapa@mara.gov.my', 'photo_path' => 'DBS/zainal_abidin.png'],
            ['department_code' => 'DBS', 'department' => 'JABATAN PENGURUSAN PERNIAGAAN (DBS)', 'lecturer_name' => 'Nur Farhana Bt Md Marzuki', 'position' => 'Pensyarah', 'email' => 'farhana.marzuki@mara.gov.my', 'photo_path' => 'DBS/nurfarhana.png'],
            ['department_code' => 'DBS', 'department' => 'JABATAN PENGURUSAN PERNIAGAAN (DBS)', 'lecturer_name' => 'Rafidah Bt Yahya', 'position' => 'Pensyarah', 'email' => 'rafidah.yahya@mara.gov.my', 'photo_path' => 'DBS/rafidah.png'],
            ['department_code' => 'DBS', 'department' => 'JABATAN PENGURUSAN PERNIAGAAN (DBS)', 'lecturer_name' => 'Nadia Bt Abdullah Sani', 'position' => 'Pensyarah', 'email' => 'nadia.sani@mara.gov.my', 'photo_path' => 'DBS/nadia_sani.png'],
            ['department_code' => 'DBS', 'department' => 'JABATAN PENGURUSAN PERNIAGAAN (DBS)', 'lecturer_name' => 'Shajaratuldur Bt Ismail@Yahya', 'position' => 'Pensyarah', 'email' => 'shajaratuldur.ismail@mara.gov.my', 'photo_path' => 'DBS/shajaratuldur.png'],
            ['department_code' => 'DBS', 'department' => 'JABATAN PENGURUSAN PERNIAGAAN (DBS)', 'lecturer_name' => 'Tuan Nur Azyyati Bt Tuan Muhammad Kamal', 'position' => 'Pensyarah', 'email' => 'azyyati.kamal@mara.gov.my', 'photo_path' => 'DBS/nur_azyyati.png'],
            ['department_code' => 'DBS', 'department' => 'JABATAN PENGURUSAN PERNIAGAAN (DBS)', 'lecturer_name' => 'Siti Nur Samawati Bt Ahmad', 'position' => 'Pensyarah', 'email' => 'samawati.ahmad@mara.gov.my', 'photo_path' => 'DBS/samawati.png'],
            ['department_code' => 'DBS', 'department' => 'JABATAN PENGURUSAN PERNIAGAAN (DBS)', 'lecturer_name' => 'Siti Safina Bt Abu Bakar', 'position' => 'Pensyarah', 'email' => 'safina.bakar@mara.gov.my', 'photo_path' => 'DBS/siti_safina.png'],
            ['department_code' => 'DBS', 'department' => 'JABATAN PENGURUSAN PERNIAGAAN (DBS)', 'lecturer_name' => 'Muhammad Ridzuan B Zulkepory', 'position' => 'Pensyarah', 'email' => 'm.ridzuan@mara.gov.my', 'photo_path' => 'DBS/ridzuan.png'],
            ['department_code' => 'GSD', 'department' => 'JABATAN PENGAJIAN AM (GSD)', 'lecturer_name' => 'Adibah Bt Kasim', 'position' => 'Ketua Jabatan', 'email' => 'adibah.kasim@mara.gov.my', 'photo_path' => 'GSD/adibah_kasim.png'],
            ['department_code' => 'GSD', 'department' => 'JABATAN PENGAJIAN AM (GSD)', 'lecturer_name' => 'Muhammad Sameer B Abd Wahab', 'position' => 'Pensyarah', 'email' => 'sameer.wahab@mara.gov.my', 'photo_path' => 'GSD/sameer.png'],
            ['department_code' => 'GSD', 'department' => 'JABATAN PENGAJIAN AM (GSD)', 'lecturer_name' => 'Syarifah Anis Hamaiza Bt Syed Osman Abadi', 'position' => 'Pensyarah', 'email' => 'hamaiza.osman@mara.gov.my', 'photo_path' => 'GSD/syarifah_anis.png'],
            ['department_code' => 'GSD', 'department' => 'JABATAN PENGAJIAN AM (GSD)', 'lecturer_name' => 'Chee Kai Yen', 'position' => 'Pensyarah', 'email' => 'chee.kaiyen@mara.gov.my', 'photo_path' => 'GSD/chee_kai_yen.png'],
            ['department_code' => 'GSD', 'department' => 'JABATAN PENGAJIAN AM (GSD)', 'lecturer_name' => 'Dr. Azwani Bt Ismail', 'position' => 'Pensyarah', 'email' => 'azwani@mara.gov.my', 'photo_path' => 'GSD/azwani.png'],
            ['department_code' => 'GSD', 'department' => 'JABATAN PENGAJIAN AM (GSD)', 'lecturer_name' => 'Nabilah Bt Abdul Ghani', 'position' => 'Pensyarah', 'email' => 'nabilah.ghani@mara.gov.my', 'photo_path' => 'GSD/nabilah_ghani.png'],
            ['department_code' => 'GSD', 'department' => 'JABATAN PENGAJIAN AM (GSD)', 'lecturer_name' => 'Norfadzieyatul Azielia Bt Zainuddin', 'position' => 'Pensyarah', 'email' => 'aziela@mara.gov.my', 'photo_path' => 'GSD/norfadzieyatul.png'],
            ['department_code' => 'GSD', 'department' => 'JABATAN PENGAJIAN AM (GSD)', 'lecturer_name' => 'Masuri Bt Masood', 'position' => 'Pensyarah', 'email' => 'masuri@mara.gov.my', 'photo_path' => 'GSD/masuri.png'],
            ['department_code' => 'GSD', 'department' => 'JABATAN PENGAJIAN AM (GSD)', 'lecturer_name' => 'Khairiah Bt Abdullah', 'position' => 'Pensyarah', 'email' => 'khairiah.abdullah@mara.gov.my', 'photo_path' => 'GSD/khairiah.png'],
            ['department_code' => 'GSD', 'department' => 'JABATAN PENGAJIAN AM (GSD)', 'lecturer_name' => 'Muhammad Izzuddin B Johari', 'position' => 'Pensyarah', 'email' => 'izzuddin.johari@mara.gov.my', 'photo_path' => 'GSD/muhd_izzuddin.png'],
            ['department_code' => 'GSD', 'department' => 'JABATAN PENGAJIAN AM (GSD)', 'lecturer_name' => 'Norhazwani Bt Rahman', 'position' => 'Pensyarah', 'email' => 'norhazwani@mara.gov.my', 'photo_path' => 'GSD/norhazwani.png'],
            ['department_code' => 'GSD', 'department' => 'JABATAN PENGAJIAN AM (GSD)', 'lecturer_name' => 'Noridayu Bt Yusoff', 'position' => 'Pensyarah', 'email' => 'noridayu.yusuf@mara.gov.my', 'photo_path' => 'GSD/noridayu.png'],
            ['department_code' => 'GSD', 'department' => 'JABATAN PENGAJIAN AM (GSD)', 'lecturer_name' => 'Nurfatihah Bt Mohd Zawawi', 'position' => 'Pensyarah', 'email' => 'nurfatihah@mara.gov.my', 'photo_path' => 'GSD/nurfatihah.png'],
            ['department_code' => 'GSD', 'department' => 'JABATAN PENGAJIAN AM (GSD)', 'lecturer_name' => 'Norzaidatulnadiyah Bt Azman', 'position' => 'Pensyarah', 'email' => 'norzaidatulnadiyah@mara.gov.my', 'photo_path' => 'GSD/nurzaidatulnadiyah.png'],
            ['department_code' => 'GSD', 'department' => 'JABATAN PENGAJIAN AM (GSD)', 'lecturer_name' => 'Riani Bt Awang', 'position' => 'Pensyarah', 'email' => 'riani@mara.gov.my', 'photo_path' => 'GSD/riani_awang.png'],
            ['department_code' => 'GSD', 'department' => 'JABATAN PENGAJIAN AM (GSD)', 'lecturer_name' => 'Syafiqah Bt Osman', 'position' => 'Pensyarah', 'email' => 'syafiqah@mara.gov.my', 'photo_path' => 'GSD/syafiqah_osman.png'],
            ['department_code' => 'GSD', 'department' => 'JABATAN PENGAJIAN AM (GSD)', 'lecturer_name' => 'Wan Muzakir B Wan Najmi', 'position' => 'Pensyarah', 'email' => 'muzakir.najmi@mara.gov.my', 'photo_path' => 'GSD/wan_muzakir.png'],
            ['department_code' => 'GSD', 'department' => 'JABATAN PENGAJIAN AM (GSD)', 'lecturer_name' => 'Wan Nurul Aishah Bt Narruddin', 'position' => 'Pensyarah', 'email' => 'aishah.narruddin@mara.gov.my', 'photo_path' => 'GSD/nurul_aisyah.png'],
            ['department_code' => 'GSD', 'department' => 'JABATAN PENGAJIAN AM (GSD)', 'lecturer_name' => 'Yusni Bt Mohamed Azhari', 'position' => 'Pensyarah', 'email' => 'yusni.azhari@mara.gov.my', 'photo_path' => 'GSD/yusni.png'],
            ['department_code' => 'GSD', 'department' => 'JABATAN PENGAJIAN AM (GSD)', 'lecturer_name' => 'Mohd Taufek B Mohd Noh', 'position' => 'Pensyarah', 'email' => 'taufek@mara.gov.my', 'photo_path' => 'GSD/taufek.png'],
            ['department_code' => 'DIA', 'department' => 'JABATAN PERAKAUNAN (DIA)', 'lecturer_name' => 'Norfarhan', 'position' => 'Pensyarah', 'email' => 'norfarhan@beranang.kpm.edu.my', 'photo_path' => 'DIA/norfarhan.png'],
            ['department_code' => 'DSC', 'department' => 'JABATAN SAINS KUANTITATIF (DSC)', 'lecturer_name' => 'Suriyani Sahar', 'position' => 'Pensyarah', 'email' => 'suriyani.sahar@mara.gov.my', 'photo_path' => 'DSC/suriyani_sahar.png'],
            ['department_code' => 'DBS', 'department' => 'JABATAN PENGURUSAN PERNIAGAAN (DBS)', 'lecturer_name' => 'Siti Hajar', 'position' => 'Pensyarah', 'email' => 'hajar.hussin@mara.gov.my', 'photo_path' => 'DBS/siti_hajar.png'],
        ];

        // Remove records excluded from the final directory before syncing the list.
        LecturerDirectory::whereIn('lecturer_name', [
            'Azlina Bt Mokhtar',
            'Rohaida Bt Harun',
            'Maslina Bt Mohamad Mustafa',
        ])->delete();

        foreach ($records as $record) {
            LecturerDirectory::updateOrCreate(
                [
                    'department_code' => $record['department_code'],
                    'email' => $record['email'],
                ],
                $record
            );
        }
    }
}
