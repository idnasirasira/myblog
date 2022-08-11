<x-front-layout>

    <div class="container py-10 flex flex-col items-center gap-5">
        <a href="{{route('home')}}" class="text-sm text-gray-600"> <- Home</a>


        <div class="bg-white rounded-md p-5 w-full">
            <h3
              class="text-5xl text-center py-3 text-gray-600 border-b border-gray-100 mb-2 font-pacifico"
            >
              Create blog post
            </h3>
            <form action="{{route('post.store')}}" method="POST" class="flex flex-col">
                @csrf
                <div class="form-control">
                    <label for="">Title: </label>
                    <input type="text" name="title" id="title" placeholder="Title..." />
                </div>
                <div class="form-control">
                    <label for="">Content: </label>
                    <textarea
                    name="content"
                    id="content"
                    cols="30"
                    rows="50"
                    ></textarea>
                </div>

                <div class="flex justify-between items-center border-t border-gray-100 mt-3 pt-2 text-lg">
                    <div></div>
                    <button class="btn" type="submit">Create</button>
                </div>
            </form>

          </div>

        <a href="{{route('home')}}" class="text-sm text-gray-600"> <- Home</a>
    </div>

    @push('scripts')
        <script src="https://cdn.ckeditor.com/ckeditor5/35.0.1/classic/ckeditor.js"></script>
        <script>
            ClassicEditor
                .create( document.querySelector( '#content' ) )
                .then( editor => {
                        console.log( editor );
                } )
                .catch( error => {
                        console.error( error );
                });
        </script>
    @endpush
</x-front-layout>
