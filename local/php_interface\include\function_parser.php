<?function AddPicture($image_url) {
    //��������� ���� � �������� ��� ���� �� �������
    $piture = explode('/', $image_url);
    $picture_last = array();
    $picture_penult = array();
    if(!empty($piture)) {
        $file_perspectiva_big = $image_url;
        $picture_last = array_pop($piture);
        $picture_penult = array_pop($piture);
        $newfile = $_SERVER["DOCUMENT_ROOT"] . '/upload/iblock/photo/' . $picture_penult.$picture_last;
        if(!CFile::MakeFileArray($newfile)){
            $file_get = file_put_contents($newfile, file_get_contents($file_perspectiva_big));
        }
    }
    return $newfile;
}
function UpdatePicture($image_url) {
    //��������� ���� � �������� ��� ���� �� �������
    $piture = explode('/', $image_url);
    $picture_last = array();
    $picture_penult = array();
    $file_perspectiva_big = $image_url;
    $picture_last = array_pop($piture);
    $picture_penult = array_pop($piture);
    $newfile = $_SERVER["DOCUMENT_ROOT"] . '/upload/iblock/photo/' . $picture_penult.$picture_last;
    if(!CFile::MakeFileArray($newfile)) {
        $file_get = file_put_contents($newfile, file_get_contents($file_perspectiva_big));
    }
    return $newfile;
}
function my_log($string) {  // ���������� ���� � ����
    $log_file_name = $_SERVER['DOCUMENT_ROOT']."/my_log.txt";
    $now = date("Y-m-d H:i:s");
    file_put_contents($log_file_name, $now." ".$string."\r\n", FILE_APPEND);
}

function AddingParceAdd() {

    $simple  = simplexml_load_file("http://www.catalog-domov.ru/xml/rosdom.xml");
    $vars = array();
    $i = 0;

    foreach ($simple->project as $name => $value) {
        $vars[$i++] = get_object_vars($value);   // ����������� ������ � ������
    }

    global $USER;
    CModule::IncludeModule('iblock');
    $arSelect = Array("ID", "IBLOCK_ID", "PROPERTY_UNLOADED_THROUGH_PARSER", "NAME", "PROPERTY_IMG_HASH", "PROPERTY_PROJECT_TEMPORARILY_UNAVAILABLE");
    $arFilter = Array("IBLOCK_ID" => IBLOCK_ID_PROJECT);

    $ar_item_name = array();
    $ar_element = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
    while ($element_wrap = $ar_element->GetNext()) {
        if($element_wrap["PROPERTY_UNLOADED_THROUGH_PARSER_VALUE"] == 'Y'){
            $ar_item_name[$element_wrap["NAME"]][] = $element_wrap["ID"];
            $ar_item_name[$element_wrap["NAME"]][] = $element_wrap["PROPERTY_IMG_HASH_VALUE"];
            $ar_item_name[$element_wrap["NAME"]][] = $element_wrap["PROPERTY_PROJECT_TEMPORARILY_UNAVAILABLE_VALUE"];
        }
    }

   foreach($vars as $key => $item_parser) {

      // ������������ �������� ����� ������� utf8win1251
      if(!$ar_item_name[$item_parser["prj_name"]]) {

        $PROP = array();

        $newfile_perspectiva_big = AddPicture($item_parser["perspectiva_big"]);
        $newfile_perspectiva_small = AddPicture($item_parser["perspectiva_small"]);

        $newfile_perspectiva_plan_0 = AddPicture($item_parser["plan_0"]);
        $newfile_perspectiva_plan_1 = AddPicture($item_parser["plan_1"]);
        $newfile_perspectiva_plan_2 = AddPicture($item_parser["plan_2"]);
        $newfile_perspectiva_plan_3 = AddPicture($item_parser["plan_3"]);
        $newfile_perspectiva_plan_4 = AddPicture($item_parser["plan_4"]);
        $newfile_perspectiva_plan_m = AddPicture($item_parser["plan_m"]);

        $newfile_perspectiva_fasad_front = AddPicture($item_parser["fasad_front"]);
        $newfile_perspectiva_fasad_left = AddPicture($item_parser["fasad_left"]);
        $newfile_perspectiva_fasad_right = AddPicture($item_parser["fasad_right"]);
        $newfile_perspectiva_fasad_behind = AddPicture($item_parser["fasad_behind"]);

        $element_room = str_split($item_parser["rooms"], 1);  // ��������� �������� �� �������� ��� ����������� ������������

        $PROP["NUMBER_OF_BEDROOMS"] = $element_room[0];  //  ����� ������
        $PROP["NUMBER_OF_LIVING"] = $element_room[1];   // ����� ����� ������, ��������������� ��� �������, ����� ��������
        $PROP["NUMBER_OF_BATH"] = $element_room[2];    // ����� �/�, ����
        $PROP["PRESENCE"] = ($element_room[3] = 1)? Array("VALUE" => PRESENCE_ID): ''; // ������� �����
        $PROP["POOL"] = ($element_room[4] = 1)? Array("VALUE" => POOL_ID): '';  // ������� ��������
        $PROP["BILLIARD"] = ($element_room[5] = 1)? Array("VALUE" => BILLIARD_ID): ''; // ������� ���������
        $PROP["COMPLEX"] = ($element_room[6] = 1)? Array("VALUE" => COMPLEX_ID): '';   // ������� ��������������
        $PROP["PRESENCE_WINTER"] = ($element_room[7] = 1)? Array("VALUE" => PRESENCE_WINTER_ID): '';   // ������� ������� ����
        if($element_room[8] = 2) {          // ������� � ��� ������
            $PROP["EXISTENS_GARAGE"] = Array("VALUE" => EXISTENS_GARAGE_ID_ONE);
        } else if($element_room[8] = 1) {
            $PROP["EXISTENS_GARAGE"] = Array("VALUE" => EXISTENS_GARAGE_ID_TWO);
        }

        $PROP["NUMBER_CARS"] = $element_room[9];  // ���������� ����� � ������
        $PROP["IMG_HASH"] = $item_parser["img_hash"];   // ����������� ����� �� ��������� �������
        $PROP["MATERIALS"] = utf8win1251($item_parser["materials"]);  // �������� "������������ ���������"
        $PROP["V_GAB"] = $item_parser["v_gab"];  // �������� "������� ���� 1"
        $PROP["H_GAB"] = $item_parser["h_gab"];        // �������� "������� ���� 2"
        $PROP["OB_PL"] = $item_parser["ob_pl"];        // �������� "����� �������"
        $PROP["JIL_PL"] = $item_parser["jil_pl"];        // �������� "����� �������"
        $PROP["UNLOADED_THROUGH_PARSER"] = 'Y';        // �������� "����� �������� ����� ������"
        $PROP["PLAN_0"] = CFile::MakeFileArray($newfile_perspectiva_plan_0);
        $PROP["PLAN_1"] = CFile::MakeFileArray($newfile_perspectiva_plan_1);
        $PROP["PLAN_2"] = CFile::MakeFileArray($newfile_perspectiva_plan_2);
        $PROP["PLAN_3"] = CFile::MakeFileArray($newfile_perspectiva_plan_3);
        $PROP["PLAN_4"] = CFile::MakeFileArray($newfile_perspectiva_plan_4);
        $PROP["PLAN_M"] = CFile::MakeFileArray($newfile_perspectiva_plan_m);
        $PROP["FASAD_FRONT"] = CFile::MakeFileArray($newfile_perspectiva_fasad_front);
        $PROP["FASAD_LEFT"] = CFile::MakeFileArray($newfile_perspectiva_fasad_left);
        $PROP["FASAD_RIGHT"] = CFile::MakeFileArray($newfile_perspectiva_fasad_right);
        $PROP["FASAD_BEHIND"] = CFile::MakeFileArray($newfile_perspectiva_fasad_behind);


        // ���� ��������� ��� � �� �������� ���������� ���
        $arParams = array(
          "max_len" => "100", // �������� ���������� ��� �� 100 ��������
          "change_case" => "L", // �������� � ������� ��������
          "replace_space" => "-", // ������ ������� �� ����
          "replace_other" => "-", // ������ ������ ������� �� ����
          "delete_repeat_replace" => "true", // ������� ������������� ����
          "use_google" => "false", // ��������� ������������� google
        );
       // ���������� ���������� ��� ������
       $xml_name = Cutil::translit($item_parser["prj_name"], "ru", $arParams);
       $section_heading = substr($item_parser["prj_name"], -1);

           $section_id = array(); // ������������� ������� �� ��������
           if($section_heading == 'P' ){ // ������ ���������
               if($item_parser["ob_pl"] < TOTAL_AREA_1) {  // ������� ���� 150 ���������� ������
                  $section_id[] = PROJECTS_HOUSES_BLOCKS_150; // ������� ����� �� ���������� � ���������� 150 ���������� ������
               } else if($item_parser["ob_pl"] >= TOTAL_AREA_1 && $item_parser["ob_pl"] < TOTAL_AREA_2) { // ������� ���� 250 ���������� ������
                  $section_id[] = PROJECTS_HOUSES_BLOCKS_150_250; // ������� ����� �� ���������� � ���������� �� 150 �� 250 ���������� ������
               } else if($item_parser["ob_pl"] >= TOTAL_AREA_2 && $item_parser["ob_pl"] < TOTAL_AREA_3) { // ������� ���� 400 ���������� ������
                  $section_id[] = PROJECTS_HOUSES_BLOCKS_250_400; // ������� ����� �� ���������� � ���������� �� 250 �� 400 ���������� ������
               }else if($item_parser["ob_pl"] > TOTAL_AREA_3) { // ������� ���� 400 ���������� ������
                  $section_id[] = PROJECTS_HOUSES_BLOCKS_400; // ������� ����� �� ���������� � ���������� 400 ���������� ������
               }
           } else if($section_heading == 'D' ){ // ������ ������
               if($item_parser["ob_pl"] < TOTAL_AREA_1) {  // ������� ���� 150 ���������� ������
                  $section_id[] = PROJECTS_WOODEN_150;  // ������� ���������� ����� 150 ���������� ������
               } else if($item_parser["ob_pl"] >= TOTAL_AREA_1 && $item_parser["ob_pl"] < TOTAL_AREA_2) { // ������� ���� 250 ���������� ������
                  $section_id[] = PROJECTS_WOODEN_150_250;  // ������� ���������� ����� �� 150 �� 250 ���������� ������
               } else if($item_parser["ob_pl"] >= TOTAL_AREA_2 && $item_parser["ob_pl"] < TOTAL_AREA_3) { // ������� ���� 400 ���������� ������
                  $section_id[] = PROJECTS_WOODEN_250_400;  // ������� ���������� ����� �� 250 �� 400 ���������� ������
               }else if($item_parser["ob_pl"] > TOTAL_AREA_3) { // ������� ���� 400 ���������� ������
                  $section_id[] = PROJECTS_WOODEN_400;    // ������� ���������� ����� 400 ���������� ������
               }
           } else if($section_heading == 'K' ) {  // ������ ������
               if($item_parser["ob_pl"] < TOTAL_AREA_1){ // ������� ���� 150 ���������� ������
                  $section_id[] = PROJECTS_BRICK_150;  // ������� ��������� ����� 150 ���������� ������
               } else if($item_parser["ob_pl"] >= TOTAL_AREA_1 && $item_parser["ob_pl"] < TOTAL_AREA_2) { // ������� ���� 250 ���������� ������
                  $section_id[] = PROJECTS_BRICK_150_250;   // ������� ��������� ����� �� 150 �� 250 ���������� ������
               } else if($item_parser["ob_pl"] >= TOTAL_AREA_2 && $item_parser["ob_pl"] < TOTAL_AREA_3) { // ������� ���� 400 ���������� ������
                  $section_id[] = PROJECTS_BRICK_250_400;    // ������� ��������� ����� �� 250 �� 400 ���������� ������
               }else if($item_parser["ob_pl"] > TOTAL_AREA_3) { // ������� ���� 400 ���������� ������
                  $section_id[] = PROJECTS_BRICK_400;   // ������� ��������� ����� 400 ���������� ������
               }
           } else if($section_heading == 'S' ) {  // ������ ������
               if($item_parser["ob_pl"] < TOTAL_AREA_1) {  // ������� ���� 150 ���������� ������
                  $section_id[] = PROJECTS_FRAME_150;  // ������� ��������� ����� 150 ���������� ������
               } else if($item_parser["ob_pl"] >= TOTAL_AREA_1 && $item_parser["ob_pl"] < TOTAL_AREA_2) { // ������� ���� 250 ���������� ������
                  $section_id[] = PROJECTS_FRAME_150_250;  // ������� ��������� ����� �� 150 �� 250 ���������� ������
               } else if($item_parser["ob_pl"] >= TOTAL_AREA_2 && $item_parser["ob_pl"] < TOTAL_AREA_3) { // ������� ���� 400 ���������� ������
                  $section_id[] = PROJECTS_FRAME_250_400;   // ������� ��������� ����� �� 250 �� 400 ���������� ������
               }else if($item_parser["ob_pl"] > TOTAL_AREA_3) { // ������� ���� 400 ���������� ������
                  $section_id[] = PROJECTS_FRAME_400;   // ������� ��������� ����� 400 ���������� ������
               }
           }
           if($item_parser["plan_1"]) {
                $section_id[] = PROJECTS_OF_SINGLE_STOREY;   // ������� ����������� �����
           }
           if($item_parser["plan_2"]) {
                $section_id[] = DRAFT_TWO_STOREY;  // ������� ����������� �����
           }
           if($item_parser["plan_3"]) {
                $section_id[] = PROJECTS_STOREY; // ������� ����������� �����
           }
           if($item_parser["plan_4"]) {
                $section_id[] = DRAFT_FOUR_STOREY;   // ������� �������������� �����
           }
           if($item_parser["plan_0"]) {
                $section_id[] = PROJECTS_OF_HOUSES_WITH; // ������� ����� � ��������� ������
           }
           if($item_parser["plan_m"]) {
                $section_id[] = PROJECTS_OF_HOUSES_ATTIC; // ������� ����� � ���������
           }
           if($item_parser["labels"] == '[61]') {
                $section_id[] = PROJECTS_TOWNHOUSES;   // ������� ���������� � ������������� �����
           }
           if($item_parser["labels"] == '[62]') {
                $section_id[] = HOUSES_TWO_FAMILIES;  // ������� ����� �� ��� �����
           }
           if($item_parser["labels"] == '[63]') {
                $section_id[] = PROJECTS_NARROW;  // ������� ����� �����
           }
           if($item_parser["labels"] == '[60]') {
                $section_id[] = BATHS_PROJECTS;   // ������� ����
           }
           if($item_parser["labels"] == '[142]') {
                $section_id[] = MANSIONS_PROJECTS; // ������� ���������
           }
           if($item_parser["labels"] == '[141]') {
                $section_id[] = GARAGE_PROJECTS;   // ������� �������
           }
           if($item_parser["labels"] == '[140]') {
                $section_id[] = SWIMMING_POOLS_DESIGNS;  // ������� ���������
           }
           if($item_parser["labels"] == '[645]') {
                $section_id[] = DESIGNS_GAZEBOS; // ������� �������, ������������� �������
           }
       $el = new CIBlockElement;
       if(!empty($section_id)){
       $arLoadProductArray = array();

            $arLoadProductArray = Array(
              "IBLOCK_SECTION" => $section_id,          // ������� ����� � ����� �������
              "CODE"           => $xml_name,
              "IBLOCK_ID"      => IBLOCK_ID_PROJECT,
              "NAME"           => $item_parser["prj_name"],   // �������� ��������
              "ACTIVE"         => "Y",
              "PROPERTY_VALUES"=> $PROP,          // �������
              "DETAIL_PICTURE" => CFile::MakeFileArray($newfile_perspectiva_big), // ��������� url ��������
              "PREVIEW_PICTURE" => CFile::MakeFileArray($newfile_perspectiva_small), // ��������� url ��������
              );
       } else {
            $arLoadProductArray = Array(
              "IBLOCK_SECTION" => false,          // ������� ����� � ����� �������
              "CODE"           => $xml_name,
              "IBLOCK_ID"      => IBLOCK_ID_PROJECT,
              "NAME"           => $item_parser["prj_name"],   // �������� ��������
              "ACTIVE"         => "Y",
              "PROPERTY_VALUES"=> $PROP,          // �������
              "DETAIL_PICTURE" => CFile::MakeFileArray($newfile_perspectiva_big), // ��������� url ��������
              "PREVIEW_PICTURE" => CFile::MakeFileArray($newfile_perspectiva_small), // ��������� url ��������
              );
       }
            $PRODUCT_ID = $el->Add($arLoadProductArray);
            if($PRODUCT_ID) {        // ������ � ����
              my_log("New ID: ".$PRODUCT_ID);
            } else {
              my_log("Error: ".$el->LAST_ERROR);
            }
            arshow($PRODUCT_ID);
            $ar_item_name[$item_parser["prj_name"]] = $PRODUCT_ID;

            $arCatFields = array(
              "ID" => $PRODUCT_ID,
              "VAT_INCLUDED" => "Y", //��� ������ � ���������
              "QUANTITY" => 1,
              "WEIGHT" => 100,
              );
            $product_cat = CCatalogProduct::Add($arCatFields);

            $ar_price_type = array(); // ������ ����� ��� � ����� ���
            $ar_price_type = array(
                PRICE_OF_DEVELOPER_KIT => $item_parser["price0"],
                PRICE_OF_COMPLETE_SET => $item_parser["price1"],
                PRICE_FOR_ARCHITECTURAL  => $item_parser["price2"],
                PRICE_OF_AN_ADDITIONAL  => $item_parser["price3"],
                PRICE_OF_THE_PASSPORT  => $item_parser["price4"],
            );
            foreach($ar_price_type as $key_type => $preice) {

                $ar_fields_offer_price = array(
                    "PRODUCT_ID"=> $PRODUCT_ID,
                    "CATALOG_GROUP_ID" => $key_type,
                    "PRICE"=> $preice,
                    "CURRENCY"=> "RUB",
                );
                $ar_offer_price = CPrice::GetList(array(), array("PRODUCT_ID"  => $PRODUCT_ID, "CATALOG_GROUP_ID" => $key_type));
                if ( $price_offer = $ar_offer_price->Fetch() ) {
                    CPrice::Update( $price_offer["ID"], $ar_fields_offer_price );
                } else {
                    CPrice::Add($ar_fields_offer_price);
                }
            }



      } else if($ar_item_name[$item_parser["prj_name"]]){  // ��� ������� ������ � ��������� ��������� ��� ��������



          // update
          $PROP = array();

            if($ar_item_name[$item_parser["prj_name"]][1] != $item_parser["img_hash"]) {

                $newfile_perspectiva_big = UpdatePicture($item_parser["perspectiva_big"]);
                $newfile_perspectiva_small = UpdatePicture($item_parser["perspectiva_small"]);

                $newfile_perspectiva_plan_0 = UpdatePicture($item_parser["plan_0"]);
                $newfile_perspectiva_plan_1 = UpdatePicture($item_parser["plan_1"]);
                $newfile_perspectiva_plan_2 = UpdatePicture($item_parser["plan_2"]);
                $newfile_perspectiva_plan_3 = UpdatePicture($item_parser["plan_3"]);
                $newfile_perspectiva_plan_4 = UpdatePicture($item_parser["plan_4"]);
                $newfile_perspectiva_plan_m = UpdatePicture($item_parser["plan_m"]);

                $newfile_perspectiva_fasad_front = UpdatePicture($item_parser["fasad_front"]);
                $newfile_perspectiva_fasad_left = UpdatePicture($item_parser["fasad_left"]);
                $newfile_perspectiva_fasad_right = UpdatePicture($item_parser["fasad_right"]);
                $newfile_perspectiva_fasad_behind = UpdatePicture($item_parser["fasad_behind"]);

            }
            $el = new CIBlockElement;

            $element_room = str_split($item_parser["rooms"], 1);  // ��������� �������� �� �������� ��� ����������� ������������

            $PROP["NUMBER_OF_BEDROOMS"] = $element_room[0];  //  ����� ������
            $PROP["NUMBER_OF_LIVING"] = $element_room[1];   // ����� ����� ������, ��������������� ��� �������, ����� ��������
            $PROP["NUMBER_OF_BATH"] = $element_room[2];    // ����� �/�, ����
            $PROP["PRESENCE"] = ($element_room[3] = 1)? Array("VALUE" => PRESENCE_ID): ''; // ������� �����
            $PROP["POOL"] = ($element_room[4] = 1)? Array("VALUE" => POOL_ID): '';  // ������� ��������
            $PROP["BILLIARD"] = ($element_room[5] = 1)? Array("VALUE" => BILLIARD_ID): ''; // ������� ���������
            $PROP["COMPLEX"] = ($element_room[6] = 1)? Array("VALUE" => COMPLEX_ID): '';   // ������� ��������������
            $PROP["PRESENCE_WINTER"] = ($element_room[7] = 1)? Array("VALUE" => PRESENCE_WINTER_ID): '';   // ������� ������� ����
            if($element_room[8] = 2) {          // ������� � ��� ������
                $PROP["EXISTENS_GARAGE"] = Array("VALUE" => EXISTENS_GARAGE_ID_ONE);
            } else if($element_room[8] = 1) {
                $PROP["EXISTENS_GARAGE"] = Array("VALUE" => EXISTENS_GARAGE_ID_TWO);
            }

            $PROP["NUMBER_CARS"] = $element_room[9];  // ���������� ����� � ������
            $PROP["IMG_HASH"] = $item_parser["img_hash"];   // ����������� ����� �� ��������� �������
            $PROP["MATERIALS"] = utf8win1251($item_parser["materials"]);  // �������� "������������ ���������"
            $PROP["V_GAB"] = $item_parser["v_gab"];  // �������� "������� ���� 1"
            $PROP["H_GAB"] = $item_parser["h_gab"];        // �������� "������� ���� 2"
            $PROP["OB_PL"] = $item_parser["ob_pl"];        // �������� "����� �������"
            $PROP["JIL_PL"] = $item_parser["jil_pl"];        // �������� "����� �������"
            $PROP["UNLOADED_THROUGH_PARSER"] = 'Y';        // �������� "����� �������� ����� ������"
            $PROP["PLAN_0"] = CFile::MakeFileArray($newfile_perspectiva_plan_0);
            $PROP["PLAN_1"] = CFile::MakeFileArray($newfile_perspectiva_plan_1);
            $PROP["PLAN_2"] = CFile::MakeFileArray($newfile_perspectiva_plan_2);
            $PROP["PLAN_3"] = CFile::MakeFileArray($newfile_perspectiva_plan_3);
            $PROP["PLAN_4"] = CFile::MakeFileArray($newfile_perspectiva_plan_4);
            $PROP["PLAN_M"] = CFile::MakeFileArray($newfile_perspectiva_plan_m);
            $PROP["FASAD_FRONT"] = CFile::MakeFileArray($newfile_perspectiva_fasad_front);
            $PROP["FASAD_LEFT"] = CFile::MakeFileArray($newfile_perspectiva_fasad_left);
            $PROP["FASAD_RIGHT"] = CFile::MakeFileArray($newfile_perspectiva_fasad_right);
            $PROP["FASAD_BEHIND"] = CFile::MakeFileArray($newfile_perspectiva_fasad_behind);

           // ���������� ���������� ��� ������
           $xml_name = Cutil::translit($item_parser["prj_name"], "ru", $arParams);
           $section_heading = substr($item_parser["prj_name"], -1);

           $section_id = array(); // ������������� ������� �� ��������
           if($section_heading == 'P' ) { // ������ ���������
               if($item_parser["ob_pl"] < TOTAL_AREA_1){  // ������� ���� 150 ���������� ������
                  $section_id[] = PROJECTS_HOUSES_BLOCKS_150; // ������� ����� �� ���������� � ���������� 150 ���������� ������
               } else if($item_parser["ob_pl"] >= TOTAL_AREA_1 && $item_parser["ob_pl"] < TOTAL_AREA_2){ // ������� ���� 250 ���������� ������
                  $section_id[] = PROJECTS_HOUSES_BLOCKS_150_250; // ������� ����� �� ���������� � ���������� �� 150 �� 250 ���������� ������
               } else if($item_parser["ob_pl"] >= TOTAL_AREA_2 && $item_parser["ob_pl"] < TOTAL_AREA_3){ // ������� ���� 400 ���������� ������
                  $section_id[] = PROJECTS_HOUSES_BLOCKS_250_400; // ������� ����� �� ���������� � ���������� �� 250 �� 400 ���������� ������
               }else if($item_parser["ob_pl"] > TOTAL_AREA_3){ // ������� ���� 400 ���������� ������
                  $section_id[] = PROJECTS_HOUSES_BLOCKS_400; // ������� ����� �� ���������� � ���������� 400 ���������� ������
               }
           } else if($section_heading == 'D' ) { // ������ ������
               if($item_parser["ob_pl"] < TOTAL_AREA_1){  // ������� ���� 150 ���������� ������
                  $section_id[] = PROJECTS_WOODEN_150;  // ������� ���������� ����� 150 ���������� ������
               } else if($item_parser["ob_pl"] >= TOTAL_AREA_1 && $item_parser["ob_pl"] < TOTAL_AREA_2){ // ������� ���� 250 ���������� ������
                  $section_id[] = PROJECTS_WOODEN_150_250;  // ������� ���������� ����� �� 150 �� 250 ���������� ������
               } else if($item_parser["ob_pl"] >= TOTAL_AREA_2 && $item_parser["ob_pl"] < TOTAL_AREA_3){ // ������� ���� 400 ���������� ������
                  $section_id[] = PROJECTS_WOODEN_250_400;  // ������� ���������� ����� �� 250 �� 400 ���������� ������
               }else if($item_parser["ob_pl"] > TOTAL_AREA_3){ // ������� ���� 400 ���������� ������
                  $section_id[] = PROJECTS_WOODEN_400;    // ������� ���������� ����� 400 ���������� ������
               }
           } else if($section_heading == 'K' ) {  // ������ ������
               if($item_parser["ob_pl"] < TOTAL_AREA_1){ // ������� ���� 150 ���������� ������
                  $section_id[] = PROJECTS_BRICK_150;  // ������� ��������� ����� 150 ���������� ������
               } else if($item_parser["ob_pl"] >= TOTAL_AREA_1 && $item_parser["ob_pl"] < TOTAL_AREA_2){ // ������� ���� 250 ���������� ������
                  $section_id[] = PROJECTS_BRICK_150_250;   // ������� ��������� ����� �� 150 �� 250 ���������� ������
               } else if($item_parser["ob_pl"] >= TOTAL_AREA_2 && $item_parser["ob_pl"] < TOTAL_AREA_3){ // ������� ���� 400 ���������� ������
                  $section_id[] = PROJECTS_BRICK_250_400;    // ������� ��������� ����� �� 250 �� 400 ���������� ������
               }else if($item_parser["ob_pl"] > TOTAL_AREA_3){ // ������� ���� 400 ���������� ������
                  $section_id[] = PROJECTS_BRICK_400;   // ������� ��������� ����� 400 ���������� ������
               }
           } else if($section_heading == 'S' ) {  // ������ ������
               if($item_parser["ob_pl"] < TOTAL_AREA_1){  // ������� ���� 150 ���������� ������
                  $section_id[] = PROJECTS_FRAME_150;  // ������� ��������� ����� 150 ���������� ������
               } else if($item_parser["ob_pl"] >= TOTAL_AREA_1 && $item_parser["ob_pl"] < TOTAL_AREA_2){ // ������� ���� 250 ���������� ������
                  $section_id[] = PROJECTS_FRAME_150_250;  // ������� ��������� ����� �� 150 �� 250 ���������� ������
               } else if($item_parser["ob_pl"] >= TOTAL_AREA_2 && $item_parser["ob_pl"] < TOTAL_AREA_3){ // ������� ���� 400 ���������� ������
                  $section_id[] = PROJECTS_FRAME_250_400;   // ������� ��������� ����� �� 250 �� 400 ���������� ������
               }else if($item_parser["ob_pl"] > TOTAL_AREA_3){ // ������� ���� 400 ���������� ������
                  $section_id[] = PROJECTS_FRAME_400;   // ������� ��������� ����� 400 ���������� ������
               }
           }
           if($item_parser["plan_1"]){
                $section_id[] = PROJECTS_OF_SINGLE_STOREY;   // ������� ����������� �����
           }
           if($item_parser["plan_2"]){
                $section_id[] = DRAFT_TWO_STOREY;  // ������� ����������� �����
           }
           if($item_parser["plan_3"]){
                $section_id[] = PROJECTS_STOREY; // ������� ����������� �����
           }
           if($item_parser["plan_4"]){
                $section_id[] = DRAFT_FOUR_STOREY;   // ������� �������������� �����
           }
           if($item_parser["plan_0"]){
                $section_id[] = PROJECTS_OF_HOUSES_WITH; // ������� ����� � ��������� ������
           }
           if($item_parser["plan_m"]){
                $section_id[] = PROJECTS_OF_HOUSES_ATTIC; // ������� ����� � ���������
           }
           if($item_parser["labels"] == '[61]'){
                $section_id[] = PROJECTS_TOWNHOUSES;   // ������� ���������� � ������������� �����
           }
           if($item_parser["labels"] == '[62]'){
                $section_id[] = HOUSES_TWO_FAMILIES;  // ������� ����� �� ��� �����
           }
           if($item_parser["labels"] == '[63]'){
                $section_id[] = PROJECTS_NARROW;  // ������� ����� �����
           }
           if($item_parser["labels"] == '[60]'){
                $section_id[] = BATHS_PROJECTS;   // ������� ����
           }
           if($item_parser["labels"] == '[142]'){
                $section_id[] = MANSIONS_PROJECTS; // ������� ���������
           }
           if($item_parser["labels"] == '[141]'){
                $section_id[] = GARAGE_PROJECTS;   // ������� �������
           }
           if($item_parser["labels"] == '[140]'){
                $section_id[] = SWIMMING_POOLS_DESIGNS;  // ������� ���������
           }
           if($item_parser["labels"] == '[645]'){
                $section_id[] = DESIGNS_GAZEBOS; // ������� �������, ������������� �������
           }
           $arLoadProductArray = array();

            $arLoadProductArray = Array(
              "MODIFIED_BY"    => $USER->GetID(), // ������� ������� ������� �������������
              "IBLOCK_SECTION" => $section_id,          // ������� ����� � ����� �������
              "IBLOCK_ID"      => IBLOCK_ID_PROJECT,
              "ACTIVE"         => "Y",
              "PROPERTY_VALUES"=> $PROP,          // �������
              "DETAIL_PICTURE" => CFile::MakeFileArray($newfile_perspectiva_big), // ��������� url ��������
              "PREVIEW_PICTURE" => CFile::MakeFileArray($newfile_perspectiva_small), // ��������� url ��������
              );

            $update_id = $el->Update($ar_item_name[$item_parser["prj_name"]][0], $arLoadProductArray);

            if(!$update_id) {        // ������ � ����
              my_log("Update error: ".$el->LAST_ERROR);
            }
            $arCatFields = array(
              "ID" => $ar_item_name[$item_parser["prj_name"]][0],
              "VAT_INCLUDED" => "Y", //��� ������ � ���������
              "QUANTITY" => 1,
              "WEIGHT" => 100,
              );
            $product_cat = CCatalogProduct::Add($arCatFields);

            $ar_price_type = array(); // ������ ����� ��� � ����� ���
            $ar_price_type = array(
                PRICE_OF_DEVELOPER_KIT => $item_parser["price0"],
                PRICE_OF_COMPLETE_SET => $item_parser["price1"],
                PRICE_FOR_ARCHITECTURAL  => $item_parser["price2"],
                PRICE_OF_AN_ADDITIONAL  => $item_parser["price3"],
                PRICE_OF_THE_PASSPORT  => $item_parser["price4"],
            );
            foreach($ar_price_type as $key_type => $preice) {
                $ar_fields_offer_price = array(
                    "PRODUCT_ID"=> $ar_item_name[$item_parser["prj_name"]][0],
                    "CATALOG_GROUP_ID" => $key_type,
                    "PRICE"=> $preice,
                    "CURRENCY"=> "RUB",
                );
                $ar_offer_price = CPrice::GetList(array(), array("PRODUCT_ID"  => $ar_item_name[$item_parser["prj_name"]][0], "CATALOG_GROUP_ID" => $key_type));
                if ( $price_offer = $ar_offer_price->Fetch() ) {
                    CPrice::Update( $price_offer["ID"], $ar_fields_offer_price );
                } else {
                    CPrice::Add($ar_fields_offer_price);
                }
            }

      } else {

            $ELEMENT_ID = $ar_item_name[$item_parser["prj_name"]][0];  // ��� ��������
            $PROPERTY_CODE = "PROJECT_TEMPORARILY_UNAVAILABLE";  // ��� ��������
            $PROPERTY_VALUE = "Y";  // �������� ��������

            // ��������� ����� �������� ��� ������� �������� ������� ��������
            CIBlockElement::SetPropertyValuesEx($ELEMENT_ID, false, array($PROPERTY_CODE => $PROPERTY_VALUE));

      }
    }
 //  return "AddingParceAdd();";
}
?>