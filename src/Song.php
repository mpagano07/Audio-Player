<?php

class Song
{
    /**
     * @var bool|string
     */
    private $extension;

    /**
     * @var string
     */
    private $title;

    /**
     * Song constructor.
     * @param string $fileName
     */
    public function __construct(string $fileName = '')
    {
        $this->extension = $this->parseExtension($fileName);
        $this->title = $this->parseTitle($fileName);
    }

    /**
     * @param string $fileName
     * @return string
     */
    private function parseTitle(string $filename)
    {
        return strstr($filename, '.', true);
    }

    /**
     * @param $fileName
     * @return bool|string
     */
    private function parseExtension(string $fileName)
    {
        return substr($fileName, -3);
    }

    /**
     * @return bool|string
     */
    public function getExtension()
    {
        return $this->extension;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }
}
