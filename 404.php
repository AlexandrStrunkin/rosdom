<? 
    include_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/urlrewrite.php');

    CHTTP::SetStatus("404 Not Found"); 
    @define("ERROR_404","Y");  

    require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

    $APPLICATION->SetTitle("404. �������� �� �������");
?>                                      
<div style="padding: 20px 0px 0px 11px; "> 		 
    <font size=18><b>404 ������</b>   
    </font>
    <br />
    <span style="color: rgb(204, 0, 0); font-size:18px; ">������������� ���� �������� <?//echo $_SERVER['HTTP_REFERER'];?> �� ������</span>
    <br> 
    <br>
    �� ������:
    <ul> 
        <li><b><a href="/" >������� �� �������</a></b></li>

        <li><b><a href="/map/" >���������� ����� �����</a></b></li>
    </ul>      		 

 </div>
 <? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>