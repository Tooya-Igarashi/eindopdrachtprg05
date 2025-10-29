<x-app-layout>
<x-slot name="header">
{{$game->name}} details
</x-slot>
    <x-slot name="header_text">
        view information on your post</x-slot>

    {{$game->name}}
{{$game->description}}
{{$game->genre->name}}
    @foreach($comments as $comment)
        <div class="border p-4 my-2">
            <h4 class="font-bold">{{ $comment->title }}</h4>
            <p>{{ $comment->contents }}</p>
            <p class="text-sm text-gray-500">By User #{{ $comment->user_id }}</p>
        </div>
    @endforeach

    <form method="POST" action="{{ route('storeComments') }}" class="max-w-lg mx-auto mt-8">
        @csrf
        <h3 class="text-xl font-bold mb-4">Add a Comment</h3>
        <input type="hidden" name="game_id" value="{{ $game->id }}">
        <div class="mb-4">
            <label for="title" class="block text-gray-700 font-bold mb-2">Title</label>
            <input type="text" name="title" id="title" class="w-full px-3 py-2 border rounded-md" required>
        </div>
        <div class="mb-4">
            <label for="contents" class="block text-gray-700 font-bold mb-2">Comment</label>
            <textarea name="contents" id="contents" rows="4" class="w-full px-3 py-2 border rounded-md" required></textarea>
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition-colors">Submit Comment</button>
    </form>

    @if($game->user_id === Auth::id())
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
    @endif
</x-app-layout>
