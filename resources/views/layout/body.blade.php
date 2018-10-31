<!DOCTYPE html>
<html lang="<?php echo $browserLanguage; ?>">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Third party fonts -->
    <link href="https://fonts.googleapis.com/css?family=Caveat+Brush" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    
    <!-- Custom styles -->
    <link href="/assets/css/app.css" rel="stylesheet">
  </head>

  <body>

    <!-- Handling csrf -->
    <script> 
      var csrf_token = '<?php echo csrf_token(); ?>'; 
    </script>
    
    <div id="app"></div>

    <script>
      var CONFIG_ENVIRONMENT = '<?php echo env('APP_ENV'); ?>';
      var CONFIG_GOOGLE_ANALYTICS_KEY = '<?php echo env('GOOGLE_ANALYTICS_KEY'); ?>';
      var CONFIG_GOOGLE_MAPS_KEY = '<?php echo env('GOOGLE_MAPS_KEY'); ?>'
      var CONFIG_BROWSER_LANGUAGE = '<?php echo $browserLanguage; ?>';
    </script>

    <script>
      window.addEventListener('error', function(e) {
        var errorText = [
          e.message,
          'URL: ' + e.filename,
          'Line: ' + e.lineno + ', Column: ' + e.colno,
          'Stack: ' + (e.error && e.error.stack || '(no stack trace)')
        ].join('\n');

        var client = new XMLHttpRequest();
        client.open('POST', '/api/error/log');
        client.setRequestHeader('Content-Type', 'application/json');
        client.setRequestHeader('X-CSRF-TOKEN', csrf_token);
        client.send(JSON.stringify({errorText}));
      });
    </script>

    <!-- Own JavaScripts -->
    <script type="text/javascript" src="/scripts/app.js"></script>
    
  </body>
</html>