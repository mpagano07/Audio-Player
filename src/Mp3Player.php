<?php

class Mp3Player implements PlayerInterface
{
    /**
     * @param $file
     * @return string
     */
	public function takeFile($file)
	{
		if (substr($file, -3) === 'mp3') {
			return 'estoy reproduciendo un mp3';
		}

		throw new InvalidArgumentException("Cannot read this format");
	}

    /**
     * @return string
     */
	public function play() 
	{
		return 'estoy reproduciendo un mp3';
	}
}
