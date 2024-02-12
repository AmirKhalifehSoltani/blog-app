@php use App\Enums\PublicationStatus; @endphp
@extends('client.template.layout')

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
                            Article list
                        </h5>
                        <p class="block mt-1 font-sans text-base antialiased font-normal leading-relaxed text-gray-700">
                            See all articles
                        </p>
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
                                <a href="{{ route('articles.show', $article->id) }}"
                                   class="relative h-10 max-h-[40px] w-10 max-w-[40px] select-none rounded-lg text-center align-middle font-sans text-xs font-medium uppercase text-gray-900 transition-all hover:bg-gray-900/10 active:bg-gray-900/20 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                   type="button">
                                  <span class="absolute transform -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                         aria-hidden="true" class="w-4 h-4">
                                      <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M12 6C8.76722 6 5.95965 8.31059 4.2048 11.7955C4.17609 11.8526 4.15483 11.8948 4.1369 11.9316C4.12109 11.964 4.11128 11.9853 4.10486 12C4.11128 12.0147 4.12109 12.036 4.1369 12.0684C4.15483 12.1052 4.17609 12.1474 4.2048 12.2045C5.95965 15.6894 8.76722 18 12 18C15.2328 18 18.0404 15.6894 19.7952 12.2045C19.8239 12.1474 19.8452 12.1052 19.8631 12.0684C19.8789 12.036 19.8888 12.0147 19.8952 12C19.8888 11.9853 19.8789 11.964 19.8631 11.9316C19.8452 11.8948 19.8239 11.8526 19.7952 11.7955C18.0404 8.31059 15.2328 6 12 6ZM2.41849 10.896C4.35818 7.04403 7.7198 4 12 4C16.2802 4 19.6419 7.04403 21.5815 10.896C21.5886 10.91 21.5958 10.9242 21.6032 10.9389C21.6945 11.119 21.8124 11.3515 21.8652 11.6381C21.9071 11.8661 21.9071 12.1339 21.8652 12.3619C21.8124 12.6485 21.6945 12.8811 21.6032 13.0611C21.5958 13.0758 21.5886 13.09 21.5815 13.104C19.6419 16.956 16.2802 20 12 20C7.7198 20 4.35818 16.956 2.41849 13.104C2.41148 13.09 2.40424 13.0758 2.39682 13.0611C2.3055 12.881 2.18759 12.6485 2.13485 12.3619C2.09291 12.1339 2.09291 11.8661 2.13485 11.6381C2.18759 11.3515 2.3055 11.119 2.39682 10.9389C2.40424 10.9242 2.41148 10.91 2.41849 10.896ZM12 10C10.8954 10 10 10.8954 10 12C10 13.1046 10.8954 14 12 14C13.1046 14 14 13.1046 14 12C14 10.8954 13.1046 10 12 10ZM8.00002 12C8.00002 9.79086 9.79088 8 12 8C14.2092 8 16 9.79086 16 12C16 14.2091 14.2092 16 12 16C9.79088 16 8.00002 14.2091 8.00002 12Z"
                                            fill="#0F1729"/>
                                    </svg>
                                  </span>
                                </a>
                                @if($article->author_id === auth()->id())
                                    <a href="{{ route('articles.edit', $article->id) }}"
                                       class="relative h-10 max-h-[40px] w-10 max-w-[40px] select-none rounded-lg text-center align-middle font-sans text-xs font-medium uppercase text-gray-900 transition-all hover:bg-gray-900/10 active:bg-gray-900/20 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                       type="button">
                                  <span class="absolute transform -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                         aria-hidden="true" class="w-4 h-4">
                                      <path d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32L19.513 8.2z"></path>
                                    </svg>
                                  </span>
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection