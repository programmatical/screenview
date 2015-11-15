<?php
/**
 * Created by PhpStorm.
 * User: sean
 * Date: 11/6/15
 * Time: 6:04 PM
 */
$app->get('/', function() use ($app) {
   $count = number_format(count(glob('protected/cache/images/*.png')));
   $app->render('home.twig', array(
      'base' => true,
      'image_count' => $count
   ));
});
$app->get('/:image', function($image) use ($app) {
   $parts = explode('.', $image);
   $name = $parts[0];
   $url = '';
   $found = false;

   if(file_exists('protected/cache/images/' . $name . '.png')) {
      $url = 'raw/' . $name . '.png';
      $found = true;
   } else {
      $found = false;
   }

   $app->render('home.twig', array(
      'image' => $url,
      'found' => $found
   ));
})->conditions(array(
   'image' => '([A-Za-z0-9\-\_.]+)'
));
$app->get('/raw/:image', function($image) use ($app) {
   if(file_exists('protected/cache/images/' . $image)) {
      $file = 'protected/cache/images/' . $image;
      $screenshot = file_get_contents($file);
      $screenshot_data = new finfo(FILEINFO_MIME_TYPE);
      $app->response->header('Content-Type', $screenshot_data->buffer($file));
      echo $screenshot;
   } else {

   }
})->conditions(array(
   'image' => '([A-Za-z0-9\-\_.]+)'
));
