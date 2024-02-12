@php use App\Enums\PublicationStatus; @endphp
@extends('admin.template.layout')

@section('content')
    <div class="max-w-7xl mx-auto p-6 lg:p-8">
        <div class="flex justify-center">

        </div>

        <div class="relative flex flex-col w-full h-full text-gray-700 bg-white shadow-md rounded-xl bg-clip-border">
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
                    @if($article->publication_status !== PublicationStatus::PUBLISHED->value)
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