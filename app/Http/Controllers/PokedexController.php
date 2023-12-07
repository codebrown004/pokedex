<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pokedex;

class PokedexController extends Controller
{
    public function __construct()
    {
        // $this->middleware(function ($request, $next) {
        //     return $next($request);
        // });
    }
    public function add_pokemon()
    {
        $data = Pokedex::where('pokemon_id', request('id'))->where('user_id', auth()->user()->id)->get();
        $result = Pokedex::where('reaction', request('react'))->where('user_id', auth()->user()->id)->get();
        $res = [];

        if(count($data) > 0)
        {
            $res['error'] = 'You already '.$data[0]->reaction.'d '.$data[0]->name;
        }
        else if(in_array(request('react'), ['like', 'hate']) && count($result) >= 3 )
        {
            $res['error'] = 'You already '.request('react').'d (3) pokemons';
        }
        else
        {
            Pokedex::create([
                'pokemon_id' => request('id'),
                'name'      => request('pokemon'),
                'img_url'   => request('image'),
                'reaction'  => request('react'),
                'user_id'   => auth()->user()->id
            ]);
            $res['success'] = request('pokemon'). ' was added to Pokedex.';
        }
        echo json_encode($res);
    }

    public function test()
    {
        $data = Pokedex::where('reaction', 'like')->where('user_id', 3)->get();
        echo count($data);
        // if(count($data) > 0)
        // {
        //     dd($data[0]->name);
        //     // echo $data['name'];
        //     echo "will not proceed";
        // }
        // else
        // {
        //     echo "proceed";
        // }
    }
}
