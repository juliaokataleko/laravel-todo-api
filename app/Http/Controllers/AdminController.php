<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    public function config(Request $request) {

        $config = Config::first();
        $states = State::all();

        if ($request->isMethod('post')) {

            $data = request()->validate([
                'name' => 'required|string',
                'email' => 'required',
                'url' => '',
                'num_pages' => '',
                'about' => '',
                'privacy_policy' => '',
                'auto_block' => 'required',
                'periodo' => 'required|numeric',
                'dia' => 'required|numeric',
                'state_id' => '',
                'city_id' => '',
                'razao_social' => '',
                'telefone' => '',
                'celular' => '',
                'taxa' => '',
                'dias_atraso' => '',
            ]);

            if (isset($_FILES['photo']) && !empty($_FILES['photo']['tmp_name'])) {
                $permitidos = array('image/jpeg', 'image/jpg', 'image/png');
                if (in_array($_FILES['photo']['type'], $permitidos)) {
                    $nome = time() . rand(0, 9999) . '.jpg';
    
                    if(!null == $config->logo && file_exists('/uploads/config/'.$config->logo)) {
                        if(unlink('/uploads/config/'.$config->logo)) {
                            # dd('imagem removida com sucesso');
                        }
                    }
                    if (move_uploaded_file($_FILES['photo']['tmp_name'], 'uploads/config/' . $nome)) {
                        $data['logo'] = $nome;
                        
                    }
                }
            } 
    
            $save = DB::table('configs')
                ->where('id', $config->id)
                ->update($data);

            $request->session()->flash('success', 
                'Configurações actualizadas');
        }
        
        # dd($request->all());
        $config = Config::first();

        # dd($config);

        return view('admin.config', compact('config', 'states'));
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
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
