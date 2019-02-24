<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function show($id)
    {
        $messages = DB::table('messages')
        ->join('users', 'users.id', '=', 'messages.id_from')
        ->select('messages.text', 'users.name', 'messages.id_to')
        ->where([['id_to', Auth::id()], ['id_from', $id]])
        ->orWhere([['id_to', $id], ['id_from', Auth::id()]])
        ->orderBy('messages.created_at')
        ->get();
        
        $is_admin = false;
        $users = [];
        
        if (isset(Auth::user()->is_admin) && Auth::user()->is_admin) {

            $users_to = DB::table('messages')
            ->join('users', 'users.id', '=', 'messages.id_to')
            ->select('users.name', 'users.id')
            ->where([['id_from', $id],['id_to', '<>', Auth::id()]])
            ->distinct()
            ->get()
            ->toArray();

            $users_from = DB::table('messages')
            ->join('users', 'users.id', '=', 'messages.id_from')
            ->select('users.name', 'users.id')
            ->where([['id_to', $id],['id_from', '<>', Auth::id()]])
            ->distinct()
            ->get()
            ->toArray();

            $users = array_replace_recursive($users_to, $users_from);
            $is_admin = true;
        }

        $user = App\User::find($id);
        return view('user.show', [
            'user' => $user,
            'id_to'=> $id,
            'messages' => $messages,
            'is_admin' => $is_admin,
            'users' => $users]);
    }

    public function correspondence($id_one, $id_two)
    {
        if ( ! Auth::user()->is_admin) {
            return redirect('/');
        }
        $messages = DB::table('messages')
        ->join('users', 'users.id', '=', 'messages.id_from')
        ->select('messages.text', 'users.name', 'messages.id_to')
        ->where([['id_to', $id_one], ['id_from', $id_two]])
        ->orWhere([['id_to', $id_two], ['id_from', $id_one]])
        ->orderBy('messages.created_at')
        ->get();
        
        $user1 = App\User::find($id_one);
        $user2 = App\User::find($id_two);
        return view('user.correspondence', [
            'user1' => $user1,
            'user2' => $user2,
            'messages' => $messages]);
    }

    public function userdelete($id)
    {
        if ( ! Auth::user()->is_admin) {
            return redirect('/');
        }
        DB::table('users')
            ->where('id', $id)
            ->update(['is_delete' => true]);

        return redirect('/user/' . $id);
    }

    public function userrecovery($id)
    {
        if ( ! Auth::user()->is_admin) {
            return redirect('/');
        }
        DB::table('users')
            ->where('id', $id)
            ->update(['is_delete' => false]);

        return redirect('/user/' . $id);        
    }

    public function postmessage($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'message' => 'required|max:1000'
        ]);
    
        if ($validator->fails()) {
            return redirect('/user/'.$id)
                ->withInput()
                ->withErrors($validator);
        }
    
        $message = new \App\Message;
        $message->text = $request->message;
        $message->id_from = Auth::id();
        $message->id_to = $id;
        $message->is_fresh = true;
        $message->save();

        return redirect('/user/'.$id);
    }
}