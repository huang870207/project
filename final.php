<?php								//更新時間
$page = $_SERVER['PHP_SELF'];
$sec = "5";
?>
<script>
function startTime() {
  var today = new Date();
  var hh = today.getHours();
  var mm = today.getMinutes();
  var ss = today.getSeconds();
  mm = checkTime(mm);
  ss = checkTime(ss);
  document.getElementById("clock").innerHTML = hh + ":" + mm + ":" + ss;
  var timeoutId = setTimeout(startTime, 500);
}

function checkTime(i) {
  if (i < 10) {
    i = "0" + i;
  }
  return i;
}

</script>

<html lang="zh_Hant-TW">
	<head>
    <meta http-equiv="refresh" content="<?php echo $sec?>;URL='<?php echo $page?>'">
    </head>
	
	<head>		
        <meta charset="utf-8">
        <link rel=stylesheet type="text/css" href="top1.css">
    </head>
<body onload="startTime()"></body>
<div class="top">
  <div class="blue"></div>
  <h1>自助洗衣房之平價智慧監控系統</h1>
</div>
<div class="clock">
  <div id="clock"></div>
</div>
<div class="content">
  <div class="max_width">
    <div class="all_machine">
      <div class="macs machine1"><img class="mm m1" src="https://www.flaticon.com/svg/static/icons/svg/3003/3003984.svg" alt=""/>
        <h5 class="name">洗衣機一號</h5>
        <div class="con">
          <h6>洗衣機狀態</h6>
          <p class="pone">
		  <?php
			$host = 'localhost';
			//改成你登入phpmyadmin帳號
			$user = 'root';
			//改成你登入phpmyadmin密碼
			$passwd = '123456';
 
			$database = 'project';
			//實例化mysqli(資料庫路徑, 登入帳號, 登入密碼, 資料庫)
			$connect = new mysqli($host, $user, $passwd, $database);
 
			if ($connect->connect_error) {
				die("連線失敗: " . $connect->connect_error);
			}
			echo "連線成功";
 
			//設定連線編碼，防止中文字亂碼
			$connect->query("SET NAMES 'utf8'");
			 
			//選擇資料表user，條件是欄位id = 1的
			$selectSql = "SELECT * FROM mcp2 ";
			//呼叫query方法(SQL語法)
			$memberData = $connect->query($selectSql);
			//有資料筆數大於0時才執行
			if ($memberData->num_rows > 0) {
			//讀取剛才取回的資料
				while ($row = $memberData->fetch_assoc()) {
					print_r($row);
					
					if($row['status']==0){
						echo "未使用";
					}
					else if($row['status']==2){
						echo "注水中<br />";
						$time_total =$row['value'];
						echo getHoursMinutes($time_total, '%02d 小時 %02d 分鐘 %02d 秒');
					}
					else {
						echo "使用中<br />";
						$time_total =$row['value'];
						echo getHoursMinutes($time_total, '%02d 小時 %02d 分鐘 %02d 秒');
					}
				}
			} else {
				echo '0筆資料';
			}

			//結果:Array ( [id] => 1 [account] => test [password] => 123 [nickname] => 測試 )
			?>
		  </p>
          <h6>使用時間</h6>
          <p class="ptwo">
		  <?php
		$host = 'localhost';
		//改成你登入phpmyadmin帳號
		$user = 'root';
		//改成你登入phpmyadmin密碼
		$passwd = '123456';
		 
		$database = 'project';
		//實例化mysqli(資料庫路徑, 登入帳號, 登入密碼, 資料庫)
		$connect = new mysqli($host, $user, $passwd, $database);
		 
		//設定連線編碼，防止中文字亂碼
		$connect->query("SET NAMES 'utf8'");
		 
		//選擇資料表user，條件是欄位id = 1的
		$selectSql = "SELECT * FROM mcp2 ";
		//呼叫query方法(SQL語法)
		$memberData = $connect->query($selectSql);
		//有資料筆數大於0時才執行
		$count = 1;
		if ($memberData->num_rows > 0) {
		//讀取剛才取回的資料
			while ($row = $memberData->fetch_assoc()) {
				print_r($row['status']);

				if($row['status']==0){
					echo "未使用";
				}
				else if($row['status']==2){
					echo "注水中<br />";
					$time_total =$row['value'];
					echo getHoursMinutes($time_total, '%02d 小時 %02d 分鐘 %02d 秒');
				}
				else {
					echo "使用中<br />";
					$time_total =$row['value'];
					echo getHoursMinutes($time_total, '%02d 小時 %02d 分鐘 %02d 秒');
				}
			}
		}	else {
				echo '0筆資料';
			}
			/**
			* 取得小時和分鐘的格式字串
			*
			* @param integer $seconds 秒
			* @param string  $format   格式
			*
			* @return string
			*/
			function getHoursMinutes($time_total, $format = '%02d:%02d:%02d') {

				if (empty($time_total) || ! is_numeric($time_total)) {
					return false;
				}

				$minutes = floor($time_total / 60);
				$seconds = round($time_total % 60);
				$hours = floor($minutes / 60);
				$remainMinutes =($minutes % 60);

				return sprintf($format, $hours, $remainMinutes, $seconds);
			}
			/*echo getHoursMinutes($time_total, '%02d 小時 %02d 分鐘 %02d 秒');*/
		?>
		  </p>
        </div>
      </div>
      <div class="macs machine2"><img class="mm m2" src="https://www.flaticon.com/premium-icon/icons/svg/2283/2283894.svg" alt=""/>
        <h5 class="name">洗衣機二號</h5>
        <div class="con">
          <h6>洗衣機狀態</h6>
          <p class="pone">未使用</p>
          <h6>使用時間</h6>
          <p class="ptwo">mins</p>
        </div>
      </div>
      <div class="macs machine3"><img class="mm m3" src="https://www.flaticon.com/svg/static/icons/svg/2657/2657002.svg" alt=""/>
        <h5 class="name">洗衣機三號</h5>
        <div class="con">
          <h6>洗衣機狀態</h6>
          <p class="pone">未使用</p>
          <h6>使用時間</h6>
          <p class="ptwo">mins</p>
        </div>
      </div>
      <div class="macs machine4"><img class="mm m4" src="https://www.flaticon.com/premium-icon/icons/svg/2955/2955774.svg" alt=""/>
        <h5 class="name">洗衣機四號</h5>
        <div class="con">
          <h6>洗衣機狀態</h6>
          <p class="pone">未使用</p>
          <h6>使用時間</h6>
          <p class="ptwo">mins</p>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="info">
  <h3>學校：國立中正大學<br>指導教授：陳鵬升教授<br>專題生：黃偉哲、賴震豪</h3>
</div>
</html>

