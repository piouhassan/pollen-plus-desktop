<?php


namespace Akuren\File;


class File
{


    /**
     * @return UploadConfig
     */
    public static  function to()
    {
        return new UploadConfig();
    }
}