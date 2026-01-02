@foreach ($aspirations as $aspiration)
    <tr class="hover:bg-gray-50">
        <td class="py-3 px-4 border-b text-sm text-gray-700">
            {{ $aspiration->created_at->format('d M Y, H:i') }}
        </td>
        <td class="py-3 px-4 border-b text-sm text-gray-700">
            <span class="font-semibold block truncate w-64">{{ $aspiration->content ?? '-' }}</span>
        </td>
        <td class="py-3 px-4 border-b text-center align-middle">
            @if ($aspiration->replies->count() > 0)
                <span
                    class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-blue-50 text-blue-600 border border-blue-100">
                    <i class="fa-regular fa-comments"></i>
                    {{ $aspiration->replies->count() }}
                </span>
            @else
                <span class="text-gray-300 text-xs">
                    <i class="fa-regular fa-comment"></i> 0
                </span>
            @endif
        </td>
        <td class="py-3 px-4 border-b text-center text-sm">
            <a href="{{ route('aspirations.show', $aspiration->id) }}"
                class="text-blue-600 hover:text-blue-800 bg-blue-50 hover:bg-blue-100 px-3 py-1.5 rounded-md transition text-xs font-bold inline-flex items-center gap-1">
                Lihat <i class="fa-solid fa-arrow-right"></i>
            </a>
        </td>
    </tr>
@endforeach
