<?php

class appointment_invoice_xml
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
   var $count_ger;

   //---- 
   function __construct()
   {
      $this->nm_data   = new nm_data("en_us");
   }


function actionBar_isValidState($buttonName, $buttonState)
{
    switch ($buttonName) {
    }

    return false;
}


function actionBar_displayState($buttonName)
{
    switch ($buttonName) {
    }
}

function actionBar_getStateHint($buttonName)
{
    switch ($buttonName) {
    }
}

function actionBar_getStateConfirm($buttonName)
{
    switch ($buttonName) {
    }
}

function actionBar_getStateDisable($buttonName)
{
    if (isset($this->sc_actionbar_disabled[$buttonName]) && $this->sc_actionbar_disabled[$buttonName]) {
        return ' disabled';
    }

    return '';
}

function actionBar_getStateHide($buttonName)
{
    if (isset($this->sc_actionbar_hidden[$buttonName]) && $this->sc_actionbar_hidden[$buttonName]) {
        return ' sc-actionbar-button-hidden';
    }

    return '';
}

   //---- 
   function monta_xml()
   {
      $this->inicializa_vars();
      $this->grava_arquivo();
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['embutida'])
      {
          if ($this->Ini->sc_export_ajax)
          {
              $this->Arr_result['file_export']  = NM_charset_to_utf8($this->Xml_f);
              $this->Arr_result['title_export'] = NM_charset_to_utf8($this->Tit_doc);
              $Temp = ob_get_clean();
              if ($Temp !== false && trim($Temp) != "")
              {
                  $this->Arr_result['htmOutput'] = NM_charset_to_utf8($Temp);
              }
              $oJson = new Services_JSON();
              echo $oJson->encode($this->Arr_result);
              exit;
          }
          else
          {
              $this->progress_bar_end();
          }
      }
      else
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['opcao'] = "";
      }
   }

   //----- 
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
                   nm_limpa_str_appointment_invoice($cadapar[1]);
                   nm_protect_num_appointment_invoice($cadapar[0], $cadapar[1]);
                   if ($cadapar[1] == "@ ") {$cadapar[1] = trim($cadapar[1]); }
                   $Tmp_par   = $cadapar[0];
                   $$Tmp_par = $cadapar[1];
                   if ($Tmp_par == "nmgp_opcao")
                   {
                       $_SESSION['sc_session'][$script_case_init]['appointment_invoice']['opcao'] = $cadapar[1];
                   }
               }
          }
      }
      if (isset($var_appointment_id)) 
      {
          $_SESSION['var_appointment_id'] = $var_appointment_id;
          nm_limpa_str_appointment_invoice($_SESSION["var_appointment_id"]);
      }
      $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
      $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
      $this->New_Format  = true;
      $this->Xml_tag_label = false;
      $this->Tem_xml_res = false;
      $this->Xml_password = "";
      if (isset($_REQUEST['nm_xml_tag']) && !empty($_REQUEST['nm_xml_tag']))
      {
          $this->New_Format = ($_REQUEST['nm_xml_tag'] == "tag") ? true : false;
      }
      if (isset($_REQUEST['nm_xml_label']) && !empty($_REQUEST['nm_xml_label']))
      {
          $this->Xml_tag_label = ($_REQUEST['nm_xml_label'] == "S") ? true : false;
      }
      $this->Tem_xml_res  = true;
      if (isset($_REQUEST['SC_module_export']) && $_REQUEST['SC_module_export'] != "")
      { 
          $this->Tem_xml_res = (strpos(" " . $_REQUEST['SC_module_export'], "resume") !== false) ? true : false;
      } 
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['SC_Ind_Groupby'] == "sc_free_group_by" && empty($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['SC_Gb_Free_cmp']))
      {
          $this->Tem_xml_res  = false;
      }
      if (!is_file($this->Ini->root . $this->Ini->path_link . "appointment_invoice/appointment_invoice_res_xml.class.php"))
      {
          $this->Tem_xml_res  = false;
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['embutida'] && isset($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['xml_label']))
      {
          $this->Xml_tag_label = $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['xml_label'];
          $this->New_Format    = true;
      }
      $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
      require_once($this->Ini->path_aplicacao . "appointment_invoice_total.class.php"); 
      $this->Tot      = new appointment_invoice_total($this->Ini->sc_page);
      $this->prep_modulos("Tot");
      $Gb_geral = "quebra_geral_" . $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['SC_Ind_Groupby'];
      if (method_exists($this->Tot,$Gb_geral))
      {
          $this->Tot->$Gb_geral();
          $this->count_ger = $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['tot_geral'][1];
      }
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['embutida'] && !$this->Ini->sc_export_ajax) {
          require_once($this->Ini->path_lib_php . "/sc_progress_bar.php");
          $this->pb = new scProgressBar();
          $this->pb->setRoot($this->Ini->root);
          $this->pb->setDir($_SESSION['scriptcase']['appointment_invoice']['glo_nm_path_imag_temp'] . "/");
          $this->pb->setProgressbarMd5($_GET['pbmd5']);
          $this->pb->initialize();
          $this->pb->setReturnUrl("./");
          $this->pb->setReturnOption($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['xml_return']);
          if ($this->Tem_xml_res) {
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
      $this->nm_data    = new nm_data("en_us");
      $this->Arquivo      = "sc_xml";
      $this->Arquivo     .= "_" . date("YmdHis") . "_" . rand(0, 1000);
      $this->Arq_zip      = $this->Arquivo . "_appointment_invoice.zip";
      $this->Arquivo     .= "_appointment_invoice";
      $this->Arquivo_view = $this->Arquivo . "_view.xml";
      $this->Arquivo     .= ".xml";
      $this->Tit_doc      = "appointment_invoice.xml";
      $this->Tit_zip      = "appointment_invoice.zip";
      $this->Grava_view   = false;
      if (strtolower($_SESSION['scriptcase']['charset']) != strtolower($_SESSION['scriptcase']['charset_html']))
      {
          $this->Grava_view = true;
      }
   }

   //---- 
   function prep_modulos($modulo)
   {
      $this->$modulo->Ini    = $this->Ini;
      $this->$modulo->Db     = $this->Db;
      $this->$modulo->Erro   = $this->Erro;
      $this->$modulo->Lookup = $this->Lookup;
   }

   //----- 
   function grava_arquivo()
   {
      global $nm_lang;
      global $nm_nada, $nm_lang;

      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->sc_proc_grid = false; 
      $nm_raiz_img  = ""; 
      $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['where_orig'];
      $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['where_pesq'];
      $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['where_pesq_filtro'];
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['campos_busca']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['campos_busca']))
      { 
          $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['campos_busca'];
          if ($_SESSION['scriptcase']['charset'] != "UTF-8")
          {
              $Busca_temp = NM_conv_charset($Busca_temp, $_SESSION['scriptcase']['charset'], "UTF-8");
          }
          $this->a_total_price = (isset($Busca_temp['a_total_price'])) ? $Busca_temp['a_total_price'] : ""; 
          $tmp_pos = (is_string($this->a_total_price)) ? strpos($this->a_total_price, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->a_total_price))
          {
              $this->a_total_price = substr($this->a_total_price, 0, $tmp_pos);
          }
          $this->a_total_price_2 = (isset($Busca_temp['a_total_price_input_2'])) ? $Busca_temp['a_total_price_input_2'] : ""; 
          $this->a_appointments_id = (isset($Busca_temp['a_appointments_id'])) ? $Busca_temp['a_appointments_id'] : ""; 
          $tmp_pos = (is_string($this->a_appointments_id)) ? strpos($this->a_appointments_id, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->a_appointments_id))
          {
              $this->a_appointments_id = substr($this->a_appointments_id, 0, $tmp_pos);
          }
          $this->a_appointments_id_2 = (isset($Busca_temp['a_appointments_id_input_2'])) ? $Busca_temp['a_appointments_id_input_2'] : ""; 
          $this->a_appointment_start_date = (isset($Busca_temp['a_appointment_start_date'])) ? $Busca_temp['a_appointment_start_date'] : ""; 
          $tmp_pos = (is_string($this->a_appointment_start_date)) ? strpos($this->a_appointment_start_date, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->a_appointment_start_date))
          {
              $this->a_appointment_start_date = substr($this->a_appointment_start_date, 0, $tmp_pos);
          }
          $this->a_appointment_start_date_2 = (isset($Busca_temp['a_appointment_start_date_input_2'])) ? $Busca_temp['a_appointment_start_date_input_2'] : ""; 
          $this->c_customers_name = (isset($Busca_temp['c_customers_name'])) ? $Busca_temp['c_customers_name'] : ""; 
          $tmp_pos = (is_string($this->c_customers_name)) ? strpos($this->c_customers_name, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->c_customers_name))
          {
              $this->c_customers_name = substr($this->c_customers_name, 0, $tmp_pos);
          }
          $this->c_customers_address = (isset($Busca_temp['c_customers_address'])) ? $Busca_temp['c_customers_address'] : ""; 
          $tmp_pos = (is_string($this->c_customers_address)) ? strpos($this->c_customers_address, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->c_customers_address))
          {
              $this->c_customers_address = substr($this->c_customers_address, 0, $tmp_pos);
          }
      } 
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['xml_name']))
      {
          $Pos = strrpos($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['xml_name'], ".");
          if ($Pos === false) {
              $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['xml_name'] .= ".xml";
          }
          $this->Arquivo = $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['xml_name'];
          $this->Arq_zip = $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['xml_name'];
          $this->Tit_doc = $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['xml_name'];
          $Pos = strrpos($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['xml_name'], ".");
          if ($Pos !== false) {
              $this->Arq_zip = substr($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['xml_name'], 0, $Pos);
          }
          $this->Arq_zip .= ".zip";
          $this->Tit_zip  = $this->Arq_zip;
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['xml_name']);
      }
      if (!$this->Grava_view)
      {
          $this->Arquivo_view = $this->Arquivo;
      }
      $this->arr_export = array('label' => array(), 'lines' => array());
      $this->arr_span   = array();

      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['embutida'])
      { 
          $xml_charset = $_SESSION['scriptcase']['charset'];
          $this->Xml_f = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
          $this->Zip_f = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arq_zip;
          $xml_f = fopen($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo, "w");
          fwrite($xml_f, "<?xml version=\"1.0\" encoding=\"$xml_charset\" ?>\r\n");
          fwrite($xml_f, "<root>\r\n");
          if ($this->Grava_view)
          {
              $xml_charset_v = $_SESSION['scriptcase']['charset_html'];
              $xml_v         = fopen($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo_view, "w");
              fwrite($xml_v, "<?xml version=\"1.0\" encoding=\"$xml_charset_v\" ?>\r\n");
              fwrite($xml_v, "<root>\r\n");
          }
      }
      $this->nm_field_dinamico = array();
      $this->nm_order_dinamico = array();
      $nmgp_select_count = "SELECT count(*) AS countTest from " . $this->Ini->nm_tabela; 
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
      { 
          $nmgp_select = "SELECT a.appointments_id as a_appointments_id, str_replace (convert(char(10),a.appointment_start_date,102), '.', '-') + ' ' + convert(char(8),a.appointment_start_date,20) as a_appointment_start_date, c.customers_name as c_customers_name, c.customers_address as c_customers_address, c.customers_city as c_customers_city, c.customers_state as c_customers_state, c.customers_zip as c_customers_zip, c.customers_phone as c_customers_phone, a.price as a_price, a.additional_charges as a_additional_charges, a.discount as a_discount, a.total_price as a_total_price from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
      { 
          $nmgp_select = "SELECT a.appointments_id as a_appointments_id, a.appointment_start_date as a_appointment_start_date, c.customers_name as c_customers_name, c.customers_address as c_customers_address, c.customers_city as c_customers_city, c.customers_state as c_customers_state, c.customers_zip as c_customers_zip, c.customers_phone as c_customers_phone, a.price as a_price, a.additional_charges as a_additional_charges, a.discount as a_discount, a.total_price as a_total_price from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      { 
       $nmgp_select = "SELECT a.appointments_id as a_appointments_id, convert(char(23),a.appointment_start_date,121) as a_appointment_start_date, c.customers_name as c_customers_name, c.customers_address as c_customers_address, c.customers_city as c_customers_city, c.customers_state as c_customers_state, c.customers_zip as c_customers_zip, c.customers_phone as c_customers_phone, a.price as a_price, a.additional_charges as a_additional_charges, a.discount as a_discount, a.total_price as a_total_price from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
      { 
          $nmgp_select = "SELECT a.appointments_id as a_appointments_id, a.appointment_start_date as a_appointment_start_date, c.customers_name as c_customers_name, c.customers_address as c_customers_address, c.customers_city as c_customers_city, c.customers_state as c_customers_state, c.customers_zip as c_customers_zip, c.customers_phone as c_customers_phone, a.price as a_price, a.additional_charges as a_additional_charges, a.discount as a_discount, a.total_price as a_total_price from " . $this->Ini->nm_tabela; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
      { 
          $nmgp_select = "SELECT a.appointments_id as a_appointments_id, EXTEND(a.appointment_start_date, YEAR TO DAY) as a_appointment_start_date, c.customers_name as c_customers_name, c.customers_address as c_customers_address, c.customers_city as c_customers_city, c.customers_state as c_customers_state, c.customers_zip as c_customers_zip, c.customers_phone as c_customers_phone, a.price as a_price, a.additional_charges as a_additional_charges, a.discount as a_discount, a.total_price as a_total_price from " . $this->Ini->nm_tabela; 
      } 
      else 
      { 
          $nmgp_select = "SELECT a.appointments_id as a_appointments_id, a.appointment_start_date as a_appointment_start_date, c.customers_name as c_customers_name, c.customers_address as c_customers_address, c.customers_city as c_customers_city, c.customers_state as c_customers_state, c.customers_zip as c_customers_zip, c.customers_phone as c_customers_phone, a.price as a_price, a.additional_charges as a_additional_charges, a.discount as a_discount, a.total_price as a_total_price from " . $this->Ini->nm_tabela; 
      } 
      $nmgp_select .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['where_pesq'];
      $nmgp_select_count .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['where_pesq'];
      $nmgp_order_by = $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['order_grid'];
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
      $this->xml_registro = "";
      $PB_tot = (isset($this->count_ger) && $this->count_ger > 0) ? "/" . $this->count_ger : "";
      while (!$rs->EOF)
      {
         $this->SC_seq_register++;
         if (!$_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['embutida'] && !$this->Ini->sc_export_ajax) {
             $Mens_bar = NM_charset_to_utf8($this->Ini->Nm_lang['lang_othr_prcs']);
             $this->pb->setProgressbarMessage($Mens_bar . ": " . $this->SC_seq_register . $PB_tot);
             $this->pb->addSteps(1);
         }
         if ($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['embutida'])
         { 
             $this->xml_registro .= "<" . $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['embutida_tit'] . ">\r\n";
         }
         elseif ($this->New_Format)
         {
             $this->xml_registro = "<appointment_invoice>\r\n";
         }
         else
         {
             $this->xml_registro = "<appointment_invoice";
         }
         $this->a_appointments_id = $rs->fields[0] ;  
         $this->a_appointments_id = (string)$this->a_appointments_id;
         $this->a_appointment_start_date = $rs->fields[1] ;  
         $this->c_customers_name = $rs->fields[2] ;  
         $this->c_customers_address = $rs->fields[3] ;  
         $this->c_customers_city = $rs->fields[4] ;  
         $this->c_customers_state = $rs->fields[5] ;  
         $this->c_customers_zip = $rs->fields[6] ;  
         $this->c_customers_phone = $rs->fields[7] ;  
         $this->a_price = $rs->fields[8] ;  
         $this->a_price =  str_replace(",", ".", $this->a_price);
         $this->a_price = (string)$this->a_price;
         $this->a_additional_charges = $rs->fields[9] ;  
         $this->a_additional_charges =  str_replace(",", ".", $this->a_additional_charges);
         $this->a_additional_charges = (string)$this->a_additional_charges;
         $this->a_discount = $rs->fields[10] ;  
         $this->a_discount =  str_replace(",", ".", $this->a_discount);
         $this->a_discount = (string)$this->a_discount;
         $this->a_total_price = $rs->fields[11] ;  
         $this->a_total_price =  str_replace(",", ".", $this->a_total_price);
         $this->a_total_price = (string)$this->a_total_price;
         $this->sc_proc_grid = true; 
         foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['field_order'] as $Cada_col)
         { 
            if (!isset($this->NM_cmp_hidden[$Cada_col]) || $this->NM_cmp_hidden[$Cada_col] != "off")
            { 
                $NM_func_exp = "NM_export_" . $Cada_col;
                $this->$NM_func_exp();
            } 
         } 
         if ($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['embutida'])
         { 
             $this->xml_registro .= "</" . $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['embutida_tit'] . ">\r\n";
         }
         elseif ($this->New_Format)
         {
             $this->xml_registro .= "</appointment_invoice>\r\n";
         }
         else
         {
             $this->xml_registro .= " />\r\n";
         }
         if (!$_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['embutida'])
         { 
             fwrite($xml_f, $this->xml_registro);
             if ($this->Grava_view)
             {
                fwrite($xml_v, $this->xml_registro);
             }
         }
         $rs->MoveNext();
      }
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['embutida'])
      { 
          if (!$this->New_Format)
          {
              $this->xml_registro = "";
          }
          $_SESSION['scriptcase']['export_return'] = $this->xml_registro;
      }
      else
      { 
          fwrite($xml_f, "</root>");
          fclose($xml_f);
          if ($this->Grava_view)
          {
             fwrite($xml_v, "</root>");
             fclose($xml_v);
          }
          if ($this->Tem_xml_res)
          { 
              if (!$this->Ini->sc_export_ajax) {
                  $this->PB_dif = intval ($this->PB_dif / 2);
                  $Mens_bar  = NM_charset_to_utf8($this->Ini->Nm_lang['lang_othr_prcs']);
                  $Mens_smry = NM_charset_to_utf8($this->Ini->Nm_lang['lang_othr_smry_titl']);
                  $this->pb->setProgressbarMessage($Mens_bar . ": " . $Mens_smry);
                  $this->pb->addSteps($this->PB_dif);
              }
              require_once($this->Ini->path_aplicacao . "appointment_invoice_res_xml.class.php");
              $this->Res = new appointment_invoice_res_xml();
              $this->prep_modulos("Res");
              $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['xml_res_grid'] = true;
              $this->Res->monta_xml();
          } 
          if (!$this->Ini->sc_export_ajax) {
              $Mens_bar = NM_charset_to_utf8($this->Ini->Nm_lang['lang_btns_export_finished']);
              $this->pb->setProgressbarMessage($Mens_bar);
              $this->pb->addSteps($this->PB_dif);
          }
          if ($this->Xml_password != "" || $this->Tem_xml_res)
          { 
              $str_zip    = "";
              $Parm_pass  = ($this->Xml_password != "") ? " -p" : "";
              $Zip_f      = (FALSE !== strpos($this->Zip_f, ' ')) ? " \"" . $this->Zip_f . "\"" :  $this->Zip_f;
              $Arq_input  = (FALSE !== strpos($this->Xml_f, ' ')) ? " \"" . $this->Xml_f . "\"" :  $this->Xml_f;
              if (is_file($Zip_f)) {
                  unlink($Zip_f);
              }
              if (FALSE !== strpos(strtolower(php_uname()), 'windows')) 
              {
                  chdir($this->Ini->path_third . "/zip/windows");
                  $str_zip = "zip.exe " . strtoupper($Parm_pass) . " -j " . $this->Xml_password . " " . $Zip_f . " " . $Arq_input;
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
                  $str_zip = "./7za " . $Parm_pass . $this->Xml_password . " a " . $Zip_f . " " . $Arq_input;
              }
              elseif (FALSE !== strpos(strtolower(php_uname()), 'darwin'))
              {
                  chdir($this->Ini->path_third . "/zip/mac/bin");
                  $str_zip = "./7za " . $Parm_pass . $this->Xml_password . " a " . $Zip_f . " " . $Arq_input;
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
              $this->Xml_f   = $this->Zip_f;
              $this->Tit_doc = $this->Tit_zip;
              if ($this->Tem_xml_res)
              { 
                  $str_zip   = "";
                  $Arq_res   = $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['xml_res_file']['xml'];
                  $Arq_input = (FALSE !== strpos($Arq_res, ' ')) ? " \"" . $Arq_res . "\"" :  $Arq_res;
                  if (FALSE !== strpos(strtolower(php_uname()), 'windows')) 
                  {
                      $str_zip = "zip.exe " . strtoupper($Parm_pass) . " -j -u " . $this->Xml_password . " " . $Zip_f . " " . $Arq_input;
                  }
                  elseif (FALSE !== strpos(strtolower(php_uname()), 'linux')) 
                  {
                      $str_zip = "./7za " . $Parm_pass . $this->Xml_password . " a " . $Zip_f . " " . $Arq_input;
                  }
                  elseif (FALSE !== strpos(strtolower(php_uname()), 'darwin'))
                  {
                      $str_zip = "./7za " . $Parm_pass . $this->Xml_password . " a " . $Zip_f . " " . $Arq_input;
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
                  unlink($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['xml_res_file']['xml']);
              }
              if ($this->Grava_view)
              {
                  $str_zip    = "";
                  $xml_view_f = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo_view;
                  $zip_view_f = str_replace(".zip", "_view.zip", $this->Zip_f);
                  $zip_arq_v  = str_replace(".zip", "_view.zip", $this->Arq_zip);
                  $Zip_f      = (FALSE !== strpos($zip_view_f, ' ')) ? " \"" . $zip_view_f . "\"" :  $zip_view_f;
                  $Arq_input  = (FALSE !== strpos($xml_view_ff, ' ')) ? " \"" . $xml_view_f . "\"" :  $xml_view_f;
                  if (is_file($Zip_f)) {
                      unlink($Zip_f);
                  }
                  if (FALSE !== strpos(strtolower(php_uname()), 'windows')) 
                  {
                      chdir($this->Ini->path_third . "/zip/windows");
                      $str_zip = "zip.exe " . strtoupper($Parm_pass) . " -j " . $this->Xml_password . " " . $Zip_f . " " . $Arq_input;
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
                      $str_zip = "./7za " . $Parm_pass . $this->Xml_password . " a " . $Zip_f . " " . $Arq_input;
                  }
                  elseif (FALSE !== strpos(strtolower(php_uname()), 'darwin'))
                  {
                      chdir($this->Ini->path_third . "/zip/mac/bin");
                      $str_zip = "./7za " . $Parm_pass . $this->Xml_password . " a " . $Zip_f . " " . $Arq_input;
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
                  unlink($Arq_input);
                  $this->Arquivo_view = $zip_arq_v;
                  if ($this->Tem_xml_res)
                  { 
                      $str_zip   = "";
                      $Arq_res   = $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['xml_res_file']['view'];
                      $Arq_input = (FALSE !== strpos($Arq_res, ' ')) ? " \"" . $Arq_res . "\"" :  $Arq_res;
                      if (FALSE !== strpos(strtolower(php_uname()), 'windows')) 
                      {
                          $str_zip = "zip.exe " . strtoupper($Parm_pass) . " -j -u " . $this->Xml_password . " " . $Zip_f . " " . $Arq_input;
                      }
                      elseif (FALSE !== strpos(strtolower(php_uname()), 'linux')) 
                      {
                          $str_zip = "./7za " . $Parm_pass . $this->Xml_password . " a " . $Zip_f . " " . $Arq_input;
                      }
                      elseif (FALSE !== strpos(strtolower(php_uname()), 'darwin'))
                      {
                          $str_zip = "./7za " . $Parm_pass . $this->Xml_password . " a " . $Zip_f . " " . $Arq_input;
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
                      unlink($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['xml_res_file']['view']);
                  }
              } 
              else 
              {
                  $this->Arquivo_view = $this->Arq_zip;
              } 
              unset($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['xml_res_grid']);
          } 
      }
      if(isset($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['export_sel_columns']['field_order']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['field_order'] = $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['export_sel_columns']['field_order'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['export_sel_columns']['field_order']);
      }
      if(isset($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['export_sel_columns']['usr_cmp_sel']))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['usr_cmp_sel'] = $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['export_sel_columns']['usr_cmp_sel'];
          unset($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['export_sel_columns']['usr_cmp_sel']);
      }
      $rs->Close();
   }
   //----- a_appointments_id
   function NM_export_a_appointments_id()
   {
             nmgp_Form_Num_Val($this->a_appointments_id, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['a_appointments_id'])) ? $this->New_label['a_appointments_id'] : "" . $this->Ini->Nm_lang['lang_appointments_fld_appointments_id'] . ""; 
         }
         else
         {
             $SC_Label = "a_appointments_id"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->a_appointments_id) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->a_appointments_id) . "\"";
         }
   }
   //----- a_appointment_start_date
   function NM_export_a_appointment_start_date()
   {
             $conteudo_x =  $this->a_appointment_start_date;
             nm_conv_limpa_dado($conteudo_x, "YYYY-MM-DD");
             if (is_numeric($conteudo_x) && strlen($conteudo_x) > 0) 
             { 
                 $this->nm_data->SetaData($this->a_appointment_start_date, "YYYY-MM-DD  ");
                 $this->a_appointment_start_date = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
             } 
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['a_appointment_start_date'])) ? $this->New_label['a_appointment_start_date'] : "" . $this->Ini->Nm_lang['lang_appointments_fld_appointment_start_date'] . ""; 
         }
         else
         {
             $SC_Label = "a_appointment_start_date"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->a_appointment_start_date) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->a_appointment_start_date) . "\"";
         }
   }
   //----- c_customers_name
   function NM_export_c_customers_name()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->c_customers_name))
         {
             $this->c_customers_name = sc_convert_encoding($this->c_customers_name, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['c_customers_name'])) ? $this->New_label['c_customers_name'] : "" . $this->Ini->Nm_lang['lang_customers_fld_customers_name'] . ""; 
         }
         else
         {
             $SC_Label = "c_customers_name"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->c_customers_name) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->c_customers_name) . "\"";
         }
   }
   //----- c_customers_address
   function NM_export_c_customers_address()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->c_customers_address))
         {
             $this->c_customers_address = sc_convert_encoding($this->c_customers_address, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['c_customers_address'])) ? $this->New_label['c_customers_address'] : "" . $this->Ini->Nm_lang['lang_customers_fld_customers_address'] . ""; 
         }
         else
         {
             $SC_Label = "c_customers_address"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->c_customers_address) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->c_customers_address) . "\"";
         }
   }
   //----- c_customers_city
   function NM_export_c_customers_city()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->c_customers_city))
         {
             $this->c_customers_city = sc_convert_encoding($this->c_customers_city, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['c_customers_city'])) ? $this->New_label['c_customers_city'] : "" . $this->Ini->Nm_lang['lang_customers_fld_customers_city'] . ""; 
         }
         else
         {
             $SC_Label = "c_customers_city"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->c_customers_city) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->c_customers_city) . "\"";
         }
   }
   //----- c_customers_state
   function NM_export_c_customers_state()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->c_customers_state))
         {
             $this->c_customers_state = sc_convert_encoding($this->c_customers_state, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['c_customers_state'])) ? $this->New_label['c_customers_state'] : "" . $this->Ini->Nm_lang['lang_customers_fld_customers_state'] . ""; 
         }
         else
         {
             $SC_Label = "c_customers_state"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->c_customers_state) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->c_customers_state) . "\"";
         }
   }
   //----- c_customers_zip
   function NM_export_c_customers_zip()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->c_customers_zip))
         {
             $this->c_customers_zip = sc_convert_encoding($this->c_customers_zip, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['c_customers_zip'])) ? $this->New_label['c_customers_zip'] : "" . $this->Ini->Nm_lang['lang_customers_fld_customers_zip'] . ""; 
         }
         else
         {
             $SC_Label = "c_customers_zip"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->c_customers_zip) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->c_customers_zip) . "\"";
         }
   }
   //----- c_customers_phone
   function NM_export_c_customers_phone()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->c_customers_phone))
         {
             $this->c_customers_phone = sc_convert_encoding($this->c_customers_phone, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['c_customers_phone'])) ? $this->New_label['c_customers_phone'] : "" . $this->Ini->Nm_lang['lang_customers_fld_customers_phone'] . ""; 
         }
         else
         {
             $SC_Label = "c_customers_phone"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->c_customers_phone) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->c_customers_phone) . "\"";
         }
   }
   //----- a_price
   function NM_export_a_price()
   {
             nmgp_Form_Num_Val($this->a_price, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['a_price'])) ? $this->New_label['a_price'] : "" . $this->Ini->Nm_lang['lang_appointments_fld_price'] . ""; 
         }
         else
         {
             $SC_Label = "a_price"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->a_price) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->a_price) . "\"";
         }
   }
   //----- a_additional_charges
   function NM_export_a_additional_charges()
   {
             nmgp_Form_Num_Val($this->a_additional_charges, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['a_additional_charges'])) ? $this->New_label['a_additional_charges'] : "" . $this->Ini->Nm_lang['lang_appointments_fld_additional_charges'] . ""; 
         }
         else
         {
             $SC_Label = "a_additional_charges"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->a_additional_charges) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->a_additional_charges) . "\"";
         }
   }
   //----- a_discount
   function NM_export_a_discount()
   {
             nmgp_Form_Num_Val($this->a_discount, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['a_discount'])) ? $this->New_label['a_discount'] : "" . $this->Ini->Nm_lang['lang_appointments_fld_discount'] . ""; 
         }
         else
         {
             $SC_Label = "a_discount"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->a_discount) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->a_discount) . "\"";
         }
   }
   //----- a_total_price
   function NM_export_a_total_price()
   {
             nmgp_Form_Num_Val($this->a_total_price, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['a_total_price'])) ? $this->New_label['a_total_price'] : "" . $this->Ini->Nm_lang['lang_appointments_fld_total_price'] . ""; 
         }
         else
         {
             $SC_Label = "a_total_price"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->a_total_price) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->a_total_price) . "\"";
         }
   }
   //----- details
   function NM_export_details()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->details))
         {
             $this->details = sc_convert_encoding($this->details, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['details'])) ? $this->New_label['details'] : "details"; 
         }
         else
         {
             $SC_Label = "details"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->details) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->details) . "\"";
         }
   }
   //----- details_att_appointments_type_id
   function NM_export_details_att_appointments_type_id()
   {
             nmgp_Form_Num_Val($this->details_att_appointments_type_id, $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['details_att_appointments_type_id'])) ? $this->New_label['details_att_appointments_type_id'] : "Appointments Type Id"; 
         }
         else
         {
             $SC_Label = "details_att_appointments_type_id"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->details_att_appointments_type_id) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->details_att_appointments_type_id) . "\"";
         }
   }
   //----- details_att_description
   function NM_export_details_att_description()
   {
         if ($_SESSION['scriptcase']['charset'] == "UTF-8" && !NM_is_utf8($this->details_att_description))
         {
             $this->details_att_description = sc_convert_encoding($this->details_att_description, "UTF-8", $_SESSION['scriptcase']['charset']);
         }
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['details_att_description'])) ? $this->New_label['details_att_description'] : "Description"; 
         }
         else
         {
             $SC_Label = "details_att_description"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->details_att_description) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->details_att_description) . "\"";
         }
   }
   //----- details_att_price
   function NM_export_details_att_price()
   {
             nmgp_Form_Num_Val($this->details_att_price, $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "0", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
         if ($this->Xml_tag_label)
         {
             $SC_Label = (isset($this->New_label['details_att_price'])) ? $this->New_label['details_att_price'] : "Price"; 
         }
         else
         {
             $SC_Label = "details_att_price"; 
         }
         $this->clear_tag($SC_Label); 
         if ($this->New_Format)
         {
             $this->xml_registro .= " <" . $SC_Label . ">" . $this->trata_dados($this->details_att_price) . "</" . $SC_Label . ">\r\n";
         }
         else
         {
             $this->xml_registro .= " " . $SC_Label . " =\"" . $this->trata_dados($this->details_att_price) . "\"";
         }
   }

   //----- 
   function trata_dados($conteudo)
   {
      $str_temp =  $conteudo;
      $str_temp =  str_replace("<br />", "",  $str_temp);
      $str_temp =  str_replace("&", "&amp;",  $str_temp);
      $str_temp =  str_replace("<", "&lt;",   $str_temp);
      $str_temp =  str_replace(">", "&gt;",   $str_temp);
      $str_temp =  str_replace("'", "&apos;", $str_temp);
      $str_temp =  str_replace('"', "&quot;",  $str_temp);
      $str_temp =  str_replace('(', "_",  $str_temp);
      $str_temp =  str_replace(')', "",  $str_temp);
      return ($str_temp);
   }

   function clear_tag(&$conteudo)
   {
      $out = (is_numeric(substr($conteudo, 0, 1)) || substr($conteudo, 0, 1) == "") ? "_" : "";
      $str_temp = "abcdefghijklmnopqrstuvwxyz0123456789";
      for ($i = 0; $i < strlen($conteudo); $i++)
      {
          $char = substr($conteudo, $i, 1);
          $ok = false;
          for ($z = 0; $z < strlen($str_temp); $z++)
          {
              if (strtolower($char) == substr($str_temp, $z, 1))
              {
                  $ok = true;
                  break;
              }
          }
          $out .= ($ok) ? $char : "_";
      }
      $conteudo = $out;
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
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['xml_file']);
      if (is_file($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['xml_file'] = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      }
      $path_doc_md5 = md5($this->Ini->path_imag_temp . "/" . $this->Arquivo);
      $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice'][$path_doc_md5][0] = $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice'][$path_doc_md5][1] = $this->Tit_doc;
      $Mens_bar = $this->Ini->Nm_lang['lang_othr_file_msge'];
      if ($_SESSION['scriptcase']['charset'] != "UTF-8") {
          $Mens_bar = sc_convert_encoding($Mens_bar, "UTF-8", $_SESSION['scriptcase']['charset']);
      }
      $this->pb->setProgressbarMessage($Mens_bar);
      $this->pb->setDownloadLink($this->Ini->path_imag_temp . "/" . $this->Arquivo);
      $this->pb->setDownloadMd5($path_doc_md5);
      $this->pb->completed();
   }
   //---- 
   function monta_html()
   {
      global $nm_url_saida, $nm_lang;
      include($this->Ini->path_btn . $this->Ini->Str_btn_grid);
      unset($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['xml_file']);
      if (is_file($this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo))
      {
          $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['xml_file'] = $this->Ini->root . $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      }
      $path_doc_md5 = md5($this->Ini->path_imag_temp . "/" . $this->Arquivo);
      $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice'][$path_doc_md5][0] = $this->Ini->path_imag_temp . "/" . $this->Arquivo;
      $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice'][$path_doc_md5][1] = $this->Tit_doc;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
            "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE><?php echo $this->Ini->Nm_lang['lang_othr_chart_titl'] ?> - `` :: XML</TITLE>
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
   <td class="scExportTitle" style="height: 25px">XML</td>
  </tr>
  <tr>
   <td class="scExportLine" style="width: 100%">
    <table style="border-collapse: collapse; border-width: 0; width: 100%"><tr><td class="scExportLineFont" style="padding: 3px 0 0 0" id="idMessage">
    <?php echo $this->Ini->Nm_lang['lang_othr_file_msge'] ?>
    </td><td class="scExportLineFont" style="text-align:right; padding: 3px 0 0 0">
     <?php echo nmButtonOutput($this->arr_buttons, "bexportview", "document.Fview.submit()", "document.Fview.submit()", "idBtnView", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
 ?>
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
<form name="Fdown" method="get" action="appointment_invoice_download.php" target="_blank" style="display: none"> 
<input type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<input type="hidden" name="nm_tit_doc" value="appointment_invoice"> 
<input type="hidden" name="nm_name_doc" value="<?php echo $path_doc_md5 ?>"> 
</form>
<FORM name="F0" method=post action="./" style="display: none"> 
<INPUT type="hidden" name="script_case_init" value="<?php echo NM_encode_input($this->Ini->sc_page); ?>"> 
<INPUT type="hidden" name="nmgp_opcao" value="<?php echo NM_encode_input($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['xml_return']); ?>"> 
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
}

?>