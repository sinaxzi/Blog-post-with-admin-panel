<x-admin-master>
    @section('content')

    @if (Session::has('post-deleted-message'))
      <div class="alert alert-danger">{{ Session::get('post-deleted-message') }}</div>
    @elseif (Session::has('post-created-message'))
      <div class="alert alert-success">{{ Session::get('post-created-message') }}</div>
    @elseif (Session::has('post-updated-message'))
      <div class="alert alert-success">{{ Session::get('post-updated-message') }}</div>
    @endif
    <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Posts</h6>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Owner</th>
                  <th>Title</th>
                  <th>Body</th>
                  <th>Image</th>
                  <th>Created At</th>
                  <th>updated At</th>
                  <th>Edit</th>
                  <th>Delete</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Id</th>
                  <th>Owner</th>
                  <th>Title</th>
                  <th>Body</th>
                  <th>Image</th>
                  <th>Created At</th>
                  <th>updated At</th>
                  <th>Edit</th>
                  <th>Delete</th>
                </tr>
              </tfoot>
              <tbody>
                @foreach ($posts as $post )

                  <tr>
                    <td>{{ $post->id }}</td>
                    <td>{{ $post->user->name }}</td>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->body }}</td>
                    <td>
                      <div>
                        <img height="40px" src="{{ asset($post->post_image) }}" alt="">
                      </div>
                    </td>
                    <td>{{ $post->created_at }}</td>
                    <td>{{ $post->updated_at }}</td>
                    <td>
                      
                        <form method="GET" action="{{ route('post.edit',$post->id) }}">
                          @csrf
                          <button class="btn btn-success">Edit</button>
                        </form>
                      
                    </td>
                    <td>
                      
                        <form method="POST" action="{{ route('post.destroy',$post->id) }}">
                          @csrf
                          @method('DELETE')
                          <button class="btn btn-danger">Delete</button>
                        </form>
                      
                    </td>
                  </tr>

                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
      {{-- <div class="d-flex">
        <div class="mx-auto">
          {{ $posts->links() }}
        </div>
      </div> --}}
      
    @endsection

    @section('scripts')
        <!-- Page level plugins -->
        <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

        <!-- Page level custom scripts -->
        <script src="{{ asset('js/demo/datatables-demo.js') }}"></script>
    @endsection
</x-admin-master>