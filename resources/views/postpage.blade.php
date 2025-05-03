<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    {{-- <div class="min-h-screen w-full lg:p-[2rem] flex item-center justify-start flex-col gap-4">
        <h3 class="font-bold text-2xl">Sigle Post</h3>

        <div class="flex flex-wrap flex-col gap-8">
            <article class="max-w-sm bg-gray-200/30 h-fit rounded-lg p-4 flex flex-col gap-2 shadow-lg">
                <h2 class="font-bold text-xl font-oxanium">
                    {{ $post['title'] }}
                </h2>
                <div class="flex">
                    <a href="/authors/{{ $post->author->username }}" class="hover:text-primary">
                        {{ $post->author->name }} </a> &nbsp; | 22 maret 2025
                </div>
                <p>
                    {{ $post['body'] }}
                </p>
                <a href="/categories/{{ $post->category->slug }}"
                    class="px-2 py-1.5 bg-gray-300 w-fit rounded-md inline-flex items-center text-sm">
                    <x-untitledui-tag-02 class="w-4 h-4" />&nbsp;{{ $post->category->name }}
                </a>
                <a href="/posts" class="bg-primary w-fit px-3 py-2 rounded-lg mt-4">
                    &laquo; Back to all posts</a>
            </article>
        </div>
    </div> --}}
    <!--
Install the "flowbite-typography" NPM package to apply styles and format the article content:

URL: https://flowbite.com/docs/components/typography/
-->

    <section class="w-full h-fit mt-4 mx-auto px-6 sm:px-8 md:px-10 lg:px-16">
        <div
            class="mx-auto w-full bg-white rounded-sm text-center py-6 lg:py-8 px-4 lg:px-8 lg:mb-4 mb-2 shadow-md border border-gray-200 dark:bg-gray-900 dark:border-gray-700">
            <h2
                class="mb-2 text-2xl font-bebas-neue tracking-wider lg:text-4xl font-semibold text-gray-900 dark:text-white">
                {{ $title }}
            </h2>
        </div>
        <div
            class="flex justify-between rounded-sm bg-white px-4 mx-auto w-full shadow-md border  border-gray-200 dark:bg-gray-900 dark:border-gray-700">
            <article
                class="flex flex-col mx-auto w-full min-h-[80vh] max-w-lg format format-sm sm:format-base lg:format-lg px-6 py-8 md:px-10 md:py-12 format-blue dark:format-invert">
                <header class="mb-4 not-format">
                    <h1
                        class="mb-2 text-3xl font-extrabold leading-tight text-gray-900 lg:mb-6 lg:text-4xl dark:text-white">
                        {{ $post->title }}
                    </h1>
                </header>
                <p>
                    {{ $post->body }}
                </p>
                <div class="inline-flex py-3 not-format">
                    <img class="mr-4 w-14 h-14 rounded-full object-cover object-center"
                        src="https://flowbite.com/docs/images/people/profile-picture-2.jpg"
                        alt="{{ $post->author->username }}">
                    <div class="not-format flex flex-col justify-center gap-2">
                        <a href="/authors/{{ $post->author->username }}"
                            class="leading-tight font-semibold font-bebas-neue tracking-widest">
                            {{ $post->author->username }}
                        </a>
                        <p class="leading-tight"> {{ $post->created_at->diffForHumans() }}</p>
                    </div>
                </div>

                <div class="py-4 inline-flex items-center gap-2 not-format my-8">
                    <h5
                        class="pl-2 leading-6 border-l-4 border-gray-700 dark:border-gray-500 font-bebas-neue tracking-wider mr-2">
                        SHARE
                    </h5>
                    <a href="#" class="">
                        <x-css-facebook class="w-6 h-6" />
                    </a>
                    <a href="#">
                        <x-css-twitter class="w-6 h-6 hover:text-blue-950" />
                    </a>
                    <a href="#">
                        <x-eva-linkedin class="w-6 h-6 hover:text-blue-950" />
                    </a>
                </div>
                <div class="mt-auto not-format font-bebas-neue tracking-widest">
                    <a href="/posts"
                        class="inline-flex gap-1.5 text-sm items-center p-2 text-black bg-primary hover:bg-primary/80 border dark:border-gray-900 shadow-[2px_2px_0px_#000] dark:shadow-[2px_2px_0px_#111827] active:translate-0.5 active:shadow-none ">
                        <x-fas-arrow-left class="w-4 h-4 pb-0.5" />
                        Back To All Posts
                    </a>
                </div>
            </article>
        </div>
    </section>

    {{-- <section class="bg-white dark:bg-gray-900">
        <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6">
            <div class="mx-auto max-w-screen-md sm:text-center">
                <h2 class="mb-4 text-3xl font-extrabold tracking-tight text-gray-900 sm:text-4xl dark:text-white">Sign
                    up for our newsletter</h2>
                <p class="mx-auto mb-8 max-w-2xl  text-gray-500 md:mb-12 sm:text-xl dark:text-gray-400">Stay up to date
                    with the roadmap progress, announcements and exclusive discounts feel free to sign up with your
                    email.</p>
                <form action="#">
                    <div class="items-center mx-auto mb-3 space-y-4 max-w-screen-sm sm:flex sm:space-y-0">
                        <div class="relative w-full">
                            <label for="email"
                                class="hidden mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Email
                                address</label>
                            <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 16">
                                    <path
                                        d="m10.036 8.278 9.258-7.79A1.979 1.979 0 0 0 18 0H2A1.987 1.987 0 0 0 .641.541l9.395 7.737Z" />
                                    <path
                                        d="M11.241 9.817c-.36.275-.801.425-1.255.427-.428 0-.845-.138-1.187-.395L0 2.6V14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2.5l-8.759 7.317Z" />
                                </svg>
                            </div>
                            <input
                                class="block p-3 pl-9 w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 sm:rounded-none sm:rounded-l-lg focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Enter your email" type="email" id="email" required="">
                        </div>
                        <div>
                            <button type="submit"
                                class="py-3 px-5 w-full text-sm font-medium text-center text-white rounded-lg border cursor-pointer bg-primary-700 border-primary-600 sm:rounded-none sm:rounded-r-lg hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Subscribe</button>
                        </div>
                    </div>
                    <div
                        class="mx-auto max-w-screen-sm text-sm text-left text-gray-500 newsletter-form-footer dark:text-gray-300">
                        We care about the protection of your data. <a href="#"
                            class="font-medium text-primary-600 dark:text-primary-500 hover:underline">Read our Privacy
                            Policy</a>.</div>
                </form>
            </div>
        </div>
    </section> --}}
</x-layout>
