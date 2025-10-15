<x-app-layout>
    <h1>Hello world</h1>
    <h3>{{$games[0]->name}}</h3>
    <p>{{$games[0]->description}}</p>
{{--    zou een cutoff van de description mogelijk zijn waarbij je kort text ziet
        en erop moet klikken om verder te lezen? opzoeken--}}
    <p>{{$games[0]->time}} hours to complete with a {{$games[0]->difficulty}} difficulty rating</p>
</x-app-layout>
