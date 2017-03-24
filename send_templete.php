<?php
// DBとの接続
$dsn = 'mysql:dbname=todo;host=localhost';
$user = 'root';
$password = '';
$dbh = new PDO($dsn, $user, $password);
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$dbh->query('SET NAMES utf8');

// ajax_template.phpから送られてくるdataは$_POSTに入る
// キーは送信元を参照
$sql = 'SELECT * FROM tasks WHERE `id`=?';
$data = array($_POST['task_id']);
$stmt = $dbh->prepare($sql);
$stmt->execute($data);

if ($task = $stmt->fetch(PDO::FETCH_ASSOC)) {

    // string型で取得したデータをbool型に変換(キャスト)する
    $completed = (bool)$task['completed']; // true(1) か false(0)

    // 値を反転させる 三項演算子
    // $completed = ($completed == true) ? false : true;
    $completed = !$completed;

    $sql = 'UPDATE tasks SET `completed`=? WHERE `id`=?';
    $data = array($completed, $task['id']);
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);

    $data = array(
          'id' => $task['id'],
          'title' => $task['title'],
          'completed' => $completed
      );

    header("Content-type: text/plain; charset=UTF-8");
    //ここに何かしらの処理を書く（DB登録やファイルへの書き込みなど）

    echo json_encode($data);
}
?>
