<x-admin-master>
    @section('content')
        <h1>Create a post</h1>
        <form method="POST" action="{{ route('post.store') }}" enctype="multipart/form-data" >
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input class="form-control" type="text" name="title" placeholder="Enter Title" id="title">
            </div>
            <div class="form-group">
                <label for="post_image">File</label>
                <input class="form-control-file" type="file" name="post_image" id="post_image">
            </div>
            <div class="form-group">
                <label for="body">Body</label>
                <textarea class="form-control" name="body" id="body" cols="30" rows="10"></textarea>
            </div>
            <button type="submit"  class="btn btn-primary">Submit</button>
        </form>
    @endsection
</x-admin-master>