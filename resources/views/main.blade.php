<!DOCTYPE html>
<html>
<head>
  <meta charset=utf-8>
  <meta name=viewport content="width=device-width,initial-scale=1">
  <meta id="csrf-token" name="csrf-token" content="{{ csrf_token() }}">
  <title>test</title>
  <link href="{{mix('css/vue.css')}}" rel=stylesheet>
</head>
<body>

  <div id=app>

  </div>

  <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/socket.io/1.7.3/socket.io.min.js"></script>
  <script type=text/javascript src="{{mix('js/manifest.js')}}"></script>
  <script type=text/javascript src="{{mix('js/vendor.js')}}"></script>
  <script type=text/javascript src="{{mix('js/main.js')}}"></script>
</body>
</html>

<?php
broadcast(new \App\Events\FilesEvent());
    ?>