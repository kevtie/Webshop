<?php
namespace App\Helpers;

use Image;

class ImageCropper
{
  protected $imageFile;
  protected $imageName;

  public function __construct($imageFile){
    $this->imageFile = $imageFile;
    $this->imageName = bin2hex(random_bytes(6).time()).'.'.$this->imageFile->extension();
  }

  public function saveCroppedImage(int $width, int $height, string $filePath){
    $img = Image::make($this->imageFile->path());
    $img->resize($width, $height, function ($const) {
        $const->aspectRatio();
    })->save($filePath.'/'.$this->imageName);
  }
  public function saveImage(string $filePath){
    $this->imageFile->move($filePath, $this->imageName);
  }
  public function unlinkImage(string $imageName){
    if(file_exists('images/' . $imageName)){
    unlink('images/' . $imageName);
    unlink('product_images/' . $imageName);
    unlink('search_icon/' . $imageName);
    };
  }
  public function getImageName(){
    return $this->imageName;
  }
}
 ?>
