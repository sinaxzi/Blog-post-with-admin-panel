<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{
    public function index(){

        $posts = Post::all();

        return view('admin.posts.index',['posts'=>$posts]);

    }

    public function show(Post $post){

        return view('blog-post',['post'=>$post]);
    }

    public function create(){

        $this->authorize('create',Post::class);

        return view('admin.posts.create');
    }

    public function store(Request $request){

        $this->authorize('create',Post::class);
        
        $inputs = request()->validate([
            'title'=>'required|min:5|max:255',
            'post_image'=>'mimes:png,jpg',
            'body'=>'required'
        ]);
        if(request('post_image')){
            $inputs['post_image'] = request('post_image')->store('IMAGES');
        }

        auth()->user()->posts()->create($inputs);
        
        Session::flash('post-created-message','Post was created');

        return redirect()->route('posts.index');
        // dd($request->post_image->originalName);
        // dd(request()->all());
    }

    public function edit(Post $post){

        $this->authorize('view',$post);

        // if(auth()->user()->can('view',$post)){}
        
        return view('admin.posts.edit',['post'=>$post]);

    }

    public function update(post $post){
        $inputs = request()->validate([
            'title'=>'required|min:5|max:255',
            'post_image'=>'mimes:png,jpg',
            'body'=>'required'
        ]);

        if(request('post_image')){
            $inputs['post_image'] = request('post_image')->store('IMAGES');
            $post->post_image = $inputs['post_image'];
        }

        $post->title = $inputs['title'];
        $post->body = $inputs['body'];

        $this->authorize('update',$post);

        $post->save();
        
        Session::flash('post-updated-message','Post was updated');

        return redirect()->route('posts.index');
    }

    public function destroy(Post $post){

        $this->authorize('delete',$post);

        $post->delete();

        Session::flash('post-deleted-message','Post was deleted');

        return back();
    }
    
    

    
}
