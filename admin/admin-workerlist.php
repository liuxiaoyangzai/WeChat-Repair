<?php
require_once("cookies.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>公寓管理中心微信报修系统</title>
<!-- paste this code into your webpage -->
<link href="css/table.css" rel="stylesheet" type="text/css" media="screen" />
<script type="text/javascript" src="js/table.js"></script>
<!-- end -->
<style>
body { margin:0; padding:0; background:#f1f1f1; font:70% Arial, Helvetica, sans-serif; color:#555; line-height:150%; text-align:left; }
a { text-decoration:none; color:#057fac; }
a:hover { text-decoration:none; color:#999; }
h1 { font-size:140%; margin:0 20px; line-height:80px; }
h2 { font-size:120%; }
#container { margin:0 auto; width:950px; background:#fff; padding-bottom:20px; }
#content { margin:0 20px; }
p.sig { margin:0 auto; width:680px; padding:1em 0; }
form { margin:1em 0; padding:.2em 20px; background:#eee; }
</style>
</head>
<body>
<div id="container">
  <div id="content">
    <!-- all you need with Tablecloth is a regular, well formed table. No need for id's, class names... -->
  <b><?php include("header.php") ?>|欢迎您,点击此处 <a href="admin-workerlist.php?action=logout">注销</a> 登录！ </b> 
    <table cellspacing="0" cellpadding="0">
      <tr>      
	            <th class="table-title">ID</th>
				<th class="table-title">用户名</th>
				<th class="table-title">用户角色</th>
				<th class="table-title">Openid</th>
				<th class="table-title">编辑</th>
				<th class="table-title">新增楼栋</th>
				<th class="table-title">楼栋管理</th>
				<th class="table-title">删除</th>
      </tr>
<?php
   $pagesize=10;
	if($_GET[page]){
	$pageval=$_GET[page];
	$page=($pageval-1)*$pagesize;
	$page.=',';
	}
   require_once("../db.php");  
   $sql2 = "SELECT * FROM `worker` order by `id` desc limit $page $pagesize ";
   $result2 = mysql_query($sql2);
   while($row2 = mysql_fetch_array($result2))
         {
        $arr2[]=$row2;
          }	
?>
<?php if( is_array( $arr2 ) ): ?>
<?php foreach(  $arr2 as $item ): ?>  
            <tr>
              <td><?php echo $item['id'];?></td>
              <td><?php echo $item['name'];?></td>
              <td><?php echo $item['role'];?></td>
			 <td><?php echo $item['openid'];?></td>
    		 <td><a href="edit-worker.php?id=<?php echo $item['id'];?>">编辑</a></td>
			 <td><a href="add-building.php?id=<?php echo $item['id'];?>">新增楼栋</a></td>
    		 <td><a href="admin-building.php?openid=<?php echo $item['openid'];?>">楼栋管理</a></td>
    		 <td><a href="del-worker.php?id=<?php echo $item['id'];?>">删除</a></td>
           </tr>
 <?php endforeach; ?>
	<?php endif; ?>
    </table>
      
<?php     
require_once("../db.php"); 
$url=$_SERVER["REQUEST_URI"];
$url=parse_url($url);
$url=$url[path];
$sql = "SELECT * FROM `worker` order by `id` desc ";
$result = mysql_query($sql);
   while($row = mysql_fetch_array($result))
         {
        $arr[]=$row;
          }	
$num = count($arr);


if($num > $pagesize){
 if($pageval<=1)$pageval=1;
echo "共 $num 条".
		" <a href=$url?page=".($pageval-1).">上一页</a> <a href=$url?page=".($pageval+1).">下一页</a>";
}      
      
?>        
<?php include("footer.php") ?>

</body>
</html>
