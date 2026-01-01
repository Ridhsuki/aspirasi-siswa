@foreach ($aspirations as $aspiration)
    <tr class="hover:bg-gray-50">
        <td class="py-3 px-4 border-b text-sm text-gray-700">
            {{ $aspiration->created_at->format('d M Y, H:i') }}
        </td>
        <td class="py-3 px-4 border-b text-sm text-gray-700">
            <span class="font-semibold block truncate w-64">{{ $aspiration->content ?? '-' }}</span>
        </td>
        <td class="py-3 px-4 border-b text-sm text-gray-700">
            <a href="{{ route('aspirations.show', $aspiration->id) }}" class="text-blue-600 hover:underline">Lihat</a>
        </td>
    </tr>
@endforeach
