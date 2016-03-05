<?php namespace Sifter\Model;

class Attachment
{
    private $filename;
    private $size;
    private $height;
    private $width;
    private $url;
    private $thumbUrl;

    /**
     * Attachment constructor.
     * @param $filename string Name of the file
     * @param $size int Size of the file
     * @param $height int Height of image
     * @param $width int Width of image
     * @param $url string URL for the file
     * @param $thumbUrl string Thumbnail URL for the image
     */
    public function __construct($filename, $size, $height, $width, $url, $thumbUrl)
    {
        $this->filename = $filename;
        $this->size = $size;
        $this->height = $height;
        $this->width = $width;
        $this->url = $url;
        $this->thumbUrl = $thumbUrl;
    }

    /**
     * Get the file name
     * @return string
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * Get size of the file
     * @return int
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * Get height of the image
     * @return int
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * Get width of the image
     * @return int
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * Get URL for the file
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Get Thumbnail URL for the image
     * @return string
     */
    public function getThumbUrl()
    {
        return $this->thumbUrl;
    }






}
