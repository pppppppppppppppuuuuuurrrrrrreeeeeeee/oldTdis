<?php
require 'ChromePhp.php';
$path = $_POST['path'];
$name = explode('/', $path);
$nameexp = "/var/www/html/export/".$name[1].".zip";
ChromePhp::log($nameexp);
// Get real path for our folder
$rootPath = realpath($path);

// Initialize archive object
$zip = new ZipArchive();
$zip->open($nameexp, ZipArchive::CREATE | ZipArchive::OVERWRITE);

// Create recursive directory iterator
/** @var SplFileInfo[] $files */
$files = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($rootPath),
    RecursiveIteratorIterator::LEAVES_ONLY
);

foreach ($files as $name => $file)
{
    // Skip directories (they would be added automatically)
    if (!$file->isDir())
    {
        // Get real and relative path for current file
        $filePath = $file->getRealPath();
        $relativePath = substr($filePath, strlen($rootPath) + 1);

        // Add current file to archive
        $zip->addFile($filePath, $relativePath);
    }
}
echo $nameexp;
// Zip archive will be created only after closing object
$zip->close();