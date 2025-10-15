<x-app-layout>
    <h1>Hello world</h1>
    @foreach ($games as $game)
        <h3>{{$game->name}}</h3>
        <p>{{$game->description}}</p>
{{--        zou een cutoff van de description mogelijk zijn waarbij je kort text ziet--}}
{{--        en erop moet klikken om verder te lezen? opzoeken--}}
        <p>{{$game->time}} hours to complete with a {{$game->difficulty}} difficulty rating</p>
        <a href="{{ route('games.show', $game) }}">View Details</a>
    @endforeach
</x-app-layout>
