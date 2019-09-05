<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>【楽天市場】レシピで検索</title>
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/indexstyle.css">
</head>
<body style="margin-left: auto; margin-right: auto;" class="body";>
	<div id="header" class="header">
		<a href="index.html"><img src="img/logo.png" alt="Rakuten, Inc."></a>
		<div class="header-title"><h1>レシピで検索</h1></div>
	</div>
    <p class="keyword_input_text">検索したいキーワードを入力してください</p>
    <div class="keyword_input">
    	<input type="search" name="search" placeholder="キーワードを入力してください">
    	<input type="submit" name="submit" value="検索">
	</div>
		<table class="table" style="table-layout:fixed;" align="center">
	    <thead>
	        <tr bgcolor=#f5deb3>
	            <th style="width: 60px;"><img src="img/cook.png" alt="cook" class="cookphoto"></th>
	            <th style="width:100px;">料理のリスト</th>
	        </tr>
	    </thead>
	    <tbody bgcolor=#fffacd>
	        <tr>
	            <td><a href="#"><img src="img/meatpotato.jpg" alt="meatpotato" class="cookphoto"></td>
	            <td><a href="#">肉じゃが</td>
	        </tr>
	        <tr>
	            <td><a href="#"><img src="img/curry.jpg" alt="curry" class="cookphoto"></td>
	            <td><a href="#">カレー</td>
	        </tr>
	        <tr>
	            <td><a href="#"><img src="img/stew.jpg" alt="stew" class="cookphoto"></td>
	            <td><a href="#">シチュー</td>
	        </tr>
	    </tbody>
</table>






	<!--<div style="text-align: center;">
		<div class="list-group recipi_list">
			<a href="#" class="list-group-item list-group-item-action active">料理のリスト</a>
			<a href="#" class="list-group-item list-group-item-action">肉じゃが</a>
			<a href="#" class="list-group-item list-group-item-action">カレー</a>
			<a href="#" class="list-group-item list-group-item-action">シチュー</a>
		</div>
	</div>-->
</body>
</html>