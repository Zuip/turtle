<?xml version="1.0" encoding="UTF-8" ?>
<rss version="2.0">

  <channel>
    <title>Turtle.travel</title>
    <link>https://turtle.travel</link>
    <description><?php echo $description; ?></description>
    <?php foreach($articles as $article) { ?>
    <item>
      <title><?php echo $article["city"]["name"]; ?>, <?php echo $article["city"]["country"]["name"]; ?></title>
      <link><?php echo env('APP_URL'); ?>/matkat/<?php echo $article["visit"]["trip"]["urlName"]; ?>/<?php echo $article["city"]["country"]["urlName"]; ?>/<?php echo $article["city"]["urlName"]; ?>/<?php echo $article["city"]["visit"]["index"] ?>/artikkeli</link>
      <description><?php echo trim(strip_tags($article["summary"])); ?></description>
    </item>
    <?php } ?>
  </channel>

</rss>