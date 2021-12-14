<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('pages.home');
    }

    public function profile()
    {
        return view('pages.profile');
    }

    public function update()
    {
        $this->validate(request(),[
            'firstname'  => 'required',
            'lastname'  => 'required',
            'birthday'  => 'required|date',
        ]);

        $user = User::find(auth()->user()->id);

        $user->update([
            'firstname' => request('firstname'),
            'lastname'  => request('lastname'),
            'birthday'  => request('birthday')
        ]);


        session()->flash('message', "Profile updated successfully!");
        return redirect('user/profile');
    }

    public function list()
    {
        return view('pages.users_list');
    }

    public function pokedex()
    {
        $users = DB::table('users as u')->join('pokedexes as po', 'u.id', '=', 'po.user_id')
                    ->select('u.firstname', 'u.lastname', 'po.name', 'po.img_url', 'po.reaction')
                    // ->whereNotIn('u.id', [auth()->user()->id])
                    ->get();

        $data = [];
        foreach($users as $u)
        {
            $data[] = array(
                        'name' => $u->firstname.' '.$u->lastname,
                        'pokemon' => '<div class="col-3 text-center"><image src="'.$u->img_url.'" class="border"/> <br>'.$u->name.'</div>',
                        'reaction' => ucfirst($u->reaction)
            );
        }
        echo json_encode(['data' => $data]);
    }


    public function destroy()
    {
        auth()->logout();

        return redirect('/login');
    }
    
}
