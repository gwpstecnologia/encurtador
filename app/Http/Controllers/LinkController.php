<?php

namespace App\Http\Controllers;
use App\Models\Link;
use App\Models\View;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LinkController extends Controller
{
    public function redirect(Request $request) {

        if ($request->link !== null) {
            $busca = Link::where('link', $request->link)->first();
            if ($busca) {

                if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                    $ip = $_SERVER['HTTP_CLIENT_IP'];
                       } elseif (!empty($_SERVER['HTTP_X_REAL_IP'])) {
                    $ip = $_SERVER['HTTP_X_REAL_IP'];
                      } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
                    $ip = preg_replace('/,.*/', '', $ip); 
                    } else {
                    $ip = $_SERVER['REMOTE_ADDR']; 
                    }
                    $ip = preg_replace('/^::ffff:/', '', $ip);

                View::create(['link_id' => $busca->id, 'ip_address' => $ip]);

                return redirect($busca->destination);
                
            } else {

                return abort(404);
            }

        }else{

            return redirect()->route('create');
        }

    }

    public function create(Request $request) {

        return view('create');

    }

    public function create_post(Request $request) {
        $user= auth()->user();

        if (isset($request->destination)) {

            if (isset($request->link)) {

                $dados = Link::where('link', $request->link)->first();

                    if ($dados == false) {
                        Link::create(['user_id' => $user->id, 'link' => $request->link,
                        'destination' => $request->destination]);

                        return redirect()->route('create')->with('completo', $request->link) ;

                    } else {

                        return redirect()->route('create')->with('error', 'URL personalizado em uso');

                    }

            } else {

                $gerado = Str::random(5);
                $dados = Link::where('link', $gerado)->first();

                if ($dados == false) {
                    Link::create(['user_id' => $user->id, 'link' => $gerado,
                    'destination' => $request->destination]);

                    return redirect()->route('create')->with('completo', $gerado);

                } else {
                    for ($dados == true;;) {

                        $gerado = Str::random(5);
                        $dados = Link::where('link', $gerado)->first();
    
                        if ($dados == false) {

                            Link::create(['user_id' => $user->id, 'link' => $gerado,
                            'destination' => $request->destination]);

                            return redirect()->route('create')->with('completo', $gerado);
                        };
                    };


                }
                      

            }

        } else { 

            return redirect()->route('create')->with('error', 'URL inválido');

        }
            

    }

    public function show(Request $request) {

        if (isset($request->showid)) {

            $user= auth()->user();
            $dados = Link::where(['user_id' => $user->id, 'id' => $request->showid])->first();
            $view = View::where(['link_id' => $request->showid])->count();
    
            return view('show', ['edit' => $dados, 'view' => $view]);

        } else {
            $user= auth()->user();
            $dados = Link::where('user_id', $user->id)->get();
    
            return view('show', ['links' => $dados]);

        }


        
    }

    public function delete(Request $request) {
        $user= auth()->user();
        $dados = Link::where(['user_id' => $user->id, 'id' => $request->id])->delete();

        if ($dados == true) {
            return redirect()->route('show')->with('success', 'Item deletado com sucesso');
        } else {
            return redirect()->route('show')->with('error', 'Erro, tente novamente mais tarde');
        }

        
        
    }

    public function edit(Request $request) {

        $user= auth()->user();
        $dados = Link::where(['user_id' => $user->id, 'id' => $request->id])->update(['title' => $request->title, 'link' => $request->link]);

        if ($dados) {
            return redirect()->route('show')->with('success', 'Atualizado com sucesso');

        } else {
            return redirect()->route('show')->with('error', 'Indisponível no nomento');

        }
        
        
    }

    public function about(Request $request) {

        return view('about');
        
    }
}
