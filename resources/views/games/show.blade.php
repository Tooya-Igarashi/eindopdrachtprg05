<x-app-layout>
<x-slot name="header">
{{$game->name}} details
</x-slot>
    <x-slot name="header_text">
        view information on your post</x-slot>

    {{$game->name}}
{{$game->description}}
{{$game->genre->name}}
    <a href="{{ route('games.edit', $game) }}"
       class="bg-gray-600 hover:bg-gray-700 text-white font-medium py-2 px-4 rounded-md transition-colors">
        Edit
    </a>
{{--    <a href="{{ route('games.destroy', $game) }}"--}}
{{--       class="bg-gray-600 hover:bg-gray-700 text-white font-medium py-2 px-4 rounded-md transition-colors">--}}
{{--        Delete post--}}
{{--    </a>--}}
    <form method="POST" action="{{ route('games.destroy', $game) }}" class="mt-4">
        @csrf
        @method('DELETE')
        <button type="submit"
                class="bg-red-600 hover:bg-red-700 text-white font-medium py-2 px-4 rounded-md transition-colors">
            Delete Game
        </button>
    </form>
</x-app-layout>
