<?php

namespace App\Http\Trait;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

trait FileHandling{

    public function uplaodFile($file, $path)
    {
        $fileName =  Str::uuid() . ',' . $file->getClientOriginalName();
        $file->move(public_path($path), $fileName);
        $path =  $path .$fileName;
        return $path;
    }

    public function deleteFile($path)
    {
        if(File::exists(public_path($path))){
            File::delete(public_path($path));
        }
    }
}
