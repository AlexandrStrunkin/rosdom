<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Title");
?> <?
?><?$APPLICATION->IncludeComponent("bitrix:news.list", "video_mainsec", array(
	"DISPLAY_DATE" => "N",
	"DISPLAY_NAME" => "Y",
	"DISPLAY_PICTURE" => "Y",
	"DISPLAY_PREVIEW_TEXT" => "Y",
	"AJAX_MODE" => "N",
	"IBLOCK_TYPE" => "video",
	"IBLOCK_ID" => "13",
	"NEWS_COUNT" => "90",
	"SORT_BY1" => "ACTIVE_FROM",
	"SORT_ORDER1" => "DESC",
	"SORT_BY2" => "SORT",
	"SORT_ORDER2" => "ASC",
	"FILTER_NAME" => "arFilter",
	"FIELD_CODE" => "",
	"PROPERTY_CODE" => array(
		0 => "VIDEO",
	),
	"CHECK_DATES" => "Y",
	"DETAIL_URL" => "/video/video#ELEMENT_ID#/",
	"PREVIEW_TRUNCATE_LEN" => "",
	"ACTIVE_DATE_FORMAT" => "d.m.Y",
	"SET_TITLE" => "Y",
	"SET_STATUS_404" => "Y",
	"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
	"ADD_SECTIONS_CHAIN" => "N",
	"HIDE_LINK_WHEN_NO_DETAIL" => "N",
	"PARENT_SECTION" => "",
	"PARENT_SECTION_CODE" => $_REQUEST["SECTION_CODE"],
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "36000000",
	"CACHE_FILTER" => "Y",
	"CACHE_GROUPS" => "Y",
	"DISPLAY_TOP_PAGER" => "N",
	"DISPLAY_BOTTOM_PAGER" => "N",
	"PAGER_TITLE" => "�������",
	"PAGER_SHOW_ALWAYS" => "N",
	"PAGER_TEMPLATE" => "",
	"PAGER_DESC_NUMBERING" => "N",
	"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
	"PAGER_SHOW_ALL" => "N",
	"AJAX_OPTION_JUMP" => "N",
	"AJAX_OPTION_STYLE" => "N",
	"AJAX_OPTION_HISTORY" => "N"
	),
	false,
	array(
	"ACTIVE_COMPONENT" => "N"
	)
);?><?$APPLICATION->IncludeComponent("bitrix:catalog.section", "rosdom_video_list", Array(
	"AJAX_MODE" => "N",	// �������� ����� AJAX
	"IBLOCK_TYPE" => "video",	// ��� ���������
	"IBLOCK_ID" => "13",	// ��������
	"SECTION_ID" => "",	// ID �������
	"SECTION_CODE" => $_REQUEST["SECTION_CODE"],	// ��� �������
	"SECTION_USER_FIELDS" => "",	// �������� �������
	"ELEMENT_SORT_FIELD" => "sort",	// �� ������ ���� ��������� ��������
	"ELEMENT_SORT_ORDER" => "asc",	// ������� ���������� ���������
	"FILTER_NAME" => "arrFilter",	// ��� ������� �� ���������� ������� ��� ���������� ���������
	"INCLUDE_SUBSECTIONS" => "N",	// ���������� �������� ����������� �������
	"SHOW_ALL_WO_SECTION" => "N",	// ���������� ��� ��������, ���� �� ������ ������
	"SECTION_URL" => "",	// URL, ������� �� �������� � ���������� �������
	"DETAIL_URL" => "",	// URL, ������� �� �������� � ���������� �������� �������
	"BASKET_URL" => "/personal/basket.php",	// URL, ������� �� �������� � �������� ����������
	"ACTION_VARIABLE" => "action",	// �������� ����������, � ������� ���������� ��������
	"PRODUCT_ID_VARIABLE" => "id",	// �������� ����������, � ������� ���������� ��� ������ ��� �������
	"PRODUCT_QUANTITY_VARIABLE" => "quantity",	// �������� ����������, � ������� ���������� ���������� ������
	"PRODUCT_PROPS_VARIABLE" => "prop",	// �������� ����������, � ������� ���������� �������������� ������
	"SECTION_ID_VARIABLE" => "SECTION_ID",	// �������� ����������, � ������� ���������� ��� ������
	"META_KEYWORDS" => "-",	// ���������� �������� ����� �������� �� ��������
	"META_DESCRIPTION" => "-",	// ���������� �������� �������� �� ��������
	"BROWSER_TITLE" => "-",	// ���������� ��������� ���� �������� �� ��������
	"ADD_SECTIONS_CHAIN" => "N",	// �������� ������ � ������� ���������
	"DISPLAY_COMPARE" => "N",	// �������� ������ ���������
	"SET_TITLE" => "Y",	// ������������� ��������� ��������
	"SET_STATUS_404" => "N",	// ������������� ������ 404, ���� �� ������� ������� ��� ������
	"PAGE_ELEMENT_COUNT" => "30",	// ���������� ��������� �� ��������
	"LINE_ELEMENT_COUNT" => "2",	// ���������� ��������� ��������� � ����� ������ �������
	"PROPERTY_CODE" => "",	// ��������
	"OFFERS_LIMIT" => "5",	// ������������ ���������� ����������� ��� ������ (0 - ���)
	"PRICE_CODE" => "",	// ��� ����
	"USE_PRICE_COUNT" => "N",	// ������������ ����� ��� � �����������
	"SHOW_PRICE_COUNT" => "1",	// �������� ���� ��� ����������
	"PRICE_VAT_INCLUDE" => "Y",	// �������� ��� � ����
	"PRODUCT_PROPERTIES" => array(	// �������������� ������
		0 => "COMPANY",
	),
	"USE_PRODUCT_QUANTITY" => "N",	// ��������� �������� ���������� ������
	"CACHE_TYPE" => "A",	// ��� �����������
	"CACHE_TIME" => "36000000",	// ����� ����������� (���.)
	"CACHE_FILTER" => "N",	// ���������� ��� ������������� �������
	"CACHE_GROUPS" => "Y",	// ��������� ����� �������
	"DISPLAY_TOP_PAGER" => "N",	// �������� ��� �������
	"DISPLAY_BOTTOM_PAGER" => "Y",	// �������� ��� �������
	"PAGER_TITLE" => "������",	// �������� ���������
	"PAGER_SHOW_ALWAYS" => "N",	// �������� ������
	"PAGER_TEMPLATE" => "",	// �������� �������
	"PAGER_DESC_NUMBERING" => "N",	// ������������ �������� ���������
	"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",	// ����� ����������� ������� ��� �������� ���������
	"PAGER_SHOW_ALL" => "Y",	// ���������� ������ "���"
	"CONVERT_CURRENCY" => "N",	// ���������� ���� � ����� ������
	"AJAX_OPTION_JUMP" => "N",	// �������� ��������� � ������ ����������
	"AJAX_OPTION_STYLE" => "Y",	// �������� ��������� ������
	"AJAX_OPTION_HISTORY" => "N",	// �������� �������� ��������� ��������
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>