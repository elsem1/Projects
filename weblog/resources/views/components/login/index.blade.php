@extends('layouts.app')


@section('content')


<section class="bg-gray-50 min-h-screen flex items-center justify-center">
    <!--Login container-->
    <div class="bg-[#7ad3f62a] flex rounded-2xl shadow-lg max-w-3xl p-4">
        <!--Form-->
        <div class="sm:w-1/2 px-16">
            <h2 class="font-bold text-2xl text-[#4527a5] text-center">Login</h2>
            <p class="text-sm mt-7 text-[#6c57b1] text-opacity-70 text-center">If you already a member, easily log in</p>

            <!--Data entry group-->
            <form class="flex flex-col gap-4" action="">
                <input class="p-2 mt-8 rounded-xl border" type="text" name="email" placeholder="Your email">
                <div class="relative">
                    <input class="p-2 mt-8 rounded-xl border w-full" type="password" name="password" placeholder="Your password">

                    <!--SVG Eye-->
                    <svg class="bi bi-eye-fill absolute top-1/2 right-4 
                    translate-y-1/2" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="gray" viewBox="0 0 16 16">
                        <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                        <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                      </svg>
                </div>
                
                <button class="Login-button rounded-xl text-white py-2">Login</button>
            </form>

            <div class="mt-10 grid grid-cols-3 items-center text-gray-400">
                <hr class="border-gray-400">
                <p class="text-center text-sm">OR</p>
                <hr class="border-gray-400">
            </div>

            <button class="bg-white border py-2 w-full rounded-xl mt-5 flex justify-center text-sm">
                <img class="w-6 mr-3" src="./img/google_logo_icon.png" alt="">                
                Login width Google
            </button>

            <p class="mt-5 text-xs border-b border-gray-400 py-4">
               <a href="">Forgot Your password?</a>
            </p>

            <div class="mt-3 text-xs flex justify-between items-cente">
                <p>
                    <a href="#">If you dont't have an account?</a>
                </p>
                <button class="py-2 px-5 bg-white border rounded-xl">Register</button>
            </div>
        </div>

        <!--Image-->
        <div class="sm:block hidden w-1/2">
            <img class="sm:block hidden rounded-2xl" src="./img/login.jpeg" alt="img-login">
        </div>
    </div>
<!--===============-->
</section>


@endsection