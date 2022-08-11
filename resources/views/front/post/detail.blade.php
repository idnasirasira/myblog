<x-front-layout>

    <div class="container py-10 flex flex-col items-center gap-5" oncopy="copyDisable(event)" oncut="copyDisable(event)" onpaste="copyDisable(event)">
        <a href="{{route('home')}}" class="text-sm text-gray-600"> <- Home</a>

        @auth
            <a href="{{ route('post.detail', ['post' => $post->id]) }}" class="text-sky-600 text-sm hover:text-gray-600 hover:bg-sky-200 px-3 py-1 bg-gray-50 rounded-full shadow-sm transition-all duration-300">Edit this post</a>
        @endauth

        <div class="bg-white rounded-md p-5 w-full">
            <h3
                class="text-5xl text-center py-4 text-gray-600 border-b border-gray-100 font-pacifico"
            >
                {{ $post->title }}
            </h3>
            <div class="blog-post text-justify text-gray-600 py-3 px-2">
                {!! $post->content !!}
            </div>

            <div
                class="flex justify-between items-center border-t border-gray-100 py-4 text-lg"
            >
                <div>{{\Carbon\Carbon::parse($post->created_at)->format('D,d F Y')}}, {{\Carbon\Carbon::parse($post->created_at)->diffForHumans()}} on <span class="text-sky-600 cursor-pointer">Random</span></div>
            </div>
        </div>

        <a href="{{route('home')}}" class="text-sm text-gray-600"> <- Home</a>
    </div>
</x-front-layout>
