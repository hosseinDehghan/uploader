<?php

namespace Hosein\Uploader\Controllers;

use Hosein\Uploader\Upload;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class UploaderController extends Controller
{
    public function index(){
        $data["files"]=Upload::all();
        return view("UploaderView::uploader",$data);
    }
    public function upload(Request $request){
        $validator=Validator::make($request->all(),[
            'title'=>'required|max:100',
            'src'=>'required|max:100000'
        ]);
        if($validator->fails()){
            return redirect("uploader")
                ->withErrors($validator,"errorFile")
                ->withInput();
        }
        if(!$this->checkExtention($request->file("src")->getClientOriginalExtension())){
            return redirect("uploader")
                ->with("errorFile","file must be jpg,png,jpeg,zip,pdf,docx");
        }
        $path=public_path()."/upload/";
        $filename=$this->checkFileName($path,$request->file("src")->getClientOriginalName());
        if($request->file("src")->move($path,$filename)){
            $upload=new Upload();
            $upload->title=$request->all()["title"];
            $upload->src=$filename;
            $upload->save();
            return redirect("uploader")->with("errorFile","با موفقیت آپلود شد");
        }
        else{
            return redirect("uploader")->with("errorFile","آپلود فایل با مشکل مواجه شده است");
        }

    }
    public function deleteFile($id){
        $file=Upload::where("id",$id)->first();
        $path=public_path()."/upload/";
        if($this->trash($path,$file->src)){
            $file->delete();
            return redirect("uploader")->with("errorFile","با موفقیت $file->src حذف شد.");
        }
        else{
            return redirect("uploader")->with("errorFile","مشکلی در حذف فایل بوجود آمده است");
        }
    }
    public function checkExtention($extention){
        $list=['jpg','png','jpeg','zip','pdf','docx'];
        foreach ($list as $value){
            if($value==$extention){
                return 1;
            }
        }
        return 0;
    }
    public function checkFileName($path,$filename){
        $name=explode('.',$filename)[0];
        $extenstion=explode('.',$filename)[1];
        while(file_exists($path.$filename)){
            $filename=$name."_".rand(1,10000000).".".$extenstion;
        }
        return $filename;
    }
    public function trash($path,$filename){
        if(file_exists($path."/".$filename)){
            unlink($path."/".$filename);
            return 1;
        }
        return 0;
    }
}
