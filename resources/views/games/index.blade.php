<x-app-layout>
    <x-slot name="header">
        Game collection</x-slot>
    <x-slot name="header_text">
        Game collection on how to 100% games</x-slot>
        <main>
            <form method="get" action="{{ route('games.index') }}" class="mb-6">
                <div class="flex gap-5 justify-end">
                    <input type="text"
                           name="name"
                           value="{{ request('name') }}"
                           placeholder="Search games..."
                           class=" px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">

                    <select name="genre"
                            class="px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        <option value="">All Genres</option>
                        @foreach($genres as $genre)
                            <option value="{{ $genre->id }}" {{ request('genre') == $genre->id ? 'selected' : '' }}>
                                {{ $genre->name }}
                            </option>
                        @endforeach
                    </select>

                    <button type="submit"
                            class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-md transition-colors">
                        Search
                    </button>

                    @if(request()->anyFilled(['name', 'genre']))
                        <a href="{{ route('games.index') }}"
                           class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md transition-colors">
                            Clear
                        </a>
                    @endif
                </div>
            </form>

    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($games as $game)
                @if($game->validation_check === 0)

                    @else
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $game->name }}</h3>
                        <h4>{{$game->genre->name}}</h4>

                        <p class="text-gray-600 mb-4 line-clamp-3">
                            {{ Str::limit($game->description, 50) }}
                        </p>

                        <div class="flex justify-between items-center mb-4">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-gray-500 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span class="text-sm text-gray-700">{{ $game->time }} hours</span>
                            </div>

                            <div class="flex items-center">
                                <span class="text-sm text-gray-700 capitalize">{{ $game->difficulty }}</span>
                            </div>
                        </div>

                        <div class="flex space-x-2">
                            <a href="{{ route('games.show', $game) }}"
                               class="flex-1 text-center bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded-md transition-colors">
                                View Details
                            </a>
                        </div>
                    </div>
                </div>
                @endif
            @endforeach
        </div>

        @if($games->isEmpty())
            <div class="text-center py-12">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <h3 class="mt-2 text-lg font-medium text-gray-900">No games found</h3>
                <p class="mt-1 text-gray-500">Get started by adding your first game.</p>
            </div>
        @endif
    </div>
</main>
</x-app-layout>
