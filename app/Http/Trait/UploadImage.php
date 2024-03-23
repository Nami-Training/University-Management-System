<?php

namespace App\Http\Trait;

use Illuminate\Support\Str;
trait UploadImage{

    public function uplaod($file)
    {
        $fileName =  Str::uuid() . $file->getClientOriginalName();
        $file->move(public_path('images'), $fileName);
        $path =  '/images/' . $fileName;
        return $path;
    }
}