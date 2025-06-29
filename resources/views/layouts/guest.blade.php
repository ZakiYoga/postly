@extends('layouts.app')

@section('title', 'Postly - ' . $title)

@section('content')
    <div
        class="w-full max-w-6xl my-6 mx-4 mr-2 h-auto sm:h-[90vh] flex flex-col sm:flex-row items-center justify-center bg-white dark:bg-gray-900 shadow-md rounded-sm overflow-hidden">
        <div
            class="flex items-center justify-center w-full sm:w-1/2 h-[40vh] sm:h-full relative bg-primary/15 dark:bg-gray-800/40">
            <a href="/" class="hover:cursor-pointer absolute top-4 left-4 z-10">
                <x-application-logo class="w-12 h-12 sm:w-10 sm:h-10" />
            </a>
            <div class="w-full h-full flex items-center justify-center px-4 sm:px-0">
                <img src="/images/auth/login.png" alt="img-login"
                    class="object-contain sm:object-cover w-full h-full max-w-md sm:max-h-[80vh]">
            </div>
        </div>

        <div class="w-full h-full sm:w-1/2 p-4 sm:p-6 md:p-8">
            {{ $slot }}
        </div>
    </div>
@endsection
