<?php

namespace App\Http\Controllers;

use App\Upload;
use App\VrTour;
use Illuminate\Http\Request;
use ZipArchive;

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

    public function uploadVrTour(Request $request)
    {
        $file = $request->file('file');
        $ext = $file->getClientOriginalExtension();
        $newName = uniqid().uniqid().uniqid().uniqid().uniqid().uniqid();
        $zipName = $newName.'.'.$ext;
        if($file->move(public_path('/vrtour/'),$zipName)) {
            $tour = new VrTour();
            $zip = new ZipArchive();
            $res = $zip->open(public_path('/vrtour/').$zipName);
            $zip->extractTo(public_path('/vrtour/') . $newName);
            $zip->close();
            unlink(public_path('/vrtour/').$zipName);
            $tour->title = $newName;
            $tour->path = url('/vrtour/'.$newName);
            $tour->save();
            return response()->json(['id' => $tour->id, 'title' => $tour->title, 'path' => $tour->path], 200);
        }
        return response()->json(['message' => 'انجم نشد!'], 422);
    }

    public function deleteVrTour(int $id)
    {
        $tour = VrTour::find($id);
        if($tour){
            if($tour->id == $id){

//                $target = public_path('/vrtour/'.$tour->title.'.zip');
//                if(is_dir($target)){
//                    $files = glob( $target . '*', GLOB_MARK ); //GLOB_MARK adds a slash to directories returned
//
//                    foreach( $files as $file ){
//                        delete_files( $file );
//                    }
//
//                    rmdir( $target );
//                } elseif(is_file($target)) {
//                    unlink( $target );
//                }
//                $target = public_path('/vrtour/'.$tour->title);
//                if(is_dir($target)){
//                    $files = glob( $target . '*', GLOB_MARK ); //GLOB_MARK adds a slash to directories returned
//
//                    foreach( $files as $file ){
//                        delete_files( $file );
//                    }
//
//                    rmdir( $target );
//                } elseif(is_file($target)) {
//                    unlink( $target );
//                }

                $tour->delete();
                return response()->json(['message' => 'با موفقیت حذف شد!'], 200);
            } else {
                return \response()->json([], 402);
            }
        } else {
            return response()->json([''], 404);
        }
    }

}
