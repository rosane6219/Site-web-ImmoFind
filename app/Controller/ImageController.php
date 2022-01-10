<?php

class ImageController extends Controller{

    public function download($url) {
        downloadImage($url);
    }
}
