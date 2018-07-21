<?php

namespace App\Http\Controllers\API;

use App\API\Post;
use App\Http\Resources\PostCollection;
use App\Http\Resources\UserCollection;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    public $successStatus = 200;
    public function __construct()
    {
        $this->middleware('session');
        $this->middleware('csrf');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function page()
    {
        return view('api.index');
    }

    public function index()
    {
        return new PostCollection(Post::latest()->paginate());
    }

//    API user register

    public function register(array $data)
    {
            $validator = Validator::make($data, [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6|confirmed',
            ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
                'api_token' => str_random(70),
            ]);
            $success = $user->api_token;

        return response()->json(['success'=> $success], $this-> successStatus);
    }


//  API user login

    public function login(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'email' => 'required|string',
            'password' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        if(Auth::attempt(['email'=> $request->input('email'), 'password'=>$request->input('password')])){
            $user = Auth::user();
            $user->api_token = str_random(70);
            $user->save();
            $success = $user->api_token;
            return response()->json(['success'=> $success], $this->successStatus);
        }else{
            return response()->json(['error'=>'Unauthorised'], 401);
        }
    }


    public function logout(Request $request)
    {
/*        $userToken = Auth::user()->token();
        DB::table('oauth_refresh_tokens')->where('access_token_id', $userToken->id)->update([
            'revoked' => true,
        ]);

        $userToken->revoke();*/

        if (Auth::check()){
                $user = Auth::user();
                $user->api_token = null;
                $user->save();

                return 'You were log out :(';
        }
        return response()->json([
            'error' => 'Unauthorized',
            'code' => 401
        ], 401);

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = new Post();
        $post->title = $request->title;
        $post->detail = $request->detail;
        $post->save();

        return response()->json($post);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $edit = Post::find($id);
        return response()->json($edit);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Post::find($id)->update($request->all());
        return response()->json('Post update successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Post::find($id)->delete();
        return response()->json('Deleted post');
    }
}
