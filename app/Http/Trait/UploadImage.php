<?php

namespace App\Http\Trait;

use Illuminate\Support\Str;
trait UploadImage{

    public function uplaod($file, $path)
    {
        $fileName =  Str::uuid() . $file->getClientOriginalName();
        $file->move(public_path($path), $fileName);
        $path =  $path . $fileName;
        return $path;
    }
}
