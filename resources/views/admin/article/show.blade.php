@extends('template.layout')

@section('content')
    <div class="max-w-7xl mx-auto p-6 lg:p-8">
        <div class="flex justify-center">
            Articles
        </div>

        <div class="relative flex flex-col w-full h-full text-gray-700 bg-white shadow-md rounded-xl bg-clip-border">
            <div class="relative mx-4 mt-4 overflow-hidden text-gray-700 bg-white rounded-none bg-clip-border">
                <div class="flex items-center justify-between gap-8 mb-8">
                    <div>
                        <h5
                                class="block font-sans text-xl antialiased font-semibold leading-snug tracking-normal text-blue-gray-900">
                            Article list
                        </h5>
                        <p class="block mt-1 font-sans text-base antialiased font-normal leading-relaxed text-gray-700">
                            See all articles
                        </p>
                    </div>
                    <div class="flex flex-col gap-2 shrink-0 sm:flex-row">
                        {{--                        <form action="{{ route('admin.articles.destroy', $article->id) }}" method="POST" onsubmit="return confirm('Delete this article?')" class="relative h-10 max-h-[40px] w-10 max-w-[40px] select-none rounded-lg text-center align-middle font-sans text-xs font-medium uppercase text-gray-900 transition-all hover:bg-gray-900/10 active:bg-gray-900/20 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none" enctype="multipart/form-data">--}}
                        {{--                            @csrf--}}
                        {{--                            @method('DELETE')--}}
                        {{--                            <button type="submit" class="absolute transform -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" style="border: none; background: none; padding: 0; margin: 0;">--}}
                        {{--                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"--}}
                        {{--                                     aria-hidden="true" class="w-4 h-5">--}}
                        {{--                                    <path d="M10 3v3h9V3a1 1 0 0 0-1-1h-7a1 1 0 0 0-1 1z"></path><path--}}
                        {{--                                            d="M4 5v1h21V5a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1zM6 8l1.812 17.209A2 2 0 0 0 9.801 27H19.2a2 2 0 0 0 1.989-1.791L23 8H6zm4.577 16.997a.999.999 0 0 1-1.074-.92l-1-13a1 1 0 0 1 .92-1.074.989.989 0 0 1 1.074.92l1 13a1 1 0 0 1-.92 1.074zM15.5 24a1 1 0 0 1-2 0V11a1 1 0 0 1 2 0v13zm3.997.077a.999.999 0 1 1-1.994-.154l1-13a.985.985 0 0 1 1.074-.92 1 1 0 0 1 .92 1.074l-1 13z"></path>--}}
                        {{--                                </svg>--}}
                        {{--                            </button>--}}
                        {{--                        </form>--}}


                        {{--                        <button--}}
                        {{--                                class="select-none rounded-lg border border-gray-900 py-2 px-4 text-center align-middle font-sans text-xs font-bold uppercase text-gray-900 transition-all hover:opacity-75 focus:ring focus:ring-gray-300 active:opacity-[0.85] disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"--}}
                        {{--                                type="button">--}}
                        {{--                            view all--}}
                        {{--                        </button>--}}
                        <a href="{{ route('articles.create') }}"
                           class="flex select-none items-center gap-3 rounded-lg bg-gray-900 py-2 px-4 text-center align-middle font-sans text-xs font-bold uppercase text-white shadow-md shadow-gray-900/10 transition-all hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                           type="button">
                            Add article
                        </a>
                    </div>
                </div>
                {{--                <div class="flex flex-col items-center justify-between gap-4 md:flex-row">--}}

                {{--                    <div class="w-full md:w-72">--}}
                {{--                        <div class="relative h-10 w-full min-w-[200px]">--}}
                {{--                            <div class="absolute grid w-5 h-5 top-2/4 right-3 -translate-y-2/4 place-items-center text-blue-gray-500">--}}
                {{--                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"--}}
                {{--                                     stroke-width="1.5"--}}
                {{--                                     stroke="currentColor" aria-hidden="true" class="w-5 h-5">--}}
                {{--                                    <path stroke-linecap="round" stroke-linejoin="round"--}}
                {{--                                          d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"></path>--}}
                {{--                                </svg>--}}
                {{--                            </div>--}}
                {{--                            <input--}}
                {{--                                    class="peer h-full w-full rounded-[7px] border border-blue-gray-200 border-t-transparent bg-transparent px-3 py-2.5 !pr-9 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-2 focus:border-gray-900 focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"--}}
                {{--                                    placeholder=" "/>--}}
                {{--                            <label--}}
                {{--                                    class="before:content[' '] after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none !overflow-visible truncate text-[11px] font-normal leading-tight text-gray-500 transition-all before:pointer-events-none before:mt-[6.5px] before:mr-1 before:box-border before:block before:h-1.5 before:w-2.5 before:rounded-tl-md before:border-t before:border-l before:border-blue-gray-200 before:transition-all after:pointer-events-none after:mt-[6.5px] after:ml-1 after:box-border after:block after:h-1.5 after:w-2.5 after:flex-grow after:rounded-tr-md after:border-t after:border-r after:border-blue-gray-200 after:transition-all peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[3.75] peer-placeholder-shown:text-blue-gray-500 peer-placeholder-shown:before:border-transparent peer-placeholder-shown:after:border-transparent peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-gray-900 peer-focus:before:border-t-2 peer-focus:before:border-l-2 peer-focus:before:!border-gray-900 peer-focus:after:border-t-2 peer-focus:after:border-r-2 peer-focus:after:!border-gray-900 peer-disabled:text-transparent peer-disabled:before:border-transparent peer-disabled:after:border-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">--}}
                {{--                                Search--}}
                {{--                            </label>--}}
                {{--                        </div>--}}
                {{--                    </div>--}}
                {{--                </div>--}}
            </div>
            <div class="py-10 px-20 overflow-scroll">
                <h1 class="pb-10 text-xl font-bold">{{ $article->title }}</h1>
                <p>
                    {{ $article->content }}
                </p>

                <div class="h-10"></div>

                <p>author: {{$article->author->full_name }}</p>
                <p>{{ $article->publication_status }}</p>
                <p>published_at: {{ $article->published_at }}</p>

                <div class="h-10"></div>

                <div class="flex flex-row">
                    <div class="basis-1/2">
                        <form action="{{ route('admin.articles.destroy', $article->id) }}" method="POST"
                              onsubmit="return confirm('Delete this article?')" class="relative">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="absolute bg-red-500 rounded-lg transform -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2 py-2 px-4 text-center align-middle font-sans text-xs font-bold uppercase text-white transition-all hover:opacity-75 focus:ring focus:ring-red-800 active:opacity-[0.85] disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                                Delete Article
                            </button>
                        </form>
                    </div>
                    @if($article->publication_status !== 'published')
                    <div class="basis-1/2">
                        <form action="{{ route('admin.articles.publish', $article->id) }}" method="POST"
                              onsubmit="return confirm('Delete this article?')" class="relative">
                            @csrf
                            @method('PATCH')
                            <button type="submit"
                                    class="absolute bg-green-500 rounded-lg transform -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2 border py-2 px-4 text-center align-middle font-sans text-xs font-bold uppercase text-white transition-all hover:opacity-75 focus:ring focus:ring-green-800 active:opacity-[0.85] disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                                Publish Article
                            </button>
                        </form>
                    </div>
                    @endif
                </div>
            </div>
        </div>

    </div>
@endsection