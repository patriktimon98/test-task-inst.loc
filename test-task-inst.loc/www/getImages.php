<?php

$imageTag = $_POST['image'];

if ($imageTag) {
    if ($imageTag[0] == '#')
        $imageTag = substr($imageTag, 1);

    $image = file_get_contents('https://www.instagram.com/explore/tags/' . $imageTag . '/?__a=1');

    $imageList = array(30);

    $result = json_decode($image, true);

    $i = 0;
    foreach ($result['graphql']['hashtag']['edge_hashtag_to_media']['edges'] as $row) {
        $imageList[$i] = $row['node']['display_url'];
        $i++;
        if ($i == 30)
            break;
    }

    echo json_encode($imageList);
}