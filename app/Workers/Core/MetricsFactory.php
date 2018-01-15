<?php namespace App\Workers\Core;

use App\Workers\Metrics\MetricsListAbstract;

//Нужна для того, чтобы можно было обрабатывать разные типы файлов в зависимости от конфига
class MetricsFactory{

  //Получения класса для работы со списком файлов метрик
  public function getListWorker()
  {
    $list_name = config('metrics.current_list');
    $list_class = config('metrics.list_providers.'.$list_name);
    if(!$list_class) return false;

    $folder = config('metrics.current_folder');
    return new $list_class($folder);
  }

  //Получение классая для работы с файлом метрики
  public function getRecWorker($filename)
  {
    $rec_name = config('metrics.current_rec');
    $rec_class = config('metrics.rec_providers.'.$rec_name);
    if(!$rec_class) return false;

    $folder = config('metrics.current_folder');
    return new $rec_class($folder, $filename);
  }
}