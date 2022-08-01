<?php

namespace App\Services;

use App\Exceptions\ServerErrorException;

class FileManagementService
{
    /**
     * @param string $fileName
     * @return bool
     * @throws ServerErrorException
     */
    public function isFileExists($fileName): bool
    {
        return file_exists($this->getFile($fileName));
    }

    /**
     * @param $fileName
     * @return string
     * @throws ServerErrorException
     */
    public function getFileContent($fileName): string
    {
        $file = file_get_contents($this->getFile($fileName));

        if($file===false) {
            throw new ServerErrorException('File not found', 500);
        }

        return $file;
    }

    /**
     * @param $fileName
     * @param $content
     * @return int
     * @throws ServerErrorException
     */
    public function createFile($fileName, $content): bool
    {
        $file = file_put_contents($this->getFile($fileName), $content);

        if($file===false) {
            throw new ServerErrorException('File not found', 500);
        }

        return $file;
    }

    /**
     * @param $fileName
     * @return string
     */
    private function getFile($fileName): string
    {
        return __DIR__.'/../../storage/app/'.$fileName;
    }
}