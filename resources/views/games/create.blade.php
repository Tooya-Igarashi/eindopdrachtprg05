<x-app-layout>
    <div class="max-w-2xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <div class="bg-white shadow-sm rounded-lg p-6">
            <h1 class="text-2xl font-bold text-gray-900 mb-6">Add New Game</h1>

            <form method="post" action="{{ route('games.store') }}" class="space-y-6">
                @csrf

                <!-- Name Field -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Game Name</label>
                    <input type="text"
                           name="name"
                           id="name"
                           value="{{ old('name') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                           placeholder="Enter game name">
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Genre Field -->
                <div>
                    <label for="genre_id" class="block text-sm font-medium text-gray-700 mb-2">Genre</label>
                    <select name="genre_id"
                            id="genre_id"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                        @foreach($genres as $genre)
                            <option value="{{ $genre->id }}" {{ old('genre_id') == $genre->id ? 'selected' : '' }}>
                                {{ $genre->name }}
                            </option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('genre_id')" class="mt-2" />
                </div>

                <!-- Description Field -->
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                    <textarea name="description"
                              id="description"
                              rows="4"
                              class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                              placeholder="Enter game description">{{ old('description') }}</textarea>
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>

                <!-- Trophies Field -->
                <div>
                    <label for="trophies" class="block text-sm font-medium text-gray-700 mb-2">Number of Trophies</label>
                    <input type="number"
                           name="trophies"
                           id="trophies"
                           value="{{ old('trophies') }}"
                           min="0"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                           placeholder="Enter number of trophies">
                    <x-input-error :messages="$errors->get('trophies')" class="mt-2" />
                </div>

                <!-- Time Field -->
                <div>
                    <label for="time" class="block text-sm font-medium text-gray-700 mb-2">Time to Complete (hours)</label>
                    <input type="number"
                           name="time"
                           id="time"
                           value="{{ old('time') }}"
                           min="0"
                           step="0.5"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                           placeholder="Enter completion time in hours">
                    <x-input-error :messages="$errors->get('time')" class="mt-2" />
                </div>

                <div>
                    <label for="difficulty" class="block text-sm font-medium text-gray-700 mb-2">difficulty</label>
                    <input type="text"
                           name="difficulty"
                           id="difficulty"
                           value="{{ old('difficulty') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                           placeholder="Enter difficulty out of 10">
                    <x-input-error :messages="$errors->get('difficulty')" class="mt-2" />
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end space-x-4">
                    <a href="{{ route('games.index') }}"
                       class="bg-gray-500 hover:bg-gray-600 text-white font-medium py-2 px-6 rounded-md transition-colors duration-300">
                        Cancel
                    </a>
                    <button type="submit"
                            class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-6 rounded-md transition-colors duration-300">
                        Create Game
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
