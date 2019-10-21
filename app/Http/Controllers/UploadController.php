<?php

namespace App\Http\Controllers;

use App\Property;
use App\Upload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class UploadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Upload  $upload
     * @return \Illuminate\Http\Response
     */
    public function show(Upload $upload)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Upload  $upload
     * @return \Illuminate\Http\Response
     */
    public function edit(Upload $upload)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Upload  $upload
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Upload $upload)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Upload  $upload
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $upload = Upload::find($id);
        if($upload){
            unlink(public_path('/upload/'.$upload->name));
            $upload->delete();
            return response()->json(['message' => 'Successed!'], 200);
        } else {
            return response()->json(['message' => 'Not Found!'], 422);
        }
    }

    public function upload(Request $request)
    {
        $file = $request->file('file');
        $ext = $file->getClientOriginalExtension();
        $newName = uniqid().uniqid().uniqid().uniqid().uniqid().uniqid().'.'.$ext;
        if($file->move(public_path('/upload/'), $newName)) {
            $upload = new Upload();
            $upload->name = $newName;
            $upload->path = url('/upload/'.$newName);
            $upload->save();
            return response()->json(['id' => $upload->id, 'name' => $upload->name, 'path' => $upload->path]);
        }
    }
}
