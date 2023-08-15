<?php

class grid_appointments_json
{
   var $Db;
   var $Erro;
   var $Ini;
   var $Lookup;
   var $nm_data;
   var $Arquivo;
   var $Arquivo_view;
   var $Tit_doc;
   var $sc_proc_grid; 
   var $NM_cmp_hidden = array();

   function __construct()
   {
      $this->nm_data = new nm_data("en_us");
   }


function actionBar_isValidState($buttonName, $buttonState)
{
    return false;
}

   function monta_json()
   {
      $this->inicializa_vars();
      $this->grava_arquivo();
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments']['embutida'])
      {
          if ($this->Ini->sc_export_ajax)
          {
              $this->Arr_result['file_export']  = NM_charset_to_utf8($this->Json_f);
              $this->Arr_result['title_export'] = NM_charset_to_utf8($this->Tit_doc);
              $Temp = ob_get_clean();
              if ($Temp !== false && trim($Temp) != "")
              {
                  $this->Arr_result['htmOutput'] = NM_charset_to_utf8($Temp);
              }
              $result_json = json_encode($this->Arr_result, JSON_UNESCAPED_UNICODE);
              if ($result_json == false)
              {
                  $oJson = new Services_JSON();
                  $result_json = $oJson->encode($this->Arr_result);
              }
              echo $result_json;
              exit;
          }
          else
          {
              $this->progress_bar_end();
          }
      }
      else
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments']['opcao'] = "";
      }
   }

   function inicializa_vars()
   {
      global $nm_lang;
      if (isset($GLOBALS['nmgp_parms']) && !empty($GLOBALS['nmgp_parms'])) 
      { 
          $GLOBALS['nmgp_parms'] = str_replace("@aspass@", "'", $GLOBALS['nmgp_parms']);
          $todox = str_replace("?#?@?@?", "?#?@ ?@?", $GLOBALS["nmgp_parms"]);
          $todo  = explode("?@?", $todox);
          foreach ($todo as $param)
          {
               $cadapar = explode("?#?", $param);
               if (1 < sizeof($cadapar))
               {
                   if (substr($cadapar[0], 0, 11) == "SC_glo_par_")
                   {
                       $cadapar[0] = substr($cadapar[0], 11);
                       $cadapar[1] = $_SESSION[$cadapar[1]];
                   }
                   if (isset($GLOBALS['sc_conv_var'][$cadapar[0]]))
                   {
                       $cadapar[0] = $GLOBALS['sc_conv_var'][$cadapar[0]];
                   }
                   elseif (isset($GLOBALS['sc_conv_var'][strtolower($cadapar[0])]))
                   {
                       $cadapar[0] = $GLOBALS['sc_conv_var'][strtolower($cadapar[0])];
                   }
                   nm_limpa_str_grid_appointments($cadapar[1]);
                   nm_protect_num_grid_appointments($cadapar[0], $cadapar[1]);
                   if ($cadapar[1] == "@ ") {$cadapar[1] = trim($cadapar[1]); }
                   $Tmp_par   = $cadapar[0];
                   $$Tmp_par = $cadapar[1];
                   if ($Tmp_par == "nmgp_opcao")
                   {
                       $_SESSION['sc_session'][$script_case_init]['grid_appointments']['opcao'] = $cadapar[1];
                   }
               }
          }
      }
      if (isset($var_appointment_id)) 
      {
          $_SESSION['var_appointment_id'] = $var_appointment_id;
          nm_limpa_str_grid_appointments($_SESSION["var_appointment_id"]);
      }
      if (isset($usr_login)) 
      {
          $_SESSION['usr_login'] = $usr_login;
          nm_limpa_str_grid_appointments($_SESSION["usr_login"]);
      }
      if (isset($usr_group)) 
      {
          $_SESSION['usr_group'] = $usr_group;
          nm_limpa_str_grid_appointments($_SESSION["usr_group"]);
      }
      if (isset($var_cur_status)) 
      {
          $_SESSION['var_cur_status'] = $var_cur_status;
          nm_limpa_str_grid_appointments($_SESSION["var_cur_status"]);
      }
      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
      $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
      $this->Json_use_label = false;
      $this->Json_format = false;
      $this->Tem_json_res = false;
      $this->Json_password = "";
      if (isset($_REQUEST['nm_json_label']) && !empty($_REQUEST['nm_json_label']))
      {
          $this->Json_use_label = ($_REQUEST['nm_json_label'] == "S") ? true : false;
      }
      if (isset($_REQUEST['nm_json_format']) && !empty($_REQUEST['nm_json_format']))
      {
          $this->Json_format = ($_REQUEST['nm_json_format'] == "S") ? true : false;
      }
      $this->Tem_json_res  = true;
      if (isset($_REQUEST['SC_module_export']) && $_REQUEST['SC_module_export'] != "")
      { 
          $this->Tem_json_res = (strpos(" " . $_REQUEST['SC_module_export'], "resume") !== false) ? true : false;
      } 
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments']['SC_Ind_Groupby'] == "sc_free_total")
      {
          $this->Tem_json_res  = false;
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments']['SC_Ind_Groupby'] == "sc_free_group_by" && empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments']['SC_Gb_Free_cmp']))
      {
          $this->Tem_json_res  = false;
      }
      if (!is_file($this->Ini->root . $this->Ini->path_link . "grid_appointments/grid_appointments_res_json.class.php"))
      {
          $this->Tem_json_res  = false;
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments']['embutida'] && isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments']['json_label']))
      {
          $this->Json_use_label = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments']['json_label'];
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments']['embutida'] && isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments']['json_format']))
      {
          $this->Json_format = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments']['json_format'];
      }
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments']['embutida'] && !$this->Ini->sc_export_ajax) {
          require_once($this->Ini->path_lib_php . "/sc_progress_bar.php");
          $this->pb = new scProgressBar();
          $this->pb->setRoot($this->Ini->root);
          $this->pb->setDir($_SESSION['scriptcase']['grid_appointments']['glo_nm_path_imag_temp'] . "/");
          $this->pb->setProgressbarMd5($_GET['pbmd5']);
          $this->pb->initialize();
          $this->pb->setReturnUrl("./");
          $this->pb->setReturnOption($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments']['json_return']);
          if ($this->Tem_json_res) {
              $PB_plus = intval ($this->count_ger * 0.04);
              $PB_plus = ($PB_plus < 2) ? 2 : $PB_plus;
          }
          else {
              $PB_plus = intval ($this->count_ger * 0.02);
              $PB_plus = ($PB_plus < 1) ? 1 : $PB_plus;
          }
          $PB_tot = $this->count_ger + $PB_plus;
          $this->PB_dif = $PB_tot - $this->count_ger;
          $this->pb->setTotalSteps($PB_tot);
      }
      $this->nm_data = new nm_data("en_us");
      $this->Arquivo      = "sc_json";
      $this->Arquivo     .= "_" . date("YmdHis") . "_" . rand(0, 1000);
      $this->Arq_zip      = $this->Arquivo . "_grid_appointments.zip";
      $this->Arquivo     .= "_grid_appointments";
      $this->Arquivo     .= ".json";
      $this->Tit_doc      = "grid_appointments.json";
      $this->Tit_zip      = "grid_appointments.zip";
   }

   function prep_modulos($modulo)
   {
      $this->$modulo->Ini    = $this->Ini;
      $this->$modulo->Db     = $this->Db;
      $this->$modulo->Erro   = $this->Erro;
      $this->$modulo->Lookup = $this->Lookup;
   }

   function grava_arquivo()
   {
      global $nm_lang;
      global $nm_nada, $nm_lang;

      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->sc_proc_grid = false; 
      $nm_raiz_img  = ""; 
      $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments']['where_orig'];
      $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments']['where_pesq'];
      $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments']['where_pesq_filtro'];
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments']['campos_busca']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments']['campos_busca']))
      { 
          $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments']['campos_busca'];
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
              $Busca_temp = NM_conv_charset($Busca_temp, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->appointments_id = (isset($Busca_temp['appointments_id'])) ? $Busca_temp['appointments_id'] : ""; 
          $tmp_pos = (is_string($this->appointments_id)) ? strpos($this->appointments_id, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->appointments_id))
          {
              $this->appointments_id = substr($this->appointments_id, 0, $tmp_pos);
          }
          $this->appointments_id_2 = (isset($Busca_temp['appointments_id_input_2'])) ? $Busca_temp['appointments_id_input_2'] : ""; 
          $this->staff_id = (isset($Busca_temp['staff_id'])) ? $Busca_temp['staff_id'] : ""; 
          $tmp_pos = (is_string($this->staff_id)) ? strpos($this->staff_id, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->staff_id))
          {
              $this->staff_id = substr($this->staff_id, 0, $tmp_pos);
          }
          $this->staff_id_2 = (isset($Busca_temp['staff_id_input_2'])) ? $Busca_temp['staff_id_input_2'] : ""; 
          $this->customers_id = (isset($Busca_temp['customers_id'])) ? $Busca_temp['customers_id'] : ""; 
          $tmp_pos = (is_string($this->customers_id)) ? strpos($this->customers_id, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->customers_id))
          {
              $this->customers_id = substr($this->customers_id, 0, $tmp_pos);
          }
          $this->customers_id_2 = (isset($Busca_temp['customers_id_input_2'])) ? $Busca_temp['customers_id_input_2'] : ""; 
          $this->price = (isset($Busca_temp['price'])) ? $Busca_temp['price'] : ""; 
          $tmp_pos = (is_string($this->price)) ? strpos($this->price, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->price))
          {
              $this->price = substr($this->price, 0, $tmp_pos);
          }
          $this->price_2 = (isset($Busca_temp['price_input_2'])) ? $Busca_temp['price_input_2'] : ""; 
      } 
      $this->nm_where_dinamico = "";
      $_SESSION['scriptcase']['grid_appointments']['contr_erro'] = 'on';
if (!isset($_SESSION['usr_group'])) {$_SESSION['usr_group'] = "";}
if (!isset($this->sc_temp_usr_group)) {$this->sc_temp_usr_group = (isset($_SESSION['usr_group'])) ? $_SESSION['usr_group'] : "";}
if (!isset($_SESSION['var_cur_status'])) {$_SESSION['var_cur_status'] = "";}
if (!isset($this->sc_temp_var_cur_status)) {$this->sc_temp_var_cur_status = (isset($_SESSION['var_cur_status'])) ? $_SESSION['var_cur_status'] : "";}
  $old_status = $this->sc_temp_var_cur_status;

switch ($this->sc_temp_usr_group){
		case 2:
			$this->nmgp_botoes["btn_rating"] = "off";;			
	
			if($old_status == 1){ 
				$this->nmgp_botoes["btn_cancel"] = "on";;
				$this->nmgp_botoes["btn_checkin"] = "on";;
				$this->nmgp_botoes["btn_conclude"] = "off";;
				$this->nmgp_botoes["btn_reopen"] = "off";;
				$this->nmgp_botoes["btn_invoice"] = "off";;
				$this->nmgp_botoes["btn_billing"] = "off";;
			}elseif($old_status == 2){
				$this->nmgp_botoes["btn_reopen"] = "on";;
				$this->nmgp_botoes["btn_cancel"] = "off";;
				$this->nmgp_botoes["btn_checkin"] = "on";;
				$this->nmgp_botoes["btn_conclude"] = "off";;
				$this->nmgp_botoes["btn_invoice"] = "off";;
				$this->nmgp_botoes["btn_billing"] = "off";;
			}elseif($old_status == 3){
				$this->nmgp_botoes["btn_reopen"] = "off";;
				$this->nmgp_botoes["btn_cancel"] = "off";;
				$this->nmgp_botoes["btn_checkin"] = "off";;
				$this->nmgp_botoes["btn_conclude"] = "off";;
				$this->nmgp_botoes["btn_invoice"] = "off";;
				$this->nmgp_botoes["btn_billing"] = "off";;
			}elseif($old_status == 4){ 
				$this->nmgp_botoes["btn_conclude"] = "on";;
				$this->nmgp_botoes["btn_cancel"] = "off";;
				$this->nmgp_botoes["btn_checkin"] = "off";;
				$this->nmgp_botoes["btn_reopen"] = "off";;
				$this->nmgp_botoes["btn_invoice"] = "off";;
				$this->nmgp_botoes["btn_billing"] = "off";;
			}else{
				$this->nmgp_botoes["btn_conclude"] = "off";;
				$this->nmgp_botoes["btn_cancel"] = "off";;
				$this->nmgp_botoes["btn_checkin"] = "off";;
				$this->nmgp_botoes["btn_reopen"] = "off";;
				$this->nmgp_botoes["btn_invoice"] = "on";;
				$this->nmgp_botoes["btn_billing"] = "on";;
			}
			break;
		
		case 3:
			$this->nmgp_botoes["btn_checkin"] = "off";;
			$this->nmgp_botoes["btn_conclude"] = "off";;
	
			if($old_status == 1){ 
				$this->nmgp_botoes["btn_cancel"] = "on";;
				$this->nmgp_botoes["btn_reopen"] = "off";;
				$this->nmgp_botoes["btn_rating"] = "off";;
				$this->nmgp_botoes["btn_invoice"] = "off";;
				$this->nmgp_botoes["btn_billing"] = "off";;
			}elseif($old_status == 2){
				$this->nmgp_botoes["btn_cancel"] = "on";;
				$this->nmgp_botoes["btn_reopen"] = "on";;				
				$this->nmgp_botoes["btn_rating"] = "off";;
				$this->nmgp_botoes["btn_invoice"] = "off";;
				$this->nmgp_botoes["btn_billing"] = "off";;
			}elseif($old_status == 5){
				$this->nmgp_botoes["btn_cancel"] = "off";;
				$this->nmgp_botoes["btn_reopen"] = "off";;				
				$this->nmgp_botoes["btn_rating"] = "on";;
				$this->nmgp_botoes["btn_invoice"] = "on";;	
				$this->nmgp_botoes["btn_billing"] = "on";;
			}else{
				$this->nmgp_botoes["btn_cancel"] = "off";;
				$this->nmgp_botoes["btn_reopen"] = "off";;				
				$this->nmgp_botoes["btn_rating"] = "off";;
				$this->nmgp_botoes["btn_invoice"] = "off";;
				$this->nmgp_botoes["btn_billing"] = "off";;
			}
			
			break;
		
		default:
			$this->nmgp_botoes["btn_cancel"] = "on";;
			$this->nmgp_botoes["btn_checkin"] = "on";;
			$this->nmgp_botoes["btn_conclude"] = "on";;	
			$this->nmgp_botoes["btn_reopen"] = "on";;
			$this->nmgp_botoes["btn_rating"] = "on";;
			$this->nmgp_botoes["btn_invoice"] = "on";;
			$this->nmgp_botoes["btn_billing"] = "on";;
			break;
	  }
if (isset($this->sc_temp_var_cur_status)) {$_SESSION['var_cur_status'] = $this->sc_temp_var_cur_status;}
if (isset($this->sc_temp_usr_group)) {$_SESSION['usr_group'] = $this->sc_temp_usr_group;}
$_SESSION['scriptcase']['grid_appointments']['contr_erro'] = 'off'; 
      if  (!empty($this->nm_where_dinamico)) 
      {   
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments']['where_pesq'] .= $this->nm_where_dinamico;
      }   
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments']['json_name']))
      {
          $Pos = strrpos($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments']['json_name'], ".");
          if ($Pos === false) {
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments']['json_name'] .= ".json";
          }
          $this->Arquivo = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments']['json_name'];
          $this->Arq_zip = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments']['json_name'];
          $this->Tit_doc = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments']['json_name'];
          $Pos = strrpos($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments']['json_name'], ".");
          if ($Pos !== false) {
              $this->Arq_zip = substr($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments']['json_name'], 0, $Pos);
          }
          $this->Arq_zip .= ".zip";
          $this->Tit_zip  = $this->Arq_zip;
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments']['json_name']);
      }
      $this->arr_export = array('label' => array(), 'lines' => array());
      $this->arr_span   = array();

      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments']['embutida'])
      { 
          $this->Json_f = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
          $this->Zip_f = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arq_zip;
          $json_f = fopen($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo, "w");
      }
      $this->nm_field_dinamico = array();
      $this->nm_order_dinamico = array();
      $nmgp_select_count = "SELECT count(*) AS countTest from " . $this->Ini->nm_tabela; 
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
      { 
          $nmgp_select = "SELECT appointments_id, current_status_id, staff_id, customers_id, price, additional_charges, discount, total_price, str_replace (convert(char(10),appointment_start_date,102), '.', '-') + ' ' + convert(char(8),appointment_start_date,20), str_replace (convert(char(10),appointment_start_time,102), '.', '-') + ' ' + convert(char(8),appointment_start_time,20) from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
      { 
          $nmgp_select = "SELECT appointments_id, current_status_id, staff_id, customers_id, price, additional_charges, discount, total_price, appointment_start_date, appointment_start_time from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      { 
       $nmgp_select = "SELECT appointments_id, current_status_id, staff_id, customers_id, price, additional_charges, discount, total_price, convert(char(23),appointment_start_date,121), convert(char(23),appointment_start_time,121) from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
      { 
          $nmgp_select = "SELECT appointments_id, current_status_id, staff_id, customers_id, price, additional_charges, discount, total_price, appointment_start_date, appointment_start_time from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
      { 
          $nmgp_select = "SELECT appointments_id, current_status_id, staff_id, customers_id, price, additional_charges, discount, total_price, EXTEND(appointment_start_date, YEAR TO DAY), appointment_start_time from " . $this->Ini->nm_tabela; 
      } 
      else 
      { 
          $nmgp_select = "SELECT appointments_id, current_status_id, staff_id, customers_id, price, additional_charges, discount, total_price, appointment_start_date, appointment_start_time from " . $this->Ini->nm_tabela; 
      } 
      $nmgp_select .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments']['where_pesq'];
      $nmgp_select_count .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments']['where_pesq'];
      $nmgp_order_by = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments']['order_grid'];
      $nmgp_select .= $nmgp_order_by; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select_count;
      $rt = $this->Db->Execute($nmgp_select_count);
      if ($rt === false && !$rt->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1)
      {
         $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
         exit;
      }
      $this->count_ger = $rt->fields[0];
      $rt->Close();
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select;
      $rs = $this->Db->Execute($nmgp_select);
      if ($rs === false && !$rs->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1)
      {
         $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
         exit;
      }
      $this->SC_seq_register = 0;
      $this->json_registro = array();
      $this->SC_seq_json   = 0;
      $PB_tot = (isset($this->count_ger) && $this->count_ger > 0) ? "/" . $this->count_ger : "";
      while (!$rs->EOF)
      {
         $this->SC_seq_register++;
         if (!$_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments']['embutida'] && !$this->Ini->sc_export_ajax) {
             $Mens_bar = NM_charset_to_utf8($this->Ini->Nm_lang['lang_othr_prcs']);
             $this->pb->setProgressbarMessage($Mens_bar . ": " . $this->SC_seq_register . $PB_tot);
             $this->pb->addSteps(1);
         }
         $this->appointments_id = $rs->fields[0] ;  
         $this->appointments_id = (string)$this->appointments_id;
         $this->current_status_id = $rs->fields[1] ;  
         $this->current_status_id = (string)$this->current_status_id;
         $this->staff_id = $rs->fields[2] ;  
         $this->staff_id = (string)$this->staff_id;
         $this->customers_id = $rs->fields[3] ;  
         $this->customers_id = (string)$this->customers_id;
         $this->price = $rs->fields[4] ;  
         $this->price =  str_replace(",", ".", $this->price);
         $this->price = (string)$this->price;
         $this->additional_charges = $rs->fields[5] ;  
         $this->additional_charges =  str_replace(",", ".", $this->additional_charges);
         $this->additional_charges = (string)$this->additional_charges;
         $this->discount = $rs->fields[6] ;  
         $this->discount =  str_replace(",", ".", $this->discount);
         $this->discount = (string)$this->discount;
         $this->total_price = $rs->fields[7] ;  
         $this->total_price =  str_replace(",", ".", $this->total_price);
         $this->total_price = (string)$this->total_price;
         $this->appointment_start_date = $rs->fields[8] ;  
         $this->appointment_start_time = $rs->fields[9] ;  
         //----- lookup - current_status_id
         $this->look_current_status_id = $this->current_status_id; 
         $this->Lookup->lookup_current_status_id($this->look_current_status_id, $this->current_status_id) ; 
         $this->look_current_status_id = ($this->look_current_status_id == "&nbsp;") ? "" : $this->look_current_status_id; 
         //----- lookup - staff_id
         $this->look_staff_id = $this->staff_id; 
         $this->Lookup->lookup_staff_id($this->look_staff_id, $this->staff_id) ; 
         $this->look_staff_id = ($this->look_staff_id == "&nbsp;") ? "" : $this->look_staff_id; 
         //----- lookup - customers_id
         $this->look_customers_id = $this->customers_id; 
         $this->Lookup->lookup_customers_id($this->look_customers_id, $this->customers_id) ; 
         $this->look_customers_id = ($this->look_customers_id == "&nbsp;") ? "" : $this->look_customers_id; 
         $this->sc_proc_grid = true; 
         foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments']['field_order'] as $Cada_col)
         { 
            if (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off")
            { 
                $NM_func_exp = "NM_export_" . $Cada_col;
                $this->$NM_func_exp();
            } 
         } 
         $this->SC_seq_json++;
         $rs->MoveNext();
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments']['embutida'])
      { 
          $_SESSION['scriptcase']['export_return'] = $this->json_registro;
      }
      else
      { 
          $result_json = json_encode($this->json_registro, JSON_UNESCAPED_UNICODE);
          if ($result_json == false)
          {
              $oJson = new Services_JSON();
              $result_json = $oJson->encode($this->json_registro);
          }
          fwrite($json_f, $result_json);
          fclose($json_f);
          if ($this->Tem_json_res)
          { 
              if (!$this->Ini->sc_export_ajax) {
                  $this->PB_dif = intval ($this->PB_dif / 2);
                  $Mens_bar  = NM_charset_to_utf8($this->Ini->Nm_lang['lang_othr_prcs']);
                  $Mens_smry = NM_charset_to_utf8($this->Ini->Nm_lang['lang_othr_smry_titl']);
                  $this->pb->setProgressbarMessage($Mens_bar . ": " . $Mens_smry);
                  $this->pb->addSteps($this->PB_dif);
              }
              require_once($this->Ini->path_aplicacao . "grid_appointments_res_json.class.php");
              $this->Res = new grid_appointments_res_json();
              $this->prep_modulos("Res");
              $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments']['json_res_grid'] = true;
              $this->Res->monta_json();
          } 
          if (!$this->Ini->sc_export_ajax) {
              $Mens_bar = NM_charset_to_utf8($this->Ini->Nm_lang['lang_btns_export_finished']);
              $this->pb->setProgressbarMessage($Mens_bar);
              $this->pb->addSteps($this->PB_dif);
          }
          if ($this->Json_password != "" || $this->Tem_json_res)
          { 
              $str_zip    = "";
              $Parm_pass  = ($this->Json_password != "") ? " -p" : "";
              $Zip_f      = (FALSE !== strpos($this->Zip_f, ' ')) ? " \"" . $this->Zip_f . "\"" :  $this->Zip_f;
              $Arq_input  = (FALSE !== strpos($this->Json_f, ' ')) ? " \"" . $this->Json_f . "\"" :  $this->Json_f;
              if (is_file($Zip_f)) {
                  unlink($Zip_f);
              }
              if (FALSE !== strpos(strtolower(php_uname()), 'windows')) 
              {
                  chdir($this->Ini->path_third . "/zip/windows");
                  $str_zip = "zip.exe " . strtoupper($Parm_pass) . " -j " . $this->Json_password . " " . $Zip_f . " " . $Arq_input;
              }
              elseif (FALSE !== strpos(strtolower(php_uname()), 'linux')) 
              {
                  if (FALSE !== strpos(strtolower(php_uname()), 'i686')) 
                  {
                      chdir($this->Ini->path_third . "/zip/linux-i386/bin");
                  }
                  else
                  {
                      chdir($this->Ini->path_third . "/zip/linux-amd64/bin");
                  }
                  $str_zip = "./7za " . $Parm_pass . $this->Json_password . " a " . $Zip_f . " " . $Arq_input;
              }
              elseif (FALSE !== strpos(strtolower(php_uname()), 'darwin'))
              {
                  chdir($this->Ini->path_third . "/zip/mac/bin");
                  $str_zip = "./7za " . $Parm_pass . $this->Json_password . " a " . $Zip_f . " " . $Arq_input;
              }
              if (!empty($str_zip)) {
                  exec($str_zip);
              }
              // ----- ZIP log
              $fp = @fopen(trim(str_replace(array(".zip",'"'), array(".log",""), $Zip_f)), 'w');
              if ($fp)
              {
                  @fwrite($fp, $str_zip . "\r\n\r\n");
                  @fclose($fp);
              }
              unlink($Arq_input);
              $this->Arquivo = $this->Arq_zip;
              $this->Json_f   = $this->Zip_f;
              $this->Tit_doc = $this->Tit_zip;
              if ($this->Tem_json_res)
              { 
                  $str_zip   = "";
                  $Arq_res   = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments']['json_res_file']['json'];
                  $Arq_input = (FALSE !== strpos($Arq_res, ' ')) ? " \"" . $Arq_res . "\"" :  $Arq_res;
                  if (FALSE !== strpos(strtolower(php_uname()), 'windows')) 
                  {
                      $str_zip = "zip.exe " . strtoupper($Parm_pass) . " -j -u " . $this->Json_password . " " . $Zip_f . " " . $Arq_input;
                  }
                  elseif (FALSE !== strpos(strtolower(php_uname()), 'linux')) 
                  {
                      $str_zip = "./7za " . $Parm_pass . $this->Json_password . " a " . $Zip_f . " " . $Arq_input;
                  }
                  elseif (FALSE !== strpos(strtolower(php_uname()), 'darwin'))
                  {
                      $str_zip = "./7za " . $Parm_pass . $this->Json_password . " a " . $Zip_f . " " . $Arq_input;
                  }
                  if (!empty($str_zip)) {
                      exec($str_zip);
                  }
                  // ----- ZIP log
                  $fp = @fopen(trim(str_replace(array(".zip",'"'), array(".log",""), $Zip_f)), 'a');
                  if ($fp)
                  {
                      @fwrite($fp, $str_zip . "\r\n\r\n");
                      @fclose($fp);
                  }
                  unlink($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments']['json_res_file']['json']);
              }
              unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments']['json_res_grid']);
          } 
      }
      if(isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments']['export_sel_columns']['field_order']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments']['field_order'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments']['export_sel_columns']['field_order'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments']['export_sel_columns']['field_order']);
      }
      if(isset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments']['export_sel_columns']['usr_cmp_sel']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments']['usr_cmp_sel'] = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments']['export_sel_columns']['usr_cmp_sel'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments']['export_sel_columns']['usr_cmp_sel']);
      }
      $rs->Close();
   }
   //----- appointments_id
   function NM_export_appointments_id()
   {
         if ($this->Json_format)
         {
             nmgp_Form_Num_Val($this->appointments_id, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         }
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['appointments_id'])) ? $this->New_label['appointments_id'] : "" . $this->Ini->Nm_lang['lang_appointments_fld_appointments_id'] . ""; 
         }
         else
         {
             $SC_Label = "appointments_id"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->appointments_id;
   }
   //----- current_status_id
   function NM_export_current_status_id()
   {
         nmgp_Form_Num_Val($this->look_current_status_id, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         $this->look_current_status_id = NM_charset_to_utf8($this->look_current_status_id);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['current_status_id'])) ? $this->New_label['current_status_id'] : "" . $this->Ini->Nm_lang['lang_appointments_fld_current_status_id'] . ""; 
         }
         else
         {
             $SC_Label = "current_status_id"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->look_current_status_id;
   }
   //----- staff_id
   function NM_export_staff_id()
   {
         nmgp_Form_Num_Val($this->look_staff_id, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         $this->look_staff_id = NM_charset_to_utf8($this->look_staff_id);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['staff_id'])) ? $this->New_label['staff_id'] : "" . $this->Ini->Nm_lang['lang_appointments_fld_staff_id'] . ""; 
         }
         else
         {
             $SC_Label = "staff_id"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->look_staff_id;
   }
   //----- customers_id
   function NM_export_customers_id()
   {
         nmgp_Form_Num_Val($this->look_customers_id, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         $this->look_customers_id = NM_charset_to_utf8($this->look_customers_id);
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['customers_id'])) ? $this->New_label['customers_id'] : "" . $this->Ini->Nm_lang['lang_appointments_fld_customers_id'] . ""; 
         }
         else
         {
             $SC_Label = "customers_id"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->look_customers_id;
   }
   //----- price
   function NM_export_price()
   {
         if ($this->Json_format)
         {
             nmgp_Form_Num_Val($this->price, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
         }
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['price'])) ? $this->New_label['price'] : "" . $this->Ini->Nm_lang['lang_appointments_fld_price'] . ""; 
         }
         else
         {
             $SC_Label = "price"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->price;
   }
   //----- additional_charges
   function NM_export_additional_charges()
   {
         if ($this->Json_format)
         {
             nmgp_Form_Num_Val($this->additional_charges, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
         }
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['additional_charges'])) ? $this->New_label['additional_charges'] : "" . $this->Ini->Nm_lang['lang_appointments_fld_additional_charges'] . ""; 
         }
         else
         {
             $SC_Label = "additional_charges"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->additional_charges;
   }
   //----- discount
   function NM_export_discount()
   {
         if ($this->Json_format)
         {
             nmgp_Form_Num_Val($this->discount, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
         }
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['discount'])) ? $this->New_label['discount'] : "" . $this->Ini->Nm_lang['lang_appointments_fld_discount'] . ""; 
         }
         else
         {
             $SC_Label = "discount"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->discount;
   }
   //----- total_price
   function NM_export_total_price()
   {
         if ($this->Json_format)
         {
             nmgp_Form_Num_Val($this->total_price, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
         }
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['total_price'])) ? $this->New_label['total_price'] : "" . $this->Ini->Nm_lang['lang_appointments_fld_total_price'] . ""; 
         }
         else
         {
             $SC_Label = "total_price"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->total_price;
   }
   //----- appointment_start_date
   function NM_export_appointment_start_date()
   {
         if ($this->Json_format)
         {
             $conteudo_x =  $this->appointment_start_date;
             nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
             if (is_numeric($conteudo_x) && strlen($conteudo_x) > 0) 
             { 
                 $this->nm_data->SetaData($this->appointment_start_date, "YYYY-MM-DD  ");
                 $this->appointment_start_date = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
             } 
         }
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['appointment_start_date'])) ? $this->New_label['appointment_start_date'] : "" . $this->Ini->Nm_lang['lang_appointments_fld_appointment_start_date'] . ""; 
         }
         else
         {
             $SC_Label = "appointment_start_date"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->appointment_start_date;
   }
   //----- appointment_start_time
   function NM_export_appointment_start_time()
   {
         if ($this->Json_format)
         {
             $conteudo_x =  $this->appointment_start_time;
             nm_conv_limpa_dado($conteudo_x, "HH:II:SS");
             if (is_numeric($conteudo_x) && strlen($conteudo_x) > 0) 
             { 
                 $this->nm_data->SetaData($this->appointment_start_time, "HH:II:SS  ");
                 $this->appointment_start_time = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("HH", "hhiiss"));
             } 
         }
         if ($this->Json_use_label)
         {
             $SC_Label = (isset($this->New_label['appointment_start_time'])) ? $this->New_label['appointment_start_time'] : "" . $this->Ini->Nm_lang['lang_appointments_fld_appointment_start_time'] . ""; 
         }
         else
         {
             $SC_Label = "appointment_start_time"; 
         }
         $SC_Label = NM_charset_to_utf8($SC_Label); 
         $this->json_registro[$this->SC_seq_json][$SC_Label] = $this->appointment_start_time;
   }

   function nm_conv_data_db($dt_in, $form_in, $form_out)
   {
       $dt_out = $dt_in;
       if (strtoupper($form_in) == "DB_FORMAT") {
           if ($dt_out == "null" || $dt_out == "")
           {
               $dt_out = "";
               return $dt_out;
           }
           $form_in = "AAAA-MM-DD";
       }
       if (strtoupper($form_out) == "DB_FORMAT") {
           if (empty($dt_out))
           {
               $dt_out = "null";
               return $dt_out;
           }
           $form_out = "AAAA-MM-DD";
       }
       if (strtoupper($form_out) == "SC_FORMAT_REGION") {
           $this->nm_data->SetaData($dt_in, strtoupper($form_in));
           $prep_out  = (strpos(strtolower($form_in), "dd") !== false) ? "dd" : "";
           $prep_out .= (strpos(strtolower($form_in), "mm") !== false) ? "mm" : "";
           $prep_out .= (strpos(strtolower($form_in), "aa") !== false) ? "aaaa" : "";
           $prep_out .= (strpos(strtolower($form_in), "yy") !== false) ? "aaaa" : "";
           return $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", $prep_out));
       }
       else {
           nm_conv_form_data($dt_out, $form_in, $form_out);
           return $dt_out;
       }
   }
   function progress_bar_end()
   {
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments']['json_file']);
      if (is_file($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments']['json_file'] = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      }
      $path_doc_md5 = md5($this->Ini->path_imag_temp . "/" . $this->Arquivo);
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments'][$path_doc_md5][0] = $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments'][$path_doc_md5][1] = $this->Tit_doc;
      $Mens_bar = $this->Ini->Nm_lang['lang_othr_file_msge'];
      if ($_SESSION['scriptcase']['charset'] != "UTF-8") {
          $Mens_bar = sc_convert_encoding($Mens_bar, "UTF-8", $_SESSION['scriptcase']['charset']);
      }
      $this->pb->setProgressbarMessage($Mens_bar);
      $this->pb->setDownloadLink($this->Ini->path_imag_temp . "/" . $this->Arquivo);
      $this->pb->setDownloadMd5($path_doc_md5);
      $this->pb->completed();
   }
   function monta_html()
   {
      global $nm_url_saida, $nm_lang;
      include($this->Ini->path_btn . $this->Ini->Str_btn_grid);
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments']['json_file']);
      if (is_file($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments']['json_file'] = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      }
      $path_doc_md5 = md5($this->Ini->path_imag_temp . "/" . $this->Arquivo);
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments'][$path_doc_md5][0] = $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments'][$path_doc_md5][1] = $this->Tit_doc;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
            "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE><?php echo $this->Ini->Nm_lang['lang_othr_grid_titl'] ?> - <?php echo $this->Ini->Nm_lang['lang_tbl_appointments'] ?> :: JSON</TITLE>
 <META http-equiv="Content-Type" content="text/html; charset=<?php echo $_SESSION['scriptcase']['charset_html'] ?>" />
<?php
if ($_SESSION['scriptcase']['proc_mobile'])
{
?>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<?php
}
?>
 <META http-equiv="Expires" content="Fri, Jan 01 1900 00:00:00 GMT"/>
 <META http-equiv="Last-Modified" content="<?php echo gmdate("D, d M Y H:i:s"); ?> GMT"/>
 <META http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate"/>
 <META http-equiv="Cache-Control" content="post-check=0, pre-check=0"/>
 <META http-equiv="Pragma" content="no-cache"/>
 <link rel="shortcut icon" href="../_lib/img/sys__NM__img__NM__1402365182_app_type_car_dealer_512px_GREY.png">
  <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_all ?>_export.css" /> 
  <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_all ?>_export<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" /> 
 <?php
 if(isset($this->Ini->str_google_fonts) && !empty($this->Ini->str_google_fonts))
 {
 ?>
    <link rel="stylesheet" type="text/css" href="<?php echo $this->Ini->str_google_fonts ?>" />
 <?php
 }
 ?>
  <link rel="stylesheet" type="text/css" href="../_lib/buttons/<?php echo $this->Ini->Str_btn_css ?>" /> 
</HEAD>
<BODY class="scExportPage">
<?php echo $this->Ini->Ajax_result_set ?>
<table style="border-collapse: collapse; border-width: 0; height: 100%; width: 100%"><tr><td style="padding: 0; text-align: center; vertical-align: middle">
 <table class="scExportTable" align="center">
  <tr>
   <td class="scExportTitle" style="height: 25px">JSON</td>
  </tr>
  <tr>
   <td class="scExportLine" style="width: 100%">
    <table style="border-collapse: collapse; border-width: 0; width: 100%"><tr><td class="scExportLineFont" style="padding: 3px 0 0 0" id="idMessage">
    <?php echo $this->Ini->Nm_lang['lang_othr_file_msge'] ?>
    </td><td class="scExportLineFont" style="text-align:right; padding: 3px 0 0 0">
     <?php echo nmButtonOutput($this->arr_buttons, "bdownload", "document.Fdown.submit()", "document.Fdown.submit()", "idBtnDown", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
 ?>
     <?php echo nmButtonOutput($this->arr_buttons, "bvoltar", "document.F0.submit()", "document.F0.submit()", "idBtnBack", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
 ?>
    </td></tr></table>
   </td>
  </tr>
 </table>
</td></tr></table>
<form name="Fview" method="get" action="<?php echo $this->Ini->path_imag_temp . "/" . $this->Arquivo_view ?>" target="_blank" style="display: none"> 
</form>
<form name="Fdown" method="get" action="grid_appointments_download.php" target="_blank" style="display: none"> 
<input type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<input type="hidden" name="nm_tit_doc" value="grid_appointments"> 
<input type="hidden" name="nm_name_doc" value="<?php echo $path_doc_md5 ?>"> 
</form>
<FORM name="F0" method=post action="./" style="display: none"> 
<INPUT type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<INPUT type="hidden" name="nmgp_opcao" value="<?php echo NM_encode_input($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments']['json_return']); ?>"> 
</FORM> 
</BODY>
</HTML>
<?php
   }
   function nm_gera_mask(&$nm_campo, $nm_mask)
   { 
      $trab_campo = $nm_campo;
      $trab_mask  = $nm_mask;
      $tam_campo  = strlen($nm_campo);
      $trab_saida = "";
      $str_highlight_ini = "";
      $str_highlight_fim = "";
      if(substr($nm_campo, 0, 23) == '<div class="highlight">' && substr($nm_campo, -6) == '</div>')
      {
           $str_highlight_ini = substr($nm_campo, 0, 23);
           $str_highlight_fim = substr($nm_campo, -6);

           $trab_campo = substr($nm_campo, 23, -6);
           $tam_campo  = strlen($trab_campo);
      }      $mask_num = false;
      for ($x=0; $x < strlen($trab_mask); $x++)
      {
          if (substr($trab_mask, $x, 1) == "#")
          {
              $mask_num = true;
              break;
          }
      }
      if ($mask_num )
      {
          $ver_duas = explode(";", $trab_mask);
          if (isset($ver_duas[1]) && !empty($ver_duas[1]))
          {
              $cont1 = count(explode("#", $ver_duas[0])) - 1;
              $cont2 = count(explode("#", $ver_duas[1])) - 1;
              if ($tam_campo >= $cont2)
              {
                  $trab_mask = $ver_duas[1];
              }
              else
              {
                  $trab_mask = $ver_duas[0];
              }
          }
          $tam_mask = strlen($trab_mask);
          $xdados = 0;
          for ($x=0; $x < $tam_mask; $x++)
          {
              if (substr($trab_mask, $x, 1) == "#" && $xdados < $tam_campo)
              {
                  $trab_saida .= substr($trab_campo, $xdados, 1);
                  $xdados++;
              }
              elseif ($xdados < $tam_campo)
              {
                  $trab_saida .= substr($trab_mask, $x, 1);
              }
          }
          if ($xdados < $tam_campo)
          {
              $trab_saida .= substr($trab_campo, $xdados);
          }
          $nm_campo = $str_highlight_ini . $trab_saida . $str_highlight_ini;
          return;
      }
      for ($ix = strlen($trab_mask); $ix > 0; $ix--)
      {
           $char_mask = substr($trab_mask, $ix - 1, 1);
           if ($char_mask != "x" && $char_mask != "z")
           {
               $trab_saida = $char_mask . $trab_saida;
           }
           else
           {
               if ($tam_campo != 0)
               {
                   $trab_saida = substr($trab_campo, $tam_campo - 1, 1) . $trab_saida;
                   $tam_campo--;
               }
               else
               {
                   $trab_saida = "0" . $trab_saida;
               }
           }
      }
      if ($tam_campo != 0)
      {
          $trab_saida = substr($trab_campo, 0, $tam_campo) . $trab_saida;
          $trab_mask  = str_repeat("z", $tam_campo) . $trab_mask;
      }
   
      $iz = 0; 
      for ($ix = 0; $ix < strlen($trab_mask); $ix++)
      {
           $char_mask = substr($trab_mask, $ix, 1);
           if ($char_mask != "x" && $char_mask != "z")
           {
               if ($char_mask == "." || $char_mask == ",")
               {
                   $trab_saida = substr($trab_saida, 0, $iz) . substr($trab_saida, $iz + 1);
               }
               else
               {
                   $iz++;
               }
           }
           elseif ($char_mask == "x" || substr($trab_saida, $iz, 1) != "0")
           {
               $ix = strlen($trab_mask) + 1;
           }
           else
           {
               $trab_saida = substr($trab_saida, 0, $iz) . substr($trab_saida, $iz + 1);
           }
      }
      $nm_campo = $str_highlight_ini . $trab_saida . $str_highlight_ini;
   } 
function execute_btn($var_stat)
{
$_SESSION['scriptcase']['grid_appointments']['contr_erro'] = 'on';
if (!isset($_SESSION['var_cur_status'])) {$_SESSION['var_cur_status'] = "";}
if (!isset($this->sc_temp_var_cur_status)) {$this->sc_temp_var_cur_status = (isset($_SESSION['var_cur_status'])) ? $_SESSION['var_cur_status'] : "";}
if (!isset($_SESSION['usr_login'])) {$_SESSION['usr_login'] = "";}
if (!isset($this->sc_temp_usr_login)) {$this->sc_temp_usr_login = (isset($_SESSION['usr_login'])) ? $_SESSION['usr_login'] : "";}
if (!isset($_SESSION['var_appointment_id'])) {$_SESSION['var_appointment_id'] = "";}
if (!isset($this->sc_temp_var_appointment_id)) {$this->sc_temp_var_appointment_id = (isset($_SESSION['var_appointment_id'])) ? $_SESSION['var_appointment_id'] : "";}
  
$sql_emails = "
SELECT
   customers.customers_email,
   staff.staff_email,
   customers.customers_name,
   staff.staff_name,
   appointment_status.appointment_status_descr
FROM
   (((appointments INNER JOIN appointment_status ON appointments.current_status_id = appointment_status.appointment_status_id)
   INNER JOIN customers ON appointments.customers_id = customers.customers_id)
   INNER JOIN staff ON appointments.staff_id = staff.staff_id) 
WHERE appointments.appointments_id = ".$this->sc_temp_var_appointment_id;

 
      $nm_select = $sql_emails; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->ds = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->ds[$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->ds = false;
          $this->ds_erro = $this->Db->ErrorMsg();
      } 



$sql_upd = "UPDATE appointments SET current_status_id = ".$var_stat." WHERE appointments_id = ".$this->sc_temp_var_appointment_id;

     $nm_select = $sql_upd; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             if ($this->Ini->sc_tem_trans_banco)
             {
                 $this->Db->RollbackTrans(); 
                 $this->Ini->sc_tem_trans_banco = false;
             }
             exit;
         }
         $rf->Close();
      


$emails = $this->ds[0][0] . ";" . $this->ds[0][1];
$dscustomername = $this->ds[0][2];
$dsstaffname = $this->ds[0][3];
$dsstatus =$this->ds[0][4];


switch($var_stat){
	case 1: $stat_name = $this->Ini->Nm_lang['lang_reschedule'];
	break;
	case 3: $stat_name = $this->Ini->Nm_lang['lang_canceled'];
	break;
	case 4: $stat_name = $this->Ini->Nm_lang['lang_checkin'];
	break;
	case 5: $stat_name = $this->Ini->Nm_lang['lang_concluded'];
	break;	
}

$hist_desc = "Cita Actualizada".
"<br/>"."Estado cambiado de".": ".$dsstatus." a ".$stat_name;

$today = date('Y-m-d');
$insert_sql = "INSERT INTO appointments_history (appointments_history_date, sec_users_login, appointments_history_descr, appointments_id, appointment_status_id) 
VALUES (".$this->Ini->sc_Sql_Protect($today, "date").", '".$this->sc_temp_usr_login."','".$hist_desc."',".$this->sc_temp_var_appointment_id.", ".$var_stat.")";


     $nm_select = $insert_sql; 
         $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
         $rf = $this->Db->Execute($nm_select);
         if ($rf === false)
         {
             $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg());
             if ($this->Ini->sc_tem_trans_banco)
             {
                 $this->Db->RollbackTrans(); 
                 $this->Ini->sc_tem_trans_banco = false;
             }
             exit;
         }
         $rf->Close();
      

$this->sc_temp_var_cur_status = $var_stat;

   $this->send_email($this->sc_temp_var_appointment_id, $emails, $hist_desc);

echo 'NOTIFICACION ENVIADA - ESTADO ACTUALIZADO';
if (isset($this->sc_temp_var_appointment_id)) {$_SESSION['var_appointment_id'] = $this->sc_temp_var_appointment_id;}
if (isset($this->sc_temp_usr_login)) {$_SESSION['usr_login'] = $this->sc_temp_usr_login;}
if (isset($this->sc_temp_var_cur_status)) {$_SESSION['var_cur_status'] = $this->sc_temp_var_cur_status;}
$_SESSION['scriptcase']['grid_appointments']['contr_erro'] = 'off';
}
function send_email($appointment_id, $copies, $message){
$_SESSION['scriptcase']['grid_appointments']['contr_erro'] = 'on';
  
		$subject = "AUTO CLEAN citas - ID ".$appointment_id." Actualizada";
		
		    include_once($this->Ini->path_third . "/swift/swift_required.php");
    $sc_mail_port     = "465";
    $sc_mail_tp_port  = "S";
    $sc_mail_tp_mens  = "H";
    $sc_mail_tp_copy  = "BCC";
    $this->sc_mail_count = 0;
    $this->sc_mail_erro  = "";
    $this->sc_mail_ok    = true;
    if ($sc_mail_tp_port == "S" || $sc_mail_tp_port == "Y")
    {
        $sc_mail_port = !empty($sc_mail_port) ? $sc_mail_port : 465;
        $Con_Mail = Swift_SmtpTransport::newInstance("smtp.gmail.com", $sc_mail_port, 'ssl');
    }
    elseif ($sc_mail_tp_port == "T")
    {
        $sc_mail_port = !empty($sc_mail_port) ? $sc_mail_port : 587;
        $Con_Mail = Swift_SmtpTransport::newInstance("smtp.gmail.com", $sc_mail_port, 'tls');
    }
    else
    {
        $sc_mail_port = !empty($sc_mail_port) ? $sc_mail_port : 25;
        $Con_Mail = Swift_SmtpTransport::newInstance("smtp.gmail.com", $sc_mail_port);
    }
    $Con_Mail->setUsername("gnahinmsandoval@gmail.com");
    $Con_Mail->setpassword("uvkdwjknrbffopzl");
    $Send_Mail = Swift_Mailer::newInstance($Con_Mail);
    if ($sc_mail_tp_mens == "H")
    {
        $Mens_Mail = Swift_Message::newInstance($subject)->setBody($message)->setContentType("text/html");
    }
    else
    {
        $Mens_Mail = Swift_Message::newInstance($subject)->setBody($message);
    }
    if (!empty($_SESSION['scriptcase']['charset']))
    {
        $Mens_Mail->setCharset($_SESSION['scriptcase']['charset']);
    }
    $Temp_mail = explode(";", "gnahinmsandoval@gmail.com");
    foreach ($Temp_mail as $NM_dest)
    {
        if (!empty($NM_dest))
        {
            $Arr_addr = SC_Mail_Address($NM_dest);
            $Mens_Mail->addTo($Arr_addr[0], $Arr_addr[1]);
        }
    }
    $Temp_mail = $copies;
    if (!is_array($Temp_mail))
    {
        $Temp_mail = explode(";", $copies);
    }
    foreach ($Temp_mail as $NM_dest)
    {
        if (!empty($NM_dest))
        {
            $Arr_addr = SC_Mail_Address($NM_dest);
            if (strtoupper(substr($sc_mail_tp_copy, 0, 2)) == "CC")
            {
                $Mens_Mail->addCc($Arr_addr[0], $Arr_addr[1]);
            }
            else
            {
                $Mens_Mail->addBcc($Arr_addr[0], $Arr_addr[1]);
            }
        }
    }
    $Arr_addr = SC_Mail_Address("Auto Clean<gnahinmsandoval@gmail.com>");
    $Err_mail = array();
    $this->sc_mail_count = $Send_Mail->send($Mens_Mail->setFrom($Arr_addr[0], $Arr_addr[1]), $Err_mail);
    if (!empty($Err_mail))
    {
        $this->sc_mail_erro = $Err_mail;
        $this->sc_mail_ok   = false;
    }
;
		if ($this->sc_mail_ok ) {

			echo "<script>alert('MENSAJE ENVIADO EXITOSAMENTE!');</script>";


		} else { 	

			
 if (!isset($this->Campos_Mens_erro)){$this->Campos_Mens_erro = "";}
 if (!empty($this->Campos_Mens_erro)){$this->Campos_Mens_erro .= "<br>";}$this->Campos_Mens_erro .= "MENSAJE NO ENVIADO!";
;
		}
$_SESSION['scriptcase']['grid_appointments']['contr_erro'] = 'off';
}
}

?>
