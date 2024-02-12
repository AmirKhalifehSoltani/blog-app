@extends('client.template.layout')

@section('content')
    <div class="max-w-7xl mx-auto p-6 lg:p-8">
        <div class="p-5 text-emerald-500 flex justify-center">
			 @if(session()->has('success'))
              	   {{ session('success') }}
			 @endif
        </div>

        <div class="relative flex flex-col w-full h-full text-gray-700 bg-white shadow-md rounded-xl bg-clip-border">
            <div class="relative mx-4 mt-4 overflow-hidden text-gray-700 bg-white rounded-none bg-clip-border">
                <div class="flex items-center justify-between gap-8 mb-8">
                    <div>
                        <h5
                                class="block font-sans text-xl antialiased font-semibold leading-snug tracking-normal text-blue-gray-900">
                            Article Details
                        </h5>
                    </div>
                    <div class="flex flex-col gap-2 shrink-0 sm:flex-row">
                        <a href="{{ route('articles.create') }}"
                           class="flex select-none items-center gap-3 rounded-lg bg-gray-900 py-2 px-4 text-center align-middle font-sans text-xs font-bold uppercase text-white shadow-md shadow-gray-900/10 transition-all hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                           type="button">
                            Add article
                        </a>
                    </div>
                </div>
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
            </div>
        </div>

    </div>
@endsection