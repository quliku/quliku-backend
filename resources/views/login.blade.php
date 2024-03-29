@extends('layout')
@section('title', 'Login Admin')

@section('content')

<div class="min-h-full flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <div>
            <img class="mx-auto h-12 w-auto" src="/images/logo-with-text-horizontal.png" alt="Workflow">
            <h2 class="mt-6 text-center text-xl tracking-tight font-bold text-black-primary">Login Admin Quliku</h2>
            <p class="mt-2 text-center text-sm text-orange-secondary">
        </div>
        <form class="mt-8 space-y-6" action="#" method="POST">
            <input type="hidden" name="remember" value="true">
            <div class="rounded-md shadow-sm -space-y-px">
            <div>
                <label for="email-address" class="sr-only">Email address</label>
                <input id="email-address" name="email" type="email" autocomplete="email" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-black-primary placeholder-black-primary text-orange-primary rounded-t-md focus:outline-none focus:ring-orange-primary focus:border-orange-primary focus:z-10 sm:text-sm" placeholder="Email address">
            </div>
            <div>
                <label for="password" class="sr-only">Password</label>
                <input id="password" name="password" type="password" autocomplete="current-password" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-black-primary placeholder-black-primary text-black-primary rounded-b-md focus:outline-none focus:ring-orange-primary focus:border-orange-primary focus:z-10 sm:text-sm" placeholder="Password">
            </div>
            </div>
    
            <div>
            <button type="submit" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white-primary bg-orange-secondary hover:bg-orange-primary focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-primary">
                <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                <!-- Heroicon name: solid/lock-closed -->
                <svg class="h-5 w-5 text-white-primary group-hover:text-indigo-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                </svg>
                </span>
                Login
            </button>
            </div>
        </form>
        </div>
    </div>
@endsection