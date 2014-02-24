<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div id="model_dop_detail">
	<div id="descr" class="z_tab">
		<div class="text">
			<? if( $arResult['PREVIEW_PICTURE']['SRC'] != "" ): ?>
			<img border="0" src="<?=$arResult['PREVIEW_PICTURE']['SRC']?>" border="0"  class="static_page" align="right" style="margin-left:60px;" />
			<? endif; ?>
			<? echo $arResult["DETAIL_TEXT"]; ?>
		</div>
	</div>

	<div id="photo" class="z_tab">
	<?
		//Соотношение сторон экрана
		$tempn = 43;
		if( $XY[2] >= 1.5  ){ 
			$tempn = 1610; 
		}

		//Разрешение
		if( $XY[0] >= 1920 ){ 
			if($temp == 43){
				$sizen = 1280;
			}else{
				$sizen = 1366;
			} 
		}else if( $XY[0] >= 1600 ){ 
			$sizen = 1048; 
		}else{ 
			$sizen = 876; 
		}

		//Массив картинок
		foreach($arResult["PROPERTIES"]["PHOTO_".$tempn."_".$sizen.""]["VALUE"] as $key => $val){ 
			$arImgNew[$key] = CFile::GetPath($val); 
		}

		//Массив превью
		foreach($arResult["PROPERTIES"]["PHOTO_".$tempn."_260"]["VALUE"] as $key => $val){ 
			$preImgNew[$key] = CFile::GetPath($val);
		}


		global $APPLICATION, $color_first, $stol_first;
		$XY = $APPLICATION->get_cookie("XY");
		$XY = split(",", $XY);
		$imgCount = 0;
		$color_first = "";
		$stol_first = "";

		//Выбираем изображение (массив изображений) в зависимости от разрешения экрана
		if($XY[2] <= 1.5)
		{
	?>


<style>
  /* Easy Slider */
  #z_slider_container{ height:659; }
  #z_slider li { height:604px; }
  #prevBtn, #nextBtn, #slider1next, #slider1prev, #z_img_num, div#z_full_page { top:574px; }
</style>


	<?
		}
		$imgCount = z_ShowImg($arImgNew);
    ?>
		<div class="text">
			<br/>
			<? echo $arResult["DETAIL_TEXT"]; ?>
		</div>
	</div>

	<div id="cost" class="z_tab" style="margin-top:50px;">
		<?
		//Получаем код раздела
		$res = CIBlockSection::GetByID($arResult["IBLOCK_SECTION_ID"]);
		if($ar_res = $res->GetNext())
		{ $s_code = $ar_res['CODE']; }

		?>

		<div id="cost_title">
			<table cellpadding="0" cellspacing="0" border="0" class="table_cost">
				<tr class="selected">
					<td width="33%" style="text-align:left; padding:5px; border:none;"><h3> <? echo $arResult["NAME"]; ?></h3></td>
					<td width="34%" style="border:none;"><div class="text" style="font-size: 1.8em;">срок производства - <? echo $arResult["PROPERTIES"]["COMPLETED"]["VALUE"]; ?>*</div></td>
					<td width="33%" style="text-align:right; padding:5px; border:none;"><h3><? echo CurrencyFormat($arResult["PRICES"]['BASE']['DISCOUNT_VALUE'], "RUS"); ?> </h3></td>
				</tr>
			</table>
		</div>

		<div id="main_cost_image" style="float:left;">
			<img src="<? echo $arImgNew[0]; ?>" class="cost_eskiz" />
		</div>
		<div id="main_cost_eskiz" style="float:right;">
			<img src="/bitrix/templates/zetta_new_copy/components/bitrix/catalog.element/model_dop_detail/pryam-1.jpg" />
			<div class="offer_descr">
				<div class="offer_size">длина 3 метра</div>
				<div class="offer_cost"><? echo CurrencyFormat($arResult["PRICES"]['BASE']['DISCOUNT_VALUE'], "RUS"); ?></div>
			</div>
		</div>
		<div class="clear"></div>
		<div style="text-align:center;"><a class="look-price" href="#price">Посмотреть все ценовые варианты</a></div>

		<div class="text">
			<? if( $s_code != "" ): ?>
				<? if( $s_code == "modern" ): ?>
					<? $APPLICATION->IncludeComponent(
						"bitrix:main.include",
						"",
						Array(
							"AREA_FILE_SHOW" => "file",
							"PATH" => "/company/cost_modern.php",
							"EDIT_TEMPLATE" => ""
						),
						false
					); ?>
				<? elseif( $s_code == "classic" ): ?>
					<? $APPLICATION->IncludeComponent(
						"bitrix:main.include",
						"",
						Array(
							"AREA_FILE_SHOW" => "file",
							"PATH" => "/company/cost_classic.php",
							"EDIT_TEMPLATE" => ""
						),
						false
					); ?>
				<? endif; ?>
			<? endif; ?>
		</div>

		<a name="price"></a>
		<h1 class="cost_h">Сравните две <span style="text-decoration: underline;">прямые кухни</span> одного размера:</h1>
		<div id="cost">
			<div id="offers_compare">
				<div class="main_cost_compare">
					<canvas id="compare-block-left">Обновите браузер</canvas>
					<img id="compare-image" src="/bitrix/templates/zetta_new_copy/components/bitrix/catalog.element/model_dop_detail/pryam-1.jpg" /><br>
					<div class="offer_descr">
						<div class="offer_size">длина 3 метра</div>
						<div class="offer_cost"><?=CurrencyFormat($arResult["DISPLAY_PROPERTIES"]["PRICES"]["VALUE"]["0"], "RUS");?></div>
					</div>
				</div>
				<div class="main_cost_compare">
					<canvas id="compare-block-right">Обновите браузер</canvas>
					<img  src="/bitrix/templates/zetta_new_copy/components/bitrix/catalog.element/model_dop_detail/pryam-2.jpg" /><br>
					<div class="offer_descr">
						<div class="offer_size">длина 3 метра</div>
						<div class="offer_cost"><?=CurrencyFormat($arResult["DISPLAY_PROPERTIES"]["PRICES"]["VALUE"]["1"], "RUS");?></div>
					</div>
				</div>
			</div>
			<div class="clear"></div>
			<div class="text">
				<table class="list-compare" cellspacing="0">
					<tr class="list-compare-select">
						<td>Высота верхних шкафов 720 мм</td>
						<td>Высота верхних шкафов 960 мм</td>
					</tr>
					<tr class="list-compare-select" onmouseover="createSelectObj(16,22,10.4,24,-0.15,47,15,10.4,25,-0.2,18,20,10,31,-0.2,47,14,10,30,-0.2);" onmouseout="createSelectObj(0);">
						<td>Фасады глухие</td>
						<td>Фасады с витражами</td>
					</tr>
					<tr class="list-compare-select" onmouseover="createSelectObj(20,69,13.6,24.5,-0.20,47.3,63,14,24,-0.2,22,71.5,13,22.4,-0.19,48,65.7,12.3,22.4,-0.2);" onmouseout="createSelectObj(0);">
						<td>2 ящика тандембокс</td>
						<td>4 ящика тандембокс</td>
					</tr>
				</table>
			</div>
			<h1 class="cost_h">Сравните две <span style="text-decoration: underline;">угловые кухни</span> одного размера:</h1>
			<div id="cost-2">
				<div id="offers_compare">
					<div class="main_cost_compare">
						<canvas id="compare-block-left-2">Обновите браузер</canvas>
						<img id="compare-image" src="/bitrix/templates/zetta_new_copy/components/bitrix/catalog.element/model_dop_detail/ugol-1.jpg" /><br>
						<div class="offer_descr">
							<div class="offer_size">длина 3x1,8 метра</div>
							<div class="offer_cost"><?=CurrencyFormat($arResult["DISPLAY_PROPERTIES"]["PRICES"]["VALUE"]["2"], "RUS");?></div>
						</div>
					</div>
					<div class="main_cost_compare">
						<canvas id="compare-block-right-2">Обновите браузер</canvas>
						<img  src="/bitrix/templates/zetta_new_copy/components/bitrix/catalog.element/model_dop_detail/ugol-2.jpg" /><br>
						<div class="offer_descr">
							<div class="offer_size">длина 3x1,8 метра</div>
							<div class="offer_cost"><?=CurrencyFormat($arResult["DISPLAY_PROPERTIES"]["PRICES"]["VALUE"]["3"], "RUS");?></div>
						</div>
					</div>
				</div>
				<div class="clear"></div>

				<div class="text">
					<table class="list-compare" cellspacing="0">
						<tr class="list-compare-select-2" onmouseout="createSelectObjNew(0);">
							<td>Высота верхних шкафов 720 мм</td>
							<td>Высота верхних шкафов 960 мм</td>
						</tr>
						<tr class="list-compare-select-2" onmouseover="createSelectObjNew(10,25,9,24,-0.27,36,15.6,9,24,-0.27,13,23,8.4,30,-0.3,37,14,8,30,-0.26);" onmouseout="createSelectObjNew(0);">
							<td>Фасады глухие</td>
							<td>Фасады с витражами</td>
						</tr>
						<tr class="list-compare-select-2" onmouseover="createSelectObjNew(15,71,12,24.5,-0.30,74,59,11.7,23.4,0.3,18,73,10.5,23,-0.26,72,62,11.4,22,0.3);" onmouseout="createSelectObjNew(0);">
							<td>2 ящика тандембокс</td>
							<td>4 ящика тандембокс</td>
						</tr>
					</table>
				</div>

<!-- Скрипт сравнения (перенести в библиотеку!) -->
<script type="text/javascript">

$(".list-compare-select").eq("0").hover( function(){
    var eblockw = $("#compare-image").width();
    var eblockh = $("#compare-image").height();
    $("#compare-block-left").css({
      "width": eblockw,
      "height": eblockh
    });
    $("#compare-block-right").css({
      "width": eblockw,
      "height": eblockh
    });

    $("#compare-block-left").css({
      "background-size": "cover",
      "background-image": "url(/bitrix/templates/zetta_new_copy/components/bitrix/catalog.element/model_dop_detail/pryam-s.png)",
      "background-position": "right"
    });

    $("#compare-block-right").css({
      "background-size": "cover",
      "background-image": "url(/bitrix/templates/zetta_new_copy/components/bitrix/catalog.element/model_dop_detail/pryam-s-big.png)",
      "background-position": "right"
    });

}, function(){

    $("#compare-block-left").css({
      "background": "none"
    });

    $("#compare-block-right").css({
      "background": "none"
    });
});

$(".list-compare-select-2").eq("0").hover( function(){
    var eblockw = $("#compare-image").width();
    var eblockh = $("#compare-image").height();

    $("#compare-block-left-2").css({
      "background-size": "cover",
      "background-image": "url(/bitrix/templates/zetta_new_copy/components/bitrix/catalog.element/model_dop_detail/ugol-s-new.png)",
      "background-position": "right",
      "width": eblockw,
      "height": eblockh
    });

    $("#compare-block-right-2").css({
      "background-size": "cover", 
      "background-image": "url(/bitrix/templates/zetta_new_copy/components/bitrix/catalog.element/model_dop_detail/ugol-s-big.png)",
      "background-position": "right",
      "width": eblockw,
      "height": eblockh
    });

}, function(){

    $("#compare-block-left-2").css({ 
      "background": "none"
    });

    $("#compare-block-right-2").css({
      "background": "none"
    });
});

  /* Изменение цвета tr при наведении */
  $(".list-compare-select").hover( function() {
    $(".list-compare-select").eq($(this).index()).css("background","#FFE0AE");
  }, function() {
    $(".list-compare-select").eq($(this).index()).css("background","#FFF");
  });

  $(".list-compare-select-2").hover( function() {
    $(".list-compare-select-2").eq($(this).index()).css("background","#FFE0AE");
  }, function() {
    $(".list-compare-select-2").eq($(this).index()).css("background","#FFF");
  });

  function createSelectObj(lx,ly,lw,lh,ls,lx2,ly2,lw2,lh2,ls2,rx,ry,rw,rh,rs,rx2,ry2,rw2,rh2,rs2){

    var eblockw = $("#compare-image").width();
    var eblockh = $("#compare-image").height();
    var blockLeft = document.getElementById("compare-block-left"),
    ctxl = blockLeft.getContext('2d');
        
    blockLeft.setAttribute("width", eblockw);
    blockLeft.setAttribute("height", eblockh);

    var scaleX = 0;
    var skewY = 1; 
    var skewX = 1; 
    var lscaleY = ls; 
    var lposX = lx*(blockLeft.width/100);
    var lposY = ly*(blockLeft.height/100); 
    var lwidth = lw*(blockLeft.width/100);
    var lheight = lh*(blockLeft.height/100);

    ctxl.setTransform(scaleX, skewY, skewX, lscaleY, lposX, lposY);
    ctxl.fillStyle = "rgba(255, 201, 126, 0.500)";
    ctxl.fillRect(0,0,lheight,lwidth);

    var lscaleY2 = ls2;
    var lposX2 = lx2*(blockLeft.width/100);
    var lposY2 = ly2*(blockLeft.height/100); 
    var lwidth2 = lw2*(blockLeft.width/100);
    var lheight2 = lh2*(blockLeft.height/100);

    ctxl.setTransform(scaleX, skewY, skewX, lscaleY2, lposX2, lposY2);
    ctxl.fillRect(0,0,lheight2,lwidth2);

    if(lx == 0){ctxl.clearRect(0, 0, blockLeft.width, blockLeft.height);}

    var blockRight = document.getElementById("compare-block-right"),
    ctxr = blockRight.getContext('2d');

    blockRight.setAttribute("width", eblockw);
    blockRight.setAttribute("height", eblockh);

    var rscaleY = rs;
    var rposX = rx*(blockRight.width/100);
    var rposY = ry*(blockRight.height/100); 
    var rwidth = rw*(blockRight.width/100);
    var rheight = rh*(blockRight.height/100);

    ctxr.setTransform(scaleX, skewY, skewX, rscaleY, rposX, rposY);
    ctxr.fillStyle = "rgba(255, 201, 126, 0.500)";
    ctxr.fillRect(0,0,rheight,rwidth);

    var rscaleY2 = rs2;
    var rposX2 = rx2*(blockRight.width/100);
    var rposY2 = ry2*(blockRight.height/100); 
    var rwidth2 = rw2*(blockRight.width/100);
    var rheight2 = rh2*(blockRight.height/100);

    ctxr.setTransform(scaleX, skewY, skewX, rscaleY2, rposX2, rposY2);
    ctxr.fillRect(0,0,rheight2,rwidth2);

    if(lx == 0){ctxr.clearRect(0, 0, blockRight.width, blockRight.height);}

  }

  function createSelectObjNew(lx,ly,lw,lh,ls,lx2,ly2,lw2,lh2,ls2,rx,ry,rw,rh,rs,rx2,ry2,rw2,rh2,rs2){

    var eblockw = $("#compare-image").width();
    var eblockh = $("#compare-image").height();
    var blockLeft = document.getElementById("compare-block-left-2"),
    ctxl = blockLeft.getContext('2d');
        
    blockLeft.setAttribute("width", eblockw);
    blockLeft.setAttribute("height", eblockh);

    var scaleX = 0;
    var skewY = 1; 
    var skewX = 1; 
    var lscaleY = ls; 
    var lposX = lx*(blockLeft.width/100);
    var lposY = ly*(blockLeft.height/100); 
    var lwidth = lw*(blockLeft.width/100);
    var lheight = lh*(blockLeft.height/100);

    ctxl.setTransform(scaleX, skewY, skewX, lscaleY, lposX, lposY);
    ctxl.fillStyle = "rgba(255, 201, 126, 0.500)";
    ctxl.fillRect(0,0,lheight,lwidth);

    var lscaleY2 = ls2;
    var lposX2 = lx2*(blockLeft.width/100);
    var lposY2 = ly2*(blockLeft.height/100); 
    var lwidth2 = lw2*(blockLeft.width/100);
    var lheight2 = lh2*(blockLeft.height/100);

    ctxl.setTransform(scaleX, skewY, skewX, lscaleY2, lposX2, lposY2);
    ctxl.fillRect(0,0,lheight2,lwidth2);

    if(lx == 0){ctxl.clearRect(0, 0, blockLeft.width, blockLeft.height);}

    var blockRight = document.getElementById("compare-block-right-2"),
    ctxr = blockRight.getContext('2d');

    blockRight.setAttribute("width", eblockw);
    blockRight.setAttribute("height", eblockh);

    var rscaleY = rs;
    var rposX = rx*(blockRight.width/100);
    var rposY = ry*(blockRight.height/100); 
    var rwidth = rw*(blockRight.width/100);
    var rheight = rh*(blockRight.height/100);

    ctxr.setTransform(scaleX, skewY, skewX, rscaleY, rposX, rposY);
    ctxr.fillStyle = "rgba(255, 201, 126, 0.500)";
    ctxr.fillRect(0,0,rheight,rwidth);

    var rscaleY2 = rs2;
    var rposX2 = rx2*(blockRight.width/100);
    var rposY2 = ry2*(blockRight.height/100); 
    var rwidth2 = rw2*(blockRight.width/100);
    var rheight2 = rh2*(blockRight.height/100);

    ctxr.setTransform(scaleX, skewY, skewX, rscaleY2, rposX2, rposY2);
    ctxr.fillRect(0,0,rheight2,rwidth2);

    if(lx == 0){ctxr.clearRect(0, 0, blockRight.width, blockRight.height);}

  }

/*фиксируем #cost_title*/
  var h_hght = 100; // высота шапки
  var h_mrg = 0;     // отступ когда шапка уже не видна
  $(function(){
   $(window).scroll(function(){
      var top = $(this).scrollTop();
      var elem = $('#cost_title');
      if (top+h_mrg < h_hght) {
       elem.css('top', (h_hght-top));
      } else {
       elem.css('top', h_mrg);
      }
    });
  });
</script>
<!-- //Скрипт сравнения End -->

<style>
  #offers{display: none;}
</style>

				<div class="mini-info-block" id="offers">
				<h1 class="cost_h">Кухня <? echo $arResult["NAME"]; ?></h1>
					<div class="mini-info-block-left">
						<div id="offer_" class="z_offer" title="">
							<div class="offer_picture">
								<img src="/bitrix/templates/zetta_new_copy/components/bitrix/catalog.element/model_dop_detail/pryam-1.jpg" class="offer_img">
							</div>
							<div class="offer_descr">
								<div class="offer_size">длина 3 метра</div>
								<div class="offer_cost"><?=CurrencyFormat($arResult["DISPLAY_PROPERTIES"]["PRICES"]["VALUE"]["0"], "RUS");?></div>
							</div>
						</div>
					<div id="offer_" class="z_offer" title="">
					<div class="offer_picture">
						<img src="/bitrix/templates/zetta_new_copy/components/bitrix/catalog.element/model_dop_detail/ugol-1.jpg" class="offer_img">
					</div>
					<div class="offer_descr">
						<div class="offer_size">длина 3 х 1,8 м</div>
						<div class="offer_cost"><?=CurrencyFormat($arResult["DISPLAY_PROPERTIES"]["PRICES"]["VALUE"]["2"], "RUS");?></div>
					</div>
				</div>
				<div class="mini-block-big-img-bg" style="position:fixed;top:1px;left:1px;width:100%;height:100%;background: rgba(255,255,255, 0.6);z-index:200;display:none;"></div>
				<div class="mini-block-big-img"><div id="block-cost-close"></div></div>
			</div>

			<div class="mini-info-block-right">
			<div class="mini-info-block-right-date">

			<?if(!$arImgNew[1]):?>
				<img style="height: 120px; float: left;max-width: 190px;" data-src="<? echo $arImgNew[0]; ?>" src="<? echo $arImgNew[0]; ?>">
				<div style="display: inline-block; height: 100%; text-align: center; font-weight: 700; font-size: 1.8em; margin-top: 30px; width: 300px;">
					срок изготовления кухни
					<br />
					<? echo $arResult["PROPERTIES"]["COMPLETED"]["VALUE"]; ?>
				</div>
			<?elseif(!$arImgNew[2]):?>
				<img style="height: 120px; float: left;max-width: 190px;" data-src="<? echo $arImgNew[0]; ?>" src="<? echo $arImgNew[0]; ?>">
				<img style="height: 120px; float: left;max-width: 190px;margin-left: 40px;" data-src="<? echo $arImgNew[1]; ?>" src="<? echo $arImgNew[1]; ?>">
			<?else:?>
				<img style="height: 120px; float: left;max-width: 190px;" data-src="<? echo $arImgNew[1]; ?>" src="<? echo $arImgNew[1]; ?>">
				<img style="height: 120px; float: left;max-width: 190px;margin-left: 40px;" data-src="<? echo $arImgNew[2]; ?>" src="<? echo $arImgNew[2]; ?>">
			<?endif;?>
		    </div>
			<div class="mini-block-title">Рекомендуемые ручки</div>
				<div class="jcarousel-wrapper">
					<div class="jcarousel">
						<ul>
<?
	global $rh_first;
	$Result = Array();
	$arFilter = Array(
		"IBLOCK_ID"=>$arResult["PROPERTIES"]["RH"]["LINK_IBLOCK_ID"],
		"ID"=>$arResult["PROPERTIES"]["RH"]["VALUE"],
		"ACTIVE"=>"Y",
	);
	$res = CIBlockElement::GetList(Array("CODE"=>"DESC", "NAME"=>"ASC"), $arFilter, false, Array("nPageSize"=>200), Array("NAME", "ID", "IBLOCK_ID", "PREVIEW_PICTURE", "DETAIL_PICTURE", "PROPERTY_RGB", "PROPERTY_HTML"));
 	$i = 0;

	while($ar_fields = $res->GetNext()){
		array_push($Result, $ar_fields);
		if($rh_first == ""){ 
			$rh_first = "zr_".$ar_fields['ID']; 
		}
		$s = "";
		if($ar_fields["PREVIEW_PICTURE"] != ""){
			$src = CFile::GetPath($ar_fields["PREVIEW_PICTURE"]);
			$s = " background-image: url(".$src.");";
		}
		if( $ar_fields["DETAIL_PICTURE"] != "" ){
			$src = CFile::GetPath($ar_fields["DETAIL_PICTURE"]); 
		}
?>
							<li style="<? echo $s; ?>" title="<? echo $ar_fields['NAME']; ?>" src="<? echo $src; ?>">
							</li>
<?
		}
?>
						</ul>
					</div>
					<a href="#" class="jcarousel-control-prev"></a>
					<a href="#" class="jcarousel-control-next"></a>
				</div>
				<div class="mini-block-title">Рекомендуемые столешницы</div>
				<div class="jcarousel-wrapper">
					<div class="jcarousel">
						<ul>
<?
  global $stol_first;
  $Result = Array();
  $arFilter = Array(
    "IBLOCK_ID"=>$arResult["PROPERTIES"]["STOL"]["LINK_IBLOCK_ID"],
    "ID"=>$arResult["PROPERTIES"]["STOL"]["VALUE"],
    "ACTIVE"=>"Y",
  );
  $res = CIBlockElement::GetList(Array("CODE"=>"DESC", "NAME"=>"ASC"), $arFilter, false, Array("nPageSize"=>200), Array("NAME", "ID", "IBLOCK_ID", "PREVIEW_PICTURE", "DETAIL_PICTURE", "PROPERTY_RGB", "PROPERTY_HTML"));
  $i = 0;
  while($ar_fields = $res->GetNext())
  {
    array_push($Result, $ar_fields);
  if( $stol_first == "" )
    { $stol_first = "zs_".$ar_fields['ID']; }
  $color = "";
    if( $ar_fields["PROPERTY_HTML_VALUE"] != "" )
    { $color = " background-color: #".$ar_fields["PROPERTY_HTML_VALUE"].";"; }
    else if( $ar_fields["PROPERTY_RGB_VALUE"] != "" )
    { $color = " background-color: rgb(".$ar_fields["PROPERTY_RGB_VALUE"].");"; }
    else if( $ar_fields["PREVIEW_PICTURE"] != "" )
    { $color = " background-image: url(".CFile::GetPath($ar_fields["DETAIL_PICTURE"]).");"; }
?>
							<li style="<? echo $color; ?>" title="<? echo $ar_fields['NAME']; ?>" ></li>
<?
  }
?>
						</ul>
					</div>
					<a href="#" class="jcarousel-control-prev"></a>
					<a href="#" class="jcarousel-control-next"></a>
				</div>

				<div class="mini-block-title">Фасады</div>
				<div class="jcarousel-wrapper">
					<div class="jcarousel">
						<ul>
<?
  global $color_first;
  $Result = Array();
  $arFilter = Array(
    "IBLOCK_ID"=>$arResult["PROPERTIES"]["COLORS"]["LINK_IBLOCK_ID"],
    "ID"=>$arResult["PROPERTIES"]["COLORS"]["VALUE"],
    "ACTIVE"=>"Y",
  );
  $res = CIBlockElement::GetList(Array("CODE"=>"DESC", "NAME"=>"ASC"), $arFilter, false, Array("nPageSize"=>200), Array("NAME", "ID", "IBLOCK_ID", "PREVIEW_PICTURE", "DETAIL_PICTURE", "PROPERTY_RGB", "PROPERTY_HTML"));
  $i = 0;
  while($ar_fields = $res->GetNext())
  {
    array_push($Result, $ar_fields);
    if( $color_first == "" )
    { $color_first = "zc_".$ar_fields['ID']; }
  $color = "";
    if( $ar_fields["PROPERTY_HTML_VALUE"] != "" )
    { $color = " background-color: #".$ar_fields["PROPERTY_HTML_VALUE"].";"; }
    else if( $ar_fields["PROPERTY_RGB_VALUE"] != "" )
    { $color = " background-color: rgb(".$ar_fields["PROPERTY_RGB_VALUE"].");"; }
    else if( $ar_fields["PREVIEW_PICTURE"] != "" )
    { $color = " background-image: url(".CFile::GetPath($ar_fields["DETAIL_PICTURE"]).");"; }
?>
							<li style="<? echo $color; ?>" title="<? echo $ar_fields['NAME']; ?>" ></li>
<?
  }
?>
						</ul>
					</div>
					<a href="#" class="jcarousel-control-prev"></a>
					<a href="#" class="jcarousel-control-next"></a>
				</div>
			</div>
		</div>
		<div class="clear"></div>
		<div id="sub_cost" style="margin-top: 20px;">
			<div id="sub_cost_left">в цену включена итальянская столешница толщиной 38 мм</div>
 			<div id="sub_cost_right">бытовая техника и аксессуары в цену не входят.</div>
		</div>
	</div>
	</div>
	</div>

	<div id="techno" class="z_tab">
		<div class="text">
		<? $APPLICATION->IncludeComponent(
			"bitrix:main.include",
			"",
			Array(
				"AREA_FILE_SHOW" => "file",
				"PATH" => "/company/technical.php",
				"EDIT_TEMPLATE" => ""
			),
			false
		); ?>
		</div>
	</div>

	<div id="colors" class="z_tab">
		<? z_ShowColor($arResult["PROPERTIES"]["COLORS"]); ?>
	</div>

	<div id="stol" class="z_tab">
		<? z_ShowStol($arResult["PROPERTIES"]["STOL"]); ?>
	</div>

	<div id="hands" class="z_tab">
		<? z_ShowRH($arResult["PROPERTIES"]["RH"]); ?>
	</div>

	<div id="left_content_hide" class="z_tab">
		<img src="<? echo $preImgNew[0]; ?>" style="margin-top:15px; margin-bottom:5px;" /><br/>
	</div>
</div>




<script>
var z_current_tab;
var img_count = <? echo $imgCount; ?>;
var color_first = '<? echo $color_first; ?>';
var stol_first = '<? echo $stol_first; ?>';

function z_tab(id)
{
  //Открываем скрытую закладку
  if(z_current_tab != "")
  {
    $("div#"+z_current_tab).removeClass('z_tab_open');
    $("div#"+z_current_tab).addClass('z_tab');
    $("a#"+z_current_tab).removeClass('root-item-selected');
    $("a#"+z_current_tab).addClass('root-item');
  }

  $("div#"+id).removeClass('z_tab');
  $("div#"+id).addClass('z_tab_open');
  $("a#"+id).removeClass('root-item');
  $("a#"+id).addClass('root-item-selected');
  z_current_tab = id;
}

function z_color(id)
{
  if( $("div#"+id).css('background-image') == 'none' )
  { $("div#color_detail").css('background-image', 'none'); }
  else
  { $("div#color_detail").css('background-image', $("div#"+id).css('background-image')); }
  $("div#color_detail").css("background-color", $("div#"+id).css('background-color'));
  $("div#color_detail_name").html($("div#"+id).attr('title'));
}

function z_show(id, type)
{
  //Меняем цвет
  if( $("div#"+id).css('background-image') == 'none' )
  { $("div#"+type+"_detail").css('background-image', 'none'); }
  else
  { $("div#"+type+"_detail").css('background-image', $("div#"+id).css('background-image')); }
  $("div#"+type+"_detail").css("background-color", $("div#"+id).css('background-color'));
  $("div#"+type+"_detail_name").html($("div#"+id).attr('title'));
}

function clearnl(text){
  return text.replace(/(\n(\r)?)/g, ' ');
}

$(document).ready(function(){

  //Создаем событие реагирования на нажатие пункта меню


  $("ul#model_menu li").click( function () {
    var id = $(this).attr('id');
    z_tab( id );
  } );

  //Загружаем в контейнер "left_content" иллюстрацию и название модели
  $("div#left_content").html( $("div#left_content_hide").html() );

  //Открываем первый контейнер
  if(window.location.hash == "#costtab") 
  {
    z_tab('cost');

  }else{
    z_tab('photo');

  }


  //Подключаем отслеживание кнопок перемотки слайдера
  $("#prevBtn a").click( function() {
    var temp = parseInt($("#z_img_current").text())-1;

    if( temp < 1 )
    { temp = img_count; }

    $("span#z_img_current").text(temp);
  });

  $("#nextBtn a").click( function() {
    var temp = parseInt($("#z_img_current").text())+1;
    if( temp > img_count )
    { temp = 1 }
    $("#z_img_current").text(temp);
  });

  //Подключаем отслеживание цветов
  if( $.trim(clearnl($("div#color_list").html())) != "" )
  {
    z_show(color_first, "color");

  }
  else
  { $("li#colors").hide(); }

  //Подключаем отслеживание столешниц
  if( $.trim(clearnl($("div#stol_list").html())) != "" )
  {
    z_show(stol_first, "stol");

  }
  else
  { $("li#stol").hide(); }



} );

</script>

<?

function z_GetImg($section_id, $size)
{
  //Функция возвращает готовый список эскизов изображений по коду раздела
  $Result = Array();

  $arFilter = Array(
     "IBLOCK_ID"=>$section_id["LINK_IBLOCK_ID"],
     "SECTION_ID"=>$section_id["VALUE"],
     "ACTIVE"=>"Y",
     );
  $res = CIBlockElement::GetList(Array("CODE"=>"ASC", "NAME"=>"ASC"), $arFilter, false, Array("nPageSize"=>50), Array("NAME", "ID", "IBLOCK_ID", "IBLOCK_SECTION_ID", "PROPERTY_PRED_".$size));
  $i = 0;
  while($ar_fields = $res->GetNext())
  { array_push($Result, CFile::GetPath($ar_fields["PROPERTY_PRED_".$size."_VALUE"]) ); }

  return $Result;

}


function z_ShowImg($arImg)
{
  //Функция публикуент код фотогалереи
  $Result = 1;

  if( count($arImg) > 1 )
  {
    $i = 0 ;
    ?>
    <div id="z_slider_container">
    <div id="z_slider_content">
    <div id="z_slider">
      <ul>
      <?
      foreach ( $arImg as $temp)
      {
        echo '<li><a href="#'.$i.'"><img src="'.$temp.'" alt="'.$i.'" /></a></li>'."\n";
        $i++;
      }
      $Result = $i;
      ?>
      </ul>
    </div>
    </div>

    <a href="/catalog/model_photo/?SECTION_CODE=<? echo $_REQUEST['SECTION_CODE']; ?>&ELEMENT_CODE=<? echo $_REQUEST['ELEMENT_CODE']; ?>"><div id="z_full_page">&nbsp;</div></a>
    <div id="z_img_num"><h4><span id="z_img_current">1</span> из <? echo $i; ?></h4></div>


    </div>
    <?
  }
  else
  {
    echo '<img src="'.$arImg[0].'">';
  }

  return $Result;
}



function z_ShowPrice($Offers)
{
  //Функция публикует варианты цены
  $Result = Array();

  ?>
  <div id="offers">
    <h1 class="cost_h">Посмотрите дополнительные ценовые варианты:</h1>
  <?
  foreach($Offers as $offer)
  {
    if( $offer['PROPERTIES']['COMPARE']['VALUE'] != "да" ):

    ?>
    <div id="offer_<? echo $ar_fields['ID']?>" class="z_offer" title="<? echo $ar_fields['NAME']; ?>">
    <div class="offer_picture"><img src="<? echo CFile::GetPath($offer['DETAIL_PICTURE']); ?>" class="offer_img"></div>
    <div class="offer_descr">
    <div class="offer_size"><? echo $offer['PROPERTIES']['SIZE']['VALUE']; ?></div><div class="offer_cost"><? echo $offer['PRICES']['BASE']['DISCOUNT_VALUE']; ?> р</div>
    </div>
    </div>
    <?

    endif;
  }

  ?>
  </div>
  <?


  return $Result;
}



function z_ShowColor($Colors)
{
  //Функция публикует код цвета
  global $color_first;
  $Result = Array();

  $arFilter = Array(
     "IBLOCK_ID"=>$Colors["LINK_IBLOCK_ID"],
     "ID"=>$Colors["VALUE"],
     "ACTIVE"=>"Y",
     );


  $res = CIBlockElement::GetList(Array("CODE"=>"DESC", "NAME"=>"ASC"), $arFilter, false, Array("nPageSize"=>200), Array("NAME", "ID", "IBLOCK_ID", "PREVIEW_PICTURE", "DETAIL_PICTURE", "PROPERTY_RGB", "PROPERTY_HTML"));
  $i = 0;
  ?>
  <div id="color_list">
  <?
  while($ar_fields = $res->GetNext())
  {
    array_push($Result, $ar_fields);
    if( $color_first == "" )
    { $color_first = "zc_".$ar_fields['ID']; }

    $color = "";
    if( $ar_fields["PROPERTY_HTML_VALUE"] != "" )
    { $color = " background-color: #".$ar_fields["PROPERTY_HTML_VALUE"].";"; }
    else if( $ar_fields["PROPERTY_RGB_VALUE"] != "" )
    { $color = " background-color: rgb(".$ar_fields["PROPERTY_RGB_VALUE"].");"; }
    else if( $ar_fields["PREVIEW_PICTURE"] != "" )
    { $color = " background-image: url(".CFile::GetPath($ar_fields["DETAIL_PICTURE"]).");"; }

    ?>
    <div id="zc_<? echo $ar_fields['ID']?>" class="z_color" style="<? echo $color; ?>" title="<? echo $ar_fields['NAME']; ?>" onClick="z_show('zc_<? echo $ar_fields['ID']?>', 'color')">
    </div>
    <?
  }

  ?>
  </div>
  <div id="color_detail_cont">
    <div id="color_detail">&nbsp;</div>
    <div id="color_detail_name"></div>
    </div>
  <?


  return $Result;
}




function z_ShowStol($Stol)
{
  //Функция публикует код цвета
  global $stol_first;
  $Result = Array();

  $arFilter = Array(
     "IBLOCK_ID"=>$Stol["LINK_IBLOCK_ID"],
     "ID"=>$Stol["VALUE"],
     "ACTIVE"=>"Y",
     );


  $res = CIBlockElement::GetList(Array("CODE"=>"DESC", "NAME"=>"ASC"), $arFilter, false, Array("nPageSize"=>200), Array("NAME", "ID", "IBLOCK_ID", "PREVIEW_PICTURE", "DETAIL_PICTURE", "PROPERTY_RGB", "PROPERTY_HTML"));
  $i = 0;
  ?>
  <div id="stol_list">
  <?
  while($ar_fields = $res->GetNext())
  {
    array_push($Result, $ar_fields);
    if( $stol_first == "" )
    { $stol_first = "zs_".$ar_fields['ID']; }

    $s = "";
    if( $ar_fields["PROPERTY_HTML_VALUE"] != "" )
    { $s = " background-color: #".$ar_fields["PROPERTY_HTML_VALUE"].";"; }
    else if( $ar_fields["PROPERTY_RGB_VALUE"] != "" )
    { $s = " background-color: rgb(".$ar_fields["PROPERTY_RGB_VALUE"].");"; }
    else if( $ar_fields["PREVIEW_PICTURE"] != "" )
    { $s = " background-image: url(".CFile::GetPath($ar_fields["DETAIL_PICTURE"]).");"; }

    ?>
    <div id="zs_<? echo $ar_fields['ID']?>" class="z_stol" style="<? echo $s; ?>" title="<? echo $ar_fields['NAME']; ?>" onClick="z_show('zs_<? echo $ar_fields['ID']?>', 'stol')">
    </div>
    <?
  }

  ?>
  </div>
  <div id="stol_detail_cont">
    <div id="stol_detail">&nbsp;</div>
    <div id="stol_detail_name"></div>
    </div>
  <?

  return $Result;
}



function z_ShowRH($RH)
{
  //Функция публикует код цвета
  global $rh_first;
  $Result = Array();

  $arFilter = Array(
     "IBLOCK_ID"=>$RH["LINK_IBLOCK_ID"],
     "ID"=>$RH["VALUE"],
     "ACTIVE"=>"Y",
     );


  $res = CIBlockElement::GetList(Array("CODE"=>"DESC", "NAME"=>"ASC"), $arFilter, false, Array("nPageSize"=>200), Array("NAME", "ID", "IBLOCK_ID", "PREVIEW_PICTURE", "DETAIL_PICTURE", "PROPERTY_RGB", "PROPERTY_HTML"));
  $i = 0;
  ?>

  <div id="rh_list">
  <div class="scroll_rh_list">
  <?
  while($ar_fields = $res->GetNext())
  {
    array_push($Result, $ar_fields);
    if( $rh_first == "" )
    { $rh_first = "zr_".$ar_fields['ID']; }


    $s = "";
    if( $ar_fields["PREVIEW_PICTURE"] != "" )
    {
      $src = CFile::GetPath($ar_fields["PREVIEW_PICTURE"]);
      $s = " background-image: url(".$src.");";
    }

    if( $ar_fields["DETAIL_PICTURE"] != "" )
    { $src = CFile::GetPath($ar_fields["DETAIL_PICTURE"]); }

    ?>
    <div id="zr_<? echo $ar_fields['ID']?>" class="z_rh" style="<? echo $s; ?>" title="<? echo $ar_fields['NAME']; ?>" src="<? echo $src; ?>">
    <img src="<? echo CFile::GetPath($ar_fields['PREVIEW_PICTURE']); ?>" class="z_rh" />
    </div>
    <?
  }

  ?>
  </div>
  </div>

  <div id="rh_detail_cont" style="">
  <div id="rh_detail">&nbsp;</div>
  <div id="rh_detail_name" style="text-align: right;font-size: 1.8em;font-weight: normal;text-transform: uppercase;"></div>
  </div>

<script>
  var background_image = $('.z_rh').css('background-image');
  var handle_name = $('.z_rh').attr("title");
  $( '#rh_detail' ).css('background-image', background_image+'no-repeat');
  $( '#rh_detail' ).css('background', background_image+'no-repeat');
  $( '#rh_detail' ).css('background-size', '100%');
  $( '#rh_detail_name' ).text(handle_name);

  $('.z_rh').click(function(){
  var background_image1 = $(this).css('background-image');
  var handle_name1 = $(this).attr("title");
  console.log(background_image1);
  console.log(handle_name1);
  $( '#rh_detail' ).css('background-image', background_image1+'no-repeat');
  $( '#rh_detail' ).css('background', background_image1+'no-repeat');
  $( '#rh_detail' ).css('background-size', '100%');
  $( '#rh_detail_name' ).text(handle_name1);
  });
</script>

  <?


  return $Result;
}



function z_ShowGoods($Colors)
{
  //Функция публикует список рекомендуемых товаров определенного раздела
  global $color_first;
  $Result = Array();

  $arFilter = Array(
     "IBLOCK_ID"=>$Colors["LINK_IBLOCK_ID"],
     "ID"=>$Colors["VALUE"],
     "ACTIVE"=>"Y",
     );


  $res = CIBlockElement::GetList(Array("CODE"=>"DESC", "NAME"=>"ASC"), $arFilter, false, Array("nPageSize"=>200), Array("NAME", "ID", "IBLOCK_ID", "PREVIEW_PICTURE", "DETAIL_PICTURE", "PROPERTY_RGB", "PROPERTY_HTML"));
  $i = 0;
  ?>
  <div id="color_list">
  <?
  while($ar_fields = $res->GetNext())
  {
    array_push($Result, $ar_fields);
    if( $color_first == "" )
    { $color_first = "zc_".$ar_fields['ID']; }

    $color = "";
    if( $ar_fields["PROPERTY_HTML_VALUE"] != "" )
    { $color = " background-color: #".$ar_fields["PROPERTY_HTML_VALUE"].";"; }
    else if( $ar_fields["PROPERTY_RGB_VALUE"] != "" )
    { $color = " background-color: rgb(".$ar_fields["PROPERTY_RGB_VALUE"].");"; }
    else if( $ar_fields["PREVIEW_PICTURE"] != "" )
    { $color = " background-image: url(".CFile::GetPath($ar_fields["DETAIL_PICTURE"]).");"; }

    ?>
    <div id="zc_<? echo $ar_fields['ID']?>" class="z_color" style="<? echo $color; ?>;" title="<? echo $ar_fields['NAME']; ?>" onClick="z_color('zc_<? echo $ar_fields['ID']?>')">
    </div>
    <?
  }

  ?>
  </div>
  <div id="color_detail_cont">
    <div id="color_detail">&nbsp;</div>
    <div id="color_detail_name"></div>
    </div>
  <?


  return $Result;
}

function z_ShowCompare($Offers)
{
  //Функция публикует сравниваемые эскизы
  $Result = Array();
  $num = 0;
  ?>
  <div id="offers_compare">
  <?
  foreach($Offers as $offer)
  {
    if( $offer['PROPERTIES']['COMPARE']['VALUE'] == "да" ):
    $num++
    ?>
    <div class="main_cost_compare" <?if($num == 1):?><?else:?>style="float: right;"<?endif;?>>
      <canvas id="compare-block-<?if($num == 1):?>left<?else:?>right<?endif;?>"></canvas>
      <img <?if($num == 1):?>id="compare-image"<?endif;?> src="<? echo CFile::GetPath($offer['DETAIL_PICTURE']); ?>" /><br>
        <div class="offer_descr">
          <div class="offer_size">длина 3 х 1,8 метра</div>
          <div class="offer_cost"><? echo $offer['PRICES']['BASE']['DISCOUNT_VALUE']; ?> р</div>
        </div>
    </div>
    <?
    endif;
  }
  ?>
  </div>
    <div id="offers_descr"></div>
  <?
  return $Result;
}

?>
