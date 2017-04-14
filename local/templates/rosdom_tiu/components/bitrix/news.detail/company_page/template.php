<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$company_id = $arResult["ID"];
global $TabsFilter;
$TabsFilter = array("PROPERTY_COMPANY"=>"$company_id");
$APPLICATION->AddChainItem($arResult["NAME"], '/');
?>
         <h1>�������� �<?=$arResult["NAME"]?>�</h1>
         <section class="last-posts w-tabs equipments-tabs">
            <div class="b-tabs" id="company-tabs">
               <nav>
                  <ul>
                     <li class="active"><a href="javascript: void(0);">� ��������</a></li>
					 <li style="display: none;" id="faq-tab"><a href="javascript: void(0);">������-�����</a></li>
                     <li style="display: none;" id="articles-tab"><a href="javascript: void(0);">������</a></li>
					 <li style="display: none;" id="photo-tab"><a href="javascript: void(0);">����</a></li>
					 <li style="display: none;" id="video-tab"><a href="javascript: void(0);">�����</a></li>
					 <li style="display: none;" id="files-tab"><a href="javascript: void(0);">�����</a></li>
					 

                  </ul>
               </nav>
            </div>
            <div class="b-descriptions">
               <div class="description visible">
	<?
	if(array_key_exists("USE_SHARE", $arParams) && $arParams["USE_SHARE"] == "Y")
	{
		?>
		<div class="news-detail-share">
			<noindex>
			<?
			$APPLICATION->IncludeComponent("bitrix:main.share", "", array(
					"HANDLERS" => $arParams["SHARE_HANDLERS"],
					"PAGE_URL" => $arResult["~DETAIL_PAGE_URL"],
					"PAGE_TITLE" => $arResult["~NAME"],
					"SHORTEN_URL_LOGIN" => $arParams["SHARE_SHORTEN_URL_LOGIN"],
					"SHORTEN_URL_KEY" => $arParams["SHARE_SHORTEN_URL_KEY"],
					"HIDE" => $arParams["SHARE_HIDE"],
				),
				$component,
				array("HIDE_ICONS" => "Y")
			);
			?>
			</noindex>
		</div>
		<?
	}
	?>

                  <div class="b-about-company">
				  <?if(!empty($arResult["PREVIEW_PICTURE"])):?>
                     <div class="b-company-logo">
                        <img src="<?=$arResult["PREVIEW_PICTURE"]["SRC"]?>" alt="" />
                     </div>
				  <?endif;?>


                     <strong>�����</strong>: <?echo $arResult["DISPLAY_PROPERTIES"]["ADDRESS"]["DISPLAY_VALUE"]?><br>
                     <strong>��������</strong>: <?echo $arResult["DISPLAY_PROPERTIES"]["PHONE"]["DISPLAY_VALUE"]?><?if(!empty($arResult["DISPLAY_PROPERTIES"]["ADD_PHONE"]["DISPLAY_VALUE"])) echo ', '.$arResult["DISPLAY_PROPERTIES"]["ADD_PHONE"]["DISPLAY_VALUE"];?><br>
					 <strong>����</strong>: <?echo $arResult["DISPLAY_PROPERTIES"]["FAX"]["DISPLAY_VALUE"]?><br>
                     <strong>E-mail</strong>: <a href="mailto:<?echo $arResult["DISPLAY_PROPERTIES"]["EMAIL"]["DISPLAY_VALUE"]?>"><?echo $arResult["DISPLAY_PROPERTIES"]["EMAIL"]["DISPLAY_VALUE"]?></a><br>
                     <?if(!empty($arResult["DISPLAY_PROPERTIES"]["SITE_URL"])):?><strong>����</strong>: <?if ($arResult["DISPLAY_PROPERTIES"]["SITE_URL_NOINDEX"]["VALUE"]):?><noindex><?endif;?><a <?if ($arResult["DISPLAY_PROPERTIES"]["SITE_URL_NOINDEX"]["VALUE"]):?>rel="rel nofollow" <?endif;?>href="http://<?echo $arResult["DISPLAY_PROPERTIES"]["SITE_URL"]["VALUE"]?>" target="_blank"><?echo $arResult["DISPLAY_PROPERTIES"]["SITE_URL"]["VALUE"]?></a><?if ($arResult["DISPLAY_PROPERTIES"]["SITE_URL_NOINDEX"]["VALUE"]):?></noindex><?endif;?><br><?endif;?>
						
                     <p><strong>��������</strong>: <?echo $arResult["DETAIL_TEXT"];?></p>
                     <div class="where-is clearfix">
                        <h3>�������� ������������ � ��������:</h3>
						<ul>
						<?
							$db_groups = CIBlockElement::GetElementGroups($arResult["ID"], true);
							while($ar_group = $db_groups->getNext()){
							
							//if ($ar_group["DEPTH_LEVEL"] == 2) echo '2nd level';
							//if ($ar_group["DEPTH_LEVEL"] == 3) echo '3rd level';
							unset($menutree_parent);
							$dbSect = CIBlockSection::GetList(Array("SORT"=>"ASC"), Array("IBLOCK_ID"=>$ar_group["IBLOCK_ID"], "<=LEFT_BORDER" => $ar_group["LEFT_MARGIN"], ">=RIGHT_BORDER" => $ar_group["RIGHT_MARGIN"]), false);
							while ($arSect = $dbSect->GetNext()) {
								$menutree_parent[$arSect["DEPTH_LEVEL"]]["ID"] = $arSect["ID"];
								$menutree_parent[$arSect["DEPTH_LEVEL"]]["CODE"] = $arSect["CODE"];
							}
							/*echo '<pre>';
							print_r($menutree_parent);
							echo '</pre>';*/
							$link = '/';
							for ($i = 1; $i<=count($menutree_parent); $i++) $link .= $menutree_parent[$i]["CODE"].'/';
							echo '<li><a href="'.$link.'">'.$ar_group["NAME"].'</a></li>';								
							}
						?>
						</ul>
                        
                        

                     </div>
					 
                  </div>
               </div>
				<div class="description">
					
					<?$APPLICATION->IncludeComponent("bitrix:news.list", "faq-company", array(
	"IBLOCK_TYPE" => "faq",
	"IBLOCK_ID" => "14",
	"NEWS_COUNT" => "10",
	"SORT_BY1" => "ACTIVE_FROM",
	"SORT_ORDER1" => "DESC",
	"SORT_BY2" => "SORT",
	"SORT_ORDER2" => "ASC",
	"FILTER_NAME" => "TabsFilter",
	"FIELD_CODE" => array(
		0 => "",
		1 => "",
	),
	"PROPERTY_CODE" => array(
		0 => "AUTHOR",
		1 => "EMAIL",
		2 => "REFERENCE",
		3 => "72",
		4 => "73",
		5 => "74",
		6 => "",
	),
	"CHECK_DATES" => "Y",
	"DETAIL_URL" => "/faq/detail.php?ELEMENT_ID=#ID#",
	"AJAX_MODE" => "N",
	"AJAX_OPTION_SHADOW" => "Y",
	"AJAX_OPTION_JUMP" => "N",
	"AJAX_OPTION_STYLE" => "Y",
	"AJAX_OPTION_HISTORY" => "N",
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "36000000",
	"CACHE_FILTER" => "N",
	"CACHE_GROUPS" => "Y",
	"PREVIEW_TRUNCATE_LEN" => "",
	"ACTIVE_DATE_FORMAT" => "d.m.Y",
	"SET_TITLE" => "N",
	"SET_STATUS_404" => "N",
	"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
	"ADD_SECTIONS_CHAIN" => "N",
	"HIDE_LINK_WHEN_NO_DETAIL" => "N",
	"PARENT_SECTION" => "",
	"PARENT_SECTION_CODE" => "",
	"DISPLAY_TOP_PAGER" => "N",
	"DISPLAY_BOTTOM_PAGER" => "N",
	"PAGER_TITLE" => "����",
	"PAGER_SHOW_ALWAYS" => "N",
	"PAGER_TEMPLATE" => "",
	"PAGER_DESC_NUMBERING" => "N",
	"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
	"PAGER_SHOW_ALL" => "N",
	"DISPLAY_DATE" => "N",
	"DISPLAY_NAME" => "N",
	"DISPLAY_PICTURE" => "N",
	"DISPLAY_PREVIEW_TEXT" => "Y",
	"AJAX_OPTION_ADDITIONAL" => ""
	),
	false
);?>
				</div>
				<div class="description">
					<?$APPLICATION->IncludeComponent("bitrix:news.list", "articles-company", Array(
	"IBLOCK_TYPE" => "articles",	// ��� ��������������� ����� (������������ ������ ��� ��������)
	"IBLOCK_ID" => "9",	// ��� ��������������� �����
	"NEWS_COUNT" => "20",	// ���������� �������� �� ��������
	"SORT_BY1" => "ACTIVE_FROM",	// ���� ��� ������ ���������� ��������
	"SORT_ORDER1" => "DESC",	// ����������� ��� ������ ���������� ��������
	"SORT_BY2" => "SORT",	// ���� ��� ������ ���������� ��������
	"SORT_ORDER2" => "ASC",	// ����������� ��� ������ ���������� ��������
	"FILTER_NAME" => "TabsFilter",	// ������
	"FIELD_CODE" => array(	// ����
		0 => "",
		1 => "",
	),
	"PROPERTY_CODE" => array(	// ��������
		0 => "AUTHOR",
		1 => "",
	),
	"CHECK_DATES" => "Y",	// ���������� ������ �������� �� ������ ������ ��������
	"DETAIL_URL" => "/articles/?ELEMENT_ID=#ID#",	// URL �������� ���������� ��������� (�� ��������� - �� �������� ���������)
	"AJAX_MODE" => "N",	// �������� ����� AJAX
	"AJAX_OPTION_SHADOW" => "Y",	// �������� ���������
	"AJAX_OPTION_JUMP" => "N",	// �������� ��������� � ������ ����������
	"AJAX_OPTION_STYLE" => "Y",	// �������� ��������� ������
	"AJAX_OPTION_HISTORY" => "N",	// �������� �������� ��������� ��������
	"CACHE_TYPE" => "A",	// ��� �����������
	"CACHE_TIME" => "36000000",	// ����� ����������� (���.)
	"CACHE_FILTER" => "N",	// ���������� ��� ������������� �������
	"CACHE_GROUPS" => "Y",	// ��������� ����� �������
	"PREVIEW_TRUNCATE_LEN" => "",	// ������������ ����� ������ ��� ������ (������ ��� ���� �����)
	"ACTIVE_DATE_FORMAT" => "d.m.Y",	// ������ ������ ����
	"SET_TITLE" => "N",	// ������������� ��������� ��������
	"SET_STATUS_404" => "N",	// ������������� ������ 404, ���� �� ������� ������� ��� ������
	"INCLUDE_IBLOCK_INTO_CHAIN" => "N",	// �������� �������� � ������� ���������
	"ADD_SECTIONS_CHAIN" => "N",	// �������� ������ � ������� ���������
	"HIDE_LINK_WHEN_NO_DETAIL" => "N",	// �������� ������, ���� ��� ���������� ��������
	"PARENT_SECTION" => "",	// ID �������
	"PARENT_SECTION_CODE" => "",	// ��� �������
	"DISPLAY_TOP_PAGER" => "N",	// �������� ��� �������
	"DISPLAY_BOTTOM_PAGER" => "Y",	// �������� ��� �������
	"PAGER_TITLE" => "�������",	// �������� ���������
	"PAGER_SHOW_ALWAYS" => "N",	// �������� ������
	"PAGER_TEMPLATE" => "",	// �������� �������
	"PAGER_DESC_NUMBERING" => "N",	// ������������ �������� ���������
	"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",	// ����� ����������� ������� ��� �������� ���������
	"PAGER_SHOW_ALL" => "N",	// ���������� ������ "���"
	"DISPLAY_DATE" => "Y",	// �������� ���� ��������
	"DISPLAY_NAME" => "Y",	// �������� �������� ��������
	"DISPLAY_PICTURE" => "Y",	// �������� ����������� ��� ������
	"DISPLAY_PREVIEW_TEXT" => "Y",	// �������� ����� ������
	"AJAX_OPTION_ADDITIONAL" => "",	// �������������� �������������
	),
	false
);?>
				</div>
				<div class="description">
					����
				</div>
				<div class="description">
					 <?$APPLICATION->IncludeComponent("bitrix:news.list", "video-company", Array(
	"IBLOCK_TYPE" => "video",	// ��� ��������������� ����� (������������ ������ ��� ��������)
	"IBLOCK_ID" => "13",	// ��� ��������������� �����
	"NEWS_COUNT" => "20",	// ���������� �������� �� ��������
	"SORT_BY1" => "ACTIVE_FROM",	// ���� ��� ������ ���������� ��������
	"SORT_ORDER1" => "DESC",	// ����������� ��� ������ ���������� ��������
	"SORT_BY2" => "SORT",	// ���� ��� ������ ���������� ��������
	"SORT_ORDER2" => "ASC",	// ����������� ��� ������ ���������� ��������
	"FILTER_NAME" => "TabsFilter",	// ������
	"FIELD_CODE" => array(	// ����
		0 => "",
		1 => "",
	),
	"PROPERTY_CODE" => array(	// ��������
		0 => "",
		1 => "",
	),
	"CHECK_DATES" => "Y",	// ���������� ������ �������� �� ������ ������ ��������
	"DETAIL_URL" => "#SITE_DIR#/video/detail.php?SECTION_ID=#SECTION_ID#&ELEMENT_ID=#ID#",	// URL �������� ���������� ��������� (�� ��������� - �� �������� ���������)
	"AJAX_MODE" => "N",	// �������� ����� AJAX
	"AJAX_OPTION_SHADOW" => "Y",	// �������� ���������
	"AJAX_OPTION_JUMP" => "N",	// �������� ��������� � ������ ����������
	"AJAX_OPTION_STYLE" => "Y",	// �������� ��������� ������
	"AJAX_OPTION_HISTORY" => "N",	// �������� �������� ��������� ��������
	"CACHE_TYPE" => "A",	// ��� �����������
	"CACHE_TIME" => "36000000",	// ����� ����������� (���.)
	"CACHE_FILTER" => "N",	// ���������� ��� ������������� �������
	"CACHE_GROUPS" => "Y",	// ��������� ����� �������
	"PREVIEW_TRUNCATE_LEN" => "",	// ������������ ����� ������ ��� ������ (������ ��� ���� �����)
	"ACTIVE_DATE_FORMAT" => "d.m.Y",	// ������ ������ ����
	"SET_TITLE" => "N",	// ������������� ��������� ��������
	"SET_STATUS_404" => "N",	// ������������� ������ 404, ���� �� ������� ������� ��� ������
	"INCLUDE_IBLOCK_INTO_CHAIN" => "N",	// �������� �������� � ������� ���������
	"ADD_SECTIONS_CHAIN" => "N",	// �������� ������ � ������� ���������
	"HIDE_LINK_WHEN_NO_DETAIL" => "N",	// �������� ������, ���� ��� ���������� ��������
	"PARENT_SECTION" => "",	// ID �������
	"PARENT_SECTION_CODE" => "",	// ��� �������
	"DISPLAY_TOP_PAGER" => "N",	// �������� ��� �������
	"DISPLAY_BOTTOM_PAGER" => "Y",	// �������� ��� �������
	"PAGER_TITLE" => "�����",	// �������� ���������
	"PAGER_SHOW_ALWAYS" => "N",	// �������� ������
	"PAGER_TEMPLATE" => "",	// �������� �������
	"PAGER_DESC_NUMBERING" => "N",	// ������������ �������� ���������
	"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",	// ����� ����������� ������� ��� �������� ���������
	"PAGER_SHOW_ALL" => "Y",	// ���������� ������ "���"
	"DISPLAY_DATE" => "Y",	// �������� ���� ��������
	"DISPLAY_NAME" => "Y",	// �������� �������� ��������
	"DISPLAY_PICTURE" => "Y",	// �������� ����������� ��� ������
	"DISPLAY_PREVIEW_TEXT" => "Y",	// �������� ����� ������
	"AJAX_OPTION_ADDITIONAL" => "",	// �������������� �������������
	),
	false
);?>
				</div>
				<div class="description">
					<?$APPLICATION->IncludeComponent("bitrix:news.list", "documents-company", Array(
	"IBLOCK_TYPE" => "documents",	// ��� ��������������� ����� (������������ ������ ��� ��������)
	"IBLOCK_ID" => "15",	// ��� ��������������� �����
	"NEWS_COUNT" => "20",	// ���������� �������� �� ��������
	"SORT_BY1" => "ACTIVE_FROM",	// ���� ��� ������ ���������� ��������
	"SORT_ORDER1" => "DESC",	// ����������� ��� ������ ���������� ��������
	"SORT_BY2" => "SORT",	// ���� ��� ������ ���������� ��������
	"SORT_ORDER2" => "ASC",	// ����������� ��� ������ ���������� ��������
	"FILTER_NAME" => "TabsFilter",	// ������
	"FIELD_CODE" => array(	// ����
		0 => "DATE_CREATE",
		1 => "",
	),
	"PROPERTY_CODE" => array(	// ��������
		0 => "",
		1 => "FILE",
		2 => "",
	),
	"CHECK_DATES" => "Y",	// ���������� ������ �������� �� ������ ������ ��������
	"DETAIL_URL" => "",	// URL �������� ���������� ��������� (�� ��������� - �� �������� ���������)
	"AJAX_MODE" => "N",	// �������� ����� AJAX
	"AJAX_OPTION_SHADOW" => "Y",	// �������� ���������
	"AJAX_OPTION_JUMP" => "N",	// �������� ��������� � ������ ����������
	"AJAX_OPTION_STYLE" => "Y",	// �������� ��������� ������
	"AJAX_OPTION_HISTORY" => "N",	// �������� �������� ��������� ��������
	"CACHE_TYPE" => "A",	// ��� �����������
	"CACHE_TIME" => "36000000",	// ����� ����������� (���.)
	"CACHE_FILTER" => "N",	// ���������� ��� ������������� �������
	"CACHE_GROUPS" => "Y",	// ��������� ����� �������
	"PREVIEW_TRUNCATE_LEN" => "",	// ������������ ����� ������ ��� ������ (������ ��� ���� �����)
	"ACTIVE_DATE_FORMAT" => "d.m.Y",	// ������ ������ ����
	"SET_TITLE" => "N",	// ������������� ��������� ��������
	"SET_STATUS_404" => "N",	// ������������� ������ 404, ���� �� ������� ������� ��� ������
	"INCLUDE_IBLOCK_INTO_CHAIN" => "N",	// �������� �������� � ������� ���������
	"ADD_SECTIONS_CHAIN" => "N",	// �������� ������ � ������� ���������
	"HIDE_LINK_WHEN_NO_DETAIL" => "N",	// �������� ������, ���� ��� ���������� ��������
	"PARENT_SECTION" => "",	// ID �������
	"PARENT_SECTION_CODE" => "",	// ��� �������
	"DISPLAY_TOP_PAGER" => "N",	// �������� ��� �������
	"DISPLAY_BOTTOM_PAGER" => "N",	// �������� ��� �������
	"PAGER_TITLE" => "���������",	// �������� ���������
	"PAGER_SHOW_ALWAYS" => "N",	// �������� ������
	"PAGER_TEMPLATE" => "",	// �������� �������
	"PAGER_DESC_NUMBERING" => "N",	// ������������ �������� ���������
	"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",	// ����� ����������� ������� ��� �������� ���������
	"PAGER_SHOW_ALL" => "N",	// ���������� ������ "���"
	"DISPLAY_DATE" => "Y",	// �������� ���� ��������
	"DISPLAY_NAME" => "Y",	// �������� �������� ��������
	"DISPLAY_PICTURE" => "Y",	// �������� ����������� ��� ������
	"DISPLAY_PREVIEW_TEXT" => "Y",	// �������� ����� ������
	"AJAX_OPTION_ADDITIONAL" => "",	// �������������� �������������
	),
	false
);?>
				</div>
            </div>



         </section>
