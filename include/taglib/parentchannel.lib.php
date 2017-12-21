<?php

/**

* 父栏目调用标签

*

* @version $Id: parentchannel.lib.php 1 9:29 2010年7月6日Z tianya $

* @package DedeCMS.Taglib

* @copyright Copyright (c) 2007 - 2010, DesDev, Inc.

* @license http://help.dedecms.com/usersguide/license.html

* @link http://www.dedecms.com

*/


/*>>dede>>

<name>父栏目标签</name>

<type>全局标记</type>

<for>V55,V56,V57</for>

<description>父栏目调用标签</description>

<demo>

{dede:parentchannel}

<a href='[field:typeurl/]'>[field:typename/]</a>

{/dede:parentchannel}

</demo>

<attributes>

<iterm>typeid:指定栏目ID</iterm>

</attributes>

>>dede>>*/


function lib_parentchannel(&$ctag,&$refObj)

{

global $_sys_globals,$dsql;


$attlist = "row|100,nosonmsg|,col|1";

FillAttsDefault($ctag->CAttribute->Items,$attlist);

extract($ctag->CAttribute->Items, EXTR_SKIP);

$innertext = $ctag->GetInnerText();

 

$reid = 0;

$topid = 0;

//如果属性里没指定栏目id，从引用类里获取栏目信息

if(empty($typeid))

{

if( isset($refObj->TypeLink->TypeInfos['id']) )

{

$typeid = $refObj->TypeLink->TypeInfos['id'];

$reid = $refObj->TypeLink->TypeInfos['reid'];

$topid = $refObj->TypeLink->TypeInfos['topid'];

}

else {

$typeid = 0;

}

} //如果指定了栏目id，从数据库获取栏目信息

else

{

$row2 = $dsql->GetOne("SELECT * FROM `#@__arctype` WHERE id='$typeid' ");

$typeid = $row2['id'];

$reid = $row2['reid'];

$topid = $row2['topid'];

$issetInfos = true;

}


$sql = "SELECT id,typename,typedir,isdefault,ispart,defaultname,namerule2,moresite,siteurl,sitepath

FROM `#@__arctype` WHERE reid='$typeid' AND ishidden<>1 ORDER BY sortrank ASC LIMIT 1";

$dsql->SetQuery($sql);

$dsql->Execute();

$totalRow = $dsql->GetTotalRow();

 

//And id<>'$typeid'

$row = $dsql->GetOne("SELECT id,typename,reid,typedir,isdefault,ispart,defaultname,namerule2,moresite,siteurl,sitepath

FROM `#@__arctype` WHERE id='$typeid' ");

if(!is_array($row)) return '';

if($totalRow==0){

$typeid = $row['reid'];

$row = $dsql->GetOne("SELECT id,typename,reid,typedir,isdefault,ispart,defaultname,namerule2,moresite,siteurl,sitepath

FROM `#@__arctype` WHERE id='$typeid' ");

if(!is_array($row)) return '';

}

if(trim($innertext)=='') $innertext = GetSysTemplets("part_type_list.htm");


$dtp = new DedeTagParse();

$dtp->SetNameSpace('field','[',']');

$dtp->LoadSource($innertext);

if(!is_array($dtp->CTags))

{

unset($dtp);

return '';

}

else

{

$row['typelink'] = $row['typeurl'] = GetOneTypeUrlA($row);

foreach($dtp->CTags as $tagid=>$ctag)

{

if(isset($row[$ctag->GetName()])) $dtp->Assign($tagid,$row[$ctag->GetName()]);

}

$revalue = $dtp->GetResult();

unset($dtp);

return $revalue;

}

}

?>
