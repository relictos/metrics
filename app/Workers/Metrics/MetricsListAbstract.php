<?php namespace App\Workers\Metrics;

abstract class MetricsListAbstract{

  protected $folder;
  protected $files_list;

  public function __construct($folder)
  {
    $this->folder = $folder;
    $this->readList($folder);
  }

  //Генерирует путь к файлу
  protected function buildName($filename = false)
  {
    return $this->folder.'/'.$filename;
  }

  abstract public function readList($folder);
  abstract public function displayList();
  abstract public function uploadFile($file);
  abstract public function removeFile($filename);
}