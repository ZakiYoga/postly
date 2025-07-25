@extends('user.layouts.app')

@section('title')
    Dashboard - Settings
@endsection

@section('content')
    @if (Auth::user()->role == 'admin')
        <x-breadcrumb :items="[['label' => 'Dashboard', 'url' => '/admin/dashboard'], ['label' => 'Settings']]" />
    @else
        <x-breadcrumb :items="[['label' => 'Dashboard', 'url' => '/dashboard'], ['label' => 'Settings']]" />
    @endif

    <div class="mx-auto space-y-6">
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-sm">
            <div class="max-w-xl">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-sm">
            <div class="max-w-xl">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-sm">
            <div class="max-w-xl">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
@endsection
