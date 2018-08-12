<!DOCTYPE html>
<html lang="<% trans('views.common.language') %>" ng-app="zui">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Zui">
    <link rel="icon" href="/assets/icon.png">

    <title>Zui.fi</title>

    <!-- Third party fonts -->
    <link href="https://fonts.googleapis.com/css?family=Caveat+Brush" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    
    <!-- Custom styles -->
    <link href="/assets/css/app.css" rel="stylesheet">
  </head>

  <body>
    
    <div id="app"></div>
    
    <!-- Third party JavaScripts -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBZ5b-VSBFUZVEUigMBiGITuacfH9KHHeg"></script>

    <!-- Own JavaScripts -->
    <script src="/scripts/app.js"></script>
    
    <!-- Handling csrf -->
    <script> 
      var csrf_token = '<?php echo csrf_token(); ?>'; 
    </script>
    
  </body>
</html>