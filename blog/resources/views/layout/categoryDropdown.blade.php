<li class="dropdown">
  <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" style="cursor:pointer">
    <% trans('views.trips.menuTopic') %> <span class="caret"></span>
  </a>
  @foreach(App\Models\Category::all()->where('parent_id', NULL)->sortBy('menu_weight') as $category)
    <ul class="dropdown-menu" role="menu">
      @foreach(App\Models\Category::all()->where('parent_id', $category->id)->sortBy('menu_weight') as $subCategory)
        @if ($subCategory->languageVersions()->where('language_id', App\Http\Controllers\LanguageController::getCurrentLocaleId())->first()->published)
          <li>
            <a href="<% trans('views.category.linkBase') %>/<% $subCategory->languageVersions()->where('language_id', App\Http\Controllers\LanguageController::getCurrentLocaleId())->first()->urlname %>">
              <% $subCategory->languageVersions()->where('language_id', App\Http\Controllers\LanguageController::getCurrentLocaleId())->first()->name %>
            </a>
          </li>
        @endif
      @endforeach
    </ul>
  @endforeach
</li>