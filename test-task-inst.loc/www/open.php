<?php

$imageList = json_decode(file_get_contents('images.json'));

foreach ($imageList as $image)
    echo '<img src="' . $image . '" alt="picture" width="200px" height="auto">';