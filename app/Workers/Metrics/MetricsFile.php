<?php namespace App\Workers\Metrics;

use App\Workers\Metrics\MetricsAbstract;
use Illuminate\Support\Facades\Storage;

class MetricsFile extends MetricsFileAbstract{

  const HEADER_MARKER = "#"; //Маркер заголовков
  protected $sep_marks = [' ', '  ']; //Возможные разделители между данными внутри блока данных

  public function readFile($filename){
      if(!Storage::exists($filename))
        die('File not found');

      $raw = Storage::get($filename);
      $this->raw = explode("\r\n", $raw);
      if($this->raw[0][0] !== $this::HEADER_MARKER)
        throw new \Exception();
  }

  public function readHeaders()
  {
    $headers = [];
    foreach($this->raw as $line)
    {
      if(isset($line[0]) && $line[0] == $this::HEADER_MARKER)
        $headers[] = $line;
    }

    $this->headers = $headers;
  }

  public function readBody()
  {
    $body = [];
    foreach($this->raw as $line)
    {
      if(isset($line[0]) && $line[0] != $this::HEADER_MARKER)
      {
        //Ищем нужный нам символ разделитель. Если нашли - добавляем разделенную на ключ\значение строку в тело
        //Если не нашли - ничего не добавляем в тело*
        foreach($this->sep_marks as $mark)
        {
          $sep_line = explode($mark, $line);

          if(isset($sep_line[1])){
            $body[] = [
                'mark' => $sep_line[0],
                'val' => $sep_line[1]
            ];
            break;
          }
        }
      }
    }

    $this->body = $body;
  }

  public function displayInfo()
  {
    $result = [
        'info' => [
            'name' => $this->filename,
            'path' => $this->buildName($this->filename)
        ],
        'body' => $this->displayBody()
    ];

    return $result;
  }

  public function displayBody()
  {
    return $this->body;
  }
}