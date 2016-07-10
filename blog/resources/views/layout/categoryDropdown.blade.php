<li class="dropdown">
  <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" style="cursor:pointer">
    <% trans('views.trips.menuTopic') %> <span class="caret"></span>
  </a>
  @foreach(App\Models\Category::all()->where('parentId', NULL)->sortBy('menuWeight') as $category)
    <ul class="dropdown-menu" role="menu">
      @foreach(App\Models\Category::all()->where('parentId', $category->id)->sortBy('menuWeight') as $subCategory)
        @if ($subCategory->languageVersions()->where('languageId', App\Http\Controllers\LanguageController::getCurrentLocaleId())->first()->published)
          <li>
            <a href="<% trans('views.category.linkBase') %>/<% $subCategory->languageVersions()->where('languageId', App\Http\Controllers\LanguageController::getCurrentLocaleId())->first()->urlname %>">
              <% $subCategory->languageVersions()->where('languageId', App\Http\Controllers\LanguageController::getCurrentLocaleId())->first()->name %>
            </a>
          </li>
        @endif
      @endforeach
    </ul>
  @endforeach
</li>