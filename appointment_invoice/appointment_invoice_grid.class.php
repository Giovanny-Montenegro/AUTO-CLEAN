<?php
class appointment_invoice_grid
{
   var $Ini;
   var $Erro;
   var $Pdf;
   var $Db;
   var $rs_grid;
   var $nm_grid_sem_reg;
   var $SC_seq_register;
   var $nm_location;
   var $nm_data;
   var $nm_cod_barra;
   var $sc_proc_grid; 
   var $nmgp_botoes = array();
   var $Campos_Mens_erro;
   var $NM_raiz_img; 
   var $Font_ttf; 
   var $details = array();
   var $details_att_appointments_type_id = array();
   var $details_att_description = array();
   var $details_att_price = array();
   var $a_appointments_id = array();
   var $a_appointment_start_date = array();
   var $c_customers_name = array();
   var $c_customers_address = array();
   var $c_customers_city = array();
   var $c_customers_state = array();
   var $c_customers_zip = array();
   var $c_customers_phone = array();
   var $a_price = array();
   var $a_additional_charges = array();
   var $a_discount = array();
   var $a_total_price = array();
//--- 
 function monta_grid($linhas = 0)
 {

   clearstatcache();
   $this->inicializa();
   $this->grid();
 }
//--- 
 function inicializa()
 {
   global $nm_saida, 
   $rec, $nmgp_chave, $nmgp_opcao, $nmgp_ordem, $nmgp_chave_det, 
   $nmgp_quant_linhas, $nmgp_quant_colunas, $nmgp_url_saida, $nmgp_parms;
//
   $this->nm_data = new nm_data("en_us");
   include_once("../_lib/lib/php/nm_font_tcpdf.php");
   $this->default_font = '';
   $this->default_font_sr  = '';
   $this->default_style    = '';
   $this->default_style_sr = 'B';
   $Tp_papel = "A4";
   $old_dir = getcwd();
   $File_font_ttf     = "";
   $temp_font_ttf     = "";
   $this->Font_ttf    = false;
   $this->Font_ttf_sr = false;
   if (empty($this->default_font) && isset($arr_font_tcpdf[$this->Ini->str_lang]))
   {
       $this->default_font = $arr_font_tcpdf[$this->Ini->str_lang];
   }
   elseif (empty($this->default_font))
   {
       $this->default_font = "Times";
   }
   if (empty($this->default_font_sr) && isset($arr_font_tcpdf[$this->Ini->str_lang]))
   {
       $this->default_font_sr = $arr_font_tcpdf[$this->Ini->str_lang];
   }
   elseif (empty($this->default_font_sr))
   {
       $this->default_font_sr = "Times";
   }
   $_SESSION['scriptcase']['appointment_invoice']['default_font'] = $this->default_font;
   chdir($this->Ini->path_third . "/tcpdf/");
   include_once("tcpdf.php");
   chdir($old_dir);
   $this->Pdf = new TCPDF('P', 'mm', $Tp_papel, true, 'UTF-8', false);
   $this->Pdf->setPrintHeader(false);
   $this->Pdf->setPrintFooter(false);
   if (!empty($File_font_ttf))
   {
       $this->Pdf->addTTFfont($File_font_ttf, "", "", 32, $_SESSION['scriptcase']['dir_temp'] . "/");
   }
   $this->Pdf->SetDisplayMode('real');
   $this->aba_iframe = false;
   if (isset($_SESSION['scriptcase']['sc_aba_iframe']))
   {
       foreach ($_SESSION['scriptcase']['sc_aba_iframe'] as $aba => $apls_aba)
       {
           if (in_array("appointment_invoice", $apls_aba))
           {
               $this->aba_iframe = true;
               break;
           }
       }
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['iframe_menu'] && (!isset($_SESSION['scriptcase']['menu_mobile']) || empty($_SESSION['scriptcase']['menu_mobile'])))
   {
       $this->aba_iframe = true;
   }
   $this->nmgp_botoes['exit'] = "on";
   $this->sc_proc_grid = false; 
   $this->NM_raiz_img = $this->Ini->root;
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
   $this->nm_where_dinamico = "";
   $this->nm_grid_colunas = 0;
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['campos_busca']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['campos_busca']))
   { 
       $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['campos_busca'];
       if ($_SESSION['scriptcase']['charset'] != "UTF-8")
       {
           $Busca_temp = NM_conv_charset($Busca_temp, $_SESSION['scriptcase']['charset'], "UTF-8");
       }
       $this->a_appointments_id[0] = (isset($Busca_temp['a_appointments_id'])) ? $Busca_temp['a_appointments_id'] : ""; 
       $tmp_pos = (is_string($this->a_appointments_id[0])) ? strpos($this->a_appointments_id[0], "##@@") : false;
       if ($tmp_pos !== false && !is_array($this->a_appointments_id[0]))
       {
           $this->a_appointments_id[0] = substr($this->a_appointments_id[0], 0, $tmp_pos);
       }
       $a_appointments_id_2 = (isset($Busca_temp['a_appointments_id_input_2'])) ? $Busca_temp['a_appointments_id_input_2'] : ""; 
       $this->a_appointments_id_2 = $a_appointments_id_2; 
       $this->a_appointment_start_date[0] = (isset($Busca_temp['a_appointment_start_date'])) ? $Busca_temp['a_appointment_start_date'] : ""; 
       $tmp_pos = (is_string($this->a_appointment_start_date[0])) ? strpos($this->a_appointment_start_date[0], "##@@") : false;
       if ($tmp_pos !== false && !is_array($this->a_appointment_start_date[0]))
       {
           $this->a_appointment_start_date[0] = substr($this->a_appointment_start_date[0], 0, $tmp_pos);
       }
       $a_appointment_start_date_2 = (isset($Busca_temp['a_appointment_start_date_input_2'])) ? $Busca_temp['a_appointment_start_date_input_2'] : ""; 
       $this->a_appointment_start_date_2 = $a_appointment_start_date_2; 
       $this->c_customers_name[0] = (isset($Busca_temp['c_customers_name'])) ? $Busca_temp['c_customers_name'] : ""; 
       $tmp_pos = (is_string($this->c_customers_name[0])) ? strpos($this->c_customers_name[0], "##@@") : false;
       if ($tmp_pos !== false && !is_array($this->c_customers_name[0]))
       {
           $this->c_customers_name[0] = substr($this->c_customers_name[0], 0, $tmp_pos);
       }
       $this->c_customers_address[0] = (isset($Busca_temp['c_customers_address'])) ? $Busca_temp['c_customers_address'] : ""; 
       $tmp_pos = (is_string($this->c_customers_address[0])) ? strpos($this->c_customers_address[0], "##@@") : false;
       if ($tmp_pos !== false && !is_array($this->c_customers_address[0]))
       {
           $this->c_customers_address[0] = substr($this->c_customers_address[0], 0, $tmp_pos);
       }
       $this->a_total_price[0] = (isset($Busca_temp['a_total_price'])) ? $Busca_temp['a_total_price'] : ""; 
       $tmp_pos = (is_string($this->a_total_price[0])) ? strpos($this->a_total_price[0], "##@@") : false;
       if ($tmp_pos !== false && !is_array($this->a_total_price[0]))
       {
           $this->a_total_price[0] = substr($this->a_total_price[0], 0, $tmp_pos);
       }
       $a_total_price_2 = (isset($Busca_temp['a_total_price_input_2'])) ? $Busca_temp['a_total_price_input_2'] : ""; 
       $this->a_total_price_2 = $a_total_price_2; 
   } 
   else 
   { 
       $this->a_appointment_start_date_2 = ""; 
   } 
   $this->nm_field_dinamico = array();
   $this->nm_order_dinamico = array();
   $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['where_orig'];
   $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['where_pesq'];
   $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['where_pesq_filtro'];
   $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
   $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
   $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
   $_SESSION['scriptcase']['contr_link_emb'] = $this->nm_location;
   $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['qt_col_grid'] = 1 ;  
   if (isset($_SESSION['scriptcase']['sc_apl_conf']['appointment_invoice']['cols']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['appointment_invoice']['cols']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['qt_col_grid'] = $_SESSION['scriptcase']['sc_apl_conf']['appointment_invoice']['cols'];  
       unset($_SESSION['scriptcase']['sc_apl_conf']['appointment_invoice']['cols']);
   }
   if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['ordem_select']))  
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['ordem_select'] = array(); 
   } 
   if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['ordem_quebra']))  
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['ordem_grid'] = "" ; 
       $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['ordem_ant']  = ""; 
       $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['ordem_desc'] = "" ; 
   }   
   if (!empty($nmgp_parms) && $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['opcao'] != "pdf")   
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['opcao'] = "igual";
       $rec = "ini";
   }
   if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['where_orig']) || $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['prim_cons'] || !empty($nmgp_parms))  
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['prim_cons'] = false;  
       $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['where_orig'] = " where (a.appointments_id = " . $_SESSION['var_appointment_id'] . ")";  
       $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['where_pesq']        = $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['where_orig'];  
       $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['where_pesq_ant']    = $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['where_orig'];  
       $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['cond_pesq']         = ""; 
       $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['where_pesq_filtro'] = "";
   }   
   if  (!empty($this->nm_where_dinamico)) 
   {   
       $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['where_pesq'] .= $this->nm_where_dinamico;
   }   
   $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['where_orig'];
   $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['where_pesq'];
   $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['where_pesq_filtro'];
//
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['tot_geral'][1])) 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['sc_total'] = $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['tot_geral'][1] ;  
   }
   $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['where_pesq_ant'] = $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['where_pesq'];  
//----- 
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
   $nmgp_order_by = ""; 
   $campos_order_select = "";
   foreach($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['ordem_select'] as $campo => $ordem) 
   {
        if ($campo != $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['ordem_grid']) 
        {
           if (!empty($campos_order_select)) 
           {
               $campos_order_select .= ", ";
           }
           $campos_order_select .= $campo . " " . $ordem;
        }
   }
   if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['ordem_grid'])) 
   { 
       $nmgp_order_by = " order by " . $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['ordem_grid'] . $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['ordem_desc']; 
   } 
   if (!empty($campos_order_select)) 
   { 
       if (!empty($nmgp_order_by)) 
       { 
          $nmgp_order_by .= ", " . $campos_order_select; 
       } 
       else 
       { 
          $nmgp_order_by = " order by $campos_order_select"; 
       } 
   } 
   $nmgp_select .= $nmgp_order_by; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['order_grid'] = $nmgp_order_by;
   $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select; 
   $this->rs_grid = $this->Db->Execute($nmgp_select) ; 
   if ($this->rs_grid === false && !$this->rs_grid->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1) 
   { 
       $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
       exit ; 
   }  
   if ($this->rs_grid->EOF || ($this->rs_grid === false && $GLOBALS["NM_ERRO_IBASE"] == 1)) 
   { 
       $this->nm_grid_sem_reg = $this->SC_conv_utf8($this->Ini->Nm_lang['lang_errm_empt']); 
   }  
// 
 }  
// 
 function Pdf_init()
 {
     if ($_SESSION['scriptcase']['reg_conf']['css_dir'] == "RTL")
     {
         $this->Pdf->setRTL(true);
     }
     $this->Pdf->setHeaderMargin(0);
     $this->Pdf->setFooterMargin(0);
     if ($this->Font_ttf)
     {
         $this->Pdf->SetFont($this->default_font, $this->default_style, 12, $this->def_TTF);
     }
     else
     {
         $this->Pdf->SetFont($this->default_font, $this->default_style, 12);
     }
     $this->Pdf->SetTextColor(0, 0, 0);
 }
// 
 function Pdf_image()
 {
   if ($_SESSION['scriptcase']['reg_conf']['css_dir'] == "RTL")
   {
       $this->Pdf->setRTL(false);
   }
   $SV_margin = $this->Pdf->getBreakMargin();
   $SV_auto_page_break = $this->Pdf->getAutoPageBreak();
   $this->Pdf->SetAutoPageBreak(false, 0);
   $this->Pdf->Image($this->NM_raiz_img . $this->Ini->path_img_global . "/grp__NM__bg__NM__invoice_sc.jpg", "1", "1", "210", "297", '', '', '', false, 300, '', false, false, 0);
   $this->Pdf->SetAutoPageBreak($SV_auto_page_break, $SV_margin);
   $this->Pdf->setPageMark();
   if ($_SESSION['scriptcase']['reg_conf']['css_dir'] == "RTL")
   {
       $this->Pdf->setRTL(true);
   }
 }
// 
//----- 
 function grid($linhas = 0)
 {
    global 
           $nm_saida, $nm_url_saida;
   $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['labels']['a_appointments_id'] = "{lang_appointments_fld_appointments_id}";
   $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['labels']['a_appointment_start_date'] = "{lang_appointments_fld_appointment_start_date}";
   $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['labels']['c_customers_name'] = "{lang_customers_fld_customers_name}";
   $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['labels']['c_customers_address'] = "{lang_customers_fld_customers_address}";
   $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['labels']['c_customers_city'] = "{lang_customers_fld_customers_city}";
   $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['labels']['c_customers_state'] = "{lang_customers_fld_customers_state}";
   $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['labels']['c_customers_zip'] = "{lang_customers_fld_customers_zip}";
   $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['labels']['c_customers_phone'] = "{lang_customers_fld_customers_phone}";
   $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['labels']['a_price'] = "{lang_appointments_fld_price}";
   $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['labels']['a_additional_charges'] = "{lang_appointments_fld_additional_charges}";
   $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['labels']['a_discount'] = "{lang_appointments_fld_discount}";
   $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['labels']['a_total_price'] = "{lang_appointments_fld_total_price}";
   $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['labels']['details'] = "details";
   $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['labels']['details_att_appointments_type_id'] = "Appointments Type Id";
   $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['labels']['details_att_description'] = "Description";
   $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['labels']['details_att_price'] = "Price";
   $HTTP_REFERER = (isset($_SERVER['HTTP_REFERER'])) ? $_SERVER['HTTP_REFERER'] : ""; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['seq_dir'] = 0; 
   $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['sub_dir'] = array(); 
   $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['where_orig'];
   $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['where_pesq'];
   $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['where_pesq_filtro'];
   if (isset($_SESSION['scriptcase']['sc_apl_conf']['appointment_invoice']['lig_edit']) && $_SESSION['scriptcase']['sc_apl_conf']['appointment_invoice']['lig_edit'] != '')
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['mostra_edit'] = $_SESSION['scriptcase']['sc_apl_conf']['appointment_invoice']['lig_edit'];
   }
   if (!empty($this->nm_grid_sem_reg))
   {
       $this->Pdf_init();
       $this->Pdf->AddPage();
       if ($this->Font_ttf_sr)
       {
           $this->Pdf->SetFont($this->default_font_sr, 'B', 12, $this->def_TTF);
       }
       else
       {
           $this->Pdf->SetFont($this->default_font_sr, 'B', 12);
       }
       $this->Pdf->SetTextColor(0, 0, 0);
       $this->Pdf->Text(10, 10, html_entity_decode($this->nm_grid_sem_reg, ENT_COMPAT, $_SESSION['scriptcase']['charset']));
       $this->Pdf->Output($this->Ini->root . $this->Ini->nm_path_pdf, 'F');
       return;
   }
// 
   $Init_Pdf = true;
   $this->SC_seq_register = 0; 
   while (!$this->rs_grid->EOF) 
   {  
      $this->nm_grid_colunas = 0; 
      $nm_quant_linhas = 0;
      $this->Pdf->setImageScale(1.33);
      $this->Pdf->AddPage();
      $this->Pdf_init();
      $this->Pdf_image();
      while (!$this->rs_grid->EOF && $nm_quant_linhas < $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['qt_col_grid']) 
      {  
          $this->sc_proc_grid = true;
          $this->SC_seq_register++; 
          $this->a_appointments_id[$this->nm_grid_colunas] = $this->rs_grid->fields[0] ;  
          $this->a_appointments_id[$this->nm_grid_colunas] = (string)$this->a_appointments_id[$this->nm_grid_colunas];
          $this->a_appointment_start_date[$this->nm_grid_colunas] = $this->rs_grid->fields[1] ;  
          $this->c_customers_name[$this->nm_grid_colunas] = $this->rs_grid->fields[2] ;  
          $this->c_customers_address[$this->nm_grid_colunas] = $this->rs_grid->fields[3] ;  
          $this->c_customers_city[$this->nm_grid_colunas] = $this->rs_grid->fields[4] ;  
          $this->c_customers_state[$this->nm_grid_colunas] = $this->rs_grid->fields[5] ;  
          $this->c_customers_zip[$this->nm_grid_colunas] = $this->rs_grid->fields[6] ;  
          $this->c_customers_phone[$this->nm_grid_colunas] = $this->rs_grid->fields[7] ;  
          $this->a_price[$this->nm_grid_colunas] = $this->rs_grid->fields[8] ;  
          $this->a_price[$this->nm_grid_colunas] =  str_replace(",", ".", $this->a_price[$this->nm_grid_colunas]);
          $this->a_price[$this->nm_grid_colunas] = (string)$this->a_price[$this->nm_grid_colunas];
          $this->a_additional_charges[$this->nm_grid_colunas] = $this->rs_grid->fields[9] ;  
          $this->a_additional_charges[$this->nm_grid_colunas] =  str_replace(",", ".", $this->a_additional_charges[$this->nm_grid_colunas]);
          $this->a_additional_charges[$this->nm_grid_colunas] = (string)$this->a_additional_charges[$this->nm_grid_colunas];
          $this->a_discount[$this->nm_grid_colunas] = $this->rs_grid->fields[10] ;  
          $this->a_discount[$this->nm_grid_colunas] =  str_replace(",", ".", $this->a_discount[$this->nm_grid_colunas]);
          $this->a_discount[$this->nm_grid_colunas] = (string)$this->a_discount[$this->nm_grid_colunas];
          $this->a_total_price[$this->nm_grid_colunas] = $this->rs_grid->fields[11] ;  
          $this->a_total_price[$this->nm_grid_colunas] =  str_replace(",", ".", $this->a_total_price[$this->nm_grid_colunas]);
          $this->a_total_price[$this->nm_grid_colunas] = (string)$this->a_total_price[$this->nm_grid_colunas];
          $this->details_att_appointments_type_id[$this->nm_grid_colunas] = array();
          $this->details_att_description[$this->nm_grid_colunas] = array();
          $this->details_att_price[$this->nm_grid_colunas] = array();
          $this->Lookup->lookup_details($this->details[$this->nm_grid_colunas] , $this->a_appointments_id[$this->nm_grid_colunas], $array_details); 
          $NM_ind = 0;
          $this->details = array();
          foreach ($array_details as $cada_subselect) 
          {
              $this->details[$this->nm_grid_colunas][$NM_ind] = "";
              $this->details_att_appointments_type_id[$this->nm_grid_colunas][$NM_ind] = $cada_subselect[0];
              $this->details_att_description[$this->nm_grid_colunas][$NM_ind] = $cada_subselect[1];
              $this->details_att_price[$this->nm_grid_colunas][$NM_ind] = $cada_subselect[2];
              $NM_ind++;
          }
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
              $this->a_appointments_id[$this->nm_grid_colunas] = NM_encode_input(sc_strip_script($this->a_appointments_id[$this->nm_grid_colunas]));
          }
          else {
              $this->a_appointments_id[$this->nm_grid_colunas] = sc_strip_script($this->a_appointments_id[$this->nm_grid_colunas]);
          }
          if ($this->a_appointments_id[$this->nm_grid_colunas] === "") 
          { 
              $this->a_appointments_id[$this->nm_grid_colunas] = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($this->a_appointments_id[$this->nm_grid_colunas], $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          } 
          $this->a_appointments_id[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->a_appointments_id[$this->nm_grid_colunas]);
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
              $this->a_appointment_start_date[$this->nm_grid_colunas] = NM_encode_input(sc_strip_script($this->a_appointment_start_date[$this->nm_grid_colunas]));
          }
          else {
              $this->a_appointment_start_date[$this->nm_grid_colunas] = sc_strip_script($this->a_appointment_start_date[$this->nm_grid_colunas]);
          }
          if ($this->a_appointment_start_date[$this->nm_grid_colunas] === "") 
          { 
              $this->a_appointment_start_date[$this->nm_grid_colunas] = "" ;  
          } 
          else    
          { 
               $a_appointment_start_date_x =  $this->a_appointment_start_date[$this->nm_grid_colunas];
               nm_conv_limpa_dado($a_appointment_start_date_x, "YYYY-MM-DD");
               if (is_numeric($a_appointment_start_date_x) && strlen($a_appointment_start_date_x) > 0) 
               { 
                   $this->nm_data->SetaData($this->a_appointment_start_date[$this->nm_grid_colunas], "YYYY-MM-DD");
                   $this->a_appointment_start_date[$this->nm_grid_colunas] = html_entity_decode($this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa")), ENT_COMPAT, $_SESSION['scriptcase']['charset']);
               } 
          } 
          $this->a_appointment_start_date[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->a_appointment_start_date[$this->nm_grid_colunas]);
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
              $this->c_customers_name[$this->nm_grid_colunas] = NM_encode_input(sc_strip_script($this->c_customers_name[$this->nm_grid_colunas]));
          }
          else {
              $this->c_customers_name[$this->nm_grid_colunas] = sc_strip_script($this->c_customers_name[$this->nm_grid_colunas]);
          }
          if ($this->c_customers_name[$this->nm_grid_colunas] === "") 
          { 
              $this->c_customers_name[$this->nm_grid_colunas] = "" ;  
          } 
          $this->c_customers_name[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->c_customers_name[$this->nm_grid_colunas]);
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
              $this->c_customers_address[$this->nm_grid_colunas] = NM_encode_input(sc_strip_script($this->c_customers_address[$this->nm_grid_colunas]));
          }
          else {
              $this->c_customers_address[$this->nm_grid_colunas] = sc_strip_script($this->c_customers_address[$this->nm_grid_colunas]);
          }
          if ($this->c_customers_address[$this->nm_grid_colunas] === "") 
          { 
              $this->c_customers_address[$this->nm_grid_colunas] = "" ;  
          } 
          $this->c_customers_address[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->c_customers_address[$this->nm_grid_colunas]);
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
              $this->c_customers_city[$this->nm_grid_colunas] = NM_encode_input(sc_strip_script($this->c_customers_city[$this->nm_grid_colunas]));
          }
          else {
              $this->c_customers_city[$this->nm_grid_colunas] = sc_strip_script($this->c_customers_city[$this->nm_grid_colunas]);
          }
          if ($this->c_customers_city[$this->nm_grid_colunas] === "") 
          { 
              $this->c_customers_city[$this->nm_grid_colunas] = "" ;  
          } 
          $this->c_customers_city[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->c_customers_city[$this->nm_grid_colunas]);
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
              $this->c_customers_state[$this->nm_grid_colunas] = NM_encode_input(sc_strip_script($this->c_customers_state[$this->nm_grid_colunas]));
          }
          else {
              $this->c_customers_state[$this->nm_grid_colunas] = sc_strip_script($this->c_customers_state[$this->nm_grid_colunas]);
          }
          if ($this->c_customers_state[$this->nm_grid_colunas] === "") 
          { 
              $this->c_customers_state[$this->nm_grid_colunas] = "" ;  
          } 
          $this->c_customers_state[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->c_customers_state[$this->nm_grid_colunas]);
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
              $this->c_customers_zip[$this->nm_grid_colunas] = NM_encode_input(sc_strip_script($this->c_customers_zip[$this->nm_grid_colunas]));
          }
          else {
              $this->c_customers_zip[$this->nm_grid_colunas] = sc_strip_script($this->c_customers_zip[$this->nm_grid_colunas]);
          }
          if ($this->c_customers_zip[$this->nm_grid_colunas] === "") 
          { 
              $this->c_customers_zip[$this->nm_grid_colunas] = "" ;  
          } 
          $this->c_customers_zip[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->c_customers_zip[$this->nm_grid_colunas]);
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
              $this->c_customers_phone[$this->nm_grid_colunas] = NM_encode_input(sc_strip_script($this->c_customers_phone[$this->nm_grid_colunas]));
          }
          else {
              $this->c_customers_phone[$this->nm_grid_colunas] = sc_strip_script($this->c_customers_phone[$this->nm_grid_colunas]);
          }
          if ($this->c_customers_phone[$this->nm_grid_colunas] === "") 
          { 
              $this->c_customers_phone[$this->nm_grid_colunas] = "" ;  
          } 
          $this->c_customers_phone[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->c_customers_phone[$this->nm_grid_colunas]);
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
              $this->a_price[$this->nm_grid_colunas] = NM_encode_input(sc_strip_script($this->a_price[$this->nm_grid_colunas]));
          }
          else {
              $this->a_price[$this->nm_grid_colunas] = sc_strip_script($this->a_price[$this->nm_grid_colunas]);
          }
          if ($this->a_price[$this->nm_grid_colunas] === "") 
          { 
              $this->a_price[$this->nm_grid_colunas] = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($this->a_price[$this->nm_grid_colunas], $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
          } 
          $this->a_price[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->a_price[$this->nm_grid_colunas]);
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
              $this->a_additional_charges[$this->nm_grid_colunas] = NM_encode_input(sc_strip_script($this->a_additional_charges[$this->nm_grid_colunas]));
          }
          else {
              $this->a_additional_charges[$this->nm_grid_colunas] = sc_strip_script($this->a_additional_charges[$this->nm_grid_colunas]);
          }
          if ($this->a_additional_charges[$this->nm_grid_colunas] === "") 
          { 
              $this->a_additional_charges[$this->nm_grid_colunas] = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($this->a_additional_charges[$this->nm_grid_colunas], $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
          } 
          $this->a_additional_charges[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->a_additional_charges[$this->nm_grid_colunas]);
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
              $this->a_discount[$this->nm_grid_colunas] = NM_encode_input(sc_strip_script($this->a_discount[$this->nm_grid_colunas]));
          }
          else {
              $this->a_discount[$this->nm_grid_colunas] = sc_strip_script($this->a_discount[$this->nm_grid_colunas]);
          }
          if ($this->a_discount[$this->nm_grid_colunas] === "") 
          { 
              $this->a_discount[$this->nm_grid_colunas] = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($this->a_discount[$this->nm_grid_colunas], $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
          } 
          $this->a_discount[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->a_discount[$this->nm_grid_colunas]);
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_invoice']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
              $this->a_total_price[$this->nm_grid_colunas] = NM_encode_input(sc_strip_script($this->a_total_price[$this->nm_grid_colunas]));
          }
          else {
              $this->a_total_price[$this->nm_grid_colunas] = sc_strip_script($this->a_total_price[$this->nm_grid_colunas]);
          }
          if ($this->a_total_price[$this->nm_grid_colunas] === "") 
          { 
              $this->a_total_price[$this->nm_grid_colunas] = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($this->a_total_price[$this->nm_grid_colunas], $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
          } 
          $this->a_total_price[$this->nm_grid_colunas] = $this->SC_conv_utf8($this->a_total_price[$this->nm_grid_colunas]);
          foreach ($this->details_att_appointments_type_id[$this->nm_grid_colunas] as $NM_ind => $Dados) 
          {
          if ($this->details_att_appointments_type_id[$this->nm_grid_colunas][$NM_ind] === "") 
          { 
              $this->details_att_appointments_type_id[$this->nm_grid_colunas][$NM_ind] = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($this->details_att_appointments_type_id[$this->nm_grid_colunas][$NM_ind], $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          } 
              $this->details_att_appointments_type_id[$this->nm_grid_colunas][$NM_ind] = $this->SC_conv_utf8($this->details_att_appointments_type_id[$this->nm_grid_colunas][$NM_ind]);
          }
          foreach ($this->details_att_description[$this->nm_grid_colunas] as $NM_ind => $Dados) 
          {
          if ($this->details_att_description[$this->nm_grid_colunas][$NM_ind] === "") 
          { 
              $this->details_att_description[$this->nm_grid_colunas][$NM_ind] = "" ;  
          } 
              $this->details_att_description[$this->nm_grid_colunas][$NM_ind] = $this->SC_conv_utf8($this->details_att_description[$this->nm_grid_colunas][$NM_ind]);
          }
          foreach ($this->details_att_price[$this->nm_grid_colunas] as $NM_ind => $Dados) 
          {
          if ($this->details_att_price[$this->nm_grid_colunas][$NM_ind] === "") 
          { 
              $this->details_att_price[$this->nm_grid_colunas][$NM_ind] = "" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($this->details_att_price[$this->nm_grid_colunas][$NM_ind], $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "0", "S", "2", "", "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
          } 
              $this->details_att_price[$this->nm_grid_colunas][$NM_ind] = $this->SC_conv_utf8($this->details_att_price[$this->nm_grid_colunas][$NM_ind]);
          }
                      /*-------- Def. Body --------*/
            $cell_a_appointments_id = array('posx' => '170', 'posy' => '29', 'data' => $this->a_appointments_id[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '12', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_a_appointment_start_date = array('posx' => '170', 'posy' => '21', 'data' => $this->a_appointment_start_date[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '12', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_c_customers_name = array('posx' => '10', 'posy' => '77', 'data' => $this->c_customers_name[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '12', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_c_customers_address = array('posx' => '10', 'posy' => '82', 'data' => $this->c_customers_address[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '12', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_c_customers_city = array('posx' => '10', 'posy' => '87', 'data' => $this->c_customers_city[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '12', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_c_customers_state = array('posx' => '40', 'posy' => '87', 'data' => $this->c_customers_state[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '12', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_c_customers_zip = array('posx' => '65', 'posy' => '87', 'data' => $this->c_customers_zip[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '12', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_c_customers_phone = array('posx' => '10', 'posy' => '95', 'data' => $this->c_customers_phone[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '12', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_a_price = array('posx' => '170', 'posy' => '202', 'data' => $this->a_price[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '12', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_a_additional_charges = array('posx' => '170', 'posy' => '210', 'data' => $this->a_additional_charges[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '12', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_a_discount = array('posx' => '170', 'posy' => '219', 'data' => $this->a_discount[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '12', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_a_total_price = array('posx' => '170', 'posy' => '231', 'data' => $this->a_total_price[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '12', 'color_r'    => '204', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => 'B');
            $cell_details_att_appointments_type_id = array('posx' => '20', 'posy' => '125', 'data' => $this->details_att_appointments_type_id[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '12', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_details_att_description = array('posx' => '30', 'posy' => '125', 'data' => $this->details_att_description[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '12', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);
            $cell_details_att_price = array('posx' => '170', 'posy' => '125', 'data' => $this->details_att_price[$this->nm_grid_colunas], 'width'      => '0', 'align'      => 'L', 'font_type'  => $this->default_font, 'font_size'  => '12', 'color_r'    => '0', 'color_g'    => '0', 'color_b'    => '0', 'font_style' => $this->default_style);



            $this->Pdf->SetFont($cell_a_appointments_id['font_type'], $cell_a_appointments_id['font_style'], $cell_a_appointments_id['font_size']);
            $this->pdf_text_color($cell_a_appointments_id['data'], $cell_a_appointments_id['color_r'], $cell_a_appointments_id['color_g'], $cell_a_appointments_id['color_b']);
            if (!empty($cell_a_appointments_id['posx']) && !empty($cell_a_appointments_id['posy']))
            {
                $this->Pdf->SetXY($cell_a_appointments_id['posx'], $cell_a_appointments_id['posy']);
            }
            elseif (!empty($cell_a_appointments_id['posx']))
            {
                $this->Pdf->SetX($cell_a_appointments_id['posx']);
            }
            elseif (!empty($cell_a_appointments_id['posy']))
            {
                $this->Pdf->SetY($cell_a_appointments_id['posy']);
            }
            $this->Pdf->Cell($cell_a_appointments_id['width'], 0, $cell_a_appointments_id['data'], 0, 0, $cell_a_appointments_id['align']);

            $this->Pdf->SetFont($cell_a_appointment_start_date['font_type'], $cell_a_appointment_start_date['font_style'], $cell_a_appointment_start_date['font_size']);
            $this->pdf_text_color($cell_a_appointment_start_date['data'], $cell_a_appointment_start_date['color_r'], $cell_a_appointment_start_date['color_g'], $cell_a_appointment_start_date['color_b']);
            if (!empty($cell_a_appointment_start_date['posx']) && !empty($cell_a_appointment_start_date['posy']))
            {
                $this->Pdf->SetXY($cell_a_appointment_start_date['posx'], $cell_a_appointment_start_date['posy']);
            }
            elseif (!empty($cell_a_appointment_start_date['posx']))
            {
                $this->Pdf->SetX($cell_a_appointment_start_date['posx']);
            }
            elseif (!empty($cell_a_appointment_start_date['posy']))
            {
                $this->Pdf->SetY($cell_a_appointment_start_date['posy']);
            }
            $this->Pdf->Cell($cell_a_appointment_start_date['width'], 0, $cell_a_appointment_start_date['data'], 0, 0, $cell_a_appointment_start_date['align']);

            $this->Pdf->SetFont($cell_c_customers_name['font_type'], $cell_c_customers_name['font_style'], $cell_c_customers_name['font_size']);
            $this->pdf_text_color($cell_c_customers_name['data'], $cell_c_customers_name['color_r'], $cell_c_customers_name['color_g'], $cell_c_customers_name['color_b']);
            if (!empty($cell_c_customers_name['posx']) && !empty($cell_c_customers_name['posy']))
            {
                $this->Pdf->SetXY($cell_c_customers_name['posx'], $cell_c_customers_name['posy']);
            }
            elseif (!empty($cell_c_customers_name['posx']))
            {
                $this->Pdf->SetX($cell_c_customers_name['posx']);
            }
            elseif (!empty($cell_c_customers_name['posy']))
            {
                $this->Pdf->SetY($cell_c_customers_name['posy']);
            }
            $this->Pdf->Cell($cell_c_customers_name['width'], 0, $cell_c_customers_name['data'], 0, 0, $cell_c_customers_name['align']);

            $this->Pdf->SetFont($cell_c_customers_address['font_type'], $cell_c_customers_address['font_style'], $cell_c_customers_address['font_size']);
            $this->pdf_text_color($cell_c_customers_address['data'], $cell_c_customers_address['color_r'], $cell_c_customers_address['color_g'], $cell_c_customers_address['color_b']);
            if (!empty($cell_c_customers_address['posx']) && !empty($cell_c_customers_address['posy']))
            {
                $this->Pdf->SetXY($cell_c_customers_address['posx'], $cell_c_customers_address['posy']);
            }
            elseif (!empty($cell_c_customers_address['posx']))
            {
                $this->Pdf->SetX($cell_c_customers_address['posx']);
            }
            elseif (!empty($cell_c_customers_address['posy']))
            {
                $this->Pdf->SetY($cell_c_customers_address['posy']);
            }
            $this->Pdf->Cell($cell_c_customers_address['width'], 0, $cell_c_customers_address['data'], 0, 0, $cell_c_customers_address['align']);

            $this->Pdf->SetFont($cell_c_customers_city['font_type'], $cell_c_customers_city['font_style'], $cell_c_customers_city['font_size']);
            $this->pdf_text_color($cell_c_customers_city['data'], $cell_c_customers_city['color_r'], $cell_c_customers_city['color_g'], $cell_c_customers_city['color_b']);
            if (!empty($cell_c_customers_city['posx']) && !empty($cell_c_customers_city['posy']))
            {
                $this->Pdf->SetXY($cell_c_customers_city['posx'], $cell_c_customers_city['posy']);
            }
            elseif (!empty($cell_c_customers_city['posx']))
            {
                $this->Pdf->SetX($cell_c_customers_city['posx']);
            }
            elseif (!empty($cell_c_customers_city['posy']))
            {
                $this->Pdf->SetY($cell_c_customers_city['posy']);
            }
            $this->Pdf->Cell($cell_c_customers_city['width'], 0, $cell_c_customers_city['data'], 0, 0, $cell_c_customers_city['align']);

            $this->Pdf->SetFont($cell_c_customers_state['font_type'], $cell_c_customers_state['font_style'], $cell_c_customers_state['font_size']);
            $this->pdf_text_color($cell_c_customers_state['data'], $cell_c_customers_state['color_r'], $cell_c_customers_state['color_g'], $cell_c_customers_state['color_b']);
            if (!empty($cell_c_customers_state['posx']) && !empty($cell_c_customers_state['posy']))
            {
                $this->Pdf->SetXY($cell_c_customers_state['posx'], $cell_c_customers_state['posy']);
            }
            elseif (!empty($cell_c_customers_state['posx']))
            {
                $this->Pdf->SetX($cell_c_customers_state['posx']);
            }
            elseif (!empty($cell_c_customers_state['posy']))
            {
                $this->Pdf->SetY($cell_c_customers_state['posy']);
            }
            $this->Pdf->Cell($cell_c_customers_state['width'], 0, $cell_c_customers_state['data'], 0, 0, $cell_c_customers_state['align']);

            $this->Pdf->SetFont($cell_c_customers_zip['font_type'], $cell_c_customers_zip['font_style'], $cell_c_customers_zip['font_size']);
            $this->pdf_text_color($cell_c_customers_zip['data'], $cell_c_customers_zip['color_r'], $cell_c_customers_zip['color_g'], $cell_c_customers_zip['color_b']);
            if (!empty($cell_c_customers_zip['posx']) && !empty($cell_c_customers_zip['posy']))
            {
                $this->Pdf->SetXY($cell_c_customers_zip['posx'], $cell_c_customers_zip['posy']);
            }
            elseif (!empty($cell_c_customers_zip['posx']))
            {
                $this->Pdf->SetX($cell_c_customers_zip['posx']);
            }
            elseif (!empty($cell_c_customers_zip['posy']))
            {
                $this->Pdf->SetY($cell_c_customers_zip['posy']);
            }
            $this->Pdf->Cell($cell_c_customers_zip['width'], 0, $cell_c_customers_zip['data'], 0, 0, $cell_c_customers_zip['align']);

            $this->Pdf->SetFont($cell_c_customers_phone['font_type'], $cell_c_customers_phone['font_style'], $cell_c_customers_phone['font_size']);
            $this->pdf_text_color($cell_c_customers_phone['data'], $cell_c_customers_phone['color_r'], $cell_c_customers_phone['color_g'], $cell_c_customers_phone['color_b']);
            if (!empty($cell_c_customers_phone['posx']) && !empty($cell_c_customers_phone['posy']))
            {
                $this->Pdf->SetXY($cell_c_customers_phone['posx'], $cell_c_customers_phone['posy']);
            }
            elseif (!empty($cell_c_customers_phone['posx']))
            {
                $this->Pdf->SetX($cell_c_customers_phone['posx']);
            }
            elseif (!empty($cell_c_customers_phone['posy']))
            {
                $this->Pdf->SetY($cell_c_customers_phone['posy']);
            }
            $this->Pdf->Cell($cell_c_customers_phone['width'], 0, $cell_c_customers_phone['data'], 0, 0, $cell_c_customers_phone['align']);

            $this->Pdf->SetFont($cell_a_price['font_type'], $cell_a_price['font_style'], $cell_a_price['font_size']);
            $this->pdf_text_color($cell_a_price['data'], $cell_a_price['color_r'], $cell_a_price['color_g'], $cell_a_price['color_b']);
            if (!empty($cell_a_price['posx']) && !empty($cell_a_price['posy']))
            {
                $this->Pdf->SetXY($cell_a_price['posx'], $cell_a_price['posy']);
            }
            elseif (!empty($cell_a_price['posx']))
            {
                $this->Pdf->SetX($cell_a_price['posx']);
            }
            elseif (!empty($cell_a_price['posy']))
            {
                $this->Pdf->SetY($cell_a_price['posy']);
            }
            $this->Pdf->Cell($cell_a_price['width'], 0, $cell_a_price['data'], 0, 0, $cell_a_price['align']);

            $this->Pdf->SetFont($cell_a_additional_charges['font_type'], $cell_a_additional_charges['font_style'], $cell_a_additional_charges['font_size']);
            $this->pdf_text_color($cell_a_additional_charges['data'], $cell_a_additional_charges['color_r'], $cell_a_additional_charges['color_g'], $cell_a_additional_charges['color_b']);
            if (!empty($cell_a_additional_charges['posx']) && !empty($cell_a_additional_charges['posy']))
            {
                $this->Pdf->SetXY($cell_a_additional_charges['posx'], $cell_a_additional_charges['posy']);
            }
            elseif (!empty($cell_a_additional_charges['posx']))
            {
                $this->Pdf->SetX($cell_a_additional_charges['posx']);
            }
            elseif (!empty($cell_a_additional_charges['posy']))
            {
                $this->Pdf->SetY($cell_a_additional_charges['posy']);
            }
            $this->Pdf->Cell($cell_a_additional_charges['width'], 0, $cell_a_additional_charges['data'], 0, 0, $cell_a_additional_charges['align']);

            $this->Pdf->SetFont($cell_a_discount['font_type'], $cell_a_discount['font_style'], $cell_a_discount['font_size']);
            $this->pdf_text_color($cell_a_discount['data'], $cell_a_discount['color_r'], $cell_a_discount['color_g'], $cell_a_discount['color_b']);
            if (!empty($cell_a_discount['posx']) && !empty($cell_a_discount['posy']))
            {
                $this->Pdf->SetXY($cell_a_discount['posx'], $cell_a_discount['posy']);
            }
            elseif (!empty($cell_a_discount['posx']))
            {
                $this->Pdf->SetX($cell_a_discount['posx']);
            }
            elseif (!empty($cell_a_discount['posy']))
            {
                $this->Pdf->SetY($cell_a_discount['posy']);
            }
            $this->Pdf->Cell($cell_a_discount['width'], 0, $cell_a_discount['data'], 0, 0, $cell_a_discount['align']);

            $this->Pdf->SetFont($cell_a_total_price['font_type'], $cell_a_total_price['font_style'], $cell_a_total_price['font_size']);
            $this->pdf_text_color($cell_a_total_price['data'], $cell_a_total_price['color_r'], $cell_a_total_price['color_g'], $cell_a_total_price['color_b']);
            if (!empty($cell_a_total_price['posx']) && !empty($cell_a_total_price['posy']))
            {
                $this->Pdf->SetXY($cell_a_total_price['posx'], $cell_a_total_price['posy']);
            }
            elseif (!empty($cell_a_total_price['posx']))
            {
                $this->Pdf->SetX($cell_a_total_price['posx']);
            }
            elseif (!empty($cell_a_total_price['posy']))
            {
                $this->Pdf->SetY($cell_a_total_price['posy']);
            }
            $this->Pdf->Cell($cell_a_total_price['width'], 0, $cell_a_total_price['data'], 0, 0, $cell_a_total_price['align']);

            $this->Pdf->SetY(125);
            foreach ($this->details[$this->nm_grid_colunas] as $NM_ind => $Dados)
            {
                $this->Pdf->SetFont($cell_details_att_appointments_type_id['font_type'], $cell_details_att_appointments_type_id['font_style'], $cell_details_att_appointments_type_id['font_size']);
                if (!empty($cell_details_att_appointments_type_id['posx']))
                {
                    $this->Pdf->SetX($cell_details_att_appointments_type_id['posx']);
                }
                $this->pdf_text_color($this->details_att_appointments_type_id[$this->nm_grid_colunas][$NM_ind], $cell_details_att_appointments_type_id['color_r'], $cell_details_att_appointments_type_id['color_g'], $cell_details_att_appointments_type_id['color_b']);
                $this->Pdf->Cell($cell_details_att_appointments_type_id['width'], 0, $this->details_att_appointments_type_id[$this->nm_grid_colunas][$NM_ind], 0, 0, $cell_details_att_appointments_type_id['align']);
                $this->Pdf->SetFont($cell_details_att_description['font_type'], $cell_details_att_description['font_style'], $cell_details_att_description['font_size']);
                if (!empty($cell_details_att_description['posx']))
                {
                    $this->Pdf->SetX($cell_details_att_description['posx']);
                }
                $atu_X = $this->Pdf->GetX();
                $atu_Y = $this->Pdf->GetY();
                $this->Pdf->SetTextColor($cell_details_att_description['color_r'], $cell_details_att_description['color_g'], $cell_details_att_description['color_b']);
                $this->Pdf->writeHTMLCell($cell_details_att_description['width'], 0, $atu_X, $atu_Y, $this->details_att_description[$this->nm_grid_colunas][$NM_ind], 0, 0, false, true, $cell_details_att_description['align']);
                $this->Pdf->SetY($atu_Y);
                $this->Pdf->SetFont($cell_details_att_price['font_type'], $cell_details_att_price['font_style'], $cell_details_att_price['font_size']);
                if (!empty($cell_details_att_price['posx']))
                {
                    $this->Pdf->SetX($cell_details_att_price['posx']);
                }
                $this->pdf_text_color($this->details_att_price[$this->nm_grid_colunas][$NM_ind], $cell_details_att_price['color_r'], $cell_details_att_price['color_g'], $cell_details_att_price['color_b']);
                $this->Pdf->Cell($cell_details_att_price['width'], 0, $this->details_att_price[$this->nm_grid_colunas][$NM_ind], 0, 0, $cell_details_att_price['align']);
                if (!isset($max_Y) || empty($max_Y) || $this->Pdf->GetY() < $max_Y )
                {
                    $max_Y = $this->Pdf->GetY();
                }
                $max_Y += 5;
                $this->Pdf->SetY($max_Y);

            }
          $max_Y = 0;
          $this->rs_grid->MoveNext();
          $this->sc_proc_grid = false;
          $nm_quant_linhas++ ;
      }  
   }  
   $this->rs_grid->Close();
   $this->Pdf->Output($this->Ini->root . $this->Ini->nm_path_pdf, 'F');
 }
 function pdf_text_color(&$val, $r, $g, $b)
 {
     if (is_array($val)) {
         $val = "";
     }
     $pos = strpos($val, "@SCNEG#");
     if ($pos !== false)
     {
         $cor = trim(substr($val, $pos + 7));
         $val = substr($val, 0, $pos);
         $cor = (substr($cor, 0, 1) == "#") ? substr($cor, 1) : $cor;
         if (strlen($cor) == 6)
         {
             $r = hexdec(substr($cor, 0, 2));
             $g = hexdec(substr($cor, 2, 2));
             $b = hexdec(substr($cor, 4, 2));
         }
     }
     $this->Pdf->SetTextColor($r, $g, $b);
 }
 function SC_conv_utf8($input)
 {
     if ($_SESSION['scriptcase']['charset'] != "UTF-8" && !NM_is_utf8($input))
     {
         $input = sc_convert_encoding($input, "UTF-8", $_SESSION['scriptcase']['charset']);
     }
     return $input;
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
