<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Проекты домов");
use Bitrix\Iblock\InheritedProperty;
?>
<?
$E =  new CIBlockElement;
$arSelect = Array("ID", "NAME", "IBLOCK_ID", "IBLOCK_SECTION_ID", "PROPERTY_MATERIAL", "PROPERTY_PLINTH", "PROPERTY_ATTIC", "PROPERTY_EXISTENS_GARAGE", "PROPERTY_OB_PL");
$arFilter = Array("IBLOCK_ID"=>37, "ACTIVE"=>"Y");
$el = CIBlockElement::GetList(Array("SORT"=>"ASC"),$arFilter, false, false, $arSelect);
$j =0;
while($elem=$el->GetNext()){
    $ipropValues =  new \Bitrix\Iblock\InheritedProperty\ElementValues($elem["IBLOCK_ID"], $elem["ID"]); 
    $elem_prop = $ipropValues->getValues();        
    $pos = mb_strstr($elem_prop["ELEMENT_META_TITLE"],'������ ������');     
    if($elem_prop["ELEMENT_META_TITLE"] == $pos || $elem_prop["ELEMENT_META_TITLE"] == false){ 
        if($elem["IBLOCK_SECTION_ID"] == 2695){
            $type = "����";                
        }elseif($elem["IBLOCK_SECTION_ID"] == 2696){
            $type = "�������";                
        }elseif($elem["IBLOCK_SECTION_ID"] == 2698 || $elem["IBLOCK_SECTION_ID"] == 2710){
            $type = "������";                
        }elseif($elem["IBLOCK_SECTION_ID"] == 2700){
            $type = "��������";                
        }else{
            $type = "����";
        }        
        $dop = array();
        if($elem["PROPERTY_PLINTH_VALUE"] == "����"){
            array_push($dop, "� �������");    
        }
        if($elem["PROPERTY_ATTIC_VALUE"] == "����"){
            array_push($dop, "� ���������");    
        }
        if($elem["PROPERTY_EXISTENS_GARAGE_VALUE"]){
            array_push($dop, "� �������");    
        }     
        if($elem["PROPERTY_MATERIAL_VALUE"] == "������"){
            $mat = "����������";    
        }elseif($elem["PROPERTY_MATERIAL_VALUE"] == "���������"){
            $mat = "������������";  
        }elseif($elem["PROPERTY_MATERIAL_VALUE"] == "������"){
            $mat = "�����������";  
        }elseif($elem["PROPERTY_MATERIAL_VALUE"] == "������"){
            $mat = "����������";  
        }elseif($elem["PROPERTY_MATERIAL_VALUE"] == "�������"){
            $mat = "�����������";  
        }                                                                     
        $arLoadProductArray[$elem["ID"]] = Array(             
        "IPROPERTY_TEMPLATES"   =>  array( 
           "ELEMENT_META_TITLE"          =>  "������ ������ ".$mat." ".$type." ".$dop[0]." ".$elem["NAME"]."  �������� ".$elem["PROPERTY_OB_PL_VALUE"]." �2  �� Rosdom",  
           "ELEMENT_META_DESCRIPTION"       =>  "������ ������� �� ������� ".$elem["NAME"]." � �������������������� �� ��������� ������������� ".$type." ������ �� �������� + 7 (495) 775-63-93. ������ �������� ������� ������ ".$elem["NAME"]." ".$mat." ".$type." �������� ".$elem["PROPERTY_OB_PL_VALUE"]." �2", 
           "ELEMENT_META_KEYWORDS"    =>  $elem["NAME"].", ������, ".$type, 
           "ELEMENT_PAGE_TITLE"          =>  "������ ".$mat." ".$type.", ".$dop[0]." ".$elem["NAME"]."  �������� ".$elem["PROPERTY_OB_PL_VALUE"]."  �2", 
        )
        );    
        //$res = $E->Update($elem["ID"],$arLoadProductArray);                  
    } 
         
}
foreach ($arLoadProductArray as $key=>$item){
    $res = $E->Update($key,$item); 
    $j++;    
} 
arshow($j);
?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>