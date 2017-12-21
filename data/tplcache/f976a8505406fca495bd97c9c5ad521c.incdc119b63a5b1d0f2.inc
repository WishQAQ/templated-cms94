<?php
$z[0]=Array("aid","\n\$sql = \"select typedir from dede_arctype where id=(select typeid from dede_archives where id=@me)\";\n\$query = mysql_query(\$sql);\n\$row=mysql_fetch_array(\$query);\n@me=\$row[typedir].\"/\".@me.\".html\";\n",13,245);
$z[0][4]['runphp']="yes";
$z[1]=Array("title","",254,294);
$z[1][4]['function']="html2text(@me)";
$z[2]=Array("username","",296,356);
$z[2][4]['function']="(@me=='guest' ? '游客' : @me)";
$z[3]=Array("global","",373,399);
$z[3][4]['name']="cfg_phpurl";
$z[4]=Array("aid","",417,429);
$z[5]=Array("title","",448,488);
$z[5][4]['function']="html2text(@me)";
$z[6]=Array("msg","",509,521);

?>