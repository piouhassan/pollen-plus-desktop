<?php


namespace Akuren\File;


class UploadConfig extends Upload
{

    protected  $path = 'images';

    protected  $formats =  [
        'thumb' => [350 , 350]
        ];

}