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
 <TITLE><?php if ('novo' == $this->nmgp_opcao) { echo strip_tags("" . $this->Ini->Nm_lang['lang_btns_mdtl_neww'] . " " . $this->Ini->Nm_lang['lang_appointment'] . ""); } else { echo strip_tags("" . $this->Ini->Nm_lang['lang_appointment_info'] . ""); } ?></TITLE>
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
 if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['embutida_pdf']))
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
 <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->path_link ?>calendar_appointments_staff/calendar_appointments_staff_<?php echo strtolower($_SESSION['scriptcase']['reg_conf']['css_dir']) ?>.css" />

<script>
var scFocusFirstErrorField = true;
var scFocusFirstErrorName  = "<?php if (isset($this->scFormFocusErrorName)) {echo $this->scFormFocusErrorName;} ?>";
</script>

<?php
include_once("calendar_appointments_staff_sajax_js.php");
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
var Nav_binicio_macro_disabled  = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['btn_disabled']['first']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['btn_disabled']['first'] : 'off'); ?>";
var Nav_bavanca_macro_disabled  = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['btn_disabled']['forward']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['btn_disabled']['forward'] : 'off'); ?>";
var Nav_bretorna_macro_disabled = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['btn_disabled']['back']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['btn_disabled']['back'] : 'off'); ?>";
var Nav_bfinal_macro_disabled   = "<?php echo (isset($_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['btn_disabled']['last']) ? $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['btn_disabled']['last'] : 'off'); ?>";
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

 function sc_calendar_all_day_click() {
  
 } // sc_calendar_all_day_click

 function sc_calendar_recurrence_change() {
  
 } // sc_calendar_recurrence_change

 function nm_field_disabled(Fields, Opt) {
  opcao = "<?php if ($GLOBALS["erro_incl"] == 1) {echo "novo";} else {echo $this->nmgp_opcao;} ?>";
  if (opcao == "novo" && Opt == "U") {
      return;
  }
  if (opcao != "novo" && Opt == "I") {
      return;
  }
  Field = Fields.split(";");
  for (i=0; i < Field.length; i++)
  {
     F_temp = Field[i].split("=");
     F_name = F_temp[0];
     F_opc  = (F_temp[1] && ("disabled" == F_temp[1] || "true" == F_temp[1])) ? true : false;
     if (F_name == "current_status_id")
     {
        $('select[name="current_status_id"]').prop("disabled", F_opc);
        if (F_opc == "disabled" || F_opc == true) {
            $('select[name="current_status_id"]').addClass("scFormInputDisabled");
        }
        else {
            $('select[name="current_status_id"]').removeClass("scFormInputDisabled");
        }
     }
     if (F_name == "customers_id")
     {
        $('select[name="customers_id"]').prop("disabled", F_opc);
        if (F_opc == "disabled" || F_opc == true) {
            $('select[name="customers_id"]').addClass("scFormInputDisabled");
        }
        else {
            $('select[name="customers_id"]').removeClass("scFormInputDisabled");
        }
     }
     if (F_name == "appointment_start_date")
     {
        $('input[name="appointment_start_date"]').prop("disabled", F_opc);
        if (F_opc == "disabled" || F_opc == true) {
            $('input[name="appointment_start_date"]').addClass("scFormInputDisabled");
        }
        else {
            $('input[name="appointment_start_date"]').removeClass("scFormInputDisabled");
        }
        $('input[id="calendar_appointment_start_date"]').prop("disabled", F_opc);
        if (F_opc) {
            $("#id_sc_field_appointment_start_date").datepicker("destroy");
        }
        else {
            scJQCalendarAdd("");
        }
     }
     if (F_name == "appointment_start_time")
     {
        $('input[name="appointment_start_time"]').prop("disabled", F_opc);
        if (F_opc == "disabled" || F_opc == true) {
            $('input[name="appointment_start_time"]').addClass("scFormInputDisabled");
        }
        else {
            $('input[name="appointment_start_time"]').removeClass("scFormInputDisabled");
        }
     }
     if (F_name == "price")
     {
        $('input[name="price"]').prop("disabled", F_opc);
        if (F_opc == "disabled" || F_opc == true) {
            $('input[name="price"]').addClass("scFormInputDisabled");
        }
        else {
            $('input[name="price"]').removeClass("scFormInputDisabled");
        }
     }
     if (F_name == "total_price")
     {
        $('input[name="total_price"]').prop("disabled", F_opc);
        if (F_opc == "disabled" || F_opc == true) {
            $('input[name="total_price"]').addClass("scFormInputDisabled");
        }
        else {
            $('input[name="total_price"]').removeClass("scFormInputDisabled");
        }
     }
  }
 } // nm_field_disabled
<?php

include_once('calendar_appointments_staff_jquery.php');

?>

 var Dyn_Ini  = true;
 $(function() {

  scJQElementsAdd('');

  scJQGeneralAdd();

  mainForm = document.getElementById('main_table_form');
  formResize();

  sc_calendar_all_day_click();
  sc_calendar_recurrence_change();

  sc_form_onload();

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
 function formResize()
 {
    var formWidth = mainForm.clientWidth,
        formHeight = mainForm.clientHeight,
        windowHeight = $(window.parent).height();
    if (0 == formWidth || 0 == formHeight)
    {
        setTimeout("formResize()", 50);
    }
    else
    {
        if (formHeight > windowHeight - 100)
        {
            formHeight = windowHeight - 100;
        }
        self.parent.tb_resize(formHeight + 50, formWidth + 50);
    }
 }

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
$str_iframe_body = ('F' == $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['run_iframe'] || 'R' == $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['run_iframe']) ? 'margin: 2px;' : '';
 if (isset($_SESSION['nm_aba_bg_color']))
 {
     $this->Ini->cor_bg_grid = $_SESSION['nm_aba_bg_color'];
     $this->Ini->img_fun_pag = $_SESSION['nm_aba_bg_img'];
 }
if ($GLOBALS["erro_incl"] == 1)
{
    $this->nmgp_opcao = "novo";
    $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['opc_ant'] = "novo";
    $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['recarga'] = "novo";
}
if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['recarga']))
{
    $opcao_botoes = $this->nmgp_opcao;
}
else
{
    $opcao_botoes = $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['recarga'];
}
    $remove_margin = isset($_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['dashboard_info']['remove_margin']) && $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['dashboard_info']['remove_margin'] ? 'margin: 0; ' : '';
    $remove_border = isset($_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['dashboard_info']['remove_border']) && $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['dashboard_info']['remove_border'] ? 'border-width: 0; ' : '';
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['link_info']['remove_margin']) && $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['link_info']['remove_margin']) {
        $remove_margin = 'margin: 0; ';
    }
    if ('' != $remove_margin && isset($str_iframe_body) && '' != $str_iframe_body) {
        $str_iframe_body = '';
    }
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['link_info']['remove_border']) && $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['link_info']['remove_border']) {
        $remove_border = 'border-width: 0; ';
    }
    $vertical_center = '';
?>
<body class="scFormPage sc-app-calendar" style="<?php echo $remove_margin . $str_iframe_body . $vertical_center; ?>">
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
 include_once("calendar_appointments_staff_js0.php");
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
    $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['insert_validation'] = md5(time() . rand(1, 99999));
?>
<input type="hidden" name="nmgp_ins_valid" value="<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['insert_validation']; ?>">
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
$_SESSION['scriptcase']['error_span_title']['calendar_appointments_staff'] = $this->Ini->Error_icon_span;
$_SESSION['scriptcase']['error_icon_title']['calendar_appointments_staff'] = '' != $this->Ini->Err_ico_title ? $this->Ini->path_icones . '/' . $this->Ini->Err_ico_title : '';
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
<tr><td>
<?php
$this->displayTopToolbar();
?>
<?php
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['run_iframe'] != "R")
{
?>
    <table style="border-collapse: collapse; border-width: 0px; width: 100%"><tr><td class="scFormToolbar sc-toolbar-top" style="padding: 0px; spacing: 0px">
    <table style="border-collapse: collapse; border-width: 0px; width: 100%">
    <tr> 
     <td nowrap align="left" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php
}
    $NM_btn = false;
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['run_iframe'] != "R")
{
?> 
     </td> 
     <td nowrap align="center" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php 
    if ($opcao_botoes != "novo") {
        $sCondStyle = ($this->nmgp_botoes['btn_customer'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['btn_disabled']['btn_customer']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['btn_disabled']['btn_customer']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['btn_label']['btn_customer']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['btn_label']['btn_customer']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['btn_label']['btn_customer'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "btn_customer", "scBtnFn_btn_customer()", "scBtnFn_btn_customer()", "sc_btn_customer_top", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if ($opcao_botoes != "novo") {
        $sCondStyle = ($this->nmgp_botoes['btn_service_details'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['btn_disabled']['btn_service_details']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['btn_disabled']['btn_service_details']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['btn_label']['btn_service_details']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['btn_label']['btn_service_details']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['btn_label']['btn_service_details'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "btn_service_details", "scBtnFn_btn_service_details()", "scBtnFn_btn_service_details()", "sc_btn_service_details_top", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
        $NM_btn = true;
    }
?> 
     </td> 
     <td nowrap align="right" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php 
}
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['run_iframe'] != "R")
{
?>
   </td></tr> 
   </table> 
   </td></tr></table> 
<?php
}
?>
<?php
if (!$NM_btn && isset($NM_ult_sep))
{
    echo "    <script language=\"javascript\">";
    echo "      document.getElementById('" .  $NM_ult_sep . "').style.display='none';";
    echo "    </script>";
}
unset($NM_ult_sep);
?>
<?php if ('novo' != $this->nmgp_opcao || $this->Embutida_form) { ?><script>nav_atualiza(Nav_permite_ret, Nav_permite_ava, 't');</script><?php } ?>
</td></tr> 
<tr><td>
<?php
       echo "<div id=\"sc-ui-empty-form\" class=\"scFormPageText\" style=\"padding: 10px; font-weight: bold" . ($this->nmgp_form_empty ? '' : '; display: none') . "\">";
       echo $this->Ini->Nm_lang['lang_errm_empt'];
       echo "</div>";
  if ($this->nmgp_form_empty)
  {
       if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['where_filter']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['empty_filter'] = true;
       }
  }
?>
<?php $sc_hidden_no = 1; $sc_hidden_yes = 0; ?>
   <a name="bloco_0"></a>
   <table width="100%" height="100%" cellpadding="0" cellspacing=0><tr valign="top"><td width="100%" height="">
<div id="div_hidden_bloco_0"><!-- bloco_c -->
<?php
?>
<TABLE align="center" id="hidden_bloco_0" class="scFormTable<?php echo $this->classes_100perc_fields['table'] ?>" width="100%" style="height: 100%;"><?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


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

    <TD class="scFormLabelOdd scUiLabelWidthFix css_current_status_id_label" id="hidden_field_label_current_status_id" style="<?php echo $sStyleHidden_current_status_id; ?>"><span id="id_label_current_status_id"><?php echo $this->nm_new_label['current_status_id']; ?></span></TD>
    <TD class="scFormDataOdd css_current_status_id_line" id="hidden_field_data_current_status_id" style="<?php echo $sStyleHidden_current_status_id; ?>">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["current_status_id"]) &&  $this->nmgp_cmp_readonly["current_status_id"] == "on") { 
 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['Lookup_current_status_id']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['Lookup_current_status_id'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['Lookup_current_status_id']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['Lookup_current_status_id'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['Lookup_current_status_id']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['Lookup_current_status_id'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['Lookup_current_status_id']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['Lookup_current_status_id'] = array(); 
    }

   $old_value_appointment_start_date = $this->appointment_start_date;
   $old_value_appointment_start_time = $this->appointment_start_time;
   $old_value_additional_charges = $this->additional_charges;
   $old_value_discount = $this->discount;
   $old_value_price = $this->price;
   $old_value_total_price = $this->total_price;
   $this->nm_tira_formatacao();
   $this->nm_converte_datas(false);


   $unformatted_value_appointment_start_date = $this->appointment_start_date;
   $unformatted_value_appointment_start_time = $this->appointment_start_time;
   $unformatted_value_additional_charges = $this->additional_charges;
   $unformatted_value_discount = $this->discount;
   $unformatted_value_price = $this->price;
   $unformatted_value_total_price = $this->total_price;

   $__calend_all_day___val_str = "''";
   if (!empty($this->__calend_all_day__))
   {
       if (is_array($this->__calend_all_day__))
       {
           $Tmp_array = $this->__calend_all_day__;
       }
       else
       {
           $Tmp_array = explode(";", $this->__calend_all_day__);
       }
       $__calend_all_day___val_str = "";
       foreach ($Tmp_array as $Tmp_val_cmp)
       {
          if ("" != $__calend_all_day___val_str)
          {
             $__calend_all_day___val_str .= ", ";
          }
          $__calend_all_day___val_str .= "'$Tmp_val_cmp'";
       }
   }
   $nm_comando = "SELECT appointment_status_id, appointment_status_descr  FROM appointment_status  ORDER BY appointment_status_id";

   $this->appointment_start_date = $old_value_appointment_start_date;
   $this->appointment_start_time = $old_value_appointment_start_time;
   $this->additional_charges = $old_value_additional_charges;
   $this->discount = $old_value_discount;
   $this->price = $old_value_price;
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
              $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['Lookup_current_status_id'][] = $rs->fields[0];
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
</TD>
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

    <TD class="scFormLabelOdd scUiLabelWidthFix css_customers_id_label" id="hidden_field_label_customers_id" style="<?php echo $sStyleHidden_customers_id; ?>"><span id="id_label_customers_id"><?php echo $this->nm_new_label['customers_id']; ?></span></TD>
    <TD class="scFormDataOdd css_customers_id_line" id="hidden_field_data_customers_id" style="<?php echo $sStyleHidden_customers_id; ?>">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["customers_id"]) &&  $this->nmgp_cmp_readonly["customers_id"] == "on") { 
 
$nmgp_def_dados = "" ; 
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['Lookup_customers_id']))
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['Lookup_customers_id'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['Lookup_customers_id']); 
}
else
{
    $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['Lookup_customers_id'] = array(); 
}
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
   { 
       $GLOBALS["NM_ERRO_IBASE"] = 1;  
   } 
   $nm_nao_carga = false;
   $nmgp_def_dados = "" ; 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['Lookup_customers_id']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['Lookup_customers_id'] = array_unique($_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['Lookup_customers_id']); 
   }
   else
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['Lookup_customers_id'] = array(); 
    }

   $old_value_appointment_start_date = $this->appointment_start_date;
   $old_value_appointment_start_time = $this->appointment_start_time;
   $old_value_additional_charges = $this->additional_charges;
   $old_value_discount = $this->discount;
   $old_value_price = $this->price;
   $old_value_total_price = $this->total_price;
   $this->nm_tira_formatacao();
   $this->nm_converte_datas(false);


   $unformatted_value_appointment_start_date = $this->appointment_start_date;
   $unformatted_value_appointment_start_time = $this->appointment_start_time;
   $unformatted_value_additional_charges = $this->additional_charges;
   $unformatted_value_discount = $this->discount;
   $unformatted_value_price = $this->price;
   $unformatted_value_total_price = $this->total_price;

   $__calend_all_day___val_str = "''";
   if (!empty($this->__calend_all_day__))
   {
       if (is_array($this->__calend_all_day__))
       {
           $Tmp_array = $this->__calend_all_day__;
       }
       else
       {
           $Tmp_array = explode(";", $this->__calend_all_day__);
       }
       $__calend_all_day___val_str = "";
       foreach ($Tmp_array as $Tmp_val_cmp)
       {
          if ("" != $__calend_all_day___val_str)
          {
             $__calend_all_day___val_str .= ", ";
          }
          $__calend_all_day___val_str .= "'$Tmp_val_cmp'";
       }
   }
   $nm_comando = "SELECT customers_id, customers_name  FROM customers  ORDER BY customers_name";

   $this->appointment_start_date = $old_value_appointment_start_date;
   $this->appointment_start_time = $old_value_appointment_start_time;
   $this->additional_charges = $old_value_additional_charges;
   $this->discount = $old_value_discount;
   $this->price = $old_value_price;
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
              $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['Lookup_customers_id'][] = $rs->fields[0];
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
</TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
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

    <TD class="scFormLabelOdd scUiLabelWidthFix css_appointment_start_date_label" id="hidden_field_label_appointment_start_date" style="<?php echo $sStyleHidden_appointment_start_date; ?>"><span id="id_label_appointment_start_date"><?php echo $this->nm_new_label['appointment_start_date']; ?></span><?php if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['php_cmp_required']['appointment_start_date']) || $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['php_cmp_required']['appointment_start_date'] == "on") { ?> <span class="scFormRequiredOdd">*</span> <?php }?></TD>
    <TD class="scFormDataOdd css_appointment_start_date_line" id="hidden_field_data_appointment_start_date" style="<?php echo $sStyleHidden_appointment_start_date; ?>">
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
&nbsp;<span class="scFormDataHelpOdd"><?php echo $tmp_form_data; ?></span></span><?php } ?>
</TD>
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

    <TD class="scFormLabelOdd scUiLabelWidthFix css_appointment_start_time_label" id="hidden_field_label_appointment_start_time" style="<?php echo $sStyleHidden_appointment_start_time; ?>"><span id="id_label_appointment_start_time"><?php echo $this->nm_new_label['appointment_start_time']; ?></span></TD>
    <TD class="scFormDataOdd css_appointment_start_time_line" id="hidden_field_data_appointment_start_time" style="<?php echo $sStyleHidden_appointment_start_time; ?>">
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
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=8"; } ?> alt="{datatype: 'time', timeSep: '<?php echo $this->field_config['appointment_start_time']['time_sep']; ?>', timeFormat: '<?php echo $this->field_config['appointment_start_time']['date_format']; ?>', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" >&nbsp;<span class="scFormDataHelpOdd"><?php echo $tmp_form_data; ?></span></span><?php } ?>
</TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


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

    <TD class="scFormLabelOdd scUiLabelWidthFix css_additional_charges_label" id="hidden_field_label_additional_charges" style="<?php echo $sStyleHidden_additional_charges; ?>"><span id="id_label_additional_charges"><?php echo $this->nm_new_label['additional_charges']; ?></span></TD>
    <TD class="scFormDataOdd css_additional_charges_line" id="hidden_field_data_additional_charges" style="<?php echo $sStyleHidden_additional_charges; ?>">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["additional_charges"]) &&  $this->nmgp_cmp_readonly["additional_charges"] == "on") { 

 ?>
<input type="hidden" name="additional_charges" value="<?php echo $this->form_encode_input($additional_charges) . "\">" . $additional_charges . ""; ?>
<?php } else { ?>
<span id="id_read_on_additional_charges" class="sc-ui-readonly-additional_charges css_additional_charges_line" style="<?php echo $sStyleReadLab_additional_charges; ?>"><?php echo $this->form_format_readonly("additional_charges", $this->form_encode_input($this->additional_charges)); ?></span><span id="id_read_off_additional_charges" class="css_read_off_additional_charges<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_additional_charges; ?>">
 <input class="sc-js-input scFormObjectOdd css_additional_charges_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_additional_charges" type=text name="additional_charges" value="<?php echo $this->form_encode_input($additional_charges) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=6"; } ?> alt="{datatype: 'decimal', maxLength: 6, precision: 2, decimalSep: '<?php echo str_replace("'", "\'", $this->field_config['additional_charges']['symbol_dec']); ?>', thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['additional_charges']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['additional_charges']['symbol_fmt']; ?>, manualDecimals: false, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['additional_charges']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</TD>
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

    <TD class="scFormLabelOdd scUiLabelWidthFix css_discount_label" id="hidden_field_label_discount" style="<?php echo $sStyleHidden_discount; ?>"><span id="id_label_discount"><?php echo $this->nm_new_label['discount']; ?></span></TD>
    <TD class="scFormDataOdd css_discount_line" id="hidden_field_data_discount" style="<?php echo $sStyleHidden_discount; ?>">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["discount"]) &&  $this->nmgp_cmp_readonly["discount"] == "on") { 

 ?>
<input type="hidden" name="discount" value="<?php echo $this->form_encode_input($discount) . "\">" . $discount . ""; ?>
<?php } else { ?>
<span id="id_read_on_discount" class="sc-ui-readonly-discount css_discount_line" style="<?php echo $sStyleReadLab_discount; ?>"><?php echo $this->form_format_readonly("discount", $this->form_encode_input($this->discount)); ?></span><span id="id_read_off_discount" class="css_read_off_discount<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_discount; ?>">
 <input class="sc-js-input scFormObjectOdd css_discount_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_discount" type=text name="discount" value="<?php echo $this->form_encode_input($discount) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=6"; } ?> alt="{datatype: 'decimal', maxLength: 6, precision: 2, decimalSep: '<?php echo str_replace("'", "\'", $this->field_config['discount']['symbol_dec']); ?>', thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['discount']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['discount']['symbol_fmt']; ?>, manualDecimals: false, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['discount']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 
<?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
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

    <TD class="scFormLabelOdd scUiLabelWidthFix css_price_label" id="hidden_field_label_price" style="<?php echo $sStyleHidden_price; ?>"><span id="id_label_price"><?php echo $this->nm_new_label['price']; ?></span></TD>
    <TD class="scFormDataOdd css_price_line" id="hidden_field_data_price" style="<?php echo $sStyleHidden_price; ?>">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["price"]) &&  $this->nmgp_cmp_readonly["price"] == "on") { 

 ?>
<input type="hidden" name="price" value="<?php echo $this->form_encode_input($price) . "\">" . $price . ""; ?>
<?php } else { ?>
<span id="id_read_on_price" class="sc-ui-readonly-price css_price_line" style="<?php echo $sStyleReadLab_price; ?>"><?php echo $this->form_format_readonly("price", $this->form_encode_input($this->price)); ?></span><span id="id_read_off_price" class="css_read_off_price<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_price; ?>">
 <input class="sc-js-input scFormObjectOdd css_price_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_price" type=text name="price" value="<?php echo $this->form_encode_input($price) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=6"; } ?> alt="{datatype: 'decimal', maxLength: 6, precision: 2, decimalSep: '<?php echo str_replace("'", "\'", $this->field_config['price']['symbol_dec']); ?>', thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['price']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['price']['symbol_fmt']; ?>, manualDecimals: false, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['price']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</TD>
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

    <TD class="scFormLabelOdd scUiLabelWidthFix css_total_price_label" id="hidden_field_label_total_price" style="<?php echo $sStyleHidden_total_price; ?>"><span id="id_label_total_price"><?php echo $this->nm_new_label['total_price']; ?></span></TD>
    <TD class="scFormDataOdd css_total_price_line" id="hidden_field_data_total_price" style="<?php echo $sStyleHidden_total_price; ?>">
<?php if ($bTestReadOnly && $this->nmgp_opcao != "novo" && isset($this->nmgp_cmp_readonly["total_price"]) &&  $this->nmgp_cmp_readonly["total_price"] == "on") { 

 ?>
<input type="hidden" name="total_price" value="<?php echo $this->form_encode_input($total_price) . "\">" . $total_price . ""; ?>
<?php } else { ?>
<span id="id_read_on_total_price" class="sc-ui-readonly-total_price css_total_price_line" style="<?php echo $sStyleReadLab_total_price; ?>"><?php echo $this->form_format_readonly("total_price", $this->form_encode_input($this->total_price)); ?></span><span id="id_read_off_total_price" class="css_read_off_total_price<?php echo $this->classes_100perc_fields['span_input'] ?>" style="white-space: nowrap;<?php echo $sStyleReadInp_total_price; ?>">
 <input class="sc-js-input scFormObjectOdd css_total_price_obj<?php echo $this->classes_100perc_fields['input'] ?>" style="" id="id_sc_field_total_price" type=text name="total_price" value="<?php echo $this->form_encode_input($total_price) ?>"
 <?php if ($this->classes_100perc_fields['keep_field_size']) { echo "size=6"; } ?> alt="{datatype: 'decimal', maxLength: 6, precision: 2, decimalSep: '<?php echo str_replace("'", "\'", $this->field_config['total_price']['symbol_dec']); ?>', thousandsSep: '<?php echo str_replace("'", "\'", $this->field_config['total_price']['symbol_grp']); ?>', thousandsFormat: <?php echo $this->field_config['total_price']['symbol_fmt']; ?>, manualDecimals: false, allowNegative: false, onlyNegative: false, negativePos: <?php echo (4 == $this->field_config['total_price']['format_neg'] ? "'suffix'" : "'prefix'") ?>, alignment: 'left', enterTab: false, enterSubmit: false, autoTab: false, selectOnFocus: true, watermark: '', watermarkClass: 'scFormObjectOddWm', maskChars: '(){}[].,;:-+/ '}" ></span><?php } ?>
</TD>
   <?php }?>

<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 2; ?>" >&nbsp;</TD>
<?php } 
?> 


   </td></tr></table>
   </tr>
</TABLE></div><!-- bloco_f -->
</td></tr> 
<tr><td>
<?php
$this->displayBottomToolbar();
?>
<?php
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['run_iframe'] != "R")
{
?>
    <table style="border-collapse: collapse; border-width: 0px; width: 100%"><tr><td class="scFormToolbar sc-toolbar-bottom" style="padding: 0px; spacing: 0px">
    <table style="border-collapse: collapse; border-width: 0px; width: 100%">
    <tr> 
     <td nowrap align="left" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php
}
    $NM_btn = false;
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['run_iframe'] != "R")
{
    if ($opcao_botoes != "novo") {
        $sCondStyle = ($this->nmgp_botoes['update'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-1';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['btn_disabled']['update']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['btn_disabled']['update']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['btn_label']['update']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['btn_label']['update']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['btn_label']['update'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "balterar", "scBtnFn_sys_format_alt()", "scBtnFn_sys_format_alt()", "sc_b_upd_b", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
        $NM_btn = true;
    }
?> 
     </td> 
     <td nowrap align="center" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php 
?> 
     </td> 
     <td nowrap align="right" valign="middle" width="33%" class="scFormToolbarPadding"> 
<?php 
    if ('' != $this->url_webhelp) {
        $sCondStyle = '';
?>
<?php
        $buttonMacroDisabled = '';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['btn_disabled']['help']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['btn_disabled']['help']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['btn_label']['help']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['btn_label']['help']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['btn_label']['help'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bhelp", "scBtnFn_sys_format_hlp()", "scBtnFn_sys_format_hlp()", "sc_b_hlp_b", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if ((!$this->Embutida_call || $this->form_3versions_single) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (isset($_SESSION['scriptcase']['nm_sc_retorno']) && !empty($_SESSION['scriptcase']['nm_sc_retorno']) && $nm_apl_dependente != 1 && $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['run_iframe'] != "R" && !$this->aba_iframe && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-2';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bsair", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_b", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if ((!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (!isset($_SESSION['scriptcase']['nm_sc_retorno']) || empty($_SESSION['scriptcase']['nm_sc_retorno']) || $nm_apl_dependente == 1 || $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['run_iframe'] == "R" || $this->aba_iframe || $this->nmgp_botoes['exit'] != "on") && ($_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['run_iframe'] != "F" && $this->nmgp_botoes['exit'] == "on") && ($nm_apl_dependente == 1 && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-3';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_b", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
        $NM_btn = true;
    }
    if ((!$this->Embutida_call) && ((!isset($_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['dashboard_info']['under_dashboard']) || !$_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['dashboard_info']['under_dashboard'] || (isset($this->is_calendar_app) && $this->is_calendar_app)))) {
        $sCondStyle = (!isset($_SESSION['scriptcase']['nm_sc_retorno']) || empty($_SESSION['scriptcase']['nm_sc_retorno']) || $nm_apl_dependente == 1 || $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['run_iframe'] == "F" || $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['run_iframe'] == "R" || $this->aba_iframe || $this->nmgp_botoes['exit'] != "on") && ($_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['run_iframe'] != "R" && $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['run_iframe'] != "F" && $this->nmgp_botoes['exit'] == "on") && ($nm_apl_dependente != 1 || $this->nmgp_botoes['exit'] != "on") && ((!$this->aba_iframe || $this->is_calendar_app) && $this->nmgp_botoes['exit'] == "on") ? '' : 'display: none;';
?>
<?php
        $buttonMacroDisabled = 'sc-unique-btn-4';
        $buttonMacroLabel = "";

        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['btn_disabled']['exit']) && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['btn_disabled']['exit']) {
            $buttonMacroDisabled .= ' disabled';
        }
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['btn_label']['exit']) && '' != $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['btn_label']['exit']) {
            $buttonMacroLabel = $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['btn_label']['exit'];
        }
?>
<?php echo nmButtonOutput($this->arr_buttons, "bsair", "scBtnFn_sys_format_sai()", "scBtnFn_sys_format_sai()", "sc_b_sai_b", "", "" . $buttonMacroLabel . "", "" . $sCondStyle . "", "", "", "", $this->Ini->path_botoes, "", "", "" . $buttonMacroDisabled . "", "", "");?>
 
<?php
        $NM_btn = true;
    }
}
if (($this->Embutida_form || !$this->Embutida_call || $this->Grid_editavel || $this->Embutida_multi || ($this->Embutida_call && 'on' == $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['embutida_liga_form_btn_nav'])) && $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['run_iframe'] != "F" && $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['run_iframe'] != "R")
{
?>
   </td></tr> 
   </table> 
   </td></tr></table> 
<?php
}
?>
<?php
if (!$NM_btn && isset($NM_ult_sep))
{
    echo "    <script language=\"javascript\">";
    echo "      document.getElementById('" .  $NM_ult_sep . "').style.display='none';";
    echo "    </script>";
}
unset($NM_ult_sep);
?>
<?php if ('novo' != $this->nmgp_opcao || $this->Embutida_form) { ?><script>nav_atualiza(Nav_permite_ret, Nav_permite_ava, 'b');</script><?php } ?>
</td></tr> 
</table> 
</div> 
</td> 
</tr> 
</table> 

<div id="id_debug_window" style="display: none;" class='scDebugWindow'><table class="scFormMessageTable">
<tr><td class="scFormMessageTitle"><?php echo nmButtonOutput($this->arr_buttons, "berrm_clse", "scAjaxHideDebug()", "scAjaxHideDebug()", "", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "");?>
&nbsp;&nbsp;Output</td></tr>
<tr><td class="scFormMessageMessage" style="padding: 0px; vertical-align: top"><div style="padding: 2px; height: 200px; width: 350px; overflow: auto" id="id_debug_text"></div></td></tr>
</table></div>

</form> 
<script> 
<?php
  $nm_sc_blocos_da_pag = array(0);

  foreach ($this->Ini->nm_hidden_blocos as $bloco => $hidden)
  {
      if ($hidden == "off" && in_array($bloco, $nm_sc_blocos_da_pag))
      {
          echo "document.getElementById('hidden_bloco_" . $bloco . "').style.display = 'none';";
          if (isset($nm_sc_blocos_aba[$bloco]))
          {
               echo "document.getElementById('id_tabs_" . $nm_sc_blocos_aba[$bloco] . "_" . $bloco . "').style.display = 'none';";
          }
      }
  }
?>
</script> 
<script>
<?php
if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['masterValue']))
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['dashboard_info']['under_dashboard']) {
?>
var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['dashboard_info']['parent_widget']; ?>']");
if (dbParentFrame && dbParentFrame[0] && dbParentFrame[0].contentWindow.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['masterValue'] as $cmp_master => $val_master)
        {
?>
    dbParentFrame[0].contentWindow.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['masterValue']);
?>
}
<?php
    }
    else {
?>
if (parent && parent.scAjaxDetailValue)
{
<?php
        foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['masterValue'] as $cmp_master => $val_master)
        {
?>
    parent.scAjaxDetailValue('<?php echo $cmp_master ?>', '<?php echo $val_master ?>');
<?php
        }
        unset($_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['masterValue']);
?>
}
<?php
    }
}
?>
function updateHeaderFooter(sFldName, sFldValue)
{
  if (sFldValue[0] && sFldValue[0]["value"])
  {
    sFldValue = sFldValue[0]["value"];
  }
}
</script>
<?php
if (isset($_POST['master_nav']) && 'on' == $_POST['master_nav'])
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['dashboard_info']['under_dashboard']) {
?>
<script>
 var dbParentFrame = $(parent.document).find("[name='<?php echo $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['dashboard_info']['parent_widget']; ?>']");
 dbParentFrame[0].contentWindow.scAjaxDetailStatus("calendar_appointments_staff");
</script>
<?php
    }
    else {
        $sTamanhoIframe = isset($_POST['sc_ifr_height']) && '' != $_POST['sc_ifr_height'] ? '"' . $_POST['sc_ifr_height'] . '"' : '$(document).innerHeight()';
?>
<script>
 parent.scAjaxDetailStatus("calendar_appointments_staff");
 parent.scAjaxDetailHeight("calendar_appointments_staff", <?php echo $sTamanhoIframe; ?>);
</script>
<?php
    }
}
elseif (isset($_GET['script_case_detail']) && 'Y' == $_GET['script_case_detail'])
{
    if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['dashboard_info']['under_dashboard']) {
    }
    else {
    $sTamanhoIframe = isset($_GET['sc_ifr_height']) && '' != $_GET['sc_ifr_height'] ? '"' . $_GET['sc_ifr_height'] . '"' : '$(document).innerHeight()';
?>
<script>
 if (0 == <?php echo $sTamanhoIframe; ?>) {
  setTimeout(function() {
   parent.scAjaxDetailHeight("calendar_appointments_staff", <?php echo $sTamanhoIframe; ?>);
  }, 100);
 }
 else {
  parent.scAjaxDetailHeight("calendar_appointments_staff", <?php echo $sTamanhoIframe; ?>);
 }
</script>
<?php
    }
}
?>
<?php
if (isset($this->NM_ajax_info['displayMsg']) && $this->NM_ajax_info['displayMsg'])
{
    $isToast   = isset($this->NM_ajax_info['displayMsgToast']) && $this->NM_ajax_info['displayMsgToast'] ? 'true' : 'false';
    $toastType = $isToast && isset($this->NM_ajax_info['displayMsgToastType']) ? $this->NM_ajax_info['displayMsgToastType'] : '';
?>
<script type="text/javascript">
_scAjaxShowMessage({title: scMsgDefTitle, message: "<?php echo $this->NM_ajax_info['displayMsgTxt']; ?>", isModal: false, timeout: sc_ajaxMsgTime, showButton: false, buttonLabel: "Ok", topPos: 0, leftPos: 0, width: 0, height: 0, redirUrl: "", redirTarget: "", redirParam: "", showClose: false, showBodyIcon: true, isToast: <?php echo $isToast ?>, toastPos: "", type: "<?php echo $toastType ?>"});
</script>
<?php
}
?>
<?php
if (isset($this->scFormFocusErrorName) && '' != $this->scFormFocusErrorName)
{
?>
<script>
scAjaxFocusError();
</script>
<?php
}
?>
<script type='text/javascript'>
bLigEditLookupCall = <?php if ($this->lig_edit_lookup_call) { ?>true<?php } else { ?>false<?php } ?>;
function scLigEditLookupCall()
{
<?php
if ($this->lig_edit_lookup && isset($_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['sc_modal'])
{
?>
  parent.<?php echo $this->lig_edit_lookup_cb; ?>(<?php echo $this->lig_edit_lookup_row; ?>);
<?php
}
elseif ($this->lig_edit_lookup)
{
?>
  opener.<?php echo $this->lig_edit_lookup_cb; ?>(<?php echo $this->lig_edit_lookup_row; ?>);
<?php
}
?>
}
if (bLigEditLookupCall)
{
  scLigEditLookupCall();
}
<?php
if (isset($this->redir_modal) && !empty($this->redir_modal))
{
    echo $this->redir_modal;
}
?>
</script>
<?php
if ($this->nmgp_form_empty) {
?>
<script type="text/javascript">
scAjax_displayEmptyForm();
</script>
<?php
}
?>
<script type="text/javascript">
	function scBtnFn_btn_customer() {
		if ($("#sc_btn_customer_top").length && $("#sc_btn_customer_top").is(":visible")) {
		    if ($("#sc_btn_customer_top").hasClass("disabled")) {
		        return;
		    }
			sc_btn_btn_customer()
			 return;
		}
	}
	function scBtnFn_btn_service_details() {
		if ($("#sc_btn_service_details_top").length && $("#sc_btn_service_details_top").is(":visible")) {
		    if ($("#sc_btn_service_details_top").hasClass("disabled")) {
		        return;
		    }
			sc_btn_btn_service_details()
			 return;
		}
	}
	function scBtnFn_sys_format_alt() {
		if ($("#sc_b_upd_b.sc-unique-btn-1").length && $("#sc_b_upd_b.sc-unique-btn-1").is(":visible")) {
		    if ($("#sc_b_upd_b.sc-unique-btn-1").hasClass("disabled")) {
		        return;
		    }
			nm_atualiza ('alterar');
			 return;
		}
	}
	function scBtnFn_sys_format_hlp() {
		if ($("#sc_b_hlp_b").length && $("#sc_b_hlp_b").is(":visible")) {
		    if ($("#sc_b_hlp_b").hasClass("disabled")) {
		        return;
		    }
			window.open('<?php echo $this->url_webhelp; ?>', '', 'resizable, scrollbars'); 
			 return;
		}
	}
	function scBtnFn_sys_format_sai() {
		if ($("#sc_b_sai_b.sc-unique-btn-2").length && $("#sc_b_sai_b.sc-unique-btn-2").is(":visible")) {
		    if ($("#sc_b_sai_b.sc-unique-btn-2").hasClass("disabled")) {
		        return;
		    }
			scFormClose_F6('<?php echo $nm_url_saida; ?>'); return false;
			 return;
		}
		if ($("#sc_b_sai_b.sc-unique-btn-3").length && $("#sc_b_sai_b.sc-unique-btn-3").is(":visible")) {
		    if ($("#sc_b_sai_b.sc-unique-btn-3").hasClass("disabled")) {
		        return;
		    }
			scFormClose_F6('<?php echo $nm_url_saida; ?>'); return false;
			 return;
		}
		if ($("#sc_b_sai_b.sc-unique-btn-4").length && $("#sc_b_sai_b.sc-unique-btn-4").is(":visible")) {
		    if ($("#sc_b_sai_b.sc-unique-btn-4").hasClass("disabled")) {
		        return;
		    }
			scFormClose_F6('<?php echo $nm_url_saida; ?>'); return false;
			 return;
		}
	}
</script>
<script type="text/javascript">
$(function() {
 $("#sc-id-mobile-in").mouseover(function() {
  $(this).css("cursor", "pointer");
 }).click(function() {
  scMobileDisplayControl("in");
 });
 $("#sc-id-mobile-out").mouseover(function() {
  $(this).css("cursor", "pointer");
 }).click(function() {
  scMobileDisplayControl("out");
 });
});
function scMobileDisplayControl(sOption) {
 $("#sc-id-mobile-control").val(sOption);
 nm_atualiza("recarga_mobile");
}
</script>
<?php
       if (isset($_SESSION['scriptcase']['device_mobile']) && $_SESSION['scriptcase']['device_mobile'])
       {
?>
<span id="sc-id-mobile-in"><?php echo $this->Ini->Nm_lang['lang_version_mobile']; ?></span>
<?php
       }
?>
<?php
$_SESSION['sc_session'][$this->Ini->sc_page]['calendar_appointments_staff']['buttonStatus'] = $this->nmgp_botoes;
?>
<script type="text/javascript">
   function sc_session_redir(url_redir)
   {
       if (window.parent && window.parent.document != window.document && typeof window.parent.sc_session_redir === 'function')
       {
           window.parent.sc_session_redir(url_redir);
       }
       else
       {
           if (window.opener && typeof window.opener.sc_session_redir === 'function')
           {
               window.close();
               window.opener.sc_session_redir(url_redir);
           }
           else
           {
               window.location = url_redir;
           }
       }
   }
</script>
</body> 
</html> 
