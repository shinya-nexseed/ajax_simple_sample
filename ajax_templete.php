<?php


?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8" />
  <title>jQuery & Ajax & PHP Example</title>

  <!-- Bootstrap -->
  <link href="assets/css/bootstrap.css" rel="stylesheet">
  <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet">
  <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>
  <h1>jQuery & Ajax & PHP Example</h1>

  <form method="post">
    <input type="checkbox" id="">hoge</span><br>
    <input type="checkbox" id="">fuga</span><br>
  </form>

  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="assets/js/jquery-3.1.1.js"></script>
  <script src="assets/js/jquery-migrate-1.4.1.js"></script>
  <script src="assets/js/bootstrap.js"></script>
  <script>
  $(document).ready(function()
  {

    /**
     * 送信ボタンクリック
     */
    $('input').click(function()
    {
      //POSTメソッドで送るデータを定義します var data = {パラメータ名 : 値};
      var data = "ほげ";

      /**
       * Ajax通信メソッド
       * @param type  : HTTP通信の種類
       * @param url   : リクエスト送信先のURL
       * @param data  : サーバに送信する値
       */
      $.ajax({
          type: "POST",
          url: "send_templete.php",
          data: data,

      /**
       * Ajax通信が成功した場合に呼び出されるメソッド
       */
      }).done(function(data) {
        // Ajax通信が成功した場合に呼び出される

        // PHPから返ってきたデータの表示
        alert(data);

      /**
       * Ajax通信が失敗した場合に呼び出されるメソッド
       */
      }).fail(function(data) {
          alert('error!!!' + data);
      });

    });
  });
  </script>
</body>
</html>
