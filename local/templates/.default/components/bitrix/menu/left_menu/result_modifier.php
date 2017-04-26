<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?              

    if (CModule::IncludeModule("iblock")):   
        $id = $_REQUEST["ELEMENT_CODE"];
        $ci = CIBlockElement::GetList(array(), array( array("LOGIC" => "OR", array("ID" => $id), array("CODE" => $id))));
        if ($el = $ci->GetNext() ) {

            if (!empty($arResult)) {

                $secs = CIBlockSection::GetByID($el["IBLOCK_SECTION_ID"]);
                if ($sec = $secs->GetNext()) $add = $sec["CODE"];

                $i = 0;
                foreach ($arResult as $arItem) {
                    $prev_l = $arItem['DEPTH_LEVEL'];
                    if ($arItem['DEPTH_LEVEL'] == 1) $lev1 = $i;

                    if ($arItem["TEXT"] == $sec["NAME"]){
                        $arItem["SELECTED"] = 1;
                        $mark = $lev1;
                    }
                    $i++;
                    if ($arItem['DEPTH_LEVEL']<$prev_l) $lev1 = -1;
                    $temp[] = $arItem;
                }    

                if ($mark >= 0) $temp[$mark]["SELECTED"] = 1;    
                $temp[$mark]["QQQ"] = $mark;   

                $arResult = $temp;
            }
        };      

        // ����������� ������ $arResult ��� ����������
        foreach ($arResult as $key => $arItem){
            $temp['TEXT'] = $arItem['TEXT'];
            $temp['SELECTED'] = $arItem['SELECTED'];    
            $temp['LINK'] = $arItem['LINK'];
            $temp["UF_MENUTITLE"] = $arItem["PARAMS"]["UF_MENUTITLE"];
            $temp['CHILDREN'] = $arItem['CHILDREN'];
            if ($arItem['DEPTH_LEVEL'] == 1 ){
                $arResult[$key] = $temp;
                $i = 1;
            }else{
                $arResult[$key-$i]['CHILDREN'][] = $temp;
                $i++;
                unset($arResult[$key]);
            }    
        } 
        usort($arResult, "cmp");
        foreach ($arResult as $key=>$arItem){
            usort($arResult[$key]["CHILDREN"], "cmp");
        }
        //arshow($arResult);
        endif;
?>