<div class="bg-white rounded-xl shadow-md overflow-hidden mb-6">
    <div class="p-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <!-- Kiri: Judul dan Subjudul + Button -->
            <div class="flex w-full items-center justify-between gap-4">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800 leading-tight">{{ $title }}</h1>
                    <p class="text-sm text-gray-500">{{ $subtitle }}</p>
                </div>
                @if(isset($button))
                    <a href="{{ $button['url'] }}"
                        class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded-lg hover:bg-blue-700 transition-all gap-2">
                         {!! $button['icon'] ?? '' !!}
                         {{ $button['label'] }}
                    </a>
                @endif
            </div>
        </div>
        @if(isset($search))
            <div class="mt-4 flex justify-end">
            <form action="{{ $search['action'] }}" method="GET" class="md:w-64 w-auto flex gap-2">
                <input
                type="text"
                name="{{ $search['name'] }}"
                value="{{ request($search['name']) }}"
                placeholder="{{ $search['placeholder'] }}"
                class="w-full border border-gray-300 text-sm rounded-lg px-4 py-2 focus:ring-blue-500 focus:border-blue-500"
                />
                <button type="submit"
                class="px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded-lg hover:bg-blue-700 transition-all flex items-center gap-1">
                Cari
                </button>
                <a href="{{ $search['action'] }}"
                class="px-4 py-2 bg-gray-200 text-gray-700 text-sm font-semibold rounded-lg hover:bg-gray-300 transition-all flex items-center gap-1">
                Reset
                </a>
            </form>
            </div>
        @endif

    </div>
</div>
