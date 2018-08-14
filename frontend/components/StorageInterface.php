<?php

namespace frontend\components;

use yii\web\UploadedFile;

/**
 * File storage interface
 *
 * @author Petro Kulybaba <ahurtep@gmail.com>
 */
interface StorageInterface
{
    public function saveUploadedFile(UploadedFile $file);
    
    public function getFile(string $filename);
}
