<x-app-layout>
<x-slot name="header">
{{$game->name}} details
</x-slot>

    {{$game->name}}
{{$game->description}}
{{$game->genre->name}}
</x-app-layout>
