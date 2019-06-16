<?php
namespace App\Traits;

trait ProcessesImages
{
    public function getImagePath ($image, $destination)
    {
        $fileName = $this->renameAndMove($image, $destination);
        $imagePath = $destination . '/' . $fileName;
        return $imagePath;
    }

    private function renameAndMove($image, $destination)
    {
        $randomKey = sha1(time() . microtime());
        $extension = $image->getClientOriginalExtension();
        $fileName = $randomKey . '.' . $extension;
        $image->move($destination, $fileName);
        return $fileName;
    }
}
