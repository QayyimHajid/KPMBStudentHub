<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campus Facilities | KPMB Student Hub</title>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:wght@400;500;600;700&family=Source+Serif+4:opsz,wght@8..60,400;8..60,600&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <style>
        *{box-sizing:border-box} body{margin:0;background:#fcf9f8;color:#1c1b1b;font-family:'Hanken Grotesk',sans-serif}
        .student-facilities-shell{margin-left:18rem;min-height:100vh}.material-symbols-outlined{font-family:'Material Symbols Outlined';font-weight:normal;font-style:normal;font-size:1em;line-height:1;display:inline-flex;align-items:center;justify-content:center;white-space:nowrap;direction:ltr;font-feature-settings:'liga';-webkit-font-feature-settings:'liga';-webkit-font-smoothing:antialiased;font-variation-settings:'FILL' 0,'wght' 400,'GRAD' 0,'opsz' 24}
        .page-container{width:min(1280px,calc(100% - 48px));margin:0 auto}.hero{position:relative;overflow:hidden;background:#002147;color:#fff;border:1px solid #001b3d;border-radius:9px;box-shadow:0 8px 16px #00000018}
        .hero:before{content:'';position:absolute;right:-70px;top:-120px;width:340px;height:340px;border-radius:50%;background:#e9c34913;filter:blur(3px)}.gold{color:#e9c349}
        .category-pill{display:inline-flex;align-items:center;gap:7px;padding:9px 13px;border-radius:7px;background:#fff;color:#44474e;font-size:12px;font-weight:600;white-space:nowrap;box-shadow:0 1px 3px #00000008;transition:.15s}
        .category-pill:hover{background:#f0eded}.category-pill.active{background:#000a1e;color:#fff}.facility-card{background:#fff;border:1px solid #eeebea;border-radius:10px;overflow:hidden;display:flex;flex-direction:column;min-width:0}
        .facility-card.featured{border-top:4px solid #735c00}.facility-cover{width:100%;height:176px;object-fit:cover;background:#e5e2e1}.featured .facility-cover{height:100%;min-height:220px}
        .image-placeholder{height:176px;display:flex;flex-direction:column;gap:8px;align-items:center;justify-content:center;color:#74777f;background:linear-gradient(135deg,#f0eded,#e5e2e1)}.featured .image-placeholder{height:100%;min-height:220px}
        .open-gallery{border:0;background:transparent;color:inherit;padding:0;text-align:left;cursor:pointer;width:100%;display:block}.open-gallery:focus-visible,.category-pill:focus-visible,.modal-control:focus-visible{outline:3px solid #e9c349;outline-offset:3px}
        .detail-button{display:flex;align-items:center;justify-content:center;gap:8px;background:#eae7e7;color:#000a1e;border-radius:6px;padding:9px 12px;font-size:12px;font-weight:700;transition:.15s}.detail-button:hover{background:#000a1e;color:white}
        .side-panel{background:#fff;border:1px solid #f0eded;border-radius:10px;padding:18px}.modal-backdrop{position:fixed;inset:0;z-index:1000;background:#030a17d1;display:none;align-items:center;justify-content:center;padding:22px}.modal-backdrop.open{display:flex}.gallery-modal{width:min(1040px,100%);max-height:calc(100vh - 44px);overflow:auto;background:white;border-radius:16px;box-shadow:0 25px 80px #0005}.modal-image-wrap{position:relative;background:#071326;min-height:230px;display:flex;align-items:center;justify-content:center}.modal-image{display:block;max-width:100%;width:100%;max-height:62vh;object-fit:contain}.modal-control{position:absolute;border:1px solid #ffffff59;color:white;background:#030a17a6;border-radius:50%;width:44px;height:44px;display:inline-flex;align-items:center;justify-content:center;cursor:pointer}.modal-close{top:14px;right:14px}.modal-prev{left:14px;top:50%;transform:translateY(-50%)}.modal-next{right:14px;top:50%;transform:translateY(-50%)}.thumb{width:72px;height:54px;flex:0 0 auto;object-fit:cover;border-radius:7px;border:2px solid transparent;cursor:pointer}.thumb.active{border-color:#c6a64b}
        @media(max-width:800px){.student-facilities-shell{margin-left:0}.page-container{width:min(100% - 28px,1280px)}.featured .facility-cover,.featured .image-placeholder{min-height:190px}}@media(max-width:560px){.facility-cover,.image-placeholder{height:200px}.modal-backdrop{padding:8px}.gallery-modal{max-height:calc(100vh - 16px);border-radius:12px}.modal-image{max-height:48vh}}
    </style>
</head>
<body>
    @if (auth()->check() && auth()->user()->role === 'student')
        @include('student.partials.sidebar')
        <div class="student-facilities-shell">
    @endif
    @include('layouts.partials.visitor-topbar')

    <main class="page-container py-7 md:py-8 space-y-7" style="padding-top: 104px;">
        <section class="hero p-5 md:p-7 lg:p-8">
            <div class="relative z-10 flex flex-col gap-5">
                <div class="flex flex-wrap items-center justify-between gap-3">
                    <div class="flex flex-wrap items-center gap-2">
                        <span class="inline-flex items-center gap-2 rounded-md bg-[#fed65b] px-3 py-1.5 text-[10px] font-bold uppercase tracking-wider text-[#574500]"><span class="h-2 w-2 rounded-full bg-[#735c00]"></span>KPMB Student Hub • Direktori Fasiliti</span>
                        <span class="inline-flex items-center gap-1 rounded-md bg-white/15 px-3 py-1.5 text-xs font-semibold text-white"><span class="material-symbols-outlined text-sm gold">verified</span>Kemudahan Kampus</span>
                    </div>
                    <div class="flex flex-wrap gap-3 text-xs text-blue-100">
                        <span class="flex items-center gap-1"><span class="material-symbols-outlined text-sm gold">domain</span><strong class="text-white">{{ $facilities->total() }}</strong> Fasiliti</span>
                        <span class="opacity-50">•</span><span class="flex items-center gap-1"><span class="material-symbols-outlined text-sm gold">category</span><strong class="text-white">{{ $categories->count() }}</strong> Kategori</span>
                    </div>
                </div>
                <div class="max-w-3xl">
                    <h1 class="text-3xl font-bold leading-tight tracking-tight sm:text-4xl md:text-[42px]">Cari Fasiliti Kampus</h1>
                    <p class="mt-2 max-w-2xl font-['Source_Serif_4'] text-base leading-7 text-blue-100 md:text-lg">Terokai kemudahan di Kolej Profesional MARA Beranang dan lihat maklumat serta gambar fasiliti yang tersedia.</p>
                </div>
                <form action="{{ route('facilities.index') }}" method="GET" class="flex flex-col gap-2 rounded-xl bg-white p-1.5 shadow-lg sm:flex-row sm:items-center">
                    <div class="flex min-w-0 flex-1 items-center px-3 py-2"><span class="material-symbols-outlined mr-3 text-slate-500">search</span><input class="w-full border-0 bg-transparent p-0 text-sm text-[#000a1e] placeholder:text-slate-500 focus:ring-0" id="search" name="search" type="search" value="{{ $search }}" maxlength="100" placeholder="Cari nama fasiliti, kategori atau lokasi..."></div>
                    @if ($category !== '' && $category !== 'all')<input type="hidden" name="category" value="{{ $category }}">@endif
                    <button type="submit" class="flex shrink-0 items-center justify-center gap-2 rounded-lg bg-[#000a1e] px-5 py-3 text-sm font-bold text-white transition hover:bg-[#002147]"><span class="material-symbols-outlined text-base">explore</span>Cari</button>
                </form>
                <div class="flex flex-wrap items-center gap-2 text-xs"><span class="text-blue-200">Cadangan carian:</span>
                    @foreach (['Dewan','Makmal','Perpustakaan','Surau','Sukan'] as $suggestion)
                        <a href="{{ route('facilities.index', array_filter(['search' => $suggestion, 'category' => $category ?: null])) }}" class="rounded-full border border-white/10 bg-white/10 px-3 py-1 text-blue-50 transition hover:bg-white/20">{{ $suggestion }}</a>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="flex items-center gap-2 overflow-x-auto pb-1">
            <a class="category-pill {{ $category === '' || $category === 'all' ? 'active' : '' }}" href="{{ route('facilities.index', array_filter(['search' => $search ?: null])) }}"><span class="material-symbols-outlined text-sm">dashboard</span>Semua Fasiliti ({{ $facilities->total() }})</a>
            @foreach ($categories as $categoryName)
                <a class="category-pill {{ $category === $categoryName ? 'active' : '' }}" href="{{ route('facilities.index', array_filter(['search' => $search ?: null, 'category' => $categoryName])) }}"><span class="material-symbols-outlined text-sm">category</span>{{ $categoryName }}</a>
            @endforeach
        </section>

        <section class="grid grid-cols-1 items-start gap-5 lg:grid-cols-12 lg:gap-6">
            <div class="flex flex-col gap-5 lg:col-span-8">
                <div class="flex flex-wrap items-end justify-between gap-2"><div><h2 class="text-xl font-bold text-[#000a1e]">Fasiliti Kampus</h2><p class="mt-1 text-sm text-slate-500">Pilih kad untuk melihat galeri gambar dan butiran.</p></div><span class="text-xs font-semibold text-slate-500">{{ number_format($facilities->total()) }} hasil</span></div>
                @php $featuredFacility = $facilities->first(); @endphp
                @if ($featuredFacility)
                    @php $featuredGallery = $featuredFacility->images->map(fn ($image) => asset('storage/' . $image->image_path))->values(); $featuredPrimary = $featuredFacility->images->firstWhere('is_primary', true) ?? $featuredFacility->images->first(); @endphp
                    <article class="facility-card featured">
                        <div class="h-1.5 w-full bg-[#735c00]"></div>
                        <div class="grid grid-cols-1 items-stretch gap-4 p-3 md:grid-cols-12 md:gap-4">
                            <div class="relative overflow-hidden rounded-lg md:col-span-5">
                                <button type="button" class="open-gallery h-full" aria-label="Lihat galeri {{ $featuredFacility->facility_name }}" data-name="{{ $featuredFacility->facility_name }}" data-category="{{ $featuredFacility->facility_type }}" data-location="{{ $featuredFacility->location }}" data-description="{{ $featuredFacility->description ?? '' }}" data-hours="{{ $featuredFacility->operating_hours ?? '' }}" data-images="{{ $featuredGallery->toJson() }}">
                                    @if ($featuredPrimary)<img class="facility-cover" src="{{ asset('storage/' . $featuredPrimary->image_path) }}" alt="Gambar {{ $featuredFacility->facility_name }}" loading="lazy">@else<div class="image-placeholder"><span class="material-symbols-outlined text-4xl">location_city</span><span class="text-sm font-semibold">Gambar belum tersedia</span></div>@endif
                                    <span class="absolute left-2 top-2 rounded bg-[#000a1e] px-2 py-1 text-[10px] font-bold uppercase tracking-wide text-white">Fasiliti pilihan</span>
                                </button>
                            </div>
                            <div class="flex flex-col justify-between gap-3 md:col-span-7 md:py-1">
                                <div><div class="mb-2 flex flex-wrap items-center justify-between gap-2"><span class="text-xs font-bold uppercase tracking-wider text-[#735c00]">{{ $featuredFacility->facility_type }}</span><span class="rounded-full bg-blue-50 px-2.5 py-1 text-[10px] font-semibold text-blue-800">Kampus KPMB</span></div>
                                    <h3 class="text-2xl font-bold tracking-tight text-[#000a1e]">{{ $featuredFacility->facility_name }}</h3>
                                    <p class="mt-2 line-clamp-3 font-['Source_Serif_4'] text-sm leading-6 text-slate-600">{{ $featuredFacility->description ?: 'Maklumat lanjut untuk fasiliti ini belum tersedia.' }}</p>
                                    <div class="mt-3 flex flex-wrap gap-2"><span class="inline-flex items-center gap-1 rounded-md bg-[#f0eded] px-2 py-1.5 text-xs text-slate-700"><span class="material-symbols-outlined text-sm text-[#735c00]">location_on</span>{{ $featuredFacility->location ?: 'Lokasi belum disahkan' }}</span>@if($featuredFacility->operating_hours)<span class="inline-flex items-center gap-1 rounded-md bg-[#f0eded] px-2 py-1.5 text-xs text-slate-700"><span class="material-symbols-outlined text-sm text-[#735c00]">schedule</span>{{ $featuredFacility->operating_hours }}</span>@endif</div>
                                </div>
                                <button type="button" class="detail-button open-gallery" data-name="{{ $featuredFacility->facility_name }}" data-category="{{ $featuredFacility->facility_type }}" data-location="{{ $featuredFacility->location }}" data-description="{{ $featuredFacility->description ?? '' }}" data-hours="{{ $featuredFacility->operating_hours ?? '' }}" data-images="{{ $featuredGallery->toJson() }}"><span>Lihat panduan arah & butiran</span><span class="material-symbols-outlined text-sm">arrow_forward</span></button>
                            </div>
                        </div>
                    </article>
                @endif

                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    @forelse ($facilities->skip($featuredFacility ? 1 : 0) as $facility)
                        @php $gallery = $facility->images->map(fn ($image) => asset('storage/' . $image->image_path))->values(); $primaryImage = $facility->images->firstWhere('is_primary', true) ?? $facility->images->first(); @endphp
                        <article class="facility-card">
                            <button type="button" class="open-gallery" aria-label="Lihat galeri {{ $facility->facility_name }}" data-name="{{ $facility->facility_name }}" data-category="{{ $facility->facility_type }}" data-location="{{ $facility->location }}" data-description="{{ $facility->description ?? '' }}" data-hours="{{ $facility->operating_hours ?? '' }}" data-images="{{ $gallery->toJson() }}">
                                @if ($primaryImage)<div class="relative"><img class="facility-cover" src="{{ asset('storage/' . $primaryImage->image_path) }}" alt="Gambar {{ $facility->facility_name }}" loading="lazy"><span class="absolute left-2 top-2 rounded bg-white/90 px-2 py-1 text-[10px] font-bold text-[#000a1e]">{{ $facility->facility_type }}</span></div>@else<div class="image-placeholder"><span class="material-symbols-outlined text-4xl">location_city</span><span class="text-sm font-semibold">Gambar belum tersedia</span></div>@endif
                            </button>
                            <div class="flex flex-1 flex-col gap-3 p-4">
                                <div><h3 class="text-lg font-bold leading-snug text-[#000a1e]">{{ $facility->facility_name }}</h3><p class="mt-2 line-clamp-3 font-['Source_Serif_4'] text-sm leading-6 text-slate-600">{{ $facility->description ?: 'Maklumat lanjut untuk fasiliti ini belum tersedia.' }}</p></div>
                                <div class="mt-auto space-y-2 border-t border-slate-100 pt-3"><div class="flex items-start gap-2 text-xs text-slate-600"><span class="material-symbols-outlined text-base text-[#735c00]">location_on</span><span>{{ $facility->location ?: 'Lokasi belum disahkan' }}</span></div>@if($facility->operating_hours)<div class="flex items-start gap-2 text-xs text-slate-600"><span class="material-symbols-outlined text-base text-[#735c00]">schedule</span><span>{{ $facility->operating_hours }}</span></div>@endif
                                    <button type="button" class="detail-button open-gallery w-full" data-name="{{ $facility->facility_name }}" data-category="{{ $facility->facility_type }}" data-location="{{ $facility->location }}" data-description="{{ $facility->description ?? '' }}" data-hours="{{ $facility->operating_hours ?? '' }}" data-images="{{ $gallery->toJson() }}">Lihat panduan pelawat <span class="material-symbols-outlined text-sm">arrow_forward</span></button>
                                </div>
                            </div>
                        </article>
                    @empty
                        @if (!$featuredFacility)<div class="col-span-full rounded-xl border border-dashed border-slate-300 bg-white px-6 py-14 text-center"><span class="material-symbols-outlined text-4xl text-slate-400">search_off</span><h3 class="mt-3 text-lg font-bold text-slate-900">Tiada fasiliti ditemui</h3><p class="mt-2 text-sm text-slate-500">Cuba kata kunci lain atau pilih kategori berbeza.</p><a href="{{ route('facilities.index') }}" class="mt-4 inline-flex rounded-lg bg-[#000a1e] px-4 py-2 font-semibold text-white">Lihat semua fasiliti</a></div>@endif
                    @endforelse
                </div>
                @if ($facilities->hasPages())<div class="mt-2">{{ $facilities->links() }}</div>@endif
            </div>

            <aside class="flex flex-col gap-5 lg:col-span-4">
                <section class="side-panel space-y-4">
                    <div class="flex items-center gap-2"><span class="material-symbols-outlined text-[#735c00]">explore</span><h3 class="text-lg font-bold text-[#000a1e]">Peta Lokasi Kampus</h3></div>
                    <div class="flex min-h-44 flex-col items-center justify-center rounded-lg bg-[#f0eded] p-5 text-center"><span class="material-symbols-outlined text-4xl text-[#735c00]">map</span><p class="mt-2 text-sm font-semibold text-slate-700">Rujukan lokasi fasiliti</p><p class="mt-1 text-xs leading-5 text-slate-500">Pilih fasiliti untuk melihat maklumat lokasi yang direkodkan.</p></div>
                    <a href="{{ url('/campus-map') }}" class="detail-button w-full">Buka peta kampus <span class="material-symbols-outlined text-sm">arrow_forward</span></a>
                </section>
                <section class="side-panel space-y-4">
                    <div class="flex items-center gap-2"><span class="material-symbols-outlined text-[#735c00]">info</span><h3 class="text-lg font-bold text-[#000a1e]">Panduan Menggunakan Direktori</h3></div>
                    <p class="font-['Source_Serif_4'] text-sm leading-6 text-slate-600">Gunakan direktori ini untuk mencari kemudahan kampus dan menyemak maklumat yang tersedia.</p>
                    <div class="space-y-3 text-sm text-slate-700"><div class="flex items-start gap-3"><span class="flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-[#ffe088] text-xs font-bold text-[#574500]">1</span><p>Taip nama fasiliti, kategori atau lokasi pada ruangan carian.</p></div><div class="flex items-start gap-3"><span class="flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-[#ffe088] text-xs font-bold text-[#574500]">2</span><p>Pilih kategori untuk menapis senarai kemudahan.</p></div><div class="flex items-start gap-3"><span class="flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-[#ffe088] text-xs font-bold text-[#574500]">3</span><p>Tekan kad fasiliti untuk melihat gambar dan butiran lanjut.</p></div></div>
                </section>
                <section class="relative overflow-hidden rounded-xl bg-[#000a1e] p-5 text-white shadow-md"><div class="flex items-center gap-2"><span class="material-symbols-outlined gold">support_agent</span><h3 class="text-lg font-bold">Bantuan & Maklumat</h3></div><p class="mt-2 font-['Source_Serif_4'] text-sm leading-6 text-blue-100">Jika maklumat lokasi atau waktu operasi tidak dipaparkan, sila rujuk pihak kolej untuk pengesahan.</p><a href="https://beranang.kpm.edu.my/" target="_blank" rel="noopener noreferrer" class="mt-4 flex items-center justify-between rounded-lg bg-white/10 px-3 py-3 text-sm font-semibold text-white transition hover:bg-white/20"><span>Laman rasmi KPMB</span><span class="material-symbols-outlined text-base">open_in_new</span></a></section>
            </aside>
        </section>
    </main>
    @include('layouts.partials.visitor-footer')


    <div id="facilityGallery" class="modal-backdrop" role="dialog" aria-modal="true" aria-labelledby="modalTitle" aria-hidden="true">
        <div class="gallery-modal">
            <div class="modal-image-wrap">
                <img id="modalImage" class="modal-image" src="" alt="">
                <div id="modalNoImage" class="hidden px-6 py-20 text-center text-white"><span class="material-symbols-outlined text-5xl">image_not_supported</span><p class="mt-3">Gambar belum tersedia.</p></div>
                <button type="button" id="modalClose" class="modal-control modal-close" aria-label="Tutup galeri"><span class="material-symbols-outlined">close</span></button>
                <button type="button" id="modalPrev" class="modal-control modal-prev" aria-label="Gambar sebelumnya"><span class="material-symbols-outlined">chevron_left</span></button>
                <button type="button" id="modalNext" class="modal-control modal-next" aria-label="Gambar seterusnya"><span class="material-symbols-outlined">chevron_right</span></button>
            </div>
            <div class="p-5 md:p-7">
                <div class="flex flex-wrap items-start justify-between gap-3">
                    <div><span id="modalCategory" class="inline-flex rounded-full bg-amber-50 px-3 py-1 text-xs font-bold text-amber-800"></span><h2 id="modalTitle" class="mt-3 text-2xl font-bold text-slate-900"></h2></div>
                    <span id="imageCount" class="rounded-full bg-slate-100 px-3 py-2 text-xs font-bold text-slate-600">0 gambar</span>
                </div>
                <p id="modalDescription" class="mt-3 text-sm leading-6 text-slate-600"></p>
                <div class="mt-4 grid gap-3 sm:grid-cols-2">
                    <div class="rounded-xl bg-slate-50 p-4"><p class="text-xs font-bold uppercase tracking-wider text-slate-500">Lokasi</p><p id="modalLocation" class="mt-1 text-sm font-semibold text-slate-800"></p></div>
                    <div id="hoursWrap" class="rounded-xl bg-slate-50 p-4"><p class="text-xs font-bold uppercase tracking-wider text-slate-500">Waktu operasi</p><p id="modalHours" class="mt-1 text-sm font-semibold text-slate-800"></p></div>
                </div>
                <div id="thumbnailStrip" class="mt-5 flex gap-2 overflow-x-auto pb-1"></div>
                <p class="mt-3 text-xs text-slate-400">Gunakan anak panah untuk melihat gambar lain bagi fasiliti ini.</p>
            </div>
        </div>
    </div>


    @if (auth()->check() && auth()->user()->role === 'student')
        </div>
    @endif

    <script>
        (() => {
            const modal = document.getElementById('facilityGallery');
            const modalImage = document.getElementById('modalImage');
            const noImage = document.getElementById('modalNoImage');
            const title = document.getElementById('modalTitle');
            const category = document.getElementById('modalCategory');
            const description = document.getElementById('modalDescription');
            const locationText = document.getElementById('modalLocation');
            const hoursWrap = document.getElementById('hoursWrap');
            const hoursText = document.getElementById('modalHours');
            const count = document.getElementById('imageCount');
            const thumbnails = document.getElementById('thumbnailStrip');
            let images = [];
            let currentIndex = 0;
            let lastTrigger = null;

            function showImage(index) {
                if (!images.length) {
                    modalImage.classList.add('hidden');
                    noImage.classList.remove('hidden');
                    count.textContent = '0 gambar';
                    thumbnails.innerHTML = '';
                    document.getElementById('modalPrev').classList.add('hidden');
                    document.getElementById('modalNext').classList.add('hidden');
                    return;
                }
                currentIndex = (index + images.length) % images.length;
                modalImage.classList.remove('hidden');
                noImage.classList.add('hidden');
                modalImage.src = images[currentIndex];
                modalImage.alt = 'Gambar ' + title.textContent + ' ' + (currentIndex + 1);
                count.textContent = (currentIndex + 1) + ' / ' + images.length + ' gambar';
                document.getElementById('modalPrev').classList.toggle('hidden', images.length < 2);
                document.getElementById('modalNext').classList.toggle('hidden', images.length < 2);
                [...thumbnails.children].forEach((thumb, i) => thumb.classList.toggle('active', i === currentIndex));
            }

            function openGallery(trigger) {
                lastTrigger = trigger;
                images = [];
                try { images = JSON.parse(trigger.dataset.images || '[]'); } catch (error) { images = []; }
                title.textContent = trigger.dataset.name || 'Kemudahan kampus';
                category.textContent = trigger.dataset.category || '';
                description.textContent = trigger.dataset.description || 'Penerangan lanjut belum tersedia.';
                locationText.textContent = trigger.dataset.location || 'Belum disahkan';
                const hours = trigger.dataset.hours || '';
                hoursWrap.classList.toggle('hidden', !hours);
                hoursText.textContent = hours;
                thumbnails.innerHTML = '';
                images.forEach((src, index) => {
                    const thumb = document.createElement('img');
                    thumb.src = src;
                    thumb.alt = 'Thumbnail ' + (index + 1) + ' untuk ' + title.textContent;
                    thumb.className = 'thumb' + (index === 0 ? ' active' : '');
                    thumb.loading = 'lazy';
                    thumb.addEventListener('click', () => showImage(index));
                    thumbnails.appendChild(thumb);
                });
                modal.classList.add('open');
                modal.setAttribute('aria-hidden', 'false');
                document.body.style.overflow = 'hidden';
                showImage(0);
                document.getElementById('modalClose').focus();
            }

            function closeGallery() {
                modal.classList.remove('open');
                modal.setAttribute('aria-hidden', 'true');
                document.body.style.overflow = '';
                if (lastTrigger) lastTrigger.focus();
            }

            document.querySelectorAll('.open-gallery').forEach(button => button.addEventListener('click', () => openGallery(button)));
            document.getElementById('modalClose').addEventListener('click', closeGallery);
            document.getElementById('modalPrev').addEventListener('click', () => showImage(currentIndex - 1));
            document.getElementById('modalNext').addEventListener('click', () => showImage(currentIndex + 1));
            modal.addEventListener('click', event => { if (event.target === modal) closeGallery(); });
            document.addEventListener('keydown', event => {
                if (!modal.classList.contains('open')) return;
                if (event.key === 'Escape') closeGallery();
                if (event.key === 'ArrowLeft') showImage(currentIndex - 1);
                if (event.key === 'ArrowRight') showImage(currentIndex + 1);
            });
        })();
    </script>


    <script>
        (function () {
            // Keep the shared visitor header clock working on pages that include visitor-topbar.
            const days = ['Ahad', 'Isnin', 'Selasa', 'Rabu', 'Khamis', 'Jumaat', 'Sabtu'];
            const months = ['Jan', 'Feb', 'Mac', 'Apr', 'Mei', 'Jun', 'Jul', 'Ogo', 'Sep', 'Okt', 'Nov', 'Dis'];

            function updateKpmbClock() {
                const time = document.getElementById('kpmb-live-time');
                const date = document.getElementById('kpmb-live-date');
                if (!time && !date) return;

                const now = new Date();
                const parts = new Intl.DateTimeFormat('en-GB', {
                    timeZone: 'Asia/Kuala_Lumpur',
                    hour: '2-digit',
                    minute: '2-digit',
                    second: '2-digit',
                    hourCycle: 'h23',
                    day: '2-digit',
                    month: '2-digit',
                    year: 'numeric'
                }).formatToParts(now);
                const get = (type) => parts.find(part => part.type === type)?.value;
                const hours = Number(get('hour'));
                const minutes = Number(get('minute'));
                const seconds = Number(get('second'));
                const day = Number(get('day'));
                const month = Number(get('month')) - 1;
                const year = get('year');
                const weekday = new Intl.DateTimeFormat('en-US', {
                    timeZone: 'Asia/Kuala_Lumpur',
                    weekday: 'short'
                }).format(now);
                const weekdayIndex = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'].indexOf(weekday);

                if (time) {
                    const hour12 = hours % 12 || 12;
                    time.textContent = String(hour12).padStart(2, '0') + ':' +
                        String(minutes).padStart(2, '0') + ':' +
                        String(seconds).padStart(2, '0') + ' ' +
                        (hours >= 12 ? 'PM' : 'AM');
                }
                if (date) {
                    date.textContent = days[weekdayIndex] + ', ' + day + ' ' + months[month] + ' ' + year;
                }

                const secondHand = document.getElementById('analog-sec-hand');
                const minuteHand = document.getElementById('analog-min-hand');
                const hourHand = document.getElementById('analog-hour-hand');
                if (secondHand) secondHand.setAttribute('transform', 'rotate(' + (seconds * 6) + ' 50 50)');
                if (minuteHand) minuteHand.setAttribute('transform', 'rotate(' + (minutes * 6 + seconds * 0.1) + ' 50 50)');
                if (hourHand) hourHand.setAttribute('transform', 'rotate(' + ((hours % 12) * 30 + minutes * 0.5) + ' 50 50)');
            }

            updateKpmbClock();
            window.setInterval(updateKpmbClock, 1000);
        })();
    </script>

</body>
</html>
