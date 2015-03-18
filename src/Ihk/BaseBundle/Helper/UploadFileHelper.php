<?php

namespace Ihk\BaseBundle\Helper;


class UploadFileHelper
{

	private $filesStorageFolder;
	private $filesWebFolder;

	public function __construct($filesStorageFolder, $filesWebFolder)
	{
		$this->filesStorageFolder = $filesStorageFolder;
		$this->filesWebFolder     = $filesWebFolder;
	}

	/**
	 * @param \Symfony\Component\HttpFoundation\File\UploadedFile $file
	 *
	 * @return string
	 * @throws \Exception
	 */
	public function upload(\Symfony\Component\HttpFoundation\File\UploadedFile $file)
	{

		$fileName       = time() . md5(uniqid(mt_rand(), true));
		$fileExtension  = $file->getClientOriginalExtension();
		$validExtension = array('jpg', 'jpeg', 'bmp', 'png');
		if (!in_array(strtolower($fileExtension), $validExtension)) {
			throw new \Exception('Invalid extension.', 400, 'Bad Request');
		}
		$oldName = $file->getPathname();
		//todo:make pictures in particular sizes
		$newName = $this->filesStorageFolder . '/' . $fileName . '.' . $fileExtension;
		rename($oldName, $newName);

		return $this->filesWebFolder . '/' . $fileName . '.' . $fileExtension;

	}

	/**
	 * @param $fileName
	 *
	 * @return bool
	 */
	public function removeUpload($fileName)
	{
		$file = $this->getStoragePath($fileName);
		if (is_file($file)) {
			unlink($file);

			return true;
		}

		return false;
	}

	/**
	 * @param $fileName
	 *
	 * @return bool
	 */
	private function getStoragePath($fileName)
	{
		$file = str_replace($this->filesWebFolder, $this->filesStorageFolder, $fileName);

		return $file;
	}
} 