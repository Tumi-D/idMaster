<?php

/**
 * Created by PhpStorm.
 * User: oduru
 * Date: 4/13/2019
 * Time: 7:00 AM
 */

class Tests extends PostController
{

    public function ap()
    {

        $rs = new RestApi();
        $rs->processApi();
    }
    public function upload()
    {
        extract($_FILES);
        $rules =[
          'image'=>'file.*|size:400|mimes:csv,txt,xls,pdf|empty'
        ];
        validate($rules,'json');
        dd($_FILES);

        // dd($image);
        $target_dir = "\\uploads\\";
        $target_file = APPROOT."\public\\".$target_dir . basename($_FILES["image"]["name"]);
        // dd($target_file);
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        // Check if file already exists
        $uploadOk =1;
        if (file_exists($target_file)) {
             simplerror("Sorry, file already exists.",422);
            $uploadOk = 0;
        }
        // Check file size
        if ($_FILES["image"]["size"] > 500000) {
            simplerror("Sorry, your file is too large",422);
            $uploadOk = 0;
        }
        dd($imageFileType);
        // Allow certain file formats
        if (
            $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif"
        ) {
            simplerror("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            simplerror("Sorry, your file was not uploaded.");
            // if everything is ok, try to upload file
        } else {
            // dd($_FILES["image"]["tmp_name"]);
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                json_encode("The file " . htmlspecialchars(basename($_FILES["image"]["name"])) . " has been uploaded.");
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }
}
