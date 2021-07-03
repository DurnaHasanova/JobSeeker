<?php
function fileUpload(array $file, int $companyId): FileUploadResponse
{
    $response = new FileUploadResponse();
    global $imageDir;

    try {

        if (!getimagesize($file["tmp_name"][0])) {
            $response->code = 4;
            $response->message = "File is not an image";
            return $response;
        }
        $targetDirectory = $imageDir;
        $targetFileName = fileNameGenerator($companyId);
        $targetFile = $targetDirectory . $targetFileName .'.'. explode(".", $file["name"][0])[1];

        if (file_exists($targetFile)) {
            $response->code = 4;
            $response->message = "Sorry, there was an error uploading your file.";
            return $response;
        }

        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif") {
            $response->code = 4;
            $response->message = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            return $response;
        }

        try{
            $result = move_uploaded_file($file["tmp_name"][0], $targetFile);
        }
        catch (Exception){

        }

        if ($result) {
            $response->code = 0;
            $response->message = "File succesfully uploaded";
            $response->fileName=$targetFile;
            return $response;
        } else {
            $response->code = 4;
            $response->message = "Sorry, there was an error uploading your file.";
            return $response;
        }
    } catch (Exception $ex){

            $response->code=5;
            $response->message=$ex->getMessage();
            return  $response;
   }

}


function  fileNameGenerator($menuId)
{
    return strval($menuId) . '-' . date('ydmhms');
}

class FileUploadResponse
{
    public int $code;
    public string $message;
    public  string $fileName;


}