<?php

class WavPlayer implements PlayerInterface
{
	/**
	 * @var string
	 */
	private $file;
	
	/**
	 * @param string $file
	 * @return string
	 */
	public function takeFile($file) 
	{
		$this->file = $file;
		
		return 'El reproductor de wav recibio el archivo ' . $this->file;
	}
	
	/**
	 * @param void
	 * @return string
	 */
	public function play() 
	{
		return 'El reproductor de wav esta reproduciendo el archivo ' . $this->file;
	}
}
