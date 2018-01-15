<html>
  <head>

  </head>
  <body>
    {{ Form::open(['url' => route('metrics.store'), 'method' => 'post', 'files' => true]) }}
      <input type="file" name="file">
      <button type="submit">Отправить</button>
    {{ Form::close() }}
  </body>
</html>