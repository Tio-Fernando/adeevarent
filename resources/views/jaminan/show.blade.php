<x-user>
<div class="min-h-screen bg-[#F8FAFC] py-8 px-4 font-sans">
<div class="max-w-5xl mx-auto">

    <div class="mb-8">
        <a href="{{ url()->previous() }}" class="group inline-flex items-center text-gray-500 hover:text-orange-500 transition mb-6 bg-white px-4 py-2 rounded-full shadow-sm border border-gray-100">
            <svg class="w-4 h-4 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali
        </a>

        <div class="bg-gradient-to-r from-orange-500 to-orange-600 rounded-2xl p-6 text-white mb-6 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-32 h-32 bg-white opacity-10 rounded-full -translate-y-10 translate-x-10"></div>
            <div class="absolute bottom-0 left-20 w-20 h-20 bg-white opacity-5 rounded-full translate-y-8"></div>
            <h1 class="text-2xl font-black tracking-tight mb-3">Persyaratan Jaminan Rental</h1>
            <div class="flex gap-4 text-sm">
                <span class="flex items-center gap-1.5 bg-white/20 px-3 py-1 rounded-full">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    8 Dokumen
                </span>
                <span class="flex items-center gap-1.5 bg-white/20 px-3 py-1 rounded-full">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                    5 MB Maks.
                </span>
                <span class="flex items-center gap-1.5 bg-white/20 px-3 py-1 rounded-full">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    8 Wajib
                </span>
            </div>
        </div>

    <div class="bg-orange-50 border border-orange-200 rounded-xl p-4 mb-6 flex gap-3">
        <svg class="w-5 h-5 text-orange-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        <div>
            <p class="text-sm font-bold text-orange-700">Informasi Keamanan Dokumen</p>
            <p class="text-xs text-orange-600 mt-0.5">Data yang Anda unggah akan digunakan sepenuhnya hanya untuk proses verifikasi rental. Kami menjamin kerahasiaan data sesuai kebijakan privasi.</p>
        </div>
    </div>

    <form action="{{ route('jaminan.store', $sewa->id_tr_sewa) }}" method="POST" enctype="multipart/form-data" id="formJaminan">
        @csrf

        @if($errors->any())
        <div class="bg-red-50 border border-red-200 rounded-xl p-4 mb-6">
            <ul class="text-sm text-red-600 space-y-1">
                @foreach($errors->all() as $error)
                    <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 bg-red-500 rounded-full"></span>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            <div class="lg:col-span-2 space-y-6">

                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="font-bold text-gray-900 text-base">Dokumen Identitas</h2>
                        <span class="text-xs font-bold text-red-500 bg-red-50 px-2 py-1 rounded-full border border-red-200">WAJIB</span>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        
                        <div class="flex flex-col gap-2">
                            <div class="w-full h-32 bg-gray-100 rounded-xl border border-gray-200 relative overflow-hidden group p-2">
                                <span class="absolute top-1.5 left-1.5 bg-black/60 text-white text-[9px] font-bold px-2 py-0.5 rounded shadow-sm z-10">CONTOH KTP</span>
                                <img src="{{ asset('img/contoh_ktp.jpeg') }}" alt="Contoh KTP" class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-300">
                            </div>
                            @include('jaminan.partials.upload-card', [
                                'field' => 'ktp',
                                'label' => 'KTP (Elektronik)',
                                'required' => true,
                                'bg' => 'bg-blue-50',
                                'iconColor' => 'text-blue-400'
                            ])
                        </div>

                        <div class="flex flex-col gap-2">
                            <div class="w-full h-32 bg-gray-100 rounded-xl border border-gray-200 relative overflow-hidden group p-2">
                                <span class="absolute top-1.5 left-1.5 bg-black/60 text-white text-[9px] font-bold px-2 py-0.5 rounded shadow-sm z-10">CONTOH KK</span>
                                <img src="{{ asset('img/contoh_kk.jpeg') }}" alt="Contoh KK" class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-300">
                            </div>
                            @include('jaminan.partials.upload-card', [
                                'field' => 'kk',
                                'label' => 'Kartu Keluarga (KK)',
                                'required' => true,
                                'bg' => 'bg-green-50',
                                'iconColor' => 'text-green-400'
                            ])
                        </div>

                    </div>
                </div>

                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="font-bold text-gray-900 text-base">Dokumen Keuangan</h2>
                        <span class="text-xs font-bold text-red-500 bg-red-50 px-2 py-1 rounded-full border border-red-200">WAJIB</span>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        
                        <div class="flex flex-col gap-2">
                            <div class="w-full h-32 bg-gray-100 rounded-xl border border-gray-200 relative overflow-hidden group p-2">
                                <span class="absolute top-1.5 left-1.5 bg-black/60 text-white text-[9px] font-bold px-2 py-0.5 rounded shadow-sm z-10">CONTOH MUTASI</span>
                                <img src="{{ asset('img/contoh_mutasi.jpeg') }}" onerror="this.src='https://placehold.co/400x250/e2e8f0/64748b?text=Contoh+Mutasi'" class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-300">
                            </div>
                            @include('jaminan.partials.upload-card', [
                                'field' => 'rekening',
                                'label' => 'Mutasi Rekening (3 Bln)',
                                'required' => true,
                                'bg' => 'bg-yellow-50',
                                'iconColor' => 'text-yellow-500'
                            ])
                        </div>

                        <div class="flex flex-col gap-2">
                            <div class="w-full h-32 bg-gray-100 rounded-xl border border-gray-200 relative overflow-hidden group p-2">
                                <span class="absolute top-1.5 left-1.5 bg-black/60 text-white text-[9px] font-bold px-2 py-0.5 rounded shadow-sm z-10">CONTOH LISTRIK</span>
                                <img src="{{ asset('img/contoh_listrik.jpeg') }}" onerror="this.src='https://placehold.co/400x250/e2e8f0/64748b?text=Contoh+Listrik'" class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-300">
                            </div>
                            @include('jaminan.partials.upload-card', [
                                'field' => 'rekening_listrik',
                                'label' => 'Rekening Listrik/PBB',
                                'required' => true,
                                'bg' => 'bg-pink-50',
                                'iconColor' => 'text-pink-400'
                            ])
                        </div>

                    </div>
                </div>

                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="font-bold text-gray-900 text-base">Foto Pendukung</h2>
                        <span class="text-xs font-bold text-red-500 bg-red-50 px-2 py-1 rounded-full border border-red-200">WAJIB</span>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="flex flex-col gap-2">
                            <div class="w-full h-32 bg-gray-100 rounded-xl border border-gray-200 relative overflow-hidden group p-2">
                                <span class="absolute top-1.5 left-1.5 bg-black/60 text-white text-[9px] font-bold px-2 py-0.5 rounded shadow-sm z-10">CONTOH SIM A</span>
                                <img src="{{ asset('img/contoh_sim.jpeg') }}" onerror="this.src='https://placehold.co/400x250/e2e8f0/64748b?text=Contoh+SIM+A'" class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-300">
                            </div>
                            @include('jaminan.partials.upload-card', [
                                'field' => 'simA',
                                'label' => 'Foto SIM A',
                                'required' => true,
                                'bg' => 'bg-green-50',
                                'iconColor' => 'text-green-300'
                            ])
                        </div>
                        <div class="flex flex-col gap-2">
                            <div class="w-full h-32 bg-gray-100 rounded-xl border border-gray-200 relative overflow-hidden group p-2">
                                <span class="absolute top-1.5 left-1.5 bg-black/60 text-white text-[9px] font-bold px-2 py-0.5 rounded shadow-sm z-10">CONTOH MOTOR</span>
                                <img src="{{ asset('img/contoh_motor.jpeg') }}" onerror="this.src='https://placehold.co/400x250/e2e8f0/64748b?text=Contoh+Motor'" class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-300">
                            </div>
                            @include('jaminan.partials.upload-card', [
                                'field' => 'motor',
                                'label' => 'Foto Motor',
                                'required' => true,
                                'bg' => 'bg-blue-50',
                                'iconColor' => 'text-blue-300'
                            ])
                        </div>
                        
                        <div class="flex flex-col gap-2">
                            <div class="w-full h-32 bg-gray-100 rounded-xl border border-gray-200 relative overflow-hidden group p-2">
                                <span class="absolute top-1.5 left-1.5 bg-black/60 text-white text-[9px] font-bold px-2 py-0.5 rounded shadow-sm z-10">CONTOH RUMAH</span>
                                <img src="{{ asset('img/contoh_rumah.jpeg') }}" onerror="this.src='https://placehold.co/400x250/e2e8f0/64748b?text=Contoh+Rumah'" class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-300">
                            </div>
                            @include('jaminan.partials.upload-card', [
                                'field' => 'rumah',
                                'label' => 'Foto Depan Rumah',
                                'required' => true,
                                'bg' => 'bg-blue-50',
                                'iconColor' => 'text-blue-300'
                            ])
                        </div>

                        <div class="flex flex-col gap-2">
                            <div class="w-full h-32 bg-gray-100 rounded-xl border border-gray-200 relative overflow-hidden group p-2">
                                <span class="absolute top-1.5 left-1.5 bg-black/60 text-white text-[9px] font-bold px-2 py-0.5 rounded shadow-sm z-10">CONTOH SELFIE</span>
                                <img src="{{ asset('img/contoh_selfie.jpeg') }}" onerror="this.src='https://placehold.co/400x250/e2e8f0/64748b?text=Contoh+Selfie'" class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-300">
                            </div>
                            @include('jaminan.partials.upload-card', [
                                'field' => 'foto_wajah',
                                'label' => 'Foto Selfie',
                                'required' => true,
                                'bg' => 'bg-purple-50',
                                'iconColor' => 'text-purple-300'
                            ])
                        </div>

                    </div>
                </div>

            </div>

            <div class="space-y-4 sticky top-6 self-start">

                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
                    <h3 class="font-bold text-gray-900 mb-4">Status Dokumen</h3>
                    <div class="space-y-2.5" id="statusList">
                        @foreach([
                            ['field' => 'ktp', 'label' => 'KTP', 'required' => true],
                            ['field' => 'kk', 'label' => 'Kartu Keluarga', 'required' => true],
                            ['field' => 'rekening', 'label' => 'Mutasi Rekening', 'required' => true],
                            ['field' => 'rekening_listrik', 'label' => 'Rekening Listrik', 'required' => true],
                            ['field' => 'simA', 'label' => 'SIM A', 'required' => true],
                            ['field' => 'motor', 'label' => 'Selfie Motor', 'required' => true],
                            ['field' => 'rumah', 'label' => 'Foto Rumah', 'required' => true],
                            ['field' => 'foto_wajah', 'label' => 'Selfie KTP', 'required' => true],
                        ] as $doc)
                        <div class="flex items-center justify-between" id="status-{{ $doc['field'] }}">
                            <span class="text-sm text-gray-600">{{ $doc['label'] }}</span>
                            <span class="text-xs font-bold px-2 py-0.5 rounded-full
                                {{ $doc['required'] ? 'bg-red-50 text-red-500 border border-red-200' : 'bg-gray-100 text-gray-400' }}"
                                id="badge-{{ $doc['field'] }}">
                                Belum
                            </span>
                        </div>
                        @endforeach
                    </div>

                    <button type="submit" id="btnKirim"
                        class="mt-6 w-full bg-gray-200 text-gray-400 font-bold py-3 rounded-xl text-sm uppercase tracking-widest cursor-not-allowed transition-all"
                        disabled>
                        Kirim Dokumen
                    </button>
                    <p class="text-xs text-gray-400 text-center mt-2" id="submitHint">Lengkapi dokumen wajib untuk melanjutkan</p>
                </div>

                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
                    <h3 class="font-bold text-gray-900 mb-3">Panduan Upload</h3>
                    <div class="space-y-3">
                        @foreach([
                            'Pastikan hasil foto dokumen jelas & tidak blur.',
                            'Format file yang didukung: JPG, PNG, atau PDF.',
                            'Ukuran file maksimal per dokumen adalah 5MB.',
                            'Data akan diverifikasi dalam waktu maksimal 1×24 jam.',
                        ] as $i => $tip)
                        <div class="flex gap-3">
                            <div class="w-6 h-6 rounded-full bg-orange-500 text-white text-xs font-bold flex items-center justify-center shrink-0">{{ $i + 1 }}</div>
                            <p class="text-xs text-gray-600 leading-relaxed">{{ $tip }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </form>
</div>
</div>

<div id="imagePreviewModal" class="fixed inset-0 z-[60] hidden bg-black/90 flex items-center justify-center p-4 transition-opacity duration-300" onclick="closePreview()">
    <button type="button" class="absolute top-6 right-6 bg-white/20 hover:bg-white/40 text-white rounded-full p-2 transition">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
    </button>
    <img id="previewModalImg" src="" class="max-w-[90vw] max-h-[90vh] rounded-lg object-contain shadow-2xl" onclick="event.stopPropagation()">
</div>

<div class="hidden opacity-0 group-hover:opacity-100 bg-black/60 backdrop-blur-sm bg-white/20 hover:bg-white hover:text-gray-900 bg-red-500/80 hover:bg-red-500 border border-gray-200"></div>

<script>
const requiredFields = ['ktp', 'kk', 'rekening', 'rekening_listrik', 'rumah', 'foto_wajah'];
const uploadedFiles = {};

document.querySelectorAll('input[type="file"]').forEach(input => {
    input.addEventListener('change', function(e) {
        const field = this.name;
        const file = this.files[0];
        const card = this.closest('.upload-card-wrapper');
        const badge = document.getElementById(`badge-${field}`);
        const preview = card.querySelector('.preview-area');
        const placeholder = card.querySelector('.placeholder-area');

        if (file) {
            uploadedFiles[field] = true;

            if (badge) {
                badge.textContent = 'Selesai';
                badge.className = 'text-xs font-bold px-2 py-0.5 rounded-full bg-green-50 text-green-600 border border-green-200';
            }

            if (file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = e => {
                    preview.innerHTML = `
                        <div class="relative w-full h-full group rounded-xl overflow-hidden cursor-pointer">
                            <img src="${e.target.result}" class="w-full h-full object-cover">
                            
                            <div class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition-all duration-300 flex items-center justify-center gap-3 backdrop-blur-sm">
                                <button type="button" onclick="openPreview('${e.target.result}', event)" class="p-2 bg-white/20 hover:bg-white text-white hover:text-gray-900 rounded-full transition-colors" title="Lihat Gambar">
                                    <svg class="w-5 h-5 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                </button>
                                
                                <button type="button" onclick="removeFile('${field}', event)" class="p-2 bg-red-500/80 hover:bg-red-500 text-white rounded-full transition-colors" title="Hapus Gambar">
                                    <svg class="w-5 h-5 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            </div>
                        </div>`;
                    preview.classList.remove('hidden');
                    placeholder.classList.add('hidden');
                };
                reader.readAsDataURL(file);
            } else {
                preview.innerHTML = `
                    <div class="relative w-full h-full group rounded-xl overflow-hidden bg-gray-50 flex flex-col items-center justify-center gap-2 border border-gray-200">
                        <svg class="w-10 h-10 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        <p class="text-xs text-gray-600 font-semibold text-center truncate w-full px-2">${file.name}</p>
                        
                        <div class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition-all duration-300 flex items-center justify-center backdrop-blur-sm">
                            <button type="button" onclick="removeFile('${field}', event)" class="p-2 bg-red-500/80 hover:bg-red-500 text-white rounded-full transition-colors" title="Hapus File">
                                <svg class="w-5 h-5 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            </button>
                        </div>
                    </div>`;
                preview.classList.remove('hidden');
                placeholder.classList.add('hidden');
            }

            card.querySelector('.card-border').classList.add('border-green-400', 'bg-green-50/30');
            card.querySelector('.card-border').classList.remove('border-gray-200');

            const uploadLabel = card.querySelector('.upload-btn');
            if (uploadLabel) {
                uploadLabel.innerHTML = `
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                    </svg>
                    Ganti File`;
                uploadLabel.className = 'upload-btn w-full flex items-center justify-center gap-2 bg-green-500 hover:bg-green-600 text-white text-xs font-bold px-3 py-2 rounded-xl cursor-pointer transition';
            }
        }

        checkAllRequired();
    });
});

window.removeFile = function(field, event) {
    event.preventDefault(); 
    event.stopPropagation(); 
    
    const input = document.getElementById(`file-${field}`);
    const card = input.closest('.upload-card-wrapper');
    const badge = document.getElementById(`badge-${field}`);
    const preview = card.querySelector('.preview-area');
    const placeholder = card.querySelector('.placeholder-area');
    const uploadLabel = card.querySelector('.upload-btn');

    input.value = '';
    uploadedFiles[field] = false;

    preview.innerHTML = '';
    preview.classList.add('hidden');
    placeholder.classList.remove('hidden');

    card.querySelector('.card-border').classList.remove('border-green-400', 'bg-green-50/30');
    card.querySelector('.card-border').classList.add('border-gray-200');

    if (uploadLabel) {
        uploadLabel.innerHTML = `
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
            </svg>
            Pilih File`;
        uploadLabel.className = 'upload-btn w-full flex items-center justify-center gap-2 bg-orange-500 hover:bg-orange-600 text-white text-xs font-bold px-3 py-2 rounded-xl cursor-pointer transition';
    }

    if (badge) {
        badge.textContent = 'Belum';
        badge.className = 'text-xs font-bold px-2 py-0.5 rounded-full bg-red-50 text-red-500 border border-red-200';
    }

    checkAllRequired();
}

window.openPreview = function(src, event) {
    event.preventDefault();
    event.stopPropagation();
    document.getElementById('previewModalImg').src = src;
    document.getElementById('imagePreviewModal').classList.remove('hidden');
}

window.closePreview = function() {
    document.getElementById('imagePreviewModal').classList.add('hidden');
    document.getElementById('previewModalImg').src = '';
}

function checkAllRequired() {
    const allDone = requiredFields.every(f => uploadedFiles[f]);
    const btn = document.getElementById('btnKirim');
    const hint = document.getElementById('submitHint');

    if (allDone) {
        btn.disabled = false;
        btn.className = 'mt-6 w-full bg-orange-500 hover:bg-orange-600 active:scale-95 text-white font-bold py-3 rounded-xl text-sm uppercase tracking-widest transition-all shadow-lg shadow-orange-500/20';
        hint.textContent = 'Semua dokumen wajib telah dilengkapi ✓';
        hint.className = 'text-xs text-green-600 text-center mt-2 font-semibold';
    } else {
        btn.disabled = true;
        btn.className = 'mt-6 w-full bg-gray-200 text-gray-400 font-bold py-3 rounded-xl text-sm uppercase tracking-widest cursor-not-allowed transition-all';
        const remaining = requiredFields.filter(f => !uploadedFiles[f]).length;
        hint.textContent = `${remaining} dokumen wajib belum dilengkapi`;
        hint.className = 'text-xs text-gray-400 text-center mt-2';
    }
}
</script>
</x-user>