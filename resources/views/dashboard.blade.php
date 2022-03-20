<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    You're logged in!
                </div>
                <div class="p-6 bg-white border-b border-gray-200">
                    Cosas Agregadas
                    <a href="{{route('token.showForm')}}">Mostrar Tokens</a>
                </div>
                <div class="p-6 bg-white border-b border-gray-200">
                    @if (count($tokens) > 0)
                        @foreach($tokens as $token)
                            Token Name: {{$token->name}}
                            <br>
                            Last Use: {{$token->last_used_at ? $token->last_used_at->diffForHumans():''}}
                            <br>
                            <form method="post" action="{{route('token.delete',['token'=>$token->id])}}">
                                @csrf
                                <input type="submit" value="Delete">
                            </form>
                        @endforeach
                    @else
                        No hay tokens.
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
