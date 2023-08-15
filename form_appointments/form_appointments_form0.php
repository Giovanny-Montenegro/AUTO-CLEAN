<?php

if (!isset($this->NM_ajax_info['param']['buffer_output']) || !$this->NM_ajax_info['param']['buffer_output'])
{
    $sOBContents = ob_get_contents();
    ob_end_clean();
}

header("X-XSS-Protection: 1; mode=block");
header("X-Frame-Options: SAMEORIGIN");

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
            "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">

<html<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE><?php if ('novo' == $this->nmgp_opcao) { echo strip_tags("" . $this->Ini->Nm_lang['lang_othr_frmi_titl'] . " - " . $this->Ini->Nm_lang['lang_tbl_appointments'] . ""); } else { echo strip_tags("" . $this->Ini->Nm_lang['lang_othr_frmu_titl'] . " - " . $this->Ini->Nm_lang['lang_tbl_appointments'] . ""); } ?></TITLE>
 <META http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['charset_html'] ?>" />
 <META http-equiv="Expires" content="Fri, Jan 01 1900 00:00:00 GMT" />
 <META http-equiv="Last-Modified" content="<?php echo gmdate('D, d M Y H:i:s') ?> GMT" />
 <META http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate" />
 <META http-equiv="Cache-Control" content="post-check=0, pre-check=0" />
 <META http-equiv="Pragma" content="no-cache" />
 <link rel="shortcut icon" href="../_lib/img/sys__NM__img__NM__1402365182_app_type_car_dealer_512px_GREY.png">
<?php

if (isset($_SESSION['scriptcase']['device_mobile']) && $_SESSION['scriptcase']['device_mobile'] && $_SESSION['scriptcase']['display_mobile'])
{
?>
 <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<?php
}

?>
            <meta name="viewport" content="minimal-ui, width=300, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">
            <meta name="mobile-web-app-capable" content="yes">
            <meta name="apple-mobile-web-app-capable" content="yes">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <link rel="apple-touch-icon"   sizes="57x57" href="">
            <link rel="apple-touch-icon"   sizes="60x60" href="">
            <link rel="apple-touch-icon"   sizes="72x72" href="">
            <link rel="apple-touch-icon"   sizes="76x76" href="">
            <link rel="apple-touch-icon" sizes="114x114" href="">
            <link rel="apple-touch-icon" sizes="120x120" href="">
            <link rel="apple-touch-icon" sizes="144x144" href="">
            <link rel="apple-touch-icon" sizes="152x152" href="">
            <link rel="apple-touch-icon" sizes="180x180" href="">
            <link rel="icon" type="image/png" sizes="192x192" href="">
            <link rel="icon" type="image/png"   sizes="32x32" href="">
            <link rel="icon" type="image/png"   sizes="96x96" href="">
            <link rel="icon" type="image/png"   sizes="16x16" href="">
            <meta name="msapplication-TileColor" content="___">
            <meta name="msapplication-TileImage" content="">
            <meta name="theme-color" content="___">
            <meta name="apple-mobile-web-app-status-bar-style" content="___">
            <link rel="shortcut icon" href=""> <link rel="stylesheet" href="<?php echo $this->Ini->path_prod ?>/third/jquery_plugin/thickbox/thickbox.css" type="text/css" media="screen" />
 <SCRIPT type="text/javascript">
  var sc_pathToTB = '<?php echo $this->Ini->path_prod ?>/third/jquery_plugin/thickbox/';
  var sc_tbLangClose = "<?php echo html_entity_decode($this->Ini->Nm_lang["lang_tb_close"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>";
  var sc_tbLangEsc = "<?php echo html_entity_decode($this->Ini->Nm_lang["lang_tb_esc"], ENT_COMPAT, $_SESSION["scriptcase"]["charset"]) ?>";
  var sc_userSweetAlertDisplayed = false;
 </SCRIPT>
 <SCRIPT type="text/javascript">
  var sc_blockCol = '<?php echo $this->Ini->Block_img_col; ?>';
  var sc_blockExp = '<?php echo $this->Ini->Block_img_exp; ?>';
  var sc_ajaxBg = '<?php echo $this->Ini->Color_bg_ajax; ?>';
  var sc_ajaxBordC = '<?php echo $this->Ini->Border_c_ajax; ?>';
  var sc_ajaxBordS = '<?php echo $this->Ini->Border_s_ajax; ?>';
  var sc_ajaxBordW = '<?php echo $this->Ini->Border_w_ajax; ?>';
  var sc_ajaxMsgTime = 2;
  var sc_img_status_ok = '<?php echo $this->Ini->path_icones; ?>/<?php echo $this->Ini->Img_status_ok; ?>';
  var sc_img_status_err = '<?php echo $this->Ini->path_icones; ?>/<?php echo $this->Ini->Img_status_err; ?>';
  var sc_css_status = '<?php echo $this->Ini->Css_status; ?>';
  var sc_css_status_pwd_box = '<?php echo $this->Ini->Css_status_pwd_box; ?>';
  var sc_css_status_pwd_text = '<?php echo $this->Ini->Css_status_pwd_text; ?>';
 </SCRIPT>
        <SCRIPT type="text/javascript" src="../_lib/lib/js/jquery-3.6.0.min.js"></SCRIPT>
            <?php
               if ($_SESSION['scriptcase']['display_mobile'] && $_SESSION['scriptcase']['device_mobile']) {
                   $forced_mobile = (isset($_SESSION['scriptcase']['force_mobile']) && $_SESSION['scriptcase']['force_mobile']) ? 'true' : 'false';
                   $sc_app_data   = json_encode([
                       'forceMobile' => $forced_mobile,
                       'appType' => 'form',
                       'improvements' => true,
                       'displayOptionsButton' => false,
                       'displayScrollUp' => false,
                       'scrollUpPosition' => 'A',
                       'toolbarOrientation' => 'H',
                       'mobilePanes' => 'true',
                       'navigationBarButtons' => unserialize('a:0:{}'),
                       'mobileSimpleToolbar' => true,
                       'bottomToolbarFixed' => true
                   ]); ?>
            <input type="hidden" id="sc-mobile-app-data" value='<?php echo $sc_app_data; ?>' />
            <script type="text/javascript" src="../_lib/lib/js/nm_modal_panes.jquery.js"></script>
            <script type="text/javascript" src="../_lib/lib/js/nm_form_mobile.js"></script>
            <link rel='stylesheet' href='../_lib/lib/css/nm_form_mobile.css' type='text/css'/>
            <script>
                $(document).ready(function(){

                    bootstrapMobile();

                });
            </script>
            <?php } ?> <SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/jquery/js/jquery-ui.js"></SCRIPT>
 <link rel="stylesheet" href="<?php echo $this->Ini->path_prod ?>/third/jquery/css/smoothness/jquery-ui.css" type="text/css" media="screen" />
<style type="text/css">
.ui-datepicker { z-index: 6 !important }
</style>
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_sweetalert.css" />
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/sweetalert/sweetalert2.all.min.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/sweetalert/polyfill.min.js"></SCRIPT>
 <script type="text/javascript" src="<?php echo $this->Ini->url_lib_js ?>frameControl.js"></script>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->url_lib_js; ?>jquery.iframe-transport.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->url_lib_js; ?>jquery.fileupload.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/jquery_plugin/malsup-blockui/jquery.blockUI.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->path_prod; ?>/third/jquery_plugin/thickbox/thickbox-compressed.js"></SCRIPT>
    <style type="text/css">
        .sc-form-order-icon {
            padding: 0 2px;
        }
    </style>
<?php
           $formOrderUnusedVisivility = $_SESSION['scriptcase']['device_mobile'] && $_SESSION['scriptcase']['display_mobile'] ? 'visible' : 'visible';
           $formOrderUnusedOpacity = $_SESSION['scriptcase']['device_mobile'] && $_SESSION['scriptcase']['display_mobile'] ? '0.5' : '0.5';
?>
    <style>
        .sc-form-order-icon-unused {
            visibility: <?php echo $formOrderUnusedVisivility ?>;
            opacity: 0.5;
        }
        .scFormLabelOddMult:hover .sc-form-order-icon-unused {
            visibility: visible;
            opacity: <?php echo $formOrderUnusedOpacity ?>;
        }
    </style>
<style type="text/css">
.sc-button-image.disabled {
	opacity: 0.25
}
.sc-button-image.disabled img {
	cursor: default !important
}
</style>
 <style type="text/css">
  .fileinput-button-padding {
   padding: 3px 10px !important;
  }
  .fileinput-button {
   position: relative;
   overflow: hidden;
   float: left;
   margin-right: 4px;
  }
  .fileinput-button input {
   position: absolute;
   top: 0;
   right: 0;
   margin: 0;
   border: solid transparent;
   border-width: 0 0 100px 200px;
   opacity: 0;
   filter: alpha(opacity=0);
   -moz-transform: translate(-300px, 0) scale(4);
   direction: ltr;
   cursor: pointer;
  }
 </style>
<?php
$miniCalendarFA = $this->jqueryFAFile('calendar');
if ('' != $miniCalendarFA) {
?>
<style type="text/css">
.css_read_off_appointment_start_date button {
	background-color: transparent;
	border: 0;
	padding: 0
}
.css_read_off_appointment_end_date button {
	background-color: transparent;
	border: 0;
	padding: 0
}
</style>
<?php
}
?>
<link rel="stylesheet" href="<?php echo $this->Ini->path_prod ?>/third/jquery_plugin/select2-4.0.6/css/select2.min.css" type="text/css" />
<script type="text/javascript" src="<?php echo $this->Ini->path_prod ?>/third/jquery_plugin/select2-4.0.6/js/select2.full.min.js"></script>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->url_lib_js; ?>scInput.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->url_lib_js; ?>jquery.scInput.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->url_lib_js; ?>jquery.scInput2.js"></SCRIPT>
 <SCRIPT type="text/javascript" src="<?php echo $this->Ini->url_lib_js; ?>jquery.fieldSelection.js"></SCRIPT>
 <?php
 if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_appointments']['embutida_pdf']))
 {
 ?>
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_form.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_form<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" />
  <?php 
  if(isset($this->Ini->str_google_fonts) && !empty($this->Ini->str_google_fonts)) 
  { 
  ?> 
  <link href="<?php echo $this->Ini->str_google_fonts ?>" rel="stylesheet" /> 
  <?php 
  } 
  ?> 
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_appdiv.css" /> 
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_appdiv<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" /> 
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_tab.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_tab<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/buttons/<?php echo $this->Ini->Str_btn_form . '/' . $this->Ini->Str_btn_form ?>.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_prod; ?>/third/font-awesome/css/all.min.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_calendar.css" />
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>_lib/css/<?php echo $this->Ini->str_schema_all ?>_calendar<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" />
<?php
   include_once("../_lib/css/" . $this->Ini->str_schema_all . "_tab.php");
 }
?>
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>form_appointments/form_appointments_<?php echo strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']) ?>.css" />

<script>
var scFocusFirstErrorField = false;
var scFocusFirstErrorName  = "<?php if (isset($this->scFormFocusErrorName)) {echo $this->scFormFocusErrorName;} ?>";
</script>

<?php
include_once("form_appointments_sajax_js.php");
?>
<script type="text/javascript">
if (document.getElementById("id_error_display_fixed"))
{
 scCenterFixedElement("id_error_display_fixed");
}
var posDispLeft = 0;
var posDispTop = 0;
var Nm_Proc_Atualiz = false;
function findPos(obj)
{
 var posCurLeft = posCurTop = 0;
 if (obj.offsetParent)
 {
  posCurLeft = obj.offsetLeft
  posCurTop = obj.offsetTop
  while (obj = obj.offsetParent)
  {
   posCurLeft += obj.offsetLeft
   posCurTop += obj.offsetTop
  }
 }
 posDispLeft = posCurLeft - 10;
 posDispTop = posCurTop + 30;
}
var Nav_permite_ret = "<?php if ($this->Nav_permite_ret) { echo 'S'; } else { echo 'N'; } ?>";
var Nav_permite_ava = "<?php if ($this->Nav_permite_ava) { echo 'S'; } else { echo 'N'; } ?>";
var Nav_binicio     = "<?php echo $this->arr_buttons['binicio']['type']; ?>";
var Nav_bavanca     = "<?php echo $this->arr_buttons['bavanca']['type']; ?>";
var Nav_bretorna    = "<?php echo $this->arr_buttons['bretorna']['type']; ?>";
var Nav_bfinal      = "<?php echo $this->arr_buttons['bfinal']['type']; ?>";
var Nav_binicio_macro_disabled  = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_appointments']['btn_disabled']['first']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_appointments']['btn_disabled']['first'] : 'off'); ?>";
var Nav_bavanca_macro_disabled  = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_appointments']['btn_disabled']['forward']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_appointments']['btn_disabled']['forward'] : 'off'); ?>";
var Nav_bretorna_macro_disabled = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_appointments']['btn_disabled']['back']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_appointments']['btn_disabled']['back'] : 'off'); ?>";
var Nav_bfinal_macro_disabled   = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_appointments']['btn_disabled']['last']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['form_appointments']['btn_disabled']['last'] : 'off'); ?>";
function nav_atualiza(str_ret, str_ava, str_pos)
{
<?php
 if (isset($this->NM_btn_navega) && 'N' == $this->NM_btn_navega)
 {
     echo " return;";
 }
 else
 {
?>
 if ('S' == str_ret)
 {
<?php
    if (isset($this->nmgp_botoes['first']) && $this->nmgp_botoes['first'] == "on")
    {
?>
       if ("off" == Nav_binicio_macro_disabled) { $("#sc_b_ini_" + str_pos).prop("disabled", false).removeClass("disabled"); }
<?php
    }
    if (isset($this->nmgp_botoes['back']) && $this->nmgp_botoes['back'] == "on")
    {
?>
       if ("off" == Nav_bretorna_macro_disabled) { $("#sc_b_ret_" + str_pos).prop("disabled", false).removeClass("disabled"); }
<?php
    }
?>
 }
 else
 {
<?php
    if (isset($this->nmgp_botoes['first']) && $this->nmgp_botoes['first'] == "on")
    {
?>
       $("#sc_b_ini_" + str_pos).prop("disabled", true).addClass("disabled");
<?php
    }
    if (isset($this->nmgp_botoes['back']) && $this->nmgp_botoes['back'] == "on")
    {
?>
       $("#sc_b_ret_" + str_pos).prop("disabled", true).addClass("disabled");
<?php
    }
?>
 }
 if ('S' == str_ava)
 {
<?php
    if (isset($this->nmgp_botoes['last']) && $this->nmgp_botoes['last'] == "on")
    {
?>
       if ("off" == Nav_bfinal_macro_disabled) { $("#sc_b_fim_" + str_pos).prop("disabled", false).removeClass("disabled"); }
<?php
    }
    if (isset($this->nmgp_botoes['forward']) && $this->nmgp_botoes['forward'] == "on")
    {
?>
       if ("off" == Nav_bavanca_macro_disabled) { $("#sc_b_avc_" + str_pos).prop("disabled", false).removeClass("disabled"); }
<?php
    }
?>
 }
 else
 {
<?php
    if (isset($this->nmgp_botoes['last']) && $this->nmgp_botoes['last'] == "on")
    {
?>
       $("#sc_b_fim_" + str_pos).prop("disabled", true).addClass("disabled");
<?php
    }
    if (isset($this->nmgp_botoes['forward']) && $this->nmgp_botoes['forward'] == "on")
    {
?>
       $("#sc_b_avc_" + str_pos).prop("disabled", true).addClass("disabled");
<?php
    }
?>
 }
<?php
  }
?>
}
function nav_liga_img()
{
 sExt = sImg.substr(sImg.length - 4);
 sImg = sImg.substr(0, sImg.length - 4);
 if ('_off' == sImg.substr(sImg.length - 4))
 {
  sImg = sImg.substr(0, sImg.length - 4);
 }
 sImg += sExt;
}
function nav_desliga_img()
{
 sExt = sImg.substr(sImg.length - 4);
 sImg = sImg.substr(0, sImg.length - 4);
 if ('_off' != sImg.substr(sImg.length - 4))
 {
  sImg += '_off';
 }
 sImg += sExt;
}

 function atualiza() {
  window.parent.location.reload(); 
  tb_remove();
 } // atualiza
<?php

include_once('form_appointments_jquery.php');

?>

 var Dyn_Ini  = true;
 $(function() {

  scJQElementsAdd('');

  scJQGeneralAdd();

  $(document).bind('drop dragover', function (e) {
      e.preventDefault();
  });

  var i, iTestWidth, iMaxLabelWidth = 0, $labelList = $(".scUiLabelWidthFix");
  for (i = 0; i < $labelList.length; i++) {
    iTestWidth = $($labelList[i]).width();
    sTestWidth = iTestWidth + "";
    if ("" == iTestWidth) {
      iTestWidth = 0;
    }
    else if ("px" == sTestWidth.substr(sTestWidth.length - 2)) {
      iTestWidth = parseInt(sTestWidth.substr(0, sTestWidth.length - 2));
    }
    iMaxLabelWidth = Math.max(iMaxLabelWidth, iTestWidth);
  }
  if (0 < iMaxLabelWidth) {
    $(".scUiLabelWidthFix").css("width", iMaxLabelWidth + "px");
  }
<?php
if (!$this->NM_ajax_flag && isset($this->NM_non_ajax_info['ajaxJavascript']) && !empty($this->NM_non_ajax_info['ajaxJavascript']))
{
    foreach ($this->NM_non_ajax_info['ajaxJavascript'] as $aFnData)
    {
?>
  <?php echo $aFnData[0]; ?>(<?php echo implode(', ', $aFnData[1]); ?>);

<?php
    }
}
?>
 });

   $(window).on('load', function() {
   });
 if($(".sc-ui-block-control").length) {
  preloadBlock = new Image();
  preloadBlock.src = "<?php echo $this->Ini->path_icones; ?>/" + sc_blockExp;
 }

 var show_block = {
  
 };

 function toggleBlock(e) {
  var block = e.data.block,
      block_id = $(block).attr("id");
      block_img = $("#" + block_id + " .sc-ui-block-control");

  if (1 >= block.rows.length) {
   return;
  }

  show_block[block_id] = !show_block[block_id];

  if (show_block[block_id]) {
    $(block).css("height", "100%");
    if (block_img.length) block_img.attr("src", changeImgName(block_img.attr("src"), sc_blockCol));
  }
  else {
    $(block).css("height", "");
    if (block_img.length) block_img.attr("src", changeImgName(block_img.attr("src"), sc_blockExp));
  }

  for (var i = 1; i < block.rows.length; i++) {
   if (show_block[block_id])
    $(block.rows[i]).show();
   else
    $(block.rows[i]).hide();
  }

  if (show_block[block_id]) {
    if ("hidden_bloco_3" == block_id) {
      scAjaxDetailHeight("form_appointment_details", $($("#nmsc_iframe_liga_form_appointment_details")[0].contentWindow.document).innerHeight());
    }
    if ("hidden_bloco_4" == block_id) {
      scAjaxDetailHeight("grid_appointments_history", $($("#nmsc_iframe_liga_grid_appointments_history")[0].contentWindow.document).innerHeight());
    }
  }
 }

 function changeImgName(imgOld, imgNew) {
   var aOld = imgOld.split("/");
   aOld.pop();
   aOld.push(imgNew);
   return aOld.join("/");
 }

</script>
</HEAD>
<?php
$str_iframe_body = ('F' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_appointments']['run_iframe'] || 'R' == $_SESSION['sc_session'][$this->Ini->sc_page]['form_appointments']['run_iframe']) ? 'margin: 2px;' : '';
 if (isset($_SESSION['nm_aba_bg_color']))
 {
     $this->Ini->cor_bg_grid = $_SESSION['nm_aba_bg_color'];
     $this->Ini->img_fun_pag = $_SESSION['nm_aba_bg_img'];
 }
if ($GLOBALS["erro_incl"] == 1)
{
    $this->nmgp_opcao = "novo";
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_appointments']['opc_ant'] = "novo";
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_appointments']['recarga'] = "novo";
}
if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_appointments']['recarga']))
{
    $opcao_botoes = $this->nmgp_opcao;
}
else
{
    $opcao_botoes = $_SESSION['sc_session'][$this->Ini->sc_page]['form_appointments']['recarga'];
}
    $remove_margin = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_appointments']['dashboard_info']['remove_margin']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_appointments']['dashboard_info']['remove_margin'] ? 'margin: 0; ' : '';
    $remove_border = isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_appointments']['dashboard_info']['remove_border']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_appointments']['dashboard_info']['remove_border'] ? 'border-width: 0; ' : '';
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_appointments']['link_info']['remove_margin']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_appointments']['link_info']['remove_margin']) {
        $remove_margin = 'margin: 0; ';
    }
    if ('' != $remove_margin && isset($str_iframe_body) && '' != $str_iframe_body) {
        $str_iframe_body = '';
    }
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_appointments']['link_info']['remove_border']) && $_SESSION['sc_session'][$this->Ini->sc_page]['form_appointments']['link_info']['remove_border']) {
        $remove_border = 'border-width: 0; ';
    }
    $vertical_center = '';
?>
<body class="scFormPage sc-app-form" style="<?php echo $remove_margin . $str_iframe_body . $vertical_center; ?>">
<?php

if (!isset($this->NM_ajax_info['param']['buffer_output']) || !$this->NM_ajax_info['param']['buffer_output'])
{
    echo $sOBContents;
}

?>
<div id="idJSSpecChar" style="display: none;"></div>
<script type="text/javascript">
function NM_tp_critica(TP)
{
    if (TP == 0 || TP == 1 || TP == 2)
    {
        nmdg_tipo_crit = TP;
    }
}
</script> 
<?php
 include_once("form_appointments_js0.php");
?>
<script type="text/javascript"> 
 function setLocale(oSel)
 {
  var sLocale = "";
  if (-1 < oSel.selectedIndex)
  {
   sLocale = oSel.options[oSel.selectedIndex].value;
  }
  document.F1.nmgp_idioma_novo.value = sLocale;
 }
 function setSchema(oSel)
 {
  var sLocale = "";
  if (-1 < oSel.selectedIndex)
  {
   sLocale = oSel.options[oSel.selectedIndex].value;
  }
  document.F1.nmgp_schema_f.value = sLocale;
 }
var scInsertFieldWithErrors = new Array();
<?php
foreach ($this->NM_ajax_info['fieldsWithErrors'] as $insertFieldName) {
?>
scInsertFieldWithErrors.push("<?php echo $insertFieldName; ?>");
<?php
}
?>
$(function() {
	scAjaxError_markFieldList(scInsertFieldWithErrors);
});
 </script>
<form  name="F1" method="post" 
               action="./" 
               target="_self">
<input type="hidden" name="nmgp_url_saida" value="">
<?php
if ('novo' == $this->nmgp_opcao || 'incluir' == $this->nmgp_opcao)
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_appointments']['insert_validation'] = md5(time() . rand(1, 99999));
?>
<input type="hidden" name="nmgp_ins_valid" value="<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['form_appointments']['insert_validation']; ?>">
<?php
}
?>
<input type="hidden" name="nm_form_submit" value="1">
<input type="hidden" name="nmgp_idioma_novo" value="">
<input type="hidden" name="nmgp_schema_f" value="">
<input type="hidden" name="nmgp_opcao" value="">
<input type="hidden" name="nmgp_ancora" value="">
<input type="hidden" name="nmgp_num_form" value="<?php  echo $this->form_encode_input($nmgp_num_form); ?>">
<input type="hidden" name="nmgp_parms" value="">
<input type="hidden" name="script_case_init" value="<?php  echo $this->form_encode_input($this->Ini->sc_page); ?>">
<input type="hidden" name="NM_cancel_return_new" value="<?php echo $this->NM_cancel_return_new ?>">
<input type="hidden" name="csrf_token" value="<?php echo $this->scCsrfGetToken() ?>" />
<input type="hidden" name="_sc_force_mobile" id="sc-id-mobile-control" value="" />
<?php
$_SESSION['scriptcase']['error_span_title']['form_appointments'] = $this->Ini->Error_icon_span;
$_SESSION['scriptcase']['error_icon_title']['form_appointments'] = '' != $this->Ini->Err_ico_title ? $this->Ini->path_icones . '/' . $this->Ini->Err_ico_title : '';
?>
<div style="display: none; position: absolute; z-index: 1000" id="id_error_display_table_frame">
<table class="scFormErrorTable scFormToastTable">
<tr><?php if ($this->Ini->Error_icon_span && '' != $this->Ini->Err_ico_title) { ?><td style="padding: 0px" rowspan="2"><img src="<?php echo $this->Ini->path_icones; ?>/<?php echo $this->Ini->Err_ico_title; ?>" style="border-width: 0px" align="top"></td><?php } ?><td class="scFormErrorTitle scFormToastTitle"><table style="border-collapse: collapse; border-width: 0px; width: 100%"><tr><td class="scFormErrorTitleFont" style="padding: 0px; vertical-align: top; width: 100%"><?php if (!$this->Ini->Error_icon_span && '' != $this->Ini->Err_ico_title) { ?><img src="<?php echo $this->Ini->path_icones; ?>/<?php echo $this->Ini->Err_ico_title; ?>" style="border-width: 0px" align="top">&nbsp;<?php } ?><?php echo $this->Ini->Nm_lang['lang_errm_errt'] ?></td><td style="padding: 0px; vertical-align: top"><?php echo nmButtonOutput($this->arr_buttons, "berrm_clse", "scAjaxHideErrorDisplay('table')", "scAjaxHideErrorDisplay('table')", "", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
</td></tr></table></td></tr>
<tr><td class="scFormErrorMessage scFormToastMessage"><span id="id_error_display_table_text"></span></td></tr>
</table>
</div>
<div style="display: none; position: absolute; z-index: 1000" id="id_message_display_frame">
 <table class="scFormMessageTable" id="id_message_display_content" style="width: 100%">
  <tr id="id_message_display_title_line">
   <td class="scFormMessageTitle" style="height: 20px"><?php
if ('' != $this->Ini->Msg_ico_title) {
?>
<img src="<?php echo $this->Ini->path_icones . '/' . $this->Ini->Msg_ico_title; ?>" style="border-width: 0px; vertical-align: middle">&nbsp;<?php
}
?>
<?php echo nmButtonOutput($this->arr_buttons, "bmessageclose", "_scAjaxMessageBtnClose()", "_scAjaxMessageBtnClose()", "id_message_display_close_icon", "", "", "float: right", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
<span id="id_message_display_title" style="vertical-align: middle"></span></td>
  </tr>
  <tr>
   <td class="scFormMessageMessage"><?php
if ('' != $this->Ini->Msg_ico_body) {
?>
<img id="id_message_display_body_icon" src="<?php echo $this->Ini->path_icones . '/' . $this->Ini->Msg_ico_body; ?>" style="border-width: 0px; vertical-align: middle">&nbsp;<?php
}
?>
<span id="id_message_display_text"></span><div id="id_message_display_buttond" style="display: none; text-align: center"><br /><input id="id_message_display_buttone" type="button" class="scButton_default" value="Ok" onClick="_scAjaxMessageBtnClick()" ></div></td>
  </tr>
 </table>
</div>
<?php
$msgDefClose = isset($this->arr_buttons['bmessageclose']) ? $this->arr_buttons['bmessageclose']['value'] : 'Ok';
?>
<script type="text/javascript">
var scMsgDefTitle = "<?php if (isset($this->Ini->Nm_lang['lang_usr_lang_othr_msgs_titl'])) {echo $this->Ini->Nm_lang['lang_usr_lang_othr_msgs_titl'];} ?>";
var scMsgDefButton = "Ok";
var scMsgDefClose = "<?php echo $msgDefClose; ?>";
var scMsgDefClick = "close";
var scMsgDefScInit = "<?php echo $this->Ini->sc_page; ?>";
</script>
<?php
if ($this->record_insert_ok)
{
?>
<script type="text/javascript">
if (typeof sc_userSweetAlertDisplayed === "undefined" || !sc_userSweetAlertDisplayed) {
    _scAjaxShowMessage({message: "<?php echo $this->form_encode_input($this->Ini->Nm_lang['lang_othr_ajax_frmi']) ?>", title: "", isModal: false, timeout: sc_ajaxMsgTime, showButton: false, buttonLabel: "Ok", topPos: 0, leftPos: 0, width: 0, height: 0, redirUrl: "", redirTarget: "", redirParam: "", showClose: false, showBodyIcon: true, isToast: true, type: "success"});
}
sc_userSweetAlertDisplayed = false;
</script>
<?php
}
if ($this->record_delete_ok)
{
?>
<script type="text/javascript">
if (typeof sc_userSweetAlertDisplayed === "undefined" || !sc_userSweetAlertDisplayed) {
    _scAjaxShowMessage({message: "<?php echo $this->form_encode_input($this->Ini->Nm_lang['lang_othr_ajax_frmd']) ?>", title: "", isModal: false, timeout: sc_ajaxMsgTime, showButton: false, buttonLabel: "Ok", topPos: 0, leftPos: 0, width: 0, height: 0, redirUrl: "", redirTarget: "", redirParam: "", showClose: false, showBodyIcon: true, isToast: true, type: "success"});
}
sc_userSweetAlertDisplayed = false;
</script>
<?php
}
?>
<table id="main_table_form"  align="center" cellpadding=0 cellspacing=0 >
 <tr>
  <td>
  <div class="scFormBorder" style="<?php echo (isset($remove_border) ? $remove_border : ''); ?>">
   <table width='100%' cellspacing=0 cellpadding=0>
<?php
$this->displayAppHeader();
?>
<tr><td>
<?php
       echo "<div id=\"sc-ui-empty-form\" class=\"scFormPageText\" style=\"padding: 10px; font-weight: bold" . ($this->nmgp_form_empty ? '' : '; display: none') . "\">";
       echo $this->Ini->Nm_lang['lang_errm_empt'];
       echo "</div>";
  if ($this->nmgp_form_empty)
  {
       if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['form_appointments']['where_filter']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['form_appointments']['empty_filter'] = true;
       }
  }
?>
<style>
.scTabInactive {
    cursor: pointer;
}
</style>
<script type="text/javascript">
var pag_ativa = "form_appointments_form0";
</script>
<ul class="scTabLine sc-ui-page-tab-line">
<?php
    $this->tabCssClass = array(
        'form_appointments_form0' => array(
            'title' => "{lang_appointment_info}",
            'class' => empty($nmgp_num_form) || $nmgp_num_form == "form_appointments_form0" ? "scTabActive" : "scTabInactive",
        ),
        'form_appointments_form1' => array(
            'title' => "{lang_service_details}",
            'class' => $nmgp_num_form == "form_appointments_form1" ? "scTabActive" : "scTabInactive",
        ),
        'form_appointments_form2' => array(
            'title' => "{lang_history}",
            'class' => $nmgp_num_form == "form_appointments_form2" ? "scTabActive" : "scTabInactive",
        ),
    );
    if (!empty($this->Ini->nm_hidden_pages)) {
        foreach ($this->Ini->nm_hidden_pages as $pageName => $pageStatus) {
            if ('{lang_appointment_info}' == $pageName && 'off' == $pageStatus) {
                $this->tabCssClass['form_appointments_form0']['class'] = 'scTabInactive';
            }
            if ('{lang_service_details}' == $pageName && 'off' == $pageStatus) {
                $this->tabCssClass['form_appointments_form1']['class'] = 'scTabInactive';
            }
            if ('{lang_history}' == $pageName && 'off' == $pageStatus) {
                $this->tabCssClass['form_appointments_form2']['class'] = 'scTabInactive';
            }
        }
        $displayingPage = false;
        foreach ($this->tabCssClass as $pageInfo) {
            if ('scTabActive' == $pageInfo['class']) {
                $displayingPage = true;
                break;
            }
        }
        if (!$displayingPage) {
            foreach ($this->tabCssClass as $pageForm => $pageInfo) {
                if (!isset($this->Ini->nm_hidden_pages[ $pageInfo['title'] ]) || 'off' != $this->Ini->nm_hidden_pages[ $pageInfo['title'] ]) {
                    $this->tabCssClass[$pageForm]['class'] = 'scTabActive';
                    break;
                }
            }
        }
    }
?>
<?php
    $css_celula = $this->tabCssClass["form_appointments_form0"]['class'];
?>
   <li id="id_form_appointments_form0" class="<?php echo $css_celula; ?> sc-form-page sc-tab-click" data-tab-name="form_appointments_form0">
     <?php echo $this->Ini->Nm_lang['lang_appointment_info']; ?>
   </li>
<?php
    $css_celula = $this->tabCssClass["form_appointments_form1"]['class'];
?>
   <li id="id_form_appointments_form1" class="<?php echo $css_celula; ?> sc-form-page sc-tab-click" data-tab-name="form_appointments_form1">
     <?php echo $this->Ini->Nm_lang['lang_service_details']; ?>
   </li>
<?php
    $css_celula = $this->tabCssClass["form_appointments_form2"]['class'];
?>
   <li id="id_form_appointments_form2" class="<?php echo $css_celula; ?> sc-form-page sc-tab-click" data-tab-name="form_appointments_form2">
     <?php echo $this->Ini->Nm_lang['lang_history']; ?>
   </li>
</ul>
<div style='clear:both'></div>
</td></tr> 
<tr><td style="padding: 0px">
<div id="form_appointments_form0" style='display: none; width: 1px; height: 0px; overflow: scroll'>
<?php $sc_hidden_no = 1; $sc_hidden_yes = 0; ?>
   <a name="bloco_0"></a>
   <table width="100%" height="100%" cellpadding="0" cellspacing=0><tr valign="top"><td width="100%" height="">
<div id="div_hidden_bloco_0"><!-- bloco_c -->
<?php
   if (!isset($this->nmgp_cmp_hidden['appointment_end_date']))
   {
       $this->nmgp_cmp_hidden['appointment_end_date'] = 'off';
   }
   if (!isset($this->nmgp_cmp_hidden['appointment_end_time']))
   {
       $this->nmgp_cmp_hidden['appointment_end_time'] = 'off';
   }
?>
<TABLE align="center" id="hidden_bloco_0" class="scFormTable<?php echo $this->classes_100perc_fields['table'] ?>" width="100%" style="height: 100%;"><?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
   if (!isset($this->nm_new_label['staff_id']))
   {
       $this->nm_new_label['staff_id'] = "" . $this->Ini->Nm_lang['lang_appointments_fld_staff_id'] . "";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $staff_id = $this->staff_id;
   $sStyleHidden_staff_id = '';
   if (isset($this->nmgp_cmp_hidden['staff_id']) && $this->nmgp_cmp_hidden['staff_id'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['staff_id']);
       $sStyleHidden_staff_id = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_staff_id = 'display: none;';
   $sStyleReadInp_staff_id = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['staff_id']) && $this->nmgp_cmp_readonly['staff_id'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['staff_id']);
       $sStyleReadLab_staff_id = '';
       $sStyleReadInp_staff_id = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['staff_id']) && $this->nmgp_cmp_hidden['staff_id'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="staff_id" value="<?php echo $this->form_encode_input($this->staff_id) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_staff_id_line" id="hidden_field_data_staff_id" style="<?php echo $sStyleHidden_staff_id; ?>vertical-align: top;"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_staff_id_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat css_staff_id_label" style=""><span id="id_label_staff_id"><?php echo $this->nm_new_label['staff_id']; ?></span></span><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["staff_id"]) &&  $this->nmgp_cmp_readonly["staff_id"] == "on") { 
 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_appointments']['Lookup_staff_id']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_appointments']['Lookup_staff_id'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_appointments']['Lookup_staff_id']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_appointments']['Lookup_staff_id'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_appointments']['Lookup_staff_id']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_appointments']['Lookup_staff_id'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_appointments']['Lookup_staff_id']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_appointments']['Lookup_staff_id'] = array(); 
    }

   $old_value_appointment_start_date = $this->appointment_start_date;
   $old_value_appointment_start_time = $this->appointment_start_time;
   $old_value_appointment_end_date = $this->appointment_end_date;
   $old_value_appointment_end_time = $this->appointment_end_time;
   $old_value_price = $this->price;
   $old_value_additional_charges = $this->additional_charges;
   $old_value_discount = $this->discount;
   $old_value_total_price = $this->total_price;
   $this->nm_tira_formatacao();
   $this->nm_converte_datas(false);


   $unformatted_value_appointment_start_date = $this->appointment_start_date;
   $unformatted_value_appointment_start_time = $this->appointment_start_time;
   $unformatted_value_appointment_end_date = $this->appointment_end_date;
   $unformatted_value_appointment_end_time = $this->appointment_end_time;
   $unformatted_value_price = $this->price;
   $unformatted_value_additional_charges = $this->additional_charges;
   $unformatted_value_discount = $this->discount;
   $unformatted_value_total_price = $this->total_price;

   $nm_comando = "SELECT staff_id, staff_name  FROM staff  ORDER BY staff_name";

   $this->appointment_start_date = $old_value_appointment_start_date;
   $this->appointment_start_time = $old_value_appointment_start_time;
   $this->appointment_end_date = $old_value_appointment_end_date;
   $this->appointment_end_time = $old_value_appointment_end_time;
   $this->price = $old_value_price;
   $this->additional_charges = $old_value_additional_charges;
   $this->discount = $old_value_discount;
   $this->total_price = $old_value_total_price;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_appointments']['Lookup_staff_id'][] = $rs->fields[0];
              $rs->MoveNext() ; 
       } 
       $rs->Close() ; 
   } 
   elseif ($GLOBALS["NM_ERRO_IBASE"] != 1 && $nm_comando != "")  
   {  
       $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
       exit; 
   } 
   $GLOBALS["NM_ERRO_IBASE"] = 0; 
   $x = 0; 
   $staff_id_look = ""; 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->staff_id_1))
          {
              foreach ($this->staff_id_1 as $tmp_staff_id)
              {
                  if (trim($tmp_staff_id) === trim($cadaselect[1])) { $staff_id_look .= $cadaselect[0] . '__SC_BREAK_LINE__'; }
              }
          }
          elseif (trim($this->staff_id) === trim($cadaselect[1])) { $staff_id_look .= $cadaselect[0]; } 
          $x++; 
   }

?>
<input type="hidden" name="staff_id" value="<?php echo $this->form_encode_input($staff_id) . "\">" . $staff_id_look . ""; ?>
<?php } else { ?>
<?php
   $todo = $this->Form_lookup_staff_id();
   $x = 0 ; 
   $staff_id_look = ""; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->staff_id_1))
          {
              foreach ($this->staff_id_1 as $tmp_staff_id)
              {
                  if (trim($tmp_staff_id) === trim($cadaselect[1])) { $staff_id_look .= $cadaselect[0] . '__SC_BREAK_LINE__'; }
              }
          }
          elseif (trim($this->staff_id) === trim($cadaselect[1])) { $staff_id_look .= $cadaselect[0]; } 
          $x++; 
   }
          if (empty($staff_id_look))
          {
              $staff_id_look = $this->staff_id;
          }
   $x = 0; 
   echo "<span id=\"id_read_on_staff_id\" class=\"css_staff_id_line\" style=\"" .  $sStyleReadLab_staff_id . "\">" . $this->form_format_readonly("staff_id", $this->form_encode_input($staff_id_look)) . "</span><span id=\"id_read_off_staff_id\" class=\"css_read_off_staff_id" . $this->classes_100perc_fields['span_input'] . "\" style=\"white-space: nowrap; " . $sStyleReadInp_staff_id . "\">";
   echo " <span id=\"idAjaxSelect_staff_id\" class=\"" . $this->classes_100perc_fields['span_select'] . "\"><select class=\"sc-js-input scFormObjectOdd css_staff_id_obj" . $this->classes_100perc_fields['input'] . "\" style=\"\" id=\"id_sc_field_staff_id\" name=\"staff_id\" size=\"1\" alt=\"{type: 'select', enterTab: false}\">" ; 
   echo "\r" ; 
   while (!empty($todo[$x]) && !$nm_nao_carga) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          echo "  <option value=\"$cadaselect[1]\"" ; 
          if (trim($this->staff_id) === trim($cadaselect[1])) 
          {
              echo " selected" ; 
          }
          if (strtoupper($cadaselect[2]) == "S") 
          {
              if (empty($this->staff_id)) 
              {
                  echo " selected" ;
              } 
           } 
          echo ">" . str_replace('<', '&lt;',$cadaselect[0]) . "</option>" ; 
          echo "\r" ; 
          $x++ ; 
   }  ; 
   echo " </select></span>" ; 
   echo "\r" ; 
   echo "</span>";
?> 
<?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_staff_id_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_staff_id_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>

   <?php
   if (!isset($this->nm_new_label['customers_id']))
   {
       $this->nm_new_label['customers_id'] = "" . $this->Ini->Nm_lang['lang_appointments_fld_customers_id'] . "";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $customers_id = $this->customers_id;
   $sStyleHidden_customers_id = '';
   if (isset($this->nmgp_cmp_hidden['customers_id']) && $this->nmgp_cmp_hidden['customers_id'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['customers_id']);
       $sStyleHidden_customers_id = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_customers_id = 'display: none;';
   $sStyleReadInp_customers_id = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['customers_id']) && $this->nmgp_cmp_readonly['customers_id'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['customers_id']);
       $sStyleReadLab_customers_id = '';
       $sStyleReadInp_customers_id = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['customers_id']) && $this->nmgp_cmp_hidden['customers_id'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="customers_id" value="<?php echo $this->form_encode_input($this->customers_id) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_customers_id_line" id="hidden_field_data_customers_id" style="<?php echo $sStyleHidden_customers_id; ?>vertical-align: top;"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_customers_id_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat css_customers_id_label" style=""><span id="id_label_customers_id"><?php echo $this->nm_new_label['customers_id']; ?></span></span><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["customers_id"]) &&  $this->nmgp_cmp_readonly["customers_id"] == "on") { 
 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_appointments']['Lookup_customers_id']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_appointments']['Lookup_customers_id'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_appointments']['Lookup_customers_id']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_appointments']['Lookup_customers_id'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_appointments']['Lookup_customers_id']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_appointments']['Lookup_customers_id'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_appointments']['Lookup_customers_id']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_appointments']['Lookup_customers_id'] = array(); 
    }

   $old_value_appointment_start_date = $this->appointment_start_date;
   $old_value_appointment_start_time = $this->appointment_start_time;
   $old_value_appointment_end_date = $this->appointment_end_date;
   $old_value_appointment_end_time = $this->appointment_end_time;
   $old_value_price = $this->price;
   $old_value_additional_charges = $this->additional_charges;
   $old_value_discount = $this->discount;
   $old_value_total_price = $this->total_price;
   $this->nm_tira_formatacao();
   $this->nm_converte_datas(false);


   $unformatted_value_appointment_start_date = $this->appointment_start_date;
   $unformatted_value_appointment_start_time = $this->appointment_start_time;
   $unformatted_value_appointment_end_date = $this->appointment_end_date;
   $unformatted_value_appointment_end_time = $this->appointment_end_time;
   $unformatted_value_price = $this->price;
   $unformatted_value_additional_charges = $this->additional_charges;
   $unformatted_value_discount = $this->discount;
   $unformatted_value_total_price = $this->total_price;

   $nm_comando = "SELECT customers_id, customers_name  FROM customers  ORDER BY customers_name";

   $this->appointment_start_date = $old_value_appointment_start_date;
   $this->appointment_start_time = $old_value_appointment_start_time;
   $this->appointment_end_date = $old_value_appointment_end_date;
   $this->appointment_end_time = $old_value_appointment_end_time;
   $this->price = $old_value_price;
   $this->additional_charges = $old_value_additional_charges;
   $this->discount = $old_value_discount;
   $this->total_price = $old_value_total_price;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_appointments']['Lookup_customers_id'][] = $rs->fields[0];
              $rs->MoveNext() ; 
       } 
       $rs->Close() ; 
   } 
   elseif ($GLOBALS["NM_ERRO_IBASE"] != 1 && $nm_comando != "")  
   {  
       $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
       exit; 
   } 
   $GLOBALS["NM_ERRO_IBASE"] = 0; 
   $x = 0; 
   $customers_id_look = ""; 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->customers_id_1))
          {
              foreach ($this->customers_id_1 as $tmp_customers_id)
              {
                  if (trim($tmp_customers_id) === trim($cadaselect[1])) { $customers_id_look .= $cadaselect[0] . '__SC_BREAK_LINE__'; }
              }
          }
          elseif (trim($this->customers_id) === trim($cadaselect[1])) { $customers_id_look .= $cadaselect[0]; } 
          $x++; 
   }

?>
<input type="hidden" name="customers_id" value="<?php echo $this->form_encode_input($customers_id) . "\">" . $customers_id_look . ""; ?>
<?php } else { ?>
<?php
   $todo = $this->Form_lookup_customers_id();
   $x = 0 ; 
   $customers_id_look = ""; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->customers_id_1))
          {
              foreach ($this->customers_id_1 as $tmp_customers_id)
              {
                  if (trim($tmp_customers_id) === trim($cadaselect[1])) { $customers_id_look .= $cadaselect[0] . '__SC_BREAK_LINE__'; }
              }
          }
          elseif (trim($this->customers_id) === trim($cadaselect[1])) { $customers_id_look .= $cadaselect[0]; } 
          $x++; 
   }
          if (empty($customers_id_look))
          {
              $customers_id_look = $this->customers_id;
          }
   $x = 0; 
   echo "<span id=\"id_read_on_customers_id\" class=\"css_customers_id_line\" style=\"" .  $sStyleReadLab_customers_id . "\">" . $this->form_format_readonly("customers_id", $this->form_encode_input($customers_id_look)) . "</span><span id=\"id_read_off_customers_id\" class=\"css_read_off_customers_id" . $this->classes_100perc_fields['span_input'] . "\" style=\"white-space: nowrap; " . $sStyleReadInp_customers_id . "\">";
   echo " <span id=\"idAjaxSelect_customers_id\" class=\"" . $this->classes_100perc_fields['span_select'] . "\"><select class=\"sc-js-input scFormObjectOdd css_customers_id_obj" . $this->classes_100perc_fields['input'] . "\" style=\"\" id=\"id_sc_field_customers_id\" name=\"customers_id\" size=\"1\" alt=\"{type: 'select', enterTab: false}\">" ; 
   echo "\r" ; 
   while (!empty($todo[$x]) && !$nm_nao_carga) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          echo "  <option value=\"$cadaselect[1]\"" ; 
          if (trim($this->customers_id) === trim($cadaselect[1])) 
          {
              echo " selected" ; 
          }
          if (strtoupper($cadaselect[2]) == "S") 
          {
              if (empty($this->customers_id)) 
              {
                  echo " selected" ;
              } 
           } 
          echo ">" . str_replace('<', '&lt;',$cadaselect[0]) . "</option>" ; 
          echo "\r" ; 
          $x++ ; 
   }  ; 
   echo " </select></span>" ; 
   echo "\r" ; 
   echo "</span>";
?> 
<?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_customers_id_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_customers_id_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>

   <?php
   if (!isset($this->nm_new_label['current_status_id']))
   {
       $this->nm_new_label['current_status_id'] = "" . $this->Ini->Nm_lang['lang_appointments_fld_current_status_id'] . "";
   }
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $current_status_id = $this->current_status_id;
   $sStyleHidden_current_status_id = '';
   if (isset($this->nmgp_cmp_hidden['current_status_id']) && $this->nmgp_cmp_hidden['current_status_id'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['current_status_id']);
       $sStyleHidden_current_status_id = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_current_status_id = 'display: none;';
   $sStyleReadInp_current_status_id = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['current_status_id']) && $this->nmgp_cmp_readonly['current_status_id'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['current_status_id']);
       $sStyleReadLab_current_status_id = '';
       $sStyleReadInp_current_status_id = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['current_status_id']) && $this->nmgp_cmp_hidden['current_status_id'] == 'off') { $sc_hidden_yes++; ?>
<input type=hidden name="current_status_id" value="<?php echo $this->form_encode_input($this->current_status_id) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_current_status_id_line" id="hidden_field_data_current_status_id" style="<?php echo $sStyleHidden_current_status_id; ?>vertical-align: top;"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_current_status_id_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat css_current_status_id_label" style=""><span id="id_label_current_status_id"><?php echo $this->nm_new_label['current_status_id']; ?></span></span><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["current_status_id"]) &&  $this->nmgp_cmp_readonly["current_status_id"] == "on") { 
 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_appointments']['Lookup_current_status_id']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_appointments']['Lookup_current_status_id'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_appointments']['Lookup_current_status_id']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['form_appointments']['Lookup_current_status_id'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_appointments']['Lookup_current_status_id']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_appointments']['Lookup_current_status_id'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['form_appointments']['Lookup_current_status_id']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['form_appointments']['Lookup_current_status_id'] = array(); 
    }

   $old_value_appointment_start_date = $this->appointment_start_date;
   $old_value_appointment_start_time = $this->appointment_start_time;
   $old_value_appointment_end_date = $this->appointment_end_date;
   $old_value_appointment_end_time = $this->appointment_end_time;
   $old_value_price = $this->price;
   $old_value_additional_charges = $this->additional_charges;
   $old_value_discount = $this->discount;
   $old_value_total_price = $this->total_price;
   $this->nm_tira_formatacao();
   $this->nm_converte_datas(false);


   $unformatted_value_appointment_start_date = $this->appointment_start_date;
   $unformatted_value_appointment_start_time = $this->appointment_start_time;
   $unformatted_value_appointment_end_date = $this->appointment_end_date;
   $unformatted_value_appointment_end_time = $this->appointment_end_time;
   $unformatted_value_price = $this->price;
   $unformatted_value_additional_charges = $this->additional_charges;
   $unformatted_value_discount = $this->discount;
   $unformatted_value_total_price = $this->total_price;

   $nm_comando = "SELECT appointment_status_id, appointment_status_descr  FROM appointment_status  ORDER BY appointment_status_id";

   $this->appointment_start_date = $old_value_appointment_start_date;
   $this->appointment_start_time = $old_value_appointment_start_time;
   $this->appointment_end_date = $old_value_appointment_end_date;
   $this->appointment_end_time = $old_value_appointment_end_time;
   $this->price = $old_value_price;
   $this->additional_charges = $old_value_additional_charges;
   $this->discount = $old_value_discount;
   $this->total_price = $old_value_total_price;

   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
   if ($nm_comando != "" && $rs = $this->Db->Execute($nm_comando))
   {
       while (!$rs->EOF) 
       { 
              $rs->fields[0] = str_replace(',', '.', $rs->fields[0]);
              $rs->fields[0] = (strpos(strtolower($rs->fields[0]), "e")) ? (float)$rs->fields[0] : $rs->fields[0];
              $rs->fields[0] = (string)$rs->fields[0];
              $nmgp_def_dados .= $rs->fields[1] . "?#?" ; 
              $nmgp_def_dados .= $rs->fields[0] . "?#?N?@?" ; 
              $_SESSION['sc_session'][$this->Ini->sc_page]['form_appointments']['Lookup_current_status_id'][] = $rs->fields[0];
              $rs->MoveNext() ; 
       } 
       $rs->Close() ; 
   } 
   elseif ($GLOBALS["NM_ERRO_IBASE"] != 1 && $nm_comando != "")  
   {  
       $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
       exit; 
   } 
   $GLOBALS["NM_ERRO_IBASE"] = 0; 
   $x = 0; 
   $current_status_id_look = ""; 
   $todox = str_replace("?#?@?#?", "?#?@ ?#?", trim($nmgp_def_dados)) ; 
   $todo  = explode("?@?", $todox) ; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->current_status_id_1))
          {
              foreach ($this->current_status_id_1 as $tmp_current_status_id)
              {
                  if (trim($tmp_current_status_id) === trim($cadaselect[1])) { $current_status_id_look .= $cadaselect[0] . '__SC_BREAK_LINE__'; }
              }
          }
          elseif (trim($this->current_status_id) === trim($cadaselect[1])) { $current_status_id_look .= $cadaselect[0]; } 
          $x++; 
   }

?>
<input type="hidden" name="current_status_id" value="<?php echo $this->form_encode_input($current_status_id) . "\">" . $current_status_id_look . ""; ?>
<?php } else { ?>
<?php
   $todo = $this->Form_lookup_current_status_id();
   $x = 0 ; 
   $current_status_id_look = ""; 
   while (!empty($todo[$x])) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          if (isset($this->Embutida_ronly) && $this->Embutida_ronly && isset($this->current_status_id_1))
          {
              foreach ($this->current_status_id_1 as $tmp_current_status_id)
              {
                  if (trim($tmp_current_status_id) === trim($cadaselect[1])) { $current_status_id_look .= $cadaselect[0] . '__SC_BREAK_LINE__'; }
              }
          }
          elseif (trim($this->current_status_id) === trim($cadaselect[1])) { $current_status_id_look .= $cadaselect[0]; } 
          $x++; 
   }
          if (empty($current_status_id_look))
          {
              $current_status_id_look = $this->current_status_id;
          }
   $x = 0; 
   echo "<span id=\"id_read_on_current_status_id\" class=\"css_current_status_id_line\" style=\"" .  $sStyleReadLab_current_status_id . "\">" . $this->form_format_readonly("current_status_id", $this->form_encode_input($current_status_id_look)) . "</span><span id=\"id_read_off_current_status_id\" class=\"css_read_off_current_status_id" . $this->classes_100perc_fields['span_input'] . "\" style=\"white-space: nowrap; " . $sStyleReadInp_current_status_id . "\">";
   echo " <span id=\"idAjaxSelect_current_status_id\" class=\"" . $this->classes_100perc_fields['span_select'] . "\"><select class=\"sc-js-input scFormObjectOdd css_current_status_id_obj" . $this->classes_100perc_fields['input'] . "\" style=\"\" id=\"id_sc_field_current_status_id\" name=\"current_status_id\" size=\"1\" alt=\"{type: 'select', enterTab: false}\">" ; 
   echo "\r" ; 
   while (!empty($todo[$x]) && !$nm_nao_carga) 
   {
          $cadaselect = explode("?#?", $todo[$x]) ; 
          if ($cadaselect[1] == "@ ") {$cadaselect[1]= trim($cadaselect[1]); } ; 
          echo "  <option value=\"$cadaselect[1]\"" ; 
          if (trim($this->current_status_id) === trim($cadaselect[1])) 
          {
              echo " selected" ; 
          }
          if (strtoupper($cadaselect[2]) == "S") 
          {
              if (empty($this->current_status_id)) 
              {
                  echo " selected" ;
              } 
           } 
          echo ">" . str_replace('<', '&lt;',$cadaselect[0]) . "</option>" ; 
          echo "\r" ; 
          $x++ ; 
   }  ; 
   echo " </select></span>" ; 
   echo "\r" ; 
   echo "</span>";
?> 
<?php  }?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_current_status_id_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_current_status_id_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 






<?php $sStyleHidden_staff_id_dumb = ('' == $sStyleHidden_staff_id) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_staff_id_dumb" style="<?php echo $sStyleHidden_staff_id_dumb; ?>"></TD>
<?php $sStyleHidden_customers_id_dumb = ('' == $sStyleHidden_customers_id) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_customers_id_dumb" style="<?php echo $sStyleHidden_customers_id_dumb; ?>"></TD>
<?php $sStyleHidden_current_status_id_dumb = ('' == $sStyleHidden_current_status_id) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_current_status_id_dumb" style="<?php echo $sStyleHidden_current_status_id_dumb; ?>"></TD>
   </tr>
<?php $sc_hidden_no = 1; ?>
</TABLE></div><!-- bloco_f -->
   </td>
   </tr></table>
   <a name="bloco_1"></a>
   <table width="100%" height="100%" cellpadding="0" cellspacing=0><tr valign="top"><td width="100%" height="">
<div id="div_hidden_bloco_1"><!-- bloco_c -->
<TABLE align="center" id="hidden_bloco_1" class="scFormTable<?php echo $this->classes_100perc_fields['table'] ?>" width="100%" style="height: 100%;"><?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['appointment_start_date']))
    {
        $this->nm_new_label['appointment_start_date'] = "" . $this->Ini->Nm_lang['lang_appointments_fld_appointment_start_date'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $appointment_start_date = $this->appointment_start_date;
   $sStyleHidden_appointment_start_date = '';
   if (isset($this->nmgp_cmp_hidden['appointment_start_date']) && $this->nmgp_cmp_hidden['appointment_start_date'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['appointment_start_date']);
       $sStyleHidden_appointment_start_date = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_appointment_start_date = 'display: none;';
   $sStyleReadInp_appointment_start_date = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['appointment_start_date']) && $this->nmgp_cmp_readonly['appointment_start_date'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['appointment_start_date']);
       $sStyleReadLab_appointment_start_date = '';
       $sStyleReadInp_appointment_start_date = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['appointment_start_date']) && $this->nmgp_cmp_hidden['appointment_start_date'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="appointment_start_date" value="<?php echo $this->form_encode_input($appointment_start_date) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_appointment_start_date_line" id="hidden_field_data_appointment_start_date" style="<?php echo $sStyleHidden_appointment_start_date; ?>vertical-align: top;"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_appointment_start_date_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat css_appointment_start_date_label" style=""><span id="id_label_appointment_start_date"><?php echo $this->nm_new_label['appointment_start_date']; ?></span><?php if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_appointments']['php_cmp_required']['appointment_start_date']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_appointments']['php_cmp_required']['appointment_start_date'] == "on") { ?> <span class="scFormRequiredOdd">*</span> <?php }?></span><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["appointment_start_date"]) &&  $this->nmgp_cmp_readonly["appointment_start_date"] == "on") { 

 ?>
<input type="hidden" name="appointment_start_date" value="<?php echo $this->form_encode_input($appointment_start_date) . "\">" . $appointment_start_date . ""; ?>
<?php } else { ?>
<span id="id_read_on_appointment_start_date" class="sc-ui-readonly-appointment_start_date css_appointment_start_date_line" style="<?php echo $sStyleReadLab_appointment_start_date; ?>"><?php echo $this->form_format_readonly("appointment_start_date", $this->form_encode_input($appointment_start_date)); ?></span><span id="id_read_off_appointment_start_date" class="css_read_off_appointment_start_date<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_appointment_start_date; ?>"><?php
$tmp_form_data = $this->field_config['appointment_start_date']['date_format'];
$tmp_form_data = str_replace('aaaa', 'yyyy', $tmp_form_data);
$tmp_form_data = str_replace('dd'  , $this->Ini->Nm_lang['lang_othr_date_days'], $tmp_form_data);
$tmp_form_data = str_replace('mm'  , $this->Ini->Nm_lang['lang_othr_date_mnth'], $tmp_form_data);
$tmp_form_data = str_replace('yyyy', $this->Ini->Nm_lang['lang_othr_date_year'], $tmp_form_data);
$tmp_form_data = str_replace('hh'  , $this->Ini->Nm_lang['lang_othr_date_hour'], $tmp_form_data);
$tmp_form_data = str_replace('ii'  , $this->Ini->Nm_lang['lang_othr_date_mint'], $tmp_form_data);
$tmp_form_data = str_replace('ss'  , $this->Ini->Nm_lang['lang_othr_date_scnd'], $tmp_form_data);
$tmp_form_data = str_replace(';'   , ' '                                       , $tmp_form_data);
?>
<?php
$miniCalendarButton = $this->jqueryButtonText('calendar');
if ('scButton_' == substr($miniCalendarButton[1], 0, 9)) {
    $miniCalendarButton[1] = substr($miniCalendarButton[1], 9);
}
?>
<span class='trigger-picker-<?php echo $miniCalendarButton[1]; ?>' style='display: inherit; width: 100%'>

 <input class="sc-js-input scFormObjectOdd css_appointment_start_date_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_appointment_start_date" type=text name="appointment_start_date" value="<?php echo $this->form_encode_input($appointment_start_date) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=10"; } ?> alt="{datatype: 'date', dateSep: '<?php echo $this->field_config['appointment_start_date']['date_sep']; ?>', dateFormat: '<?php echo $this->field_config['appointment_start_date']['date_format']; ?>', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span>
</span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_appointment_start_date_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_appointment_start_date_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>

   <?php
    if (!isset($this->nm_new_label['appointment_start_time']))
    {
        $this->nm_new_label['appointment_start_time'] = "" . $this->Ini->Nm_lang['lang_appointments_fld_appointment_start_time'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $appointment_start_time = $this->appointment_start_time;
   $sStyleHidden_appointment_start_time = '';
   if (isset($this->nmgp_cmp_hidden['appointment_start_time']) && $this->nmgp_cmp_hidden['appointment_start_time'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['appointment_start_time']);
       $sStyleHidden_appointment_start_time = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_appointment_start_time = 'display: none;';
   $sStyleReadInp_appointment_start_time = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['appointment_start_time']) && $this->nmgp_cmp_readonly['appointment_start_time'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['appointment_start_time']);
       $sStyleReadLab_appointment_start_time = '';
       $sStyleReadInp_appointment_start_time = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['appointment_start_time']) && $this->nmgp_cmp_hidden['appointment_start_time'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="appointment_start_time" value="<?php echo $this->form_encode_input($appointment_start_time) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_appointment_start_time_line" id="hidden_field_data_appointment_start_time" style="<?php echo $sStyleHidden_appointment_start_time; ?>vertical-align: top;"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_appointment_start_time_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat css_appointment_start_time_label" style=""><span id="id_label_appointment_start_time"><?php echo $this->nm_new_label['appointment_start_time']; ?></span><?php if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['form_appointments']['php_cmp_required']['appointment_start_time']) || $_SESSION['sc_session'][$this->Ini->sc_page]['form_appointments']['php_cmp_required']['appointment_start_time'] == "on") { ?> <span class="scFormRequiredOdd">*</span> <?php }?></span><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["appointment_start_time"]) &&  $this->nmgp_cmp_readonly["appointment_start_time"] == "on") { 

 ?>
<input type="hidden" name="appointment_start_time" value="<?php echo $this->form_encode_input($appointment_start_time) . "\">" . $appointment_start_time . ""; ?>
<?php } else { ?>
<span id="id_read_on_appointment_start_time" class="sc-ui-readonly-appointment_start_time css_appointment_start_time_line" style="<?php echo $sStyleReadLab_appointment_start_time; ?>"><?php echo $this->form_format_readonly("appointment_start_time", $this->form_encode_input($appointment_start_time)); ?></span><span id="id_read_off_appointment_start_time" class="css_read_off_appointment_start_time<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_appointment_start_time; ?>"><?php
$tmp_form_data = $this->field_config['appointment_start_time']['date_format'];
$tmp_form_data = str_replace('aaaa', 'yyyy', $tmp_form_data);
$tmp_form_data = str_replace('dd'  , $this->Ini->Nm_lang['lang_othr_date_days'], $tmp_form_data);
$tmp_form_data = str_replace('mm'  , $this->Ini->Nm_lang['lang_othr_date_mnth'], $tmp_form_data);
$tmp_form_data = str_replace('yyyy', $this->Ini->Nm_lang['lang_othr_date_year'], $tmp_form_data);
$tmp_form_data = str_replace('hh'  , $this->Ini->Nm_lang['lang_othr_date_hour'], $tmp_form_data);
$tmp_form_data = str_replace('ii'  , $this->Ini->Nm_lang['lang_othr_date_mint'], $tmp_form_data);
$tmp_form_data = str_replace('ss'  , $this->Ini->Nm_lang['lang_othr_date_scnd'], $tmp_form_data);
$tmp_form_data = str_replace(';'   , ' '                                       , $tmp_form_data);
?>

 <input class="sc-js-input scFormObjectOdd css_appointment_start_time_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_appointment_start_time" type=text name="appointment_start_time" value="<?php echo $this->form_encode_input($appointment_start_time) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=8"; } ?> alt="{datatype: 'time', timeSep: '<?php echo $this->field_config['appointment_start_time']['time_sep']; ?>', timeFormat: '<?php echo $this->field_config['appointment_start_time']['date_format']; ?>', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_appointment_start_time_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_appointment_start_time_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 
<?php $sStyleHidden_appointment_start_date_dumb = ('' == $sStyleHidden_appointment_start_date) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_appointment_start_date_dumb" style="<?php echo $sStyleHidden_appointment_start_date_dumb; ?>"></TD>
<?php $sStyleHidden_appointment_start_time_dumb = ('' == $sStyleHidden_appointment_start_time) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_appointment_start_time_dumb" style="<?php echo $sStyleHidden_appointment_start_time_dumb; ?>"></TD>
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['appointment_end_date']))
    {
        $this->nm_new_label['appointment_end_date'] = "" . $this->Ini->Nm_lang['lang_appointments_fld_appointment_end_date'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $appointment_end_date = $this->appointment_end_date;
   if (!isset($this->nmgp_cmp_hidden['appointment_end_date']))
   {
       $this->nmgp_cmp_hidden['appointment_end_date'] = 'off';
   }
   $sStyleHidden_appointment_end_date = '';
   if (isset($this->nmgp_cmp_hidden['appointment_end_date']) && $this->nmgp_cmp_hidden['appointment_end_date'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['appointment_end_date']);
       $sStyleHidden_appointment_end_date = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_appointment_end_date = 'display: none;';
   $sStyleReadInp_appointment_end_date = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['appointment_end_date']) && $this->nmgp_cmp_readonly['appointment_end_date'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['appointment_end_date']);
       $sStyleReadLab_appointment_end_date = '';
       $sStyleReadInp_appointment_end_date = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['appointment_end_date']) && $this->nmgp_cmp_hidden['appointment_end_date'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="appointment_end_date" value="<?php echo $this->form_encode_input($appointment_end_date) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_appointment_end_date_line" id="hidden_field_data_appointment_end_date" style="<?php echo $sStyleHidden_appointment_end_date; ?>vertical-align: top;"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_appointment_end_date_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat css_appointment_end_date_label" style=""><span id="id_label_appointment_end_date"><?php echo $this->nm_new_label['appointment_end_date']; ?></span></span><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["appointment_end_date"]) &&  $this->nmgp_cmp_readonly["appointment_end_date"] == "on") { 

 ?>
<input type="hidden" name="appointment_end_date" value="<?php echo $this->form_encode_input($appointment_end_date) . "\">" . $appointment_end_date . ""; ?>
<?php } else { ?>
<span id="id_read_on_appointment_end_date" class="sc-ui-readonly-appointment_end_date css_appointment_end_date_line" style="<?php echo $sStyleReadLab_appointment_end_date; ?>"><?php echo $this->form_format_readonly("appointment_end_date", $this->form_encode_input($appointment_end_date)); ?></span><span id="id_read_off_appointment_end_date" class="css_read_off_appointment_end_date<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_appointment_end_date; ?>"><?php
$tmp_form_data = $this->field_config['appointment_end_date']['date_format'];
$tmp_form_data = str_replace('aaaa', 'yyyy', $tmp_form_data);
$tmp_form_data = str_replace('dd'  , $this->Ini->Nm_lang['lang_othr_date_days'], $tmp_form_data);
$tmp_form_data = str_replace('mm'  , $this->Ini->Nm_lang['lang_othr_date_mnth'], $tmp_form_data);
$tmp_form_data = str_replace('yyyy', $this->Ini->Nm_lang['lang_othr_date_year'], $tmp_form_data);
$tmp_form_data = str_replace('hh'  , $this->Ini->Nm_lang['lang_othr_date_hour'], $tmp_form_data);
$tmp_form_data = str_replace('ii'  , $this->Ini->Nm_lang['lang_othr_date_mint'], $tmp_form_data);
$tmp_form_data = str_replace('ss'  , $this->Ini->Nm_lang['lang_othr_date_scnd'], $tmp_form_data);
$tmp_form_data = str_replace(';'   , ' '                                       , $tmp_form_data);
?>
<?php
$miniCalendarButton = $this->jqueryButtonText('calendar');
if ('scButton_' == substr($miniCalendarButton[1], 0, 9)) {
    $miniCalendarButton[1] = substr($miniCalendarButton[1], 9);
}
?>
<span class='trigger-picker-<?php echo $miniCalendarButton[1]; ?>' style='display: inherit; width: 100%'>

 <input class="sc-js-input scFormObjectOdd css_appointment_end_date_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_appointment_end_date" type=text name="appointment_end_date" value="<?php echo $this->form_encode_input($appointment_end_date) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=10"; } ?> alt="{datatype: 'date', dateSep: '<?php echo $this->field_config['appointment_end_date']['date_sep']; ?>', dateFormat: '<?php echo $this->field_config['appointment_end_date']['date_format']; ?>', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span>
</span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_appointment_end_date_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_appointment_end_date_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>

   <?php
    if (!isset($this->nm_new_label['appointment_end_time']))
    {
        $this->nm_new_label['appointment_end_time'] = "" . $this->Ini->Nm_lang['lang_appointments_fld_appointment_end_time'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $appointment_end_time = $this->appointment_end_time;
   if (!isset($this->nmgp_cmp_hidden['appointment_end_time']))
   {
       $this->nmgp_cmp_hidden['appointment_end_time'] = 'off';
   }
   $sStyleHidden_appointment_end_time = '';
   if (isset($this->nmgp_cmp_hidden['appointment_end_time']) && $this->nmgp_cmp_hidden['appointment_end_time'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['appointment_end_time']);
       $sStyleHidden_appointment_end_time = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_appointment_end_time = 'display: none;';
   $sStyleReadInp_appointment_end_time = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['appointment_end_time']) && $this->nmgp_cmp_readonly['appointment_end_time'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['appointment_end_time']);
       $sStyleReadLab_appointment_end_time = '';
       $sStyleReadInp_appointment_end_time = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['appointment_end_time']) && $this->nmgp_cmp_hidden['appointment_end_time'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="appointment_end_time" value="<?php echo $this->form_encode_input($appointment_end_time) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_appointment_end_time_line" id="hidden_field_data_appointment_end_time" style="<?php echo $sStyleHidden_appointment_end_time; ?>vertical-align: top;"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_appointment_end_time_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat css_appointment_end_time_label" style=""><span id="id_label_appointment_end_time"><?php echo $this->nm_new_label['appointment_end_time']; ?></span></span><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["appointment_end_time"]) &&  $this->nmgp_cmp_readonly["appointment_end_time"] == "on") { 

 ?>
<input type="hidden" name="appointment_end_time" value="<?php echo $this->form_encode_input($appointment_end_time) . "\">" . $appointment_end_time . ""; ?>
<?php } else { ?>
<span id="id_read_on_appointment_end_time" class="sc-ui-readonly-appointment_end_time css_appointment_end_time_line" style="<?php echo $sStyleReadLab_appointment_end_time; ?>"><?php echo $this->form_format_readonly("appointment_end_time", $this->form_encode_input($appointment_end_time)); ?></span><span id="id_read_off_appointment_end_time" class="css_read_off_appointment_end_time<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_appointment_end_time; ?>"><?php
$tmp_form_data = $this->field_config['appointment_end_time']['date_format'];
$tmp_form_data = str_replace('aaaa', 'yyyy', $tmp_form_data);
$tmp_form_data = str_replace('dd'  , $this->Ini->Nm_lang['lang_othr_date_days'], $tmp_form_data);
$tmp_form_data = str_replace('mm'  , $this->Ini->Nm_lang['lang_othr_date_mnth'], $tmp_form_data);
$tmp_form_data = str_replace('yyyy', $this->Ini->Nm_lang['lang_othr_date_year'], $tmp_form_data);
$tmp_form_data = str_replace('hh'  , $this->Ini->Nm_lang['lang_othr_date_hour'], $tmp_form_data);
$tmp_form_data = str_replace('ii'  , $this->Ini->Nm_lang['lang_othr_date_mint'], $tmp_form_data);
$tmp_form_data = str_replace('ss'  , $this->Ini->Nm_lang['lang_othr_date_scnd'], $tmp_form_data);
$tmp_form_data = str_replace(';'   , ' '                                       , $tmp_form_data);
?>

 <input class="sc-js-input scFormObjectOdd css_appointment_end_time_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_appointment_end_time" type=text name="appointment_end_time" value="<?php echo $this->form_encode_input($appointment_end_time) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=8"; } ?> alt="{datatype: 'time', timeSep: '<?php echo $this->field_config['appointment_end_time']['time_sep']; ?>', timeFormat: '<?php echo $this->field_config['appointment_end_time']['date_format']; ?>', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_appointment_end_time_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_appointment_end_time_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 






<?php $sStyleHidden_appointment_end_date_dumb = ('' == $sStyleHidden_appointment_end_date) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_appointment_end_date_dumb" style="<?php echo $sStyleHidden_appointment_end_date_dumb; ?>"></TD>
<?php $sStyleHidden_appointment_end_time_dumb = ('' == $sStyleHidden_appointment_end_time) ? 'display: none' : ''; ?>
    <TD class="scFormDataOdd" id="hidden_field_data_appointment_end_time_dumb" style="<?php echo $sStyleHidden_appointment_end_time_dumb; ?>"></TD>
   </tr>
<?php $sc_hidden_no = 1; ?>
</TABLE></div><!-- bloco_f -->
   </td>
   </tr></table>
   <a name="bloco_2"></a>
   <table width="100%" height="100%" cellpadding="0" cellspacing=0><tr valign="top"><td width="100%" height="">
<div id="div_hidden_bloco_2"><!-- bloco_c -->
<TABLE align="center" id="hidden_bloco_2" class="scFormTable<?php echo $this->classes_100perc_fields['table'] ?>" width="100%" style="height: 100%;"><?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['price']))
    {
        $this->nm_new_label['price'] = "" . $this->Ini->Nm_lang['lang_appointments_fld_price'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $price = $this->price;
   $sStyleHidden_price = '';
   if (isset($this->nmgp_cmp_hidden['price']) && $this->nmgp_cmp_hidden['price'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['price']);
       $sStyleHidden_price = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_price = 'display: none;';
   $sStyleReadInp_price = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['price']) && $this->nmgp_cmp_readonly['price'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['price']);
       $sStyleReadLab_price = '';
       $sStyleReadInp_price = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['price']) && $this->nmgp_cmp_hidden['price'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="price" value="<?php echo $this->form_encode_input($price) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_price_line" id="hidden_field_data_price" style="<?php echo $sStyleHidden_price; ?>vertical-align: top;"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_price_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat css_price_label" style=""><span id="id_label_price"><?php echo $this->nm_new_label['price']; ?></span></span><br><input type="hidden" name="price" value="<?php echo $this->form_encode_input($price); ?>"><span id="id_ajax_label_price"><?php echo nl2br($price); ?></span>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_price_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_price_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>

   <?php
    if (!isset($this->nm_new_label['additional_charges']))
    {
        $this->nm_new_label['additional_charges'] = "" . $this->Ini->Nm_lang['lang_appointments_fld_additional_charges'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $additional_charges = $this->additional_charges;
   $sStyleHidden_additional_charges = '';
   if (isset($this->nmgp_cmp_hidden['additional_charges']) && $this->nmgp_cmp_hidden['additional_charges'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['additional_charges']);
       $sStyleHidden_additional_charges = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_additional_charges = 'display: none;';
   $sStyleReadInp_additional_charges = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['additional_charges']) && $this->nmgp_cmp_readonly['additional_charges'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['additional_charges']);
       $sStyleReadLab_additional_charges = '';
       $sStyleReadInp_additional_charges = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['additional_charges']) && $this->nmgp_cmp_hidden['additional_charges'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="additional_charges" value="<?php echo $this->form_encode_input($additional_charges) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_additional_charges_line" id="hidden_field_data_additional_charges" style="<?php echo $sStyleHidden_additional_charges; ?>vertical-align: top;"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_additional_charges_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat css_additional_charges_label" style=""><span id="id_label_additional_charges"><?php echo $this->nm_new_label['additional_charges']; ?></span></span><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["additional_charges"]) &&  $this->nmgp_cmp_readonly["additional_charges"] == "on") { 

 ?>
<input type="hidden" name="additional_charges" value="<?php echo $this->form_encode_input($additional_charges) . "\">" . $additional_charges . ""; ?>
<?php } else { ?>
<span id="id_read_on_additional_charges" class="sc-ui-readonly-additional_charges css_additional_charges_line" style="<?php echo $sStyleReadLab_additional_charges; ?>"><?php echo $this->form_format_readonly("additional_charges", $this->form_encode_input($this->additional_charges)); ?></span><span id="id_read_off_additional_charges" class="css_read_off_additional_charges<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_additional_charges; ?>">
 <input class="sc-js-input scFormObjectOdd css_additional_charges_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_additional_charges" type=text name="additional_charges" value="<?php echo $this->form_encode_input($additional_charges) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=6"; } ?> alt="{datatype: 'decimal', maxLength: 6, precision: 2, decimalSep: '<?php echo str_replace("'", "\'", $this->field_config['additional_charges']['symbol_dec']); ?>', thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['additional_charges']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['additional_charges']['symbol_fmt']; ?>, manualDecimals: false, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['additional_charges']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_additional_charges_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_additional_charges_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>

   <?php
    if (!isset($this->nm_new_label['discount']))
    {
        $this->nm_new_label['discount'] = "" . $this->Ini->Nm_lang['lang_appointments_fld_discount'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $discount = $this->discount;
   $sStyleHidden_discount = '';
   if (isset($this->nmgp_cmp_hidden['discount']) && $this->nmgp_cmp_hidden['discount'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['discount']);
       $sStyleHidden_discount = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_discount = 'display: none;';
   $sStyleReadInp_discount = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['discount']) && $this->nmgp_cmp_readonly['discount'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['discount']);
       $sStyleReadLab_discount = '';
       $sStyleReadInp_discount = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['discount']) && $this->nmgp_cmp_hidden['discount'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="discount" value="<?php echo $this->form_encode_input($discount) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_discount_line" id="hidden_field_data_discount" style="<?php echo $sStyleHidden_discount; ?>vertical-align: top;"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_discount_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat css_discount_label" style=""><span id="id_label_discount"><?php echo $this->nm_new_label['discount']; ?></span></span><br>
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["discount"]) &&  $this->nmgp_cmp_readonly["discount"] == "on") { 

 ?>
<input type="hidden" name="discount" value="<?php echo $this->form_encode_input($discount) . "\">" . $discount . ""; ?>
<?php } else { ?>
<span id="id_read_on_discount" class="sc-ui-readonly-discount css_discount_line" style="<?php echo $sStyleReadLab_discount; ?>"><?php echo $this->form_format_readonly("discount", $this->form_encode_input($this->discount)); ?></span><span id="id_read_off_discount" class="css_read_off_discount<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_discount; ?>">
 <input class="sc-js-input scFormObjectOdd css_discount_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_discount" type=text name="discount" value="<?php echo $this->form_encode_input($discount) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=6"; } ?> alt="{datatype: 'decimal', maxLength: 6, precision: 2, decimalSep: '<?php echo str_replace("'", "\'", $this->field_config['discount']['symbol_dec']); ?>', thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['discount']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['discount']['symbol_fmt']; ?>, manualDecimals: false, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['discount']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_discount_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_discount_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>

   <?php
    if (!isset($this->nm_new_label['total_price']))
    {
        $this->nm_new_label['total_price'] = "" . $this->Ini->Nm_lang['lang_appointments_fld_total_price'] . "";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $total_price = $this->total_price;
   $sStyleHidden_total_price = '';
   if (isset($this->nmgp_cmp_hidden['total_price']) && $this->nmgp_cmp_hidden['total_price'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['total_price']);
       $sStyleHidden_total_price = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_total_price = 'display: none;';
   $sStyleReadInp_total_price = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['total_price']) && $this->nmgp_cmp_readonly['total_price'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['total_price']);
       $sStyleReadLab_total_price = '';
       $sStyleReadInp_total_price = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['total_price']) && $this->nmgp_cmp_hidden['total_price'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="total_price" value="<?php echo $this->form_encode_input($total_price) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_total_price_line" id="hidden_field_data_total_price" style="<?php echo $sStyleHidden_total_price; ?>vertical-align: top;"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td  class="scFormDataFontOdd css_total_price_line" style="vertical-align: top;padding: 0px"><span class="scFormLabelOddFormat css_total_price_label" style=""><span id="id_label_total_price"><?php echo $this->nm_new_label['total_price']; ?></span></span><br><input type="hidden" name="total_price" value="<?php echo $this->form_encode_input($total_price); ?>"><span id="id_ajax_label_total_price"><?php echo nl2br($total_price); ?></span>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_total_price_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_total_price_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 






   </tr>
</TABLE></div><!-- bloco_f -->
   </td></tr></table>
   </div>
