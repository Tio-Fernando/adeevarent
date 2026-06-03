    <div class="upload-card-wrapper">
        <div class="card-border border-2 border-gray-200 rounded-xl overflow-hidden transition-all hover:border-orange-300">

            <div class="preview-area hidden h-32 relative">
            </div>

            <div class="placeholder-area {{ $bg }} h-32 flex flex-col items-center justify-center gap-2 cursor-pointer"
                onclick="document.getElementById('file-{{ $field }}').click()">
                <svg class="w-8 h-8 {{ $iconColor }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 15a4 4 0 004 4h10a4 4 0 004-4M16 8l-4-4m0 0L8 8m4-4v12"/>
                </svg>
            </div>

            <div class="p-3 bg-white">
                <p class="text-xs font-semibold text-gray-700 mb-2 leading-tight">
                    {{ $label }}
                    @if($required)
                        <span class="text-red-500">*</span>
                    @endif
                </p>
                <label for="file-{{ $field }}"
                    class="upload-btn w-full flex items-center justify-center gap-2 bg-orange-500 hover:bg-orange-600 text-white text-xs font-bold px-3 py-2 rounded-xl cursor-pointer transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                    </svg>
                    Pilih File
                </label>
                <input type="file"
                    id="file-{{ $field }}"
                    name="{{ $field }}"
                    accept=".jpg,.jpeg,.png,.pdf"
                    class="hidden"
                    {{ $required ? 'required' : '' }}>
            </div>
        </div>
    </div>