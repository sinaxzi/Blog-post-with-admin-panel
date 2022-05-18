<x-admin-master>
    @section('content')
        <div class="row">
            <div class="col-sm-6">
                <h1>Edit a Permission</h1>
                <form method="POST" action="{{ route('permission.update',$permission->id) }}" >
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input class="form-control" type="text" name="name" placeholder="Enter Name" id="name" value="{{ $permission->name }}">
                    </div>
                    <button type="submit"  class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
        <br/>
    @endsection
</x-admin-master>