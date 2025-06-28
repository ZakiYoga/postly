@extends('layouts.app')

@section('title', $title)

@section('content')

    <div class="bg-primary/20 font-lora antialiased text-gray-900 dark:bg-gray-900 dark:text-gray-100">
        <div x-data="{
            sidebarOpen: false,
            toggleSidebar() {
                this.sidebarOpen = !this.sidebarOpen;
                localStorage.setItem('sidebarOpen', JSON.stringify(this.sidebarOpen));
            }
        }" class="flex h-screen">

            <div class="min-h-screen overflow-hidden flex flex-col transition-transform duration-300 ease-in-out">
                <!-- Sidebar -->
                @include('user.layouts.sidebar')
            </div>

            <!-- Main Content Area -->
            <div class="flex-1 flex flex-col overflow-hidden">
                <!-- Header -->
                @include('user.layouts.header')


                <!-- Main Content -->
                <main
                    class="flex-1 overflow-y-auto bg-background dark:bg-background-foreground p-6 transition-all duration-300 ">
                    {{-- Alert Success --}}
                    @if (session('success'))
                        <x-alert type="success" title="Sukses!" :duration="3000">
                            {{ session('success') }}
                        </x-alert>
                    @endif
                    @yield('content')
                </main>
            </div>
        </div>
    </div>

@endsection

@stack('push')
<script>
    function previewAvatar(input) {
        const filename = document.getElementById("avatar-name");

        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                document.querySelector('img[alt="Avatar"]').src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);

            filename.textContent = input.files[0].name;
        }
    }



    function deleteAvatar() {
        if (confirm('Apakah Anda yakin ingin menghapus avatar?')) {
            document.getElementById('delete-avatar-form').submit();
        }
    }
</script>
@endpush
