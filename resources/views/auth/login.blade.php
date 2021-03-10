@extends('layouts.app')
@section('title', 'connexion')

@section('content')
    <div class="flex justify-center pt-44">
        <div class="text-2xl text-light font-semibold">
            <form action="{{ route('login') }}" method="POST" class="shadow-lg rounded-3xl px-36 py-20">
                @csrf
                <h2 class="text-center text-4xl pb-10">Connexion</h2>

                <label for="username" class="flex inset-x-0 bottom-0">Adresse mail ou
                    identifiant</label>
                <input name="username" class="border-2 w-full rounded-md border-light text-lg" type="text"
                    placeholder="Votre email ou identifiant">

                <label for="password" class="mt-3 flex  mb-0 inset-x-0 bottom-0">Mot de passe</label>
                <input name="password" class="border-2 w-full rounded-md border-light text-lg" type="password"
                    placeholder="Votre mot de passe">

                <div class="pt-10">
                    <a href="/register" class="text-sm text-center font-normal text-light ">
                        <p> Vous n'avez pas de compte ? </p>
                        <p> Créer un compte </p>

                    </a>
                </div>

                @if ($errors->any())
                    <div>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="flex justify-center mt-8">
                <button
                    class="focus:outline-none font-bold text-white text-2xl py-4 px-10 border-b-8 rounded-full bg-light hover:bg-opacity-70">connexion</button>
                </div>
            </form>


        </div>

    </div>
@endsection
