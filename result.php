<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>【楽天市場】レシピで検索</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/indexstyle.css">
    <?php 
    include('php/api.php');
    //$url = echo $_SERVER["REQUEST_URI"];
    $cook_name = "肉じゃが";//utf8_decode("%E8%82%89%E3%81%98%E3%82%83%E3%81%8C");//explode(" ", $url)[1]);
    $results = json_decode(get_ingredients($cook_name), true);
    ?>
</head>
<body style="margin-left: auto; margin-right: auto;">
    <div id="header">
        <a href="index.html"><img src="img/logo.png" alt="Rakuten, Inc."></a>
        <div class="header-title"><h1>レシピで検索</h1></div>
    </div>
    
    <h2><?php echo $cook_name;?></h2>

    <h3>必要食材一覧</h3>
	<ul>
    	<li>豚こま</li>
    	<li>じゃがいも</li>
    	<li>人参</li>
    </ul>

    <?php foreach ($results['info'] as $key => $value): ?>
        <p><?php echo $key; ?></p>
        <p><?php echo $value[0]['url']; ?></p>
        <p><?php echo $value[0]['img']; ?></p>
    <?php endforeach; ?>

    <table id="result">
    </table>
    <script>
        var results =JSON.parse('<?php echo $php_results; ?>');
    </script>

</body>
</html>