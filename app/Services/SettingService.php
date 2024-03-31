<?php

namespace App\Services;

use App\Models\Image;
use App\Models\Setting;
use App\Http\Trait\FileHandling;

class SettingService extends MainService
{
    use FileHandling;

    private $Setting;

    public function __construct()
    {
        parent::__construct(new Setting);
        $this->Setting = new Setting;
    }


    public function get()
    {
        return $this->Setting::first();
    }

    public function Upload_attachment($file)
    {
        $setting = $this->get();
        $path = $this->uplaodFile($file, 'attachments/logo/');
        $name = $file->getClientOriginalName();

        Image::create([
            'filename' => $name,
            'path' => $path,
            'imageable_id' => $setting->id,
            'imageable_type' => Setting::class,
        ]);
    }

    public function Delete_attachment($filename, $image_id)
    {
        $image = Image::find($image_id);

        $this->deleteFile($image->path);

        if ($image->filename == $filename){
            $image->delete();
        }
    }
}
