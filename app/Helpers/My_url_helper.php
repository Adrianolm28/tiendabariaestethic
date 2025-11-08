<?php
function getYoutubeVideoId($url) {
    $videoId = '';
    $urlParts = parse_url($url);
      if (isset($urlParts['query'])) {
        parse_str($urlParts['query'], $params);
        if (isset($params['v'])) {
          $videoId = $params['v'];
      }
    } elseif (isset($urlParts['path'])) {
        $pathParts = explode('/', trim($urlParts['path'], '/'));
        if (count($pathParts) === 2) {
          $videoId = $pathParts[1];
      }
    }
    return $videoId;
}