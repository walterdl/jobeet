<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Jobeet 404</title>
  <?php echo stylesheet_tag('404f.css') ?>
</head>
<body>
  <div class="container">
    <div class="logo-container">
      <img src="/legacy/images/logo.jpg" alt="jobeet" />
    </div>
    <h1 class="title">
      404 page not found for <span><?php echo $currentUri ?></span>
    </h1>
    <br />
    <p class="message">Please follow <a href="<?php echo $url; ?>">this link</a> to continue</p>
  </div>
</body>
</html>