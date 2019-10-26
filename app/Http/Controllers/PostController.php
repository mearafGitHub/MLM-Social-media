<?php
namespace App\Http\Controllers;

use App\Likes;
use App\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getDashBoard()
    {
        $posts = Post::orderBy('created_at', 'desc')->get();
        //$posts = Post::paginate(5, 'created_at', 'desc')->get();
        return view('home', ['posts' => $posts]);
    }

    public function postCreatePost(Request $request)
    {
        $this->validate($request, [
            'post_body' => 'required|max:1000'
        ]);
        $post = new Post();
        $post->post_body = $request['post_body'];
        $message = 'Oops, Something went wrong.';
        if ($request->user()->posts()->save($post)) {
            $message = 'Post successfully created!';
        }
        return redirect()->route('home')->with(['message' => $message]);
        //return view(post.postCreatePost, compact('post'));
    }

    public function getDeletePost($post_id)
    {
        $post = Post::where('id', $post_id)->first();
        if (Auth::user() != $post->user) {
            return redirect()->back();
        }
        $post->delete();
        return redirect()->route('home')->with(['message' => 'Successfully deleted!']);
    }

    public function postEditPost(Request $request)
    {
        $this->validate($request, [
            'post_body' => 'required'
        ]);
        $post = Post::find($request['postId']);
        if (Auth::user() != $post->user) {
            return redirect()->back();
        }
        $post->post_body = $request['post_body'];
        $post->update();
        return response()->json(['new_body' => $post->post_body], 200);
    }

    public function like($id){
        $loggedin_user = Auth::user()->id;
        $like_user = Like::where(['user_id'=>$loggedin_user, 'post_id'=>$id]);

        if(empty($like_user->user_id)){
            $user_id = Auth::user()->user_id;
            $post_id =$id;
            $like = new Like;
            $like->user_id = $user_id;
            $like->post_id = $post_id;
            $like->save();
        }
    }

    public function postLikePost(Request $request)
    {
        $post_id = $request['postId'];
        $is_like = $request['isLike'] === 'true';
        $update = false;
        $post = Post::find($post_id);
        if (!$post) {
            return null;
        }
        $user = Auth::user();
        $like = $user->likes()->where('post_id', $post_id)->first();
        if ($like) {
            $already_like = $like->like;
            $update = true;
            if ($already_like == $is_like) {
                $like->delete();
                return null;
            }
        } else {
            $like = new Likes();
        }
        $like->like = $is_like;
        $like->user_id = $user->id;
        $like->post_id = $post->id;
        if ($update) {
            $like->update();
        } else {
            $like->save();
        }
        return null;
    }
}