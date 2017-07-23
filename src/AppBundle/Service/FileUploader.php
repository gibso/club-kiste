<?php

namespace AppBundle\Service;

use Symfony\Component\HttpFoundation\File\File;

/**
 * Class FileUploader
 */
class FileUploader
{
    /**
     * @param File $file
     * @param string $path
     *
     * @return string
     */
    public function uploadFileTo(File $file, $path)
    {
        $fileName = md5(uniqid()) . '.' . $file->guessExtension();
        $file->move(
            $path,
            $fileName
        );
        return $fileName;
    }
}