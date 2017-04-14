<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="news-list">
<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?><br />
<?endif;?>
<section class="about-section">
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
	


<div class="b-subsection">
<h2>
<a href="<?echo $arItem["DETAIL_PAGE_URL"]?>"><?if(!empty($arItem['PROPERTIES']['MENUTITLE']['VALUE'])): echo $arItem['PROPERTIES']['MENUTITLE']['VALUE']; else: echo $arItem["NAME"]; endif;?></a>
</h2>
<figure>
<img alt="" src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>">
<figcaption>
<p><?echo $arItem["PREVIEW_TEXT"];?></p>
<p class="more">
<a href="<?echo $arItem["DETAIL_PAGE_URL"]?>">���������</a>
</p>

</figcaption>
</figure>
</div>
	
<?endforeach;?>
</section>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
</div>
