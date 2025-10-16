<x-app-layout>
<form method="post" action="{{ route('games.store') }}">
    @csrf
{{--    //errors tonen--}}
{{--    //beveiliging--}}
{{--    //data terug schrijven in de form fields--}}
    <label for="name">Name</label>
    <input type="text" name="name" id="name" >
    @error('name')
    <div class="alert-danger">{{ $message }}</div>
    @enderror

    <x-input-error :messages="$errors->first('name')"/>
    <br>

    <label for="genre_id">Genre</label>
    <select name="genre_id" id="">
        @foreach($genres as $genre)
            <option value="{{ $genre->id }}">{{ $genre->name }}</option>
        @endforeach

<br>
            <label for="description">Description</label>
    <input name="description" id="description" value="{{ old('description') }}">
    <br>

    <label for="trophies">trophies</label>
    <input type="number" name="trophies" id="trophies">
    <br>

    <label for="time">Time to complete</label>
    <input type="number" name="time" id="time">

    <input type ="submit" name="submit" value="Create">
</form>
</x-app-layout>
