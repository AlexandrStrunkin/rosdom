<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("�����");
?>
<h1>�����</h1>
 <?$APPLICATION->IncludeComponent("bitrix:catalog.section.list", "rosdom_video_sec_list", Array(
	"IBLOCK_TYPE" => "video",	// ��� ����-�����
	"IBLOCK_ID" => "13",	// ����-����
	"SECTION_ID" => "",	// ID �������
	"SECTION_CODE" => $_REQUEST["SECTION_CODE"],	// ��� �������
	"COUNT_ELEMENTS" => "Y",	// ���������� ���������� ��������� � �������
	"TOP_DEPTH" => "2",	// ������������ ������������ ������� ��������
	"SECTION_FIELDS" => array(	// ���� ��������
		0 => "",
		1 => "",
	),
	"SECTION_USER_FIELDS" => array(	// �������� ��������
		0 => "",
		1 => "",
	),
	"SECTION_URL" => "/video/#SECTION_CODE#/",	// URL, ������� �� �������� � ���������� �������
	"CACHE_TYPE" => "A",	// ��� �����������
	"CACHE_TIME" => "36000000",	// ����� ����������� (���.)
	"CACHE_GROUPS" => "Y",	// ��������� ����� �������
	"ADD_SECTIONS_CHAIN" => "Y",	// �������� ������ � ������� ���������
	),
	false
);?> 
		

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>