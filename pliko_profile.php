<?php
$username = "put your username here"; // * insert your pliko username

$pliks = "https://pliko.net/?module=rss&params=profile&u=" . $username; // - create the RSS feed URL

$rss = simplexml_load_file($pliks); // - load the RSS feed

if ($rss) {
    $seenItemTitles = array();
    $items = $rss->channel->item;
    $itemCount = count($items);
    $startIndex = $itemCount - 10; // * you can change the maximum amount of pliks you want displayed at once
    for ($i = $startIndex; $i < $itemCount; $i++) {
        $item = $items[$i];
        $title = (string)$item->title;
        $pubDate = strtotime($item->pubDate);
        $formattedDate = date('Y-m-d H:i:s', $pubDate);
        $content = $item->description;
        $link = $item->link; // Get the link to the original post

        if (!in_array($title, $seenItemTitles)) {
            echo "<small><a href=\"$link\" target=\"_blank\">$formattedDate</a> : </small> $content<br>"; // * you can change how it's displayed on your site here
            $seenItemTitles[] = $title;
        }
    }
} else {
    echo "Can't find the pliks<br>";
}
?>
