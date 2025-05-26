// app/Controllers/TestZip.php
<?php

namespace App\Controllers;

class TestZip extends BaseController
{
    public function index()
    {
        if (class_exists('ZipArchive')) {
            echo "SUCCESS: ZipArchive is ready!";
        } else {
            // Debug lebih detail
            print_r(get_loaded_extensions());
            echo "ERROR: ZipArchive still missing!";
        }
    }
}
