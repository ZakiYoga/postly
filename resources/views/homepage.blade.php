<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <section class="h-fit mt-4 px-6 sm:px-8 md:px-10 lg:px-16">
        <div class="w-full flex items-start justify-between gap-x-8 h-[65vh] py-4">
            <div class="w-[60%] h-full">
                <article class="relative w-full h-full">
                    <div
                        class="absolute top-0 -left-2 w-[45%] h-fit bg-background border border-gray-300 dark:border-gray-700 dark:bg-gray-900 z-10 space-y-2 p-4">
                        <div
                            class="inline-flex items-center gap-2 font-bebas-neue uppercase text-sm/6 text-gray-800 dark:text-gray-200">
                            <a href="#" class="tracking-wider p-0.5 px-1.5 dark:bg-[#050708]">Gadget</a>
                            <span class="w-5 h-[1px] bg-gray-300"></span>
                            <p class="tracking-wider">20 minute ago</p>
                        </div>
                        <p class="text-3xl font-semibold dark:text-white">
                            Lorem ipsum dolor sit amet, consectetur adipisicingelit.
                        </p>
                        <div class="bg-primary w-[30%] h-1.5"></div>
                    </div>
                    <div class="absolute top-0 right-0 h-full ">
                        <img src="/images/article-1.png" alt="article1"
                            class="aspect-[10/8] h-full object-cover object-center">
                    </div>
                </article>
            </div>
            <div class="flex flex-col justify-between items-start w-[40%] h-full">
                <article class="flex gap-2 group">
                    <div class="max-w-44 items-center overflow-hidden">
                        <img src="/images/article-1.png" alt="article1"
                            class="group-hover:scale-110 transition-all duration-300 aspect-[4/2.8] object-cover object-center">
                    </div>
                    <div class="space-y-2 h-full group">
                        <div class="inline-flex items-center gap-2 font-bebas-neue dark:text-gray-200 text-sm/6">
                            <a href="#" class="tracking-wider p-0.5 px-1.5 dark:bg-[#050708]">Gadget</a>
                            <div class="w-5 h-[1px] bg-gray-300"></div>
                            <p class="tracking-wider">20 minute ago</p>
                        </div>
                        <div class="md:text-xl font-semibold dark:text-white">
                            <a href="#" class="hover:text-primary">Lorem ipsum dolor sit amet consectetur
                                adipisicing elit.</a>
                        </div>
                        <a href="#"
                            class="relative overflow-hidden inline-flex items-center gap-1 uppercase underline tracking-wider font-bebas-neue mt-auto dark:text-white hover:text-gray-900/80">
                            More
                            <x-fas-arrow-right
                                class="w-3 h-3 mb-0.5 group-hover:rotate-[315deg] transition-all duration-200" />
                        </a>
                    </div>
                </article>
                <hr class="w-full h-1.5 text-gray-300" />
                <article class="flex gap-2">
                    <div class="max-w-44 items-center">
                        <img src="/images/article-1.png" alt="article1"
                            class="aspect-[4/2.8] object-cover object-center">
                    </div>
                    <div class="space-y-2 h-full">
                        <div class="inline-flex items-center gap-2 font-bebas-neue text-sm/6">
                            <a href="#" class="">Gadget</a>
                            <div class="w-5 h-[1px] bg-gray-300"></div>
                            <p>20 minute ago</p>
                        </div>
                        <div class="md:text-xl font-semibold">
                            <h1>Lorem ipsum dolor sit amet consectetur adipisicing elit.</h1>
                        </div>
                        <a href="#" class="uppercase underline tracking-wider font-bebas-neue mt-auto">More</a>
                    </div>
                </article>
                <hr class="w-full h-1.5 text-gray-300" />
                <article class="flex gap-2">
                    <div class="max-w-44 items-center">
                        <img src="/images/article-1.png" alt="article1"
                            class="aspect-[4/2.8] object-cover object-center">
                    </div>
                    <div class="space-y-2 h-full">
                        <div class="inline-flex items-center gap-2 font-bebas-neue text-sm/6">
                            <a href="#" class="">Gadget</a>
                            <div class="w-5 h-[1px] bg-gray-300"></div>
                            <p>20 minute ago</p>
                        </div>
                        <div class="md:text-xl font-semibold">
                            <h1>Lorem ipsum dolor sit amet consectetur adipisicing elit.</h1>
                        </div>
                        <a href="#" class="uppercase underline tracking-wider font-bebas-neue mt-auto">More</a>
                    </div>
                </article>
            </div>

        </div>
    </section>
</x-layout>
