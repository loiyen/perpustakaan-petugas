<?php

use Aws\S3\S3Client;


function uploadFiles3New($folder,$file)
{
    $objAwsS3Client = new S3Client([
        'version'      => 'latest',
        'endpoint'     => 'https://nos.wjv-1.neo.id',
        'region'       => AWS_ACCESS_REGION,
        'credentials'  => [
            'key'      => AWS_ACCESS_KEY_ID,
            'secret'   => AWS_ACCESS_KEY_SECRET
        ]
    ]);
    $fileName       = $_FILES[$file]['name'];
    $fileTempName   = $_FILES[$file]['tmp_name'];
    $fileNameCmps   = explode(".", $fileName);
    $fileExtension  = strtolower(end($fileNameCmps));
    $newFileName    = $folder.'/'.md5(time() . $fileName) . '.' . $fileExtension;

    try {
        $objAwsS3Client->putObject([
            'Bucket' => AWS_BUCKET_NAME,
            'Key'    => $newFileName,
            'Body'   => fopen($fileTempName, 'r'),
            'ACL'    => 'public-read'
        ]);

        return $newFileName;
    } catch (Aws\S3\Exception\S3Exception $e) {
        //  var_dump($e);
        return "error.jpg";
    }
}


function validateUpload($file, $allowed_extensions, $max_size)
{
    $errors = array();

    // // Check if file was uploaded
    // if ($_FILES[$file]['error'] == UPLOAD_ERR_NO_FILE) {
    //     $errors[] = 'Tidak ada file yang diupload';
    // }

    // Check if the file extension is allowed
    $fileNameCmps   = explode(".", $_FILES[$file]['name']);
    $fileExtension  = strtolower(end($fileNameCmps));
    if (!in_array($fileExtension, $allowed_extensions)) {
        $errors[] = 'Tipe file yang diizinkan ' . implode(', ', $allowed_extensions);
    }

    // Check if file size exceeds the max allowed
    if ($_FILES[$file]['size'] > $max_size) {
        $errors[] = 'Ukuran file minimal 1 MB';
    }

    return $errors;
}

