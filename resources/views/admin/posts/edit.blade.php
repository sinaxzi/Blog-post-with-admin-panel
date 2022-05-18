<x-admin-master>
    @section('content')
        <h1>Edit a post</h1>
        <form method="POST" action="{{ route('post.update',$post->id) }}" enctype="multipart/form-data" >
            @csrf
            @method('PATCH')
            <div class="form-group">
                <label for="title">Title</label>
                <input class="form-control" type="text" name="title" placeholder="Enter Title" id="title" value="{{ $post->title }}">
            </div>
            <div class="form-group">
                <div><img height="100px" src="{{ $post->post_image }}" alt=""></div>
                <label for="post_image">File</label>
                <input class="form-control-file" type="file" name="post_image" id="post_image">
            </div>
            <div class="form-group">
                <label for="body">Body</label>
                <textarea class="form-control" name="body" id="body" cols="30" rows="10">{{ $post->body }}</textarea>
            </div>
            <button type="submit"  class="btn btn-primary">Update</button>
        </form>
    @endsection
</x-admin-master>