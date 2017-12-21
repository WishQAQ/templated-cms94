<li><a href="[field:aid runphp='yes']
$sql = "select typedir from dede_arctype where id=(select typeid from dede_archives where id=@me)";
$query = mysql_query($sql);
$row=mysql_fetch_array($query);
@me=$row[typedir]."/".@me.".html";
[/field:aid]" title="[field:title function='html2text(@me)'/]">[field:username function="(@me=='guest' ? '游客' : @me)"/]</a> » <a href="[field:global.cfg_phpurl/]/feedback.php?aid=[field:aid/]" title="查看 《[field:title function='html2text(@me)'/]》 的所有评论">[field:msg/]</a></li>