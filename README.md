# PHP Secure Image Uploader

Easy, secure image uploader for handling form submissions with PHP

## Usage

The `ImgUploader` class is very self contained, all you really need to know for basic usage is as follows:

* Constructor
  
    Pass to the constructor the information of one item in the `$_FILES` array - for instance
    `$_FILES['uploadedImage']` if your form used the name `uploadedImage`.
  
* `upload_unscaled()`

    `upload_unscaled()` takes two parameters, a directory (or series of directories) and a filename *without* the extension.
    the directories should be from the web root (though you can of course use ../ to navigate above that).
    the filename will be appended with the appropriate extension automatically.

* `upload()`

    `upload()` takes two additional parameters to `upload_unscaled()`, a maximum width and height for the image.
    The final image will be scaled down so it is no larger than either the width or height passed.

    there is an optional fifth parameter which defaults to false which ensure that images smaller
    than the maximum width and height are not scaled up.
    Passing true to this parameter will scale up small images, though this may reduce quality.
    
`upload_unscaled()` and `upload()` can be called as many times as needed, for instance to create
a thumbnail in one directory, a medium image in another, and the full sized image
(using `upload_unscaled()`) in an third directory.

## Details

### Maximum File Size

This script will allow images up to 5MB.  To change that, simply modify the if statement on line 55.
The script does not use the `MAX_FILE_SIZE` parameter of the HTML form since a malicious user can easily spoof that value.

### Error Checking

Both `upload_unscaled()` and `upload()` return false on failure, or the location of the image (from the web root) on success.
Any failure, be it at upload time, not an image, or a non-existent directory, will return false.
Call `getError()` to return the associated error code and handle the error accordingly.

Possible Errors and their codes:

* 101 - File is too large
* 102 - Upload failed or was interrupted
* 103 - File was not uploaded
* 104 - File is not an image
* 105 - File is not an acceptable image (gif, jpeg, png)
* 106 - File could not be saved because the directory does not exist

--------------------------------------------------------------------------------

## Example Usage

See `imguploader.test.php` for a more complete example:

    <?php
    include 'imguploader.class.php';

    $img = new imgUploader($_FILES['file']);
    if($name = $img->upload('images/demoFile', '1000', 400,400))
      echo '<img src="'.$name.'" alt="aPicture" />';
      // will output as <img src="/images/demoFile/1000.jpg" alt="aPicture" /> assuming file is a jpg
    else
      echo 'ERROR! '.$img->getError();
    }
    ?>

## Copyright

Copyright 2007 Michael Diamond

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.