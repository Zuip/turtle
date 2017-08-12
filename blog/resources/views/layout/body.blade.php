<!DOCTYPE html>
<html lang="<% trans('views.common.languageCode') %>" ng-app="zui">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Zui">
    <link rel="icon" href="/assets/icon.png">
    
    @if(trans('views.common.languageCode') == 'en')
      <base href="/en/">
    @else
      <base href="/">
    @endif

    <title>Zui.fi</title>

    <!-- Third party fonts -->
    <link href="https://fonts.googleapis.com/css?family=Caveat+Brush" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    
    <!-- Third party CSS -->
    <!-- <link href="/assets/thirdparty/bootstrap-3.3.2/css/bootstrap.min.css" rel="stylesheet"> -->

    <!-- Custom styles -->
    <link href="/assets/css/app.css" rel="stylesheet">
  </head>

  <body>
    
    <div id="app"></div>
    
    <?php /*
    <nav class="navbar navbar-default">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".nav-main" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          </button>
          <a class="navbar-brand" href="/" style="margin-right:10px;">
            <span class="glyphicon glyphicon-camera" aria-hidden="true"></span> Zui.fi
          </a>
        </div>
          
        <div id="navbar" class="collapse navbar-collapse nav-main">
          <ul class="nav navbar-nav">
            @include('layout.categoryDropdown')
            <li>
              <a href="/about">
                <% trans('views.about.menuTopic') %>
              </a>
            </li>
            <li ng-controller="UserController as user" ng-show="isAdmin()">
              <a href="<% trans('admin.link') %>">
                <% trans('admin.menuTopic') %>
              </a>
            </li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li ng-controller="UserController as user" ng-show="user.username"
                @if(\Auth::check())
                ng-init="user.username = '<% \Auth::user()->name %>';user.permissionLevel = '<% \Auth::user()->permissionlevel %>'"
                @endif
                >
              <a ng-click="logout()" style="padding:12px;font-size:24px;cursor:pointer" title="<% trans('views.logout.menuTooltip') %>" data-toggle="tooltip" data-placement="bottom">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    
    <div class="container">
      <div class="row">
        <div class="col-sm-2 sidebar"></div>
        <div id="app" class="col-sm-8 content" ng-view>
        </div>
        <div class="col-sm-2 sidebar"></div>
      </div>
    </div>
    
    <footer class="blog-footer">
      <p>&copy; 2015-2017 Zui.fi</p>
    </footer>
    
    <!-- Google Analytics -->
    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-89629930-1', 'auto');
      ga('send', 'pageview');
    </script>
    
    <!-- jQuery-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    
    <!-- Language handler -->
    <!-- <script src="/scripts/language.js"></script> -->
    
    */ ?>
    
    <script type="text/javascript">
      var GlobalState = {
        language: "<% trans('views.common.languageCode') %>",
        @if(trans('views.common.languageCode') == 'en')
          rootURL: "<% URL::to('/') %>/en"
        @else
          rootURL: "<% URL::to('/') %>"
        @endif
      };
    </script>
    
    <!-- Third party JavaScripts -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBZ5b-VSBFUZVEUigMBiGITuacfH9KHHeg"></script>

    <!-- Own JavaScripts -->
    <script src="/scripts/app.bundle.js"></script>
    
    <?php /*
    
    <!-- Old AngularJS functionalities
    <script src="/scripts/app.js"></script>
    <script src="/scripts/services/LanguageService.js"></script>
    <script src="/scripts/services/SpinnerService.js"></script>
    <script src="/scripts/models/HomeModel.js"></script>
    <script src="/scripts/models/LoginModel.js"></script>
    <script src="/scripts/models/UserModel.js"></script>
    <script src="/scripts/models/CategoryModel.js"></script>
    <script src="/scripts/models/ArticleModel.js"></script>
    <script src="/scripts/models/admin/AdminModel.js"></script>
    <script src="/scripts/models/admin/AdminCategoryModel.js"></script>
    <script src="/scripts/models/admin/AdminArticleModel.js"></script>
    <script src="/scripts/models/admin/CategoryEditorModel.js"></script>
    <script src="/scripts/models/NotFoundModel.js"></script>
    <script src="/scripts/controllers/HomeController.js"></script>
    <script src="/scripts/controllers/LoginController.js"></script>
    <script src="/scripts/controllers/UserController.js"></script>
    <script src="/scripts/controllers/CategoryController.js"></script>
    <script src="/scripts/controllers/ArticleController.js"></script>
    <script src="/scripts/controllers/admin/AdminController.js"></script>
    <script src="/scripts/controllers/admin/AdminCategoryController.js"></script>
    <script src="/scripts/controllers/admin/AdminArticleController.js"></script>
    <script src="/scripts/controllers/admin/CategoryEditorController.js"></script>
    <script src="/scripts/controllers/NotFoundController.js"></script>
    -->
    
    <!-- Short JavaScripts common for all templates -->
    <script type="text/javascript">
      
      // Enable Bootstrap tooltips
      /* $(function () {
        $('[data-toggle="tooltip"]').tooltip();
        $('#chooseLanguage').tooltip();
      });
      
      // Choosing the locale
      $('.languageSelect').click(function(e) {
        var languageUrl = window.location.pathname;
        if (languageUrl === '/en') {
          languageUrl = '/';
        } else if(languageUrl.search(/\/en/) === 0) {
          languageUrl = languageUrl.replace('/en', '');
        }
        if($(this).attr('lan') !== 'fi') {
          languageUrl = '/' + $(this).attr('lan') + languageUrl;
        }
        window.location = languageUrl;
      });
      
      // Allow only one navbar open at once
      $('.navbar-toggle').on('click', function () {
        if(!$(this).siblings('.navbar-toggle').hasClass('collapsed')) {
          $(this).siblings('.navbar-toggle').click();
        }
      });
      
      // Setting how to show language menu depending on is user using mobile or normal version
      function initializeLanguageMenu() {
        if($('#mobileLanguageMenu').css('display') === 'none') {
          $('#languagesDropdownMenu').css('display', 'block');
          $('#languagesMobileMenu').find('li').css('display', 'none');
        } else {
          $('#languagesDropdownMenu').css('display', 'none');
          $('#languagesMobileMenu').find('li').css('display', 'block');
        }
      }
      $(document).ready(function() { initializeLanguageMenu(); });
      $(window).resize(function()  { initializeLanguageMenu(); });
      
    </script> */ ?>
  </body>
</html>