@php use App\Enums\PublicationStatus; @endphp
@extends('admin.template.layout')

@section('content')
    <div class="max-w-7xl mx-auto p-6 lg:p-8">
        <div class="flex justify-center">

        </div>

        <div class="relative flex flex-col w-full h-full text-gray-700 bg-white shadow-md rounded-xl bg-clip-border">
            <div class="relative mx-4 mt-4 overflow-hidden text-gray-700 bg-white rounded-none bg-clip-border">
                <div class="flex items-center justify-between gap-8 mb-8">
                    <div>
                        <h5
                                class="block font-sans text-xl antialiased font-semibold leading-snug tracking-normal text-blue-gray-900">
                            Article trash list
                        </h5>
                    </div>
                </div>
            </div>
            <div class="p-6 px-0 overflow-scroll">
                <table class="w-full mt-4 text-left table-auto min-w-max">
                    <thead>
                    <tr>
                        <th class="p-4 border-y border-blue-gray-100 bg-blue-gray-50/50">
                            <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
                                Id
                            </p>
                        </th>
                        <th class="p-4 border-y border-blue-gray-100 bg-blue-gray-50/50">
                            <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
                                Title
                            </p>
                        </th>
                        <th class="p-4 border-y border-blue-gray-100 bg-blue-gray-50/50">
                            <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
                                Author
                            </p>
                        </th>
                        <th class="p-4 border-y border-blue-gray-100 bg-blue-gray-50/50">
                            <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
                                Status
                            </p>
                        </th>
                        <th class="p-4 border-y border-blue-gray-100 bg-blue-gray-50/50">
                            <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
                                Published at
                            </p>
                        </th>
                        <th class="p-4 border-y border-blue-gray-100 bg-blue-gray-50/50">
                            <p class="block font-sans text-sm antialiased font-normal leading-none text-blue-gray-900 opacity-70">
                                Operation
                            </p>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($articles as $article)
                        <tr>
                            <td class="p-4 border-b border-blue-gray-50">
                                <div class="flex flex-col">
                                    <p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
                                        {{ $article->id }}
                                    </p>
                                </div>
                            </td>
                            <td class="p-4 border-b border-blue-gray-50">
                                <div class="flex flex-col">
                                    <p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
                                        {{ $article->title }}
                                    </p>
                                </div>
                            </td>
                            <td class="p-4 border-b border-blue-gray-50">
                                <div class="flex items-center gap-3">
                                    <div class="flex flex-col">
                                        <p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
                                            {{ $article->author->full_name }}
                                        </p>
                                        <p
                                                class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900 opacity-70">
                                            {{ $article->author->email }}
                                        </p>
                                    </div>
                                </div>
                            </td>
                            <td class="p-4 border-b border-blue-gray-50">
                                <div class="w-max">
                                    <div
                                            class="relative grid items-center px-2 py-1 font-sans text-xs font-bold uppercase rounded-md select-none whitespace-nowrap @if($article->publication_status == PublicationStatus::PUBLISHED->value) text-green-900 bg-green-500/20 @else text-blue-900 bg-blue-500/20 @endif">
                                        <span class="">{{ $article->publication_status }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="p-4 border-b border-blue-gray-50">
                                <p class="block font-sans text-sm antialiased font-normal leading-normal text-blue-gray-900">
                                    {{ $article->published_at }}
                                </p>
                            </td>
                            <td class="p-4 border-b border-blue-gray-50">
                                <div class="flex items-center space-x-4">
                                    <form action="{{ route('admin.articles.restore', $article->id) }}" method="POST"
                                          onsubmit="return confirm('Restore this article?')"
                                          class="relative h-10 max-h-[40px] w-10 max-w-[40px] select-none rounded-lg text-center align-middle font-sans text-xs font-medium uppercase text-gray-900 transition-all hover:bg-gray-900/10 active:bg-gray-900/20 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit"
                                                class="absolute transform -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                                                style="border: none; background: none; padding: 0; margin: 0;">
                                            <svg class="w-4 h-4" fill="#000000" height="800px" width="800px"
                                                 version="1.1" id="Capa_1"
                                                 xmlns="http://www.w3.org/2000/svg"
                                                 xmlns:xlink="http://www.w3.org/1999/xlink"
                                                 viewBox="0 0 342.5 342.5" xml:space="preserve">
                                                    <path d="M254.37,22.255c-1.161-0.642-2.53-0.795-3.803-0.428c-1.274,0.367-2.35,1.226-2.992,2.387l-21.758,39.391
                                                        c-1.335,2.417-0.458,5.459,1.96,6.794C264.616,90.748,287.5,129.495,287.5,171.52c0,63.649-51.782,115.431-115.431,115.431
                                                        S56.638,235.169,56.638,171.52c0-23.888,7.557-47.427,21.382-66.897l34.478,34.478c1.338,1.337,3.315,1.806,5.109,1.21
                                                        c1.795-0.596,3.101-2.152,3.374-4.024L139.963,6.271c0.228-1.563-0.295-3.141-1.412-4.258c-1.117-1.117-2.7-1.639-4.258-1.412
                                                        L4.278,19.584c-1.872,0.273-3.428,1.579-4.023,3.374c-0.596,1.795-0.127,3.772,1.21,5.109l37.292,37.292
                                                        C14.788,95.484,1.638,133,1.638,171.52c0,93.976,76.455,170.431,170.431,170.431c93.976,0,170.431-76.455,170.431-170.431
                                                        C342.5,109.478,308.731,52.283,254.37,22.255z"/>
                                                </svg>
                                        </button>
                                    </form>

                                </div>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection