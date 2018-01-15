<?php namespace App\Workers\Metrics;

use App\Workers\Metrics\MetricsListAbstract;
use Illuminate\Support\Facades\Storage;

class MetricsList extends MetricsListAbstract {

  //Сортирует список по полю
  protected function sortList(&$list, $field, $direction = 'desc')
  {
    usort($list, function($a, $b) use($field, $direction){
      if ($a[$field] == $b[$field]) {
        return 0;
      }

      if($direction == 'desc')
        return ($a[$field] > $b[$field]) ? -1 : 1;
      else
        return ($a[$field] < $b[$field]) ? -1 : 1;
    });
  }

  public function readList($folder)
  {
    $raw_list = Storage::files($folder);
    $files_list = [];

    foreach($raw_list as $i => $filepath)
    {
      $files_list[] = [
          'path' => $filepath,
          'filename' => basename($filepath),
          'updated_at' => Storage::lastModified($filepath)
      ];
    }

    //Сортирует список по убыванию
    $this->sortList($files_list, 'updated_at');

    $this->files_list = $files_list;
  }

  //Показывает список файлов
  public function displayList()
  {
    return $this->files_list;
  }

  //Загружает файл к нам в директорию
  public function uploadFile($file)
  {
    //Тут можно сделать чтото с файлом перед загрузкой или во время загрузки. Для того и абстракция
    $result = $file->store($this->folder);
    $this->readList($this->folder);

    return $result;
  }

  //Удаляет файл
  public function removeFile($filename)
  {
    if(!Storage::exists($this->buildName($filename)))
      return false;

    Storage::delete($this->buildName($filename));
    $this->readList($this->folder);

    return true;
  }
}