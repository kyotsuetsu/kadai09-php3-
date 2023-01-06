<?php
//【重要】
/**
 * DB接続のための関数をfuncs.phpに用意
 * require_onceでfuncs.phpを取得
 * 関数を使えるようにする。
 */
try {
    $db_name = 'gs_db4';    //データベース名
    $db_id   = 'root';      //アカウント名
    $db_pw   = '';      //パスワード：MAMPは'root'
    $db_host = 'localhost'; //DBホスト
    $pdo = new PDO('mysql:dbname=' . $db_name . ';charset=utf8;host=' . $db_host, $db_id, $db_pw);
} catch (PDOException $e) {
    exit('DB Connection Error:' . $e->getMessage());
}

//２．データ登録SQL作成
$stmt = $pdo->prepare('SELECT * FROM gs_an_table;');
$status = $stmt->execute();

//３．データ表示
$view = '';
if ($status === false) {
    $error = $stmt->errorInfo();
    exit('SQLError:' . print_r($error, true));
} else {
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {

        $date = $result['indate'];
        $word_1 = $result['word_1'];
        $word_2 = $result['word_2'];
        $word_3 = $result['word_3'];


        // GETデータ送信リンク作成
        // <a>で囲う。
        // $view .= '<p>';
        //     $view .= '<a href=detail.php?id=' . $result['id'] . '">';
        // $view .= $result['indate'] . '：' . $result['word_1']. $result['word_2'];
        //     $view .= '</a>';

        //     $view .= '<a href=delete.php?id=' . $result['id'] . '">';
        // $view .= '[削除]';
        //     $view .= '</a>';

        // $view .= '</p>';


        // $view .= '<tr>';
        //     $view .= '<a href=detail.php?id=' . $result['id'] . '">';
        // $view .= $result['indate'] . '：' . $result['word_1']. $result['word_2'].$result['word_3'];
        //     $view .= '</a>';

        //     $view .= '<a href=delete.php?id=' . $result['id'] . '">';
        // $view .= '[削除]';
        //     $view .= '</a>';

        // $view .= '</tr>';

        $view.= "
                <tr>
                    <th>$date</th>
                    <th>$word_1</th> 
                    <th>$word_2</th> 
                    <th>$word_3</th> 
                </tr>'
                ";
    }
}
?>


<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>フリーアンケート表示</title>
    <link rel="stylesheet" href="css/range.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
        div {
            padding: 10px;
            font-size: 16px;
        }
    </style>
</head>

<body id="main">
    <!-- Head[Start] -->
    <header>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.php">データ登録</a>
                </div>
            </div>
        </nav>
    </header>
    <!-- Head[End] -->

    <!-- Main[Start] -->
    <div>
        <div class="container jumbotron">
            <a href="detail.php"></a>
            <tr class="header">
                <th class="item2">記入日</th>
                <th class="item2">単語1</th>
                <th class="item2">単語2</th>
                <th class="item2">単語3</th>
            </tr>
            
        </div>
        <div><?= $view ?></div>


    </div>
    <!-- Main[End] -->

</body>

</html>
