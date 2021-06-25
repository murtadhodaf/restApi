<?php

namespace App\Http\Controllers;

use App\Models\pengguna;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class penggunasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pengguna = pengguna::orderBy('id', 'ASC')->get();
        $response = [
            'message'=>'List Username',
            'data'=> $pengguna
        ];
        return response()->json($response, Response::HTTP_OK);
    }

    // /**
    //  * Show the form for creating a new resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function create()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = validator::make($request->all(), [
            'username'=>['required', 'min:3'],
            'password'=>['required', 'min:7'],
            'name'=>['required', 'min:3'],
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        };

        
        try {
            $pengguna = pengguna::create($request->all());
            $response = [
                'message'=> 'Pengguna Berhasil ditambahkan',
                'data'=>$pengguna
            ];


            return response()->json($response, Response::HTTP_CREATED);
        } catch (QueryException $object) {
            return response()->json([
                'message'=>'failed'. $object->errorInfo
            ]);
        
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pengguna = pengguna::findOrFail($id);
        $response = [
            'message'=> 'Detail Pengguna',
            'data'=>$pengguna
        ];
        return response()->json($response, Response::HTTP_OK);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function edit($id)
    // {
    //     $pengguna = pengguna::findOrFail($id);
    //     $response = [
    //         'message'=> 'Pengguna Berhasil ditambahkan',
    //         'data'=>$pengguna];

        
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $pengguna = pengguna::findOrFail($id);
        $validator = validator::make($request->all(), [
            'username'=>['required', 'min:3'],
            'password'=>['required', 'min:7'],
            'name'=>['required', 'min:3'],
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        };
        
        try {
            $pengguna->update($request->all());
            $response = [
                'message'=> 'Pengguna Berhasil diupdate',
                'data'=>$pengguna
            ];
            return response()->json($response, Response::HTTP_OK);
        } catch (QueryException $object) {
            return response()->json([
                'message'=>'failed'. $object->errorInfo
            ]);
        
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pengguna = pengguna::findOrFail($id);
        
        try {
            $pengguna->delete();
            $response = [
                'message'=> 'Pengguna Berhasil dihapus'
                
            ];


            return response()->json($response, Response::HTTP_OK);
        } catch (QueryException $object) {
            return response()->json([
                'message'=>'failed'. $object->errorInfo
            ]);
        
        }
    }
}
