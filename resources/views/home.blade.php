@extends('layouts.app')
@section('title', 'Accueil')

@section('sidebar')
    @parent
@endsection

@section('content')
    <div class="flex justify-center pt-10">
        <div class="flex space-x-20">
            <img src="images/cloudy.svg" width="500" height="500">
            <div>
                <h1 class="text-10xl text-main font-semibold">Toudou</h1>
                <div class="text-light font-semibold text-8xl">
                    <h1>Organisez vos tâches</h1>
                    <h1>en toute simplicité</h1>
                </div>
                <div class="flex justify-center pt-10">

                    @auth
                        <button onclick="window.location.href='/projects'" type="button"
                            class="focus:outline-none font-bold text-white text-5xl py-7 px-24 border-b-4 border-black-600 rounded-full bg-light hover:bg-blue-400 mr-16">Mes
                            projets</button>

                        <button onclick="toggleDarkMode()" type="button"
                            class="focus:outline-none font-bold text-white text-5xl py-7 px-10 border-b-4 border-black-600 rounded-full bg-black hover:bg-blue-200 ml-8 mr-28">Switch mode sombre</button>

                    @endauth
                    @guest
                        <button onclick="window.location.href='/register'" type="button"
                            class="focus:outline-none font-bold text-white text-5xl py-7 px-24 border-b-4 border-black-600 rounded-full bg-light hover:bg-blue-400 mr-16">Commencer</button>
                        <button onclick="window.location.href='/register'" type="button"
                            class="focus:outline-none font-bold text-white text-5xl py-7 px-10 border-b-4 border-black-600 rounded-full bg-blue-200 hover:bg-blue-200 ml-8 mr-28">J'ai
                            déjà un compte</button>
                    @endguest

                </div>

            </div>
        </div>
    </div>
@endsection

@section('scripts')

<script>
    const html = document.getElementsByTagName('html')[0];    

    function toggleDarkMode() {
        console.log("test " + localStorage.getItem("darkmode"));
        if(localStorage.getItem("darkmode") !== null && localStorage.getItem("darkmode") === 'true') {
            console.log("remove");
            html.classList.remove('dark');
            localStorage.setItem('darkmode', 'false');
        } else {
            console.log("add");
            html.classList.add('dark');
            localStorage.setItem('darkmode', 'true');
        }
    }
</script>
    
@endsection
