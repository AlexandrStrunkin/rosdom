<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if (!empty($arResult)):?>
<div id="mainmenu">

<ul>
<li class="root-item-selected"> <a href="/" class="root-item-selected">������� </a>
</li>
</ul>

<ul id="question" style="float:right"><li><a href="/about/feedback/">������ ������</a></li></ul>
</div>


<!-- <div class="menu-clear-left"></div> -->

<!-- <pre>
<?// print_r($arResult);?>
</pre> -->
  

	<? 
	$curDir = $APPLICATION -> GetCurPage();
	
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
	"SET_TITLE" => "N",	// ������������� ��������� ��������
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
<? ?>
	


<div style="clear:both;"></div>

<?endif?>