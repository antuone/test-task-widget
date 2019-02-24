<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App;

class MessengerController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = DB::table('users')->count();
        
        $is_users = false;
        
        if ($users == 0) {
            $is_users = true;
        }
        
        $users = App\User::select('id', 'name')
            ->where('id', '!=', Auth::id())
            ->get();

        $messages = DB::table('messages')
            ->join('users', 'users.id', '=', 'messages.id_from')
            ->select('messages.text', 'users.name')
            ->where([['id_to', Auth::id()],['is_fresh', 'true']])
            ->orderBy('messages.created_at')
            ->get();
        
        DB::table('messages')
            ->where('id_to', Auth::id())
            ->update(['is_fresh' => false]);

        return view('welcome', ['messages' => $messages, 'users' => $users, 'is_users' => $is_users]);
    }
}