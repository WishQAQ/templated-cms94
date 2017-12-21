document.write("共有<?php
require_once(dirname(__FILE__)."/../include/common.inc.php");
$row = $db->GetOne("select count(*) as fc from #@__feedback where aid='{$aid}'");
if(!is_array($row)){
echo "0";
}else {
echo $row['fc'];
}
?>条");
