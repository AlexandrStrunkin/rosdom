<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if (!empty($arResult)):?>
<div id="mainmenu">

<ul>
<? if ($APPLICATION->GetCurDir() == '/') 
	echo '<li class="root-item-selected"> <a href="/" class="root-item-selected">';
else 
	echo '<li class="root-item"> <a href="/" class="root-item">'; ?>
� ������� </a>
</li>
<? 
$sub=0;
$mem=0;
foreach($arResult as $arItem):?>
		<?if ($arItem["DEPTH_LEVEL"] == 1):?>
		    <? if ($arItem["SELECTED"]){ ?>

			<li class="root-item-selected">
				<a href="<?=$arItem["LINK"]?>" id="root-item-selected"><span class="root-item-selected">
					<?=$arItem["PARAMS"]["UF_MENUTITLE"]?></span></a>
			</li>
			<? $mem=$arItem["LINK"];
			$root_link=$arItem["LINK"];
			$root_name = $arItem["PARAMS"]["UF_MENUTITLE"]; ?>
			<?//$APPLICATION->AddChainItem($arItem["PARAMS"]["UF_MENUTITLE"], $arItem["LINK"]);?>
		    <? }
		    else{ ?>
			<li>
				<a href="<?=$arItem["LINK"]?>" class="root-item">
					<?=$arItem["PARAMS"]["UF_MENUTITLE"]?></a>
			</li>
			<? $mem=0; ?>
			<? } ?>
		<?elseif ($arItem["DEPTH_LEVEL"] == 2) :?> 
			<? //echo "!".$mem."!";
			if ($mem) $sub++;
			$temp=array();
//			$temp = $arItem;
//			$temp["LINK"]=substr($mem,0,-1).$arItem["LINK"];
//			$curDir = $APPLICATION -> GetCurPage();
//			if(substr($mem,0,-1).$arItem["LINK"] == $curDir) $temp["SELECTED"]=1; 

//			$SubMenu[]=$temp; 
//			}
			?> 
		<?endif?>
<?endforeach?>
</ul>

<ul id="question" style="float:right"><li><a href="/about/feedback/">������ ������</a></li></ul>
</div>
<!-- <div class="menu-clear-left"></div> -->

<!-- <pre
<?// print_r($arResult);?>
</pre> -->
  

	<? 
	$curDir = $APPLICATION -> GetCurPage();
	if ($curDir == "/"){
?>
<div id="submenu">
<?/**/?>
 <? $APPLICATION->IncludeComponent("bitrix:news.detail", "rosdom_text_only", Array(
	"DISPLAY_DATE" => "N",	// �������� ���� ��������
	"DISPLAY_NAME" => "N",	// �������� �������� ��������
	"DISPLAY_PICTURE" => "N",	// �������� ��������� �����������
	"DISPLAY_PREVIEW_TEXT" => "Y",	// �������� ����� ������
	"USE_SHARE" => "N",	// ���������� ������ ���. ��������
	"AJAX_MODE" => "N",	// �������� ����� AJAX
	"IBLOCK_TYPE" => "generated",	// ��� ��������������� ����� (������������ ������ ��� ��������)
	"IBLOCK_ID" => "24",	// ��� ��������������� �����
	"ELEMENT_ID" => "10814",	// ID �������
	"ELEMENT_CODE" => "",	// ��� �������
	"CHECK_DATES" => "Y",	// ���������� ������ �������� �� ������ ������ ��������
	"FIELD_CODE" => "",	// ����
	"PROPERTY_CODE" => "",	// ��������
	"IBLOCK_URL" => "",	// URL �������� ��������� ������ ��������� (�� ��������� - �� �������� ���������)
	"META_KEYWORDS" => "-",	// ���������� �������� ����� �������� �� ��������
	"META_DESCRIPTION" => "-",	// ���������� �������� �������� �� ��������
	"BROWSER_TITLE" => "-",	// ���������� ��������� ���� �������� �� ��������
	"SET_TITLE" => "Y",	// ������������� ��������� ��������
	"SET_STATUS_404" => "N",	// ������������� ������ 404, ���� �� ������� ������� ��� ������
	"INCLUDE_IBLOCK_INTO_CHAIN" => "Y",	// �������� �������� � ������� ���������
	"ADD_SECTIONS_CHAIN" => "Y",	// �������� ������ � ������� ���������
	"ACTIVE_DATE_FORMAT" => "d.m.Y",	// ������ ������ ����
	"USE_PERMISSIONS" => "N",	// ������������ �������������� ����������� �������
	"CACHE_TYPE" => "A",	// ��� �����������
	"CACHE_TIME" => "36000000",	// ����� ����������� (���.)
	"CACHE_NOTES" => "",
	"CACHE_GROUPS" => "Y",	// ��������� ����� �������
	"DISPLAY_TOP_PAGER" => "N",	// �������� ��� �������
	"DISPLAY_BOTTOM_PAGER" => "Y",	// �������� ��� �������
	"PAGER_TITLE" => "��������",	// �������� ���������
	"PAGER_TEMPLATE" => "",	// �������� �������
	"PAGER_SHOW_ALL" => "Y",	// ���������� ������ "���"
	"AJAX_OPTION_JUMP" => "N",	// �������� ��������� � ������ ����������
	"AJAX_OPTION_STYLE" => "Y",	// �������� ��������� ������
	"AJAX_OPTION_HISTORY" => "N",	// �������� �������� ��������� ��������
	"AJAX_OPTION_ADDITIONAL" => "",	// �������������� �������������
	),
	false
);
?>
</div>
<? }
	elseif ($sub>0){
?>

<div id="submenu">
<?/**/?>
	    <ul>
	    <? $i=0;?>
<?
global $APPLICATION;
$dirs = array();
$dir = $APPLICATION->GetCurDir();
$dirs = explode( "/", $dir );
$CurPath="/".$dirs["1"]."/".$dirs["2"]."/"; 
?>

<?
$count=ceil($sub/5);
$show = 0;
foreach($arResult as $arItem):?>

<? if ($arItem["DEPTH_LEVEL"] == 1 && $arItem["SELECTED"] == 1) $show=1;
elseif ($arItem["DEPTH_LEVEL"] == 1 && !$arItem["SELECTED"] == 1) $show=0;

    if ($arItem["DEPTH_LEVEL"] == 2 && $show == 1) { 
?>
			<li>
			<?if ($arItem["SELECTED"]):
 				$APPLICATION->AddChainItem($root_name, $root_link);
				global $sub_name;
				global $sub_link;
				$sub_name =$arItem["PARAMS"]["UF_MENUTITLE"] ;
				$sub_link =$arItem["LINK"]; ?>
 			<span class="selected">
 			<a href="<?=$arItem["LINK"]?>" >
			<?=$arItem["PARAMS"]["UF_MENUTITLE"]?>
			</a>
			</span>
			<?else: ?> 
 			<a href="<?=$arItem["LINK"]?>" >
			<?=$arItem["PARAMS"]["UF_MENUTITLE"]?>
			</a>
 			<?endif?>
			</li>	
		<? 
    
		 $i++;
		if ($i>0 && $i< $sub && $i%$count == 0 ) echo "</ul><ul>";
		?>
<? } ?>

<?endforeach?>
	    </ul>


</div>
<div style="clear:both;"></div>
<? } ?>
<?endif?>