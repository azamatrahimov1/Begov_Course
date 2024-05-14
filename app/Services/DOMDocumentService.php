<?php

namespace App\Services;

use DOMDocument;
use Illuminate\Support\Facades\File;

class DOMDocumentService
{
    public function processHTML($htmlContent)
    {
        $dom = new DOMDocument();
        $dom->loadHTML($htmlContent, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

        $images = $dom->getElementsByTagName('img');

        foreach ($images as $key => $img) {
            $src = $img->getAttribute('src');
            if (strpos($src, 'base64,') !== false) {
                $data = base64_decode(explode(',', explode(';', $src)[1])[1]);
                $image_name = "/storage/images/" . time() . $key . '.jpeg';
                file_put_contents(public_path($image_name), $data);

                $img->setAttribute('src', $image_name);
            }
        }

        return $dom->saveHTML();
    }

    public function delete($htmlContent)
    {
        if (!empty($htmlContent)) {
            $dom = new DOMDocument();
            $dom->loadHTML($htmlContent, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            $images = $dom->getElementsByTagName('img');

            foreach ($images as $img) {
                $path = public_path($img->getAttribute('src'));

                if (File::exists($path)) {
                    File::delete($path);
                }
            }
        }
    }

}
