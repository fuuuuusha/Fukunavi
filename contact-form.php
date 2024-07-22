<?php
require '../lib/functions.php';
$error = false;

if (!empty($_POST)) {
  if (!check_form_validation($_POST)) {
    $error = true;
  } else {
    send_email($_POST);
  }
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact form</title>
  <!-- CSS only -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
  <div class="container-md p-5">
    <h2 class="mb-3">お問い合わせ</h2>

    <form action="<?php echo get_self_url(); ?>" method="POST">
      <div class="mb-3">
        <label for="name" class="form-label">お名前</label>
        <input type="text" class="form-control" id="name" name="name">
      </div>
      <div class="mb-3">
        <label for="mail" class="form-label">メールアドレス</label>
        <input type="email" class="form-control" id="mail" name="mail">
      </div>
      <div class="mb-3">
        <label for="content" class="form-label">お問い合わせ内容</label>
        <textarea class="form-control" name="content" rows="5" ></textarea>
      </div>
      <button type="submit" class="btn btn-primary">送信</button>
    </form>
  </div>


</body>

</html>