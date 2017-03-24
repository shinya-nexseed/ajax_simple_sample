<?php
$dsn = 'mysql:dbname=todo;host=localhost';
$user = 'root';
$password = '';
$dbh = new PDO($dsn, $user, $password);
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$dbh->query('SET NAMES utf8');

$sql = 'SELECT * FROM tasks';
$stmt = $dbh->prepare($sql);
$stmt->execute();
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
    <?php while($task = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
      <?php if($task['completed']): // ture (1) だったら ?>
        <input type="checkbox" id="<?php echo $task['id']; ?>" checked="check"><span class="checked"><?php echo $task['title']; ?></span><br>
      <?php else: ?>
        <input type="checkbox" id="<?php echo $task['id']; ?>"><span><?php echo $task['title']; ?></span><br>
      <?php endif; ?>
    <?php endwhile; ?>
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
      var id = $(this).attr('id');
      console.log(id);

      var data = {task_id : id};

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
        // dataにsend_templete.phpからechoされたjsonデータが入る

        // jsonデータをjsの配列データに変換してvar dataに代入
        var data = JSON.parse(data);

        // clickしたinputタグを取得し、スタイルの変更やチェックのon/offを切り替える
        var element = document.getElementById(data['id']);
        element.checked = data['completed'];

        element.nextSibling.classList.toggle('checked');

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
