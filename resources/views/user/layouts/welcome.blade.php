<div class="bg-gradient-to-tl from-primary/60 to-primary/10 rounded-sm p-6 mb-6 shadow-sm">
    <div
        class="flex items-center justify-between flex-col-reverse md:flex-row md:max-h-32 font-bebas-neue tracking-wider">
        <div class="space-y-2">
            <h2 class="text-2xl font-bold text-gray-800">Hi, <span
                    class="first-letter:uppercase">{{ auth()->user()->name }}</span>
            </h2>
            <p class="text-gray-600 font-benne">Ready to share your thoughts today?</p>
        </div>
        <div class="flex md:relative w-60 h-60">
            <img src="/images/imgHeader.png" alt="image-header" class="md:absolute w-56 h-56 md:w-60 md:h-60 md:-top-2" />
        </div>
    </div>
</div>
