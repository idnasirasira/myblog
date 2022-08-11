<x-front-layout>

    <div class="container py-10 flex flex-col items-center gap-5">
        <a href="{{route('home')}}" class="text-sm text-gray-600"> <- Home</a>

        <div class="bg-white rounded-md p-5 w">
            <h3
                class="text-5xl text-center py-3 text-gray-600 border-b border-gray-100 mb-2 font-pacifico"
            >
                {{ $post->title }}
            </h3>
            <div class="blog-post text-justify text-gray-600">
                {!! $post->content !!}
            </div>

            <div
                class="flex justify-between items-center border-t border-gray-100 mt-3 pt-2 text-lg"
            >
                <div>{{\Carbon\Carbon::parse($post->created_at)->diffForHumans()}}</div>
            </div>
        </div>

        <a href="{{route('home')}}" class="text-sm text-gray-600"> <- Home</a>
    </div>
</x-front-layout>
