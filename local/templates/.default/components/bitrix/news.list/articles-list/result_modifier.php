<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
    global $APPLICATION;
    
    //���� �� � ������ ������, �� ��� �������� �� ������� ��������� �������� ������ (/articles/article#CODE#/), �� ��������� ������ �������� (����������� �� ������)
    if (substr_count($APPLICATION->GetCurDir(), "/articles/article") > 0) {     
        $APPLICATION->RestartBuffer();
        CHTTP::SetStatus("404 Not Found");
        @define("ERROR_404","Y");
        include($_SERVER["DOCUMENT_ROOT"].'/404.php');
        die();       
}    