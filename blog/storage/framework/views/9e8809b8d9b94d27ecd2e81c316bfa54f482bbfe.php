<li class="dropdown">
  <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" style="cursor:pointer">
    <?php echo e(trans('views.trips.menuTopic')); ?> <span class="caret"></span>
  </a>
  <?php foreach(App\Models\Category::all()->where('parentId', NULL)->sortBy('menuWeight') as $category): ?>
    <ul class="dropdown-menu" role="menu">
      <?php foreach(App\Models\Category::all()->where('parentId', $category->id)->sortBy('menuWeight') as $subCategory): ?>
        <?php if($subCategory->languageVersions()->where('languageId', App\Http\Controllers\LanguageController::getCurrentLocaleId())->first()->published): ?>
          <li>
            <a href="<?php echo e(trans('views.category.linkBase')); ?>/<?php echo e($subCategory->languageVersions()->where('languageId', App\Http\Controllers\LanguageController::getCurrentLocaleId())->first()->urlname); ?>">
              <?php echo e($subCategory->languageVersions()->where('languageId', App\Http\Controllers\LanguageController::getCurrentLocaleId())->first()->name); ?>

            </a>
          </li>
        <?php endif; ?>
      <?php endforeach; ?>
    </ul>
  <?php endforeach; ?>
</li>