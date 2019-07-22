<?php

$firstTag = $_POST['first'];
$secondTag = $_POST['second'];

if ($firstTag && $secondTag) {
    if ($firstTag[0] == '#')
        $firstTag = substr($firstTag, 1);

    if ($secondTag[0] == '#')
        $secondTag = substr($secondTag, 1);

    $image = file_get_contents('https://www.instagram.com/explore/tags/' . $firstTag . '/?__a=1');

    $imageList = array(30);

    $result = json_decode($image, true);

    $i = 0;
    foreach ($result['graphql']['hashtag']['edge_hashtag_to_media']['edges'] as $row) {

        $text = $row['node']['edge_media_to_caption']['edges'][0]['node']['text'];

        if (strripos($text, '#' . $firstTag) && strripos($text, '#' . $secondTag)) {
            $imageList[$i] = $row['node']['display_url'];
            $i++;
        }

        if ($i == 30)
            break;
    }

    echo json_encode($imageList);
}
