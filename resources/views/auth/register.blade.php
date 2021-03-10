@extends('layouts.app')
@section('title', 'inscription')


@section('content')
    <div class="flex justify-center pt-32">
        <div class="text-2xl text-light font-semibold">
            <form action="{{ route('register') }}" method="POST" name="login" class="shadow-lg rounded-3xl px-36 py-20">
                @csrf
                <h2 class="text-center text-4xl pb-10">Inscription</h2>

                <label for="email" class="flex inset-x-0 bottom-0">Email</label>
                <input name="email" class="border-2 w-full rounded-md border-light text-lg" type="email"
                    placeholder="toudou@cloud.com">

                <label for="username" class="mt-3 flex mb-0 inset-x-0 bottom-0">Nom d'utilisateur </label>
                <input name="username" class="border-2 w-full rounded-md border-light text-lg" type="text"
                    placeholder="toudou.man">

                <label for="surname" class="mt-3 flex mb-0 inset-x-0 bottom-0">Votre petit prénom </label>
                <input name="surname" class="border-2 w-full rounded-md border-light text-lg" type="text"
                    placeholder="Mercure">

                <label for="name" class="mt-3 flex mb-0 inset-x-0 bottom-0">Votre petit nom</label>
                <input name="name" class="border-2 w-full rounded-md border-light text-lg" type="text" placeholder="Freddy">

                <label for="password" class="mt-3 flex mb-0 inset-x-0 bottom-0">Mot de passe</label>
                <input name="password" class="border-2 w-full rounded-md border-light text-lg" type="password"
                    placeholder="mot de passe">

                <label for="password_confirmation" class="mt-3 flex mb-0 inset-x-0 bottom-0">Confirmation mot de
                    passe</label>
                <input name="password_confirmation" class="border-2 w-full rounded-md border-light text-lg" type="password"
                    placeholder="confirmation mot de passe">

                <div class="pt-10">
                    <a href="/login" class="text-sm text-center font-normal text-light ">
                        <p> Vous disposez déjà d'un compte ? </p>
                        <p> Connectez-vous</p>

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
                        class="focus:outline-none font-bold text-white text-2xl py-4 px-10 border-b-8 rounded-full bg-light hover:bg-opacity-70">inscription</button>
                </div>
            </form>


        </div>

    </div>
@endsection
