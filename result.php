<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>【楽天市場】レシピで検索</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/indexstyle.css">
    <?php include(‘ファイルのパス’); ?>
</head>
<body style="margin-left: auto; margin-right: auto;">
    <div id="header">
        <a href="index.html"><img src="img/logo.png" alt="Rakuten, Inc."></a>
        <div class="header-title"><h1>レシピで検索</h1></div>
    </div>
    
    <h2>肉じゃが<?php echo h($result['cook_name']);?></h2>

    <h3>必要食材一覧</h3>
	<ul>
    	<li>豚こま</li>
    	<li>じゃがいも</li>
    	<li>人参</li>
    </ul>

    <?php foreach ($results['ingredient'] as $result): ?>
        <p><?php echo h($result['name']); ?></p>
        <p><?php echo h($result['pic_link']); ?></p>
        <p><?php echo h($result['link']); ?></p>
    <?php endforeach; ?>

    <table id="result">
    </table>
    <script>
        var results =JSON.parse('<?php echo $php_results; ?>');

    </script>

</body>
</html>