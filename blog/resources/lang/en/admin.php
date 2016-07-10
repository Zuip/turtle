<?php

/*
 * A language file for the admin views
 */

return [
  'menuTopic' => 'Admin',
  'link' => '/en/admin',
  'topic' => 'Admin page',
  'content' => 'In here you can alter the content of the website.',
  'tools' => 'Tools',
  'categories' => [
    'topic' => 'Categories',
    'link' => '/en/admin/categories',
    'content' => 'You can edit English language version of the categories here. Change the UI language to Finnish from the top menu if you want to edit the Finnish language versions of categories.',
    'published' => 'Published',
    'notPublished' => 'Not published',
    'addSubCategory' => 'Add sub category',
    
    // Single category view
    'categoryName' => 'Category\'s name',
    'categoryDescription' => 'Category\'s description',
    'categoryURLName' => 'Category\'s name in URL',
    'backToList' => 'Back to category list',
    'add' => [
      'topic' => 'Add category',
      'link' => '/en/admin/category'
    ],
    'edit' => [
      'topic' => 'Edit category',
      'link' => '/en/admin/category'
    ]
  ],
  'category' => [
    'topic' => 'Category',
    'article' => 'Article',
    'published' => 'Published'
  ],
  'article' => [
    'topic' => 'Article',
    'topicNew' => 'New article',
    'topicEdit' => 'Muokkaa artikkelia',
    'articleTopic' => 'Article\'s topic',
    'URLName' => 'URL name',
    'text' => 'Text',
    'published' => 'Published',
    'notPublished' => 'Not published',
    'publishTime' => 'Publish date',
    'savingSucceeded' => 'Saving succeeded!',
    'savingFailed' => 'Saving failed!',
    'returnToCategory' => 'Return to category level',
    'continueEditing' => 'Continue editing article',
    'errorMessage' => 'Error message'
  ]
];