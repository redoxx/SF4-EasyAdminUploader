<?php

// src/Service/MessageGenerator.php
namespace App\Service;
use App\Entity\CodesCsvFile as CodesCsvFile;

class S3Uploader
{
    private $csvFile;

    public function __construct(CodesCsvFile $csvFile)
    {
        $this->csvFile = $csvFile;
    }

    public function upload_file()
    {
//var_dump($this->csvFile);
        throw new \Exception('Failed upload');
        return 'Did it ...';
    }
}
