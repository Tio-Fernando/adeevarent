<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-gray-50 text-gray-900">
        <div class="flex h-screen overflow-hidden">
            
            @include('layouts.sidebar')

            <div class="flex-1 flex flex-col overflow-hidden">
                
                <header class="bg-white border-b border-gray-100 h-20 flex items-center justify-between px-8 z-10">
                    <div class="relative w-96">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </span>
                        <input type="text" placeholder="Search" class="w-full bg-gray-50 border border-gray-200 text-gray-700 rounded-full focus:ring-primary focus:border-primary block pl-10 p-2.5 outline-none sm:text-sm">
                    </div>

                    <div class="flex items-center space-x-3 cursor-pointer">
                        <img class="w-10 h-10 rounded-full" src="https://ui-avatars.com/api/?name=Lahap&background=random" alt="User avatar">
                        <div>
                            <p class="text-sm font-semibold text-gray-700">Lahap</p>
                            <p class="text-xs text-gray-500">Admin</p>
                        </div>
                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </div>
                </header>

                <main class="flex-1 overflow-x-hidden overflow-y-auto bg-[#F8F9FA] p-8">
                    {{ $slot }}
                </main>
                
            </div>
        </div>
    </body>
</html>