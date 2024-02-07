<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Comment;
use App\Models\Follow;
use App\Models\User;
use Attribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

use function PHPSTORM_META\map;

class BlogController extends Controller
{

    public function index(){
        $blogs=Blog::latest()->with('comments')->with('user')->get();
        //Most followers
        $bloggers = Follow::select('following_id as blogger_id', Follow::raw('count(id) as follower_count'))
        ->groupBy('following_id')
        ->orderByDesc('follower_count')
        ->take(3)->get();

        $bloggerIds=collect($bloggers)->pluck('blogger_id')->toArray(); //fetch only ids
        // return $bloggerIds;
        
        $topBloggers=[];
        foreach($bloggerIds as $bId){
            $topBlogger=User::where("id",$bId)->first();
            $topBloggers[]=$topBlogger;
            // $topBloggers=array_merge($topBloggers, User::where("id", $bId)->get()->toArray());
        }

        //top blogs
        $topBlogs=Blog::orderBy('viewer','desc')->with("user")->take(3)->get();

        // return $topBloggers;
        return Inertia::render('Home',[
            "blogs" => $blogs,
            "topBloggers" => $topBloggers,
            "topBlogs" => $topBlogs,
        ]);
    }

    public function show($id){
        $blog=Blog::where("id",$id)->with('user')->first();
        if(!$blog){
            return redirect('/');   
        }
        $author=$blog->user->name;
       
        $comments=$blog->comments;
        // dd($comments);
        $commentWriters=[];
        foreach($comments as $c){
            $commentWriters[]=$c->user;
        }
        // dd($comments);
        // dd($commentWriters);
        // dd($author);

        return Inertia::render('Show',[
            "blog" => $blog,
            "author" => $author,
            "comments" => $comments,
        ]);
    }

    public function create(){
        return Inertia::render('Create');
    }

    public function store(Request $request){
        $attributes=$request->validate([
            'title' => ['required','max:100'],
            'body' => 'required',
            'file'=> ['required','mimes:png,jpg,jpeg','max:2048'],
            'topic' => 'required',
        ]);
        // dd('validated');
        $file = $request->file('file'); // Retrieve the uploaded file from the request
        $filename = $request->feature_photo; // Retrieve the original filename
        Storage::disk('local')->put($filename,file_get_contents($file));

        // Blog::create($attributes);
        $blog=new Blog();
        $blog->title=$request->title;
        $blog->body=$request->body;
        $blog->feature_photo=$request->feature_photo;
        $blog->topic=$request->topic;
        $blog->user_id=Auth::user()->id;
        $blog->save();
        return redirect('/');
    }

    public function following(){
        
        $blogs=Blog::latest()->get();

        //followedBlogs
        $followings = Auth::user()->followings->all();
        $userIds = collect($followings)->pluck('id')->toArray();
        $followedBlogs=[];
        foreach($userIds as $userId){
           $followedBlogs=array_merge($followedBlogs, Blog::where("user_id", $userId)->with('user')->get()->toArray());
        }
        // dd($followedBlogs);
        //end of followedBlogs

        //Most followers
        $bloggers = Follow::select('following_id as blogger_id', Follow::raw('count(id) as follower_count'))
        ->groupBy('following_id')
        ->orderByDesc('follower_count')
        ->take(3)->get();

        $bloggerIds=collect($bloggers)->pluck('blogger_id')->toArray(); //fetch only ids
        // return $bloggerIds;
        
        $topBloggers=[];
        foreach($bloggerIds as $bId){
            $topBlogger=User::where("id",$bId)->first();
            $topBloggers[]=$topBlogger;
            // $topBloggers=array_merge($topBloggers, User::where("id", $bId)->get()->toArray());
        }
        //end of Most followers

        //top blogs
        $topBlogs=Blog::orderBy('viewer','desc')->with("user")->take(3)->get();

        return Inertia::render('Following',[
            "blogs" => $blogs,
            "followedBlogs" => $followedBlogs,
            "topBloggers" => $topBloggers,
            "topBlogs" => $topBlogs,
        ]);
    }

    public function viewer(Request $request){
        $blog_id=$request->blog_id;
        $blog=Blog::where("id",$blog_id)->first();
        // dd($blog->viewer);
        $blog->viewer++;
        $blog->update();
    }
}
