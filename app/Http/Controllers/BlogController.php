<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Mail;
use Session;
use GuzzleHttp\Exception\GuzzleException;
use App\Models\Blog;
use App\Models\BlogCategory;

class BlogController extends Controller
{
    public function fetchBlog() {
        $data = Blog::where('status',1)->with('cat')->orderBy('id', 'DESC')->paginate(10);
        if(count($data) > 0){
            $response = array(
                "status" => 200,
                "message" => "operation successful",
                "data" => $data,
            );
            return Response::json($response);
        } else {
            $response = array(
                "status" => 400,
                "message" => "empty data",
                "data" => $data,
            );
            return Response::json($response);
        }
    }

    public function featuredBlog() {
        $data = Blog::where('status',1)->where('featured',1)->with('cat')->orderBy('id', 'DESC')->paginate(10);
        if(count($data) > 0){
            $response = array(
                "status" => 200,
                "message" => "operation successful",
                "data" => $data,
            );
            return Response::json($response);
        } else {
            $response = array(
                "status" => 400,
                "message" => "empty data",
                "data" => $data,
            );
            return Response::json($response);
        }
    }

    public function blogByCategory($id) {
        $data = Blog::select('blogs.*','blog_categories.name')
                ->leftJoin('blog_categories','blog_categories.id','=','blogs.cat_id')
                ->where('blog_categories.slug',$id)
                ->orWhere('blog_categories.id',$id)
                ->with('cat')
                ->orderBy('blogs.id', 'DESC')
                ->paginate(10);
    
        if(count($data) > 0){
            $response = array(
                "status" => 200,
                "message" => "operation successful",
                "data" => $data,
            );
            return Response::json($response);
        } else {
            $response = array(
                "status" => 400,
                "message" => "empty data",
                "data" => $data,
            );
            return Response::json($response);
        }
    }

    public function singleBlog($id) {
        $data = Blog::where('slug',$id)->orWhere('id',$id)->with('cat')->first();
        if($data){
            $response = array(
                "status" => 200,
                "message" => "operation successful",
                "status" => $data,
            );
            return Response::json($response);
        } else {
            $response = array(
                "status" => 403,
                "message" => "not found",
            );
            return Response::json($response);
        }
    }

    public function searchBlog(Request $request){
        $q = $request->get('q');
        $data = Blog::where ( 'title', 'LIKE', '%' . $q . '%' )->orWhere ( 'description', 'LIKE', '%' . $q . '%' )->with('cat')->paginate(10);
        if(count($data) > 0){
            $response = array(
                "status" => 200,
                "message" => "operation successful",
                "data" => $data,
            );
            return Response::json($response);
        } else {
            $response = array(
                "status" => 400,
                "message" => "empty data",
                "data" => $data,
            );
            return Response::json($response);
        }
    }
}
