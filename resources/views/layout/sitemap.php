<?xml version="1.0" encoding="UTF-8"?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
  
  <url>
    <loc><?php echo env('APP_URL'); ?></loc>
    <changefreq>weekly</changefreq>
    <priority>1</priority>
  </url>

<?php foreach($fiArticles as $article) { ?>
  <url>
    <loc><?php echo env('APP_URL'); ?>/matkat/<?php echo $article["visit"]["trip"]["urlName"]; ?>/<?php echo $article["city"]["country"]["urlName"]; ?>/<?php echo $article["city"]["urlName"]; ?>/<?php echo $article["city"]["visit"]["index"] ?>/artikkeli</loc>
    <changefreq>weekly</changefreq>
  </url>
<?php } ?>
  
<?php foreach($enArticles as $article) { ?>
  <url>
    <loc><?php echo env('APP_URL'); ?>/trips/<?php echo $article["visit"]["trip"]["urlName"]; ?>/<?php echo $article["city"]["country"]["urlName"]; ?>/<?php echo $article["city"]["urlName"]; ?>/<?php echo $article["city"]["visit"]["index"] ?>/article</loc>
    <changefreq>weekly</changefreq>
  </url>
<?php } ?>

</urlset>