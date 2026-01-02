@foreach ($replies as $reply)
    <li class="py-4">
        <div class="flex space-x-3">
            <div class="flex-1 space-y-1">
                <div class="flex items-center justify-between">
                    <h3 class="text-sm font-medium">
                        Mengomentari:
                        <a href="{{ route('aspirations.show', $reply->aspiration_id) }}" class="hover:underline">
                            <span class="text-blue-600">
                                {{ $reply->aspiration->title ?? 'Aspirasi #' . $reply->aspiration_id }}
                            </span>
                        </a>
                    </h3>
                    <p class="text-sm text-gray-500">
                        {{ $reply->created_at->diffForHumans() }}</p>
                </div>
                <p class="text-sm text-gray-700 bg-gray-50 p-3 rounded-md">
                    "{{ $reply->content }}"
                </p>

                <div class="mt-2 text-right">
                    <form action="{{ route('replies.destroy', $reply->id) }}" method="POST"
                        class="inline delete-confirm" data-confirm-text="Hapus Komentar Ini?">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-xs text-red-500 hover:text-red-700">Hapus Komentar</button>
                    </form>
                </div>
            </div>
        </div>
    </li>
@endforeach
