<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Hash;

class LearnController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['users']= User::all();
        return view('users',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = [
            'nome' => $request->nome,
            'email' => $request->email,
            'password' => Hash::make($request->nome),
        ];
        $save = User::insert('user');
        if($save)
            return redirect('users');
        else 
            return     redirect()->back()->withInp();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['users']= User::find($id);
        dd($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['users']= User::find($id);
        return view('create',$data);
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
        if($request->has('password')){
            $password = $request->password;
            $user = [
                'nome' => $request->nome,
                'email' => $request->email,
                'password' => $password,
            ];
        }    
        else{
            $user = [
                'nome' => $request->nome,
                'email' => $request->email,
            ];
        }

        $update = User::find($id)->update($user);
        if($update)
            return redirect('users');
        else 
            return redirect()->back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if($user){
            $user->destroy();
            $msg = 'mensagem';
        }else {
           $msg = 'outra mensagem';
        }

        return redirect()
            ->back()
            ->withSuccess($msg);

    }
}