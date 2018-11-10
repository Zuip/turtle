<?xml version="1.0" encoding="UTF-8" ?>
<rss version="2.0">

  <channel>
    <title>Turtle.travel</title>
    <link>https://turtle.travel</link>
    <description><?php echo $description; ?></description>
    <?php foreach($articles as $article) { ?>
    <item>
      <?php
        $startDate = DateTime::createFromFormat("Y-m-d", $article["visit"]["start"]);
        $endDate = DateTime::createFromFormat("Y-m-d", $article["visit"]["end"]);
        $startFormat = "j.n.Y";
        if($startDate->format("Y") === $endDate->format("Y")) {
          $startFormat = "j.n.";
          if($startDate->format("n") === $endDate->format("n")) {
            $startFormat = "j.";
          }
        }
        $visitDuration = $startDate->format($startFormat) . "-" . $endDate->format("j.n.Y");
        if($startDate->getTimestamp() === $endDate->getTimestamp()) {
          $visitDuration = $endDate->format("j.n.Y");
        }
      ?>
      <title><?php echo $article["city"]["name"]; ?>, <?php echo $article["city"]["country"]["name"]; ?>, <?php echo $visitDuration; ?></title>
      <link><?php echo env("APP_URL"); ?>/matkat/<?php echo $article["visit"]["trip"]["urlName"]; ?>/<?php echo $article["city"]["country"]["urlName"]; ?>/<?php echo $article["city"]["urlName"]; ?>/<?php echo $article["city"]["visit"]["index"] ?>/artikkeli</link>
      <description><?php echo trim(strip_tags($article["summary"])); ?></description>
    </item>
    <?php } ?>
  </channel>

</rss>