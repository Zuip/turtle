<!DOCTYPE html>
<html lang="<% trans('views.common.languageCode') %>" ng-app="zui">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Zui">
    <link rel="icon" href="/assets/icon.png">
    
    @if(trans('views.common.languageCode') == 'en')
      <base href="/en/">
    @else
      <base href="/">
    @endif

    <title>Zui.fi</title>

    <!-- Third party CSS -->
    <link href="/assets/thirdparty/bootstrap-3.3.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles -->
    <link href="/assets/css/style.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
    <nav class="navbar navbar-default">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".nav-main" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <?php /* Future feature: mobile change language menu
          <a class="navbar-toggle collapsed language" id="mobileLanguageMenu" data-toggle="collapse" data-target=".nav-language" aria-expanded="false" aria-controls="navbar">
            <span class="glyphicon glyphicon-globe" style="margin-right:3px;" aria-hidden="true"></span><span class="caret"></span>
          </a> */ ?>
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
            
            <?php /*
            <!-- Future feature: search articles
            <li>
              <a href="#" style="padding:12px;font-size:24px;" title="{{trans('views.search.menuTooltip')}}" data-toggle="tooltip" data-placement="bottom">
                <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
              </a>
            </li>
            -->
            
            <!-- Future feature: Change language
            <li class="dropdown" id="languagesDropdownMenu" style="font-size:16px">
              <a class="dropdown-toggle" id="chooseLanguage" data-toggle="dropdown" role="button" aria-expanded="false" style="padding:12px;font-size:24px;cursor:pointer" title="<% trans('views.chooseLanguage.menuTooltip') %>" data-placement="bottom">
                <span class="glyphicon glyphicon-globe" style="margin-right:3px;" aria-hidden="true"></span><span class="caret"></span>
              </a>
              <ul class="dropdown-menu" role="menu">
                @foreach(App\Models\Language::all() as $language)
                  <li>
                    <a class="languageSelect" lan="<% $language->code %>" style="cursor:pointer">
                      <% strtoupper($language->code) %> - <% ucfirst($language->name) %>
                    </a>
                  </li>
                @endforeach
              </ul>
            </li>
            -->
            */ ?>
            
          </ul>
        </div>
        
        <?php /* Future feature: Change language with mobile device
        <div id="languagesMobileMenu" class="collapse navbar-collapse nav-language">
          <ul class="nav navbar-nav">
            @foreach(App\Models\Language::all() as $language)
              <li>
                <a class="languageSelect" lan="<% $language->code %>" style="cursor:pointer">
                  <% strtoupper($language->code) %> - <% ucfirst($language->name) %>
                </a>
              </li>
            @endforeach
          </ul>
        </div>
        */ ?>
        
      </div>
    </nav>
    
    <div class="container">
      <div class="row">
        <div class="col-sm-2 sidebar"></div>
        <div class="col-sm-8 content" ng-view>
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
    <script src="/scripts/language.js"></script>
    
    <!-- Third party JavaScripts -->
    <script src="/assets/thirdparty/bootstrap-3.3.2/js/bootstrap.min.js"></script>
    <script src="/assets/thirdparty/ie10-viewport-bug-workaround.js"></script> <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.15/angular.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.15/angular-route.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.15/angular-resource.min.js"></script>
    <script src="/assets/thirdparty/reactjs/react.min.js"></script>
    <script src="/assets/thirdparty/reactjs/react-dom.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBZ5b-VSBFUZVEUigMBiGITuacfH9KHHeg"></script>
    
    <!-- Own JavaScripts -->
    <script src="/scripts/app.js"></script>
    <script src="/scripts/services/LanguageService.js"></script>
    <script src="/scripts/services/SpinnerService.js"></script>
    <script src="/scripts/models/HomeModel.js"></script>
    <script src="/scripts/models/AboutModel.js"></script>
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
    <script src="/scripts/controllers/AboutController.js"></script>
    <script src="/scripts/controllers/LoginController.js"></script>
    <script src="/scripts/controllers/UserController.js"></script>
    <script src="/scripts/controllers/CategoryController.js"></script>
    <script src="/scripts/controllers/ArticleController.js"></script>
    <script src="/scripts/controllers/admin/AdminController.js"></script>
    <script src="/scripts/controllers/admin/AdminCategoryController.js"></script>
    <script src="/scripts/controllers/admin/AdminArticleController.js"></script>
    <script src="/scripts/controllers/admin/CategoryEditorController.js"></script>
    <script src="/scripts/controllers/NotFoundController.js"></script>
    
    <!-- Short JavaScripts common for all templates -->
    <script type="text/javascript">
      
      // Enable Bootstrap tooltips
      $(function () {
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
      
    </script>
  </body>
</html>