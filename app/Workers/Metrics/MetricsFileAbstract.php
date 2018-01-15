<?php namespace App\Workers\Metrics;

abstract class MetricsFileAbstract{

  protected $folder;
  protected $filename;
  protected $raw;
  protected $headers;
  protected $body;

  public function __construct($folder, $filename)
  {
    $this->folder = $folder;
    $this->filename = $filename;

    $this->openFile($this->filename);
  }

  //Открывает и обрабатывает файл
  public function openFile($filename)
  {
    $this->readFile($this->buildName($this->filename));
    if(!$this->raw)
      return;

    $this->readHeaders();
    $this->readBody();
  }

  //Генерирует путь к файлу
  protected function buildName($filename = false)
  {
    if(!$filename)
      $filename = $this->filename;

    return $this->folder.'/'.$filename;
  }

  abstract public function displayInfo();
  abstract public function displayBody(); //Показывает содержимое файла (без заголовков и уже обработанное)
  abstract protected function readFile($filename);
  abstract protected function readHeaders();
  abstract protected function readBody();
}