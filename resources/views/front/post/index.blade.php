<x-front-layout>
    <div class="header text-center text-gray-700 border-b border-gray-100 border-dotted">
        <h1 class="text-6xl font-bold tracking-widest">Idnasirasira</h1>
        <small class="font-semibold"
        >Do what you wanna do, and say what you wanna say.</small
        >
    </div>
    <div class="container py-10 flex flex-col items-center gap-5">
        @if($posts->isEmpty())
            <p class="text-gray-600 text-lg">I'm really sorry, There are nothing to show.</p>
            <a class="text-sky-600 text-sm hover:text-gray-600" href="{{route('post.create')}}">Let's create a new post</a>
        @endif
        @foreach ($posts as $post)
            <!-- Card -->
            <div class="card bg-white border-stone-200 rounded-md p-5 w-full hover:drop-shadow-xl border transition-all duration-300">
                <h3 class="text-3xl text-gray-600 cursor-pointer border-b border-gray-100 mb-2 pb-2 font-pacifico">
                    <a href="{{route('post.detail', ['post' => $post->id])}}" class="hover:text-sky-400 transition-colors duration-300 w-full">{{$post->title}}</a>
                </h3>
                {{-- <p class="text-gray-600"> --}}
                    {{-- {!! Str::limit(str_replace(array("\r", "\n"), '', $post->content), 150, '...') !!} --}}
                {{-- </p> --}}
                <div class="flex justify-between items-center border-gray-100 mt-3 pt-2 text-lg">
                    <div>{{\Carbon\Carbon::parse($post->created_at)->format('D,d F Y')}}, {{\Carbon\Carbon::parse($post->created_at)->diffForHumans()}} on <span class="text-sky-600 cursor-pointer">Random</span></div>
                    <a href="{{route('post.detail', ['post' => $post->id])}}" class="hover:text-sky-400 transition-colors duration-300" >Read -></a>
                </div>
            </div>
        @endforeach
        {{ $posts->links() }}

    </div>
</x-front-layout>
