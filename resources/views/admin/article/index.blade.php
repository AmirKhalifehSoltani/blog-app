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
                            Article list
                        </h5>
                        <p class="block mt-1 font-sans text-base antialiased font-normal leading-relaxed text-gray-700">
                            See all articles
                        </p>
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
                                    <a href="{{ route('admin.articles.show', $article->id) }}"
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
                                    <form action="{{ route('admin.articles.destroy', $article->id) }}" method="POST"
                                          onsubmit="return confirm('Delete this article?')"
                                          class="relative h-10 max-h-[40px] w-10 max-w-[40px] select-none rounded-lg text-center align-middle font-sans text-xs font-medium uppercase text-gray-900 transition-all hover:bg-gray-900/10 active:bg-gray-900/20 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                          enctype="multipart/form-data">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="absolute transform -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                                                style="border: none; background: none; padding: 0; margin: 0;">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                 fill="currentColor"
                                                 aria-hidden="true" class="w-4 h-5">
                                                <path d="M10 3v3h9V3a1 1 0 0 0-1-1h-7a1 1 0 0 0-1 1z"></path>
                                                <path
                                                        d="M4 5v1h21V5a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1zM6 8l1.812 17.209A2 2 0 0 0 9.801 27H19.2a2 2 0 0 0 1.989-1.791L23 8H6zm4.577 16.997a.999.999 0 0 1-1.074-.92l-1-13a1 1 0 0 1 .92-1.074.989.989 0 0 1 1.074.92l1 13a1 1 0 0 1-.92 1.074zM15.5 24a1 1 0 0 1-2 0V11a1 1 0 0 1 2 0v13zm3.997.077a.999.999 0 1 1-1.994-.154l1-13a.985.985 0 0 1 1.074-.92 1 1 0 0 1 .92 1.074l-1 13z"></path>
                                            </svg>
                                        </button>
                                    </form>
                                    @if($article->publication_status === PublicationStatus::DRAFT->value)
                                        <form action="{{ route('admin.articles.publish', $article->id) }}" method="POST"
                                              onsubmit="return confirm('Publish this article?')"
                                              class="relative h-10 max-h-[40px] w-10 max-w-[40px] select-none rounded-lg text-center align-middle font-sans text-xs font-medium uppercase text-gray-900 transition-all hover:bg-gray-900/10 active:bg-gray-900/20 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                              enctype="multipart/form-data">
                                            @csrf
                                            @method('PATCH') <!-- Assuming you're updating an article -->
                                            <button type="submit"
                                                    class="absolute transform -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                                                    style="border: none; background: none; padding: 0; margin: 0;">
                                                <svg class="w-4 h-4" viewBox="0 0 512 512" version="1.1"
                                                     xml:space="preserve" xmlns="http://www.w3.org/2000/svg"
                                                     xmlns:xlink="http://www.w3.org/1999/xlink">
            									<style type="text/css">.st0 {
                                                        fill: #333333;
                                                    }</style>
                                                    <g id="Layer_1"/>
                                                    <g id="Layer_2">
                                                        <g>
                                                            <path class="st0"
                                                                  d="M256,27.5c-61.03,0-118.42,23.77-161.57,66.93C51.27,137.58,27.5,194.97,27.5,256s23.77,118.42,66.93,161.57    C137.58,460.73,194.97,484.5,256,484.5s118.42-23.77,161.57-66.93C460.73,374.42,484.5,317.03,484.5,256    s-23.77-118.42-66.93-161.57C374.42,51.27,317.03,27.5,256,27.5z M256,452.5c-108.35,0-196.5-88.15-196.5-196.5    S147.65,59.5,256,59.5S452.5,147.65,452.5,256S364.35,452.5,256,452.5z"/>
                                                            <path class="st0"
                                                                  d="M347.7,131.81c-16.03,0-31.09,6.24-42.43,17.57l-85.16,85.16l-13.39-13.39    c-11.33-11.33-26.4-17.58-42.43-17.58c-16.03,0-31.1,6.24-42.43,17.57c-11.32,11.32-17.56,26.39-17.56,42.43    s6.24,31.1,17.56,42.43l57.17,57.17c10.97,10.97,25.56,17.01,41.08,17.01s30.1-6.04,41.08-17.01l128.94-128.94    c11.32-11.32,17.56-26.39,17.56-42.43c0-16.04-6.24-31.1-17.56-42.42C378.8,138.05,363.73,131.81,347.7,131.81z M367.5,211.61    L238.57,340.55c-4.93,4.93-11.48,7.64-18.45,7.64s-13.52-2.71-18.45-7.64l-57.17-57.17c-5.28-5.28-8.18-12.31-8.18-19.8    s2.91-14.52,8.19-19.8c5.29-5.29,12.32-8.2,19.8-8.2s14.51,2.91,19.8,8.2l24.71,24.7c6.25,6.25,16.38,6.25,22.63,0l96.47-96.47    c5.29-5.29,12.32-8.2,19.8-8.2s14.51,2.91,19.8,8.2c5.28,5.28,8.18,12.31,8.18,19.8S372.78,206.33,367.5,211.61z"/>
                                                        </g>
                                                    </g>
        									</svg>
                                            </button>
                                        </form>

                                </div>
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