<?php

/*
 * A language file for the admin views
 */

return [
  'menuTopic' => 'Admin',
  'link' => '/admin',
  'topic' => 'Sisällönhallinta',
  'content' => 'Tällä sivulla voit hallita sivuston sisältöä.',
  'tools' => 'Työkalut',
  'categories' => [
    'topic' => 'Kategoriat',
    'link' => '/admin/categories',
    'content' => 'Voit muokata suomenkielisiä kategorioiden kieliversioita täällä. Vaihda käyttöliittymän kieli yläpalkin valikosta englanniksi muokataksesi englanninkielistä kieliversiota.',
    'published' => 'Julkaistu',
    'notPublished' => 'Ei julkaistu',
    'addSubCategory' => 'Lisää alikategoria',
    
    // Single category view
    'categoryName' => 'Kategorian nimi',
    'categoryDescription' => 'Kategorian kuvaus',
    'categoryURLName' => 'Kategorian nimi URL:issa',
    'backToList' => 'Takaisin kategorialistaan',
    'add' => [
      'topic' => 'Lisää kategoria',
      'link' => '/admin/category'
    ],
    'edit' => [
      'topic' => 'Muokkaa kategoriaa',
      'link' => '/admin/category'
    ]
  ],
  'category' => [
    'topic' => 'Kategoria',
    'article' => 'Artikkeli',
    'published' => 'Julkaistu'
  ],
  'article' => [
    'topic' => 'Artikkeli',
    'topicNew' => 'Uusi artikkeli',
    'topicEdit' => 'Muokkaa artikkelia',
    'articleTopic' => 'Artikkelin otsikko',
    'URLName' => 'URL nimi',
    'text' => 'Teksti',
    'published' => 'Julkaistu',
    'notPublished' => 'Ei julkaistu',
    'publishTime' => 'Julkaisupäivämäärä',
    'savingSucceeded' => 'Tallentaminen onnistui!',
    'savingFailed' => 'Tallentuminen epäonnistui!',
    'returnToCategory' => 'Palaa kategoriatasolle',
    'continueEditing' => 'Jatka artikkelin muokkaamista',
    'errorMessage' => 'Virheilmoitus'
  ]
];