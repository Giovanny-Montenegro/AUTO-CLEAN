<?php
class appointment_billing_grid
{
   var $Ini;
   var $Erro;
   var $Db;
   var $Tot;
   var $Lin_impressas;
   var $Lin_final;
   var $nm_grid_colunas;
   var $rs_grid;
   var $nm_grid_ini;
   var $nm_grid_sem_reg;
   var $Rec_ini;
   var $Rec_fim;
   var $ordem_grid;
   var $nmgp_reg_start;
   var $nmgp_reg_inicial;
   var $nmgp_reg_final;
   var $SC_seq_register;
   var $nm_location;
   var $nm_data;
   var $nm_cod_barra;
   var $sc_proc_grid; 
   var $nmgp_botoes     = array();
   var $nm_btn_exist    = array();
   var $nm_btn_label    = array(); 
   var $nm_btn_disabled = array();
   var $Campos_Mens_erro;
   var $Print_All;
   var $NM_raiz_img; 
   var $progress_fp;
   var $progress_tot;
   var $progress_now;
   var $progress_lim_tot;
   var $progress_lim_now;
   var $progress_lim_qtd;
   var $progress_grid;
   var $progress_pdf;
   var $progress_res;
   var $progress_graf;
   var $count_ger;
   var $due_date = array();
   var $barcode = array();
   var $item_desc = array();
   var $item_value = array();
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
   var $c_customers_email = array();
//--- 
 function monta_grid($linhas = 0)
 {

   clearstatcache();
   $this->NM_cor_embutida();
   $this->inicializa();
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['embutida'])
   { 
       $this->Lin_impressas = 0;
       $this->Lin_final     = FALSE;
       $this->grid($linhas);
       if ($this->Lin_final)
       {
         $this->Db->Close(); 
       }
   } 
   else 
   { 
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['opcao'] != "pdf")
       { 
           $this->form_navegacao();
       } 
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['opcao'] != "pdf")
       { 
           $this->nmgp_barra_top();
           $this->nmgp_embbed_placeholder_top();
       } 
       unset ($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['save_grid']);
       $this->grid();
       $flag_apaga_pdf_log = TRUE;
       if (!$this->Print_All && $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['opcao'] == "pdf")
       { 
           $flag_apaga_pdf_log = FALSE;
           $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['opcao'] = "igual";
       } 
       $this->nm_fim_grid($flag_apaga_pdf_log);
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['opcao_print'] == "print")
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['opcao'] = $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['opcao_ant'];
       $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['opcao_print'] = "";
   }
   $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['opcao_ant'] = $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['opcao'];
 }
  function resume($linhas = 0)
  {
     $this->Lin_impressas = 0;
     $this->Lin_final     = FALSE;
     $this->grid($linhas);
     if ($this->Lin_final)
     {
         $this->Db->Close(); 
     }
  }
//--- 
 function inicializa()
 {
   global $nm_saida, 
   $rec, $nmgp_chave, $nmgp_opcao, $nmgp_ordem, $nmgp_chave_det, 
   $nmgp_quant_linhas, $nmgp_quant_colunas, $nmgp_url_saida, $nmgp_parms;
//
   $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['orig_pesq'] = "grid";
   $this->force_toolbar = false;
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['force_toolbar']))
   { 
       $this->force_toolbar = true;
       unset($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['force_toolbar']);
   } 
   include_once($this->Ini->path_third . "/barcodegen/class/BCGFont.php");
   include_once($this->Ini->path_third . "/barcodegen/class/BCGColor.php");
   include_once($this->Ini->path_third . "/barcodegen/class/BCGDrawing.php");
   include_once($this->Ini->path_third . "/barcodegen/class/BCGgs1128.barcode.php");
   if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['Ind_lig_mult'])) {
       $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['Ind_lig_mult'] = 0;
   }
   $this->Img_embbed     = false;
   $this->nm_data        = new nm_data("en_us");
   $this->Fix_bar_top    = false;
   $this->Fix_bar_bottom = false;
   $this->Grid_body      = 'id="sc_grid_body"';
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['embutida'])
   {
       $this->Grid_body = "";
   }
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['opc_liga']['fix_top'])) {
       $this->Fix_bar_top = ($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['opc_liga']['fix_top'] == "S") ? true : false;
   }
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['opc_liga']['fix_bot'])) {
       $this->Fix_bar_bottom = ($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['opc_liga']['fix_bot'] == "S") ? true : false;
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['embutida'])
   {
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['Lig_Md5']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['Lig_Md5'] = array();
       }
   }
   elseif ($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['opcao'] != "pdf" && $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['opcao'] != 'print')
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['Lig_Md5'] = array();
   }
   $this->grid_emb_form = false;
   $this->grid_emb_form_full = false;
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['embutida_form']) && $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['embutida_form'])
   {
       if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['embutida_form_full']) && $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['embutida_form_full'])
       {
          $this->grid_emb_form_full = true;
       }
       else
       {
           $this->grid_emb_form = true;
           $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['mostra_edit'] = "N";
       }
   }
   $this->aba_iframe = false;
   $this->Print_All = $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['print_all'];
   if ($this->Print_All)
   {
       $this->Ini->nm_limite_lin = $this->Ini->nm_limite_lin_prt; 
   }
   if (isset($_SESSION['scriptcase']['sc_aba_iframe']))
   {
       foreach ($_SESSION['scriptcase']['sc_aba_iframe'] as $aba => $apls_aba)
       {
           if (in_array("appointment_billing", $apls_aba))
           {
               $this->aba_iframe = true;
               break;
           }
       }
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['iframe_menu'] && (!isset($_SESSION['scriptcase']['menu_mobile']) || empty($_SESSION['scriptcase']['menu_mobile'])))
   {
       $this->aba_iframe = true;
   }
   $this->nmgp_botoes['group_1'] = "on";
   $this->nmgp_botoes['group_1'] = "on";
   $this->nmgp_botoes['exit'] = "on";
   $this->nmgp_botoes['first'] = "off";
   $this->nmgp_botoes['back'] = "off";
   $this->nmgp_botoes['forward'] = "off";
   $this->nmgp_botoes['last'] = "off";
   $this->nmgp_botoes['filter'] = "on";
   $this->nmgp_botoes['pdf'] = "on";
   $this->nmgp_botoes['xls'] = "on";
   $this->nmgp_botoes['xml'] = "on";
   $this->nmgp_botoes['json'] = "on";
   $this->nmgp_botoes['csv'] = "on";
   $this->nmgp_botoes['export'] = "on";
   if (isset($_SESSION['scriptcase']['sc_apl_conf']['appointment_billing']['export']) && $_SESSION['scriptcase']['sc_apl_conf']['appointment_billing']['export'] == 'off')
   {
       $this->nmgp_botoes['export'] = "off";
   }
   $this->nmgp_botoes['print'] = "on";
   if (isset($_SESSION['scriptcase']['sc_apl_conf']['appointment_billing']['print']) && $_SESSION['scriptcase']['sc_apl_conf']['appointment_billing']['print'] == 'off')
   {
       $this->nmgp_botoes['print'] = "off";
   }
   $this->nmgp_botoes['sel_col'] = "off";
   $this->nmgp_botoes['gridsave'] = "on";
   if (isset($_SESSION['scriptcase']['sc_apl_conf']['appointment_billing']['btn_display']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['appointment_billing']['btn_display']))
   {
       foreach ($_SESSION['scriptcase']['sc_apl_conf']['appointment_billing']['btn_display'] as $NM_cada_btn => $NM_cada_opc)
       {
           $this->nmgp_botoes[$NM_cada_btn] = $NM_cada_opc;
       }
   }
   $this->ordem_grid   = ""; 
   $this->sc_proc_grid = false; 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['doc_word'] || $this->Ini->sc_export_ajax_img)
   { 
       $this->NM_raiz_img = $this->Ini->root; 
   } 
   else 
   { 
       $this->NM_raiz_img = ""; 
   } 
   $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
   $this->nm_where_dinamico = "";
   $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['where_pesq'] = $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['where_pesq_ant'];  
   $this->nm_grid_colunas = 0;
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['campos_busca']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['campos_busca']))
   { 
       $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['campos_busca'];
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
   } 
   else 
   { 
       $this->a_appointment_start_date_2 = ""; 
   } 
   $this->nm_field_dinamico = array();
   $this->nm_order_dinamico = array();
   $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['where_orig'];
   $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['where_pesq'];
   $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['where_pesq_filtro'];
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['opcao'] == "muda_qt_linhas")
   { 
       unset($rec);
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['opcao'] == "muda_rec_linhas")
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['opcao'] = "muda_qt_linhas";
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['embutida'])
   {
       $nmgp_ordem = ""; 
       $rec = "ini"; 
   } 
//
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['embutida'])
   { 
       include_once($this->Ini->path_embutida . "appointment_billing/appointment_billing_total.class.php"); 
   } 
   else 
   { 
       include_once($this->Ini->path_aplicacao . "appointment_billing_total.class.php"); 
   } 
   $dir_raiz          = strrpos($_SERVER['PHP_SELF'],"/") ;  
   $dir_raiz          = substr($_SERVER['PHP_SELF'], 0, $dir_raiz + 1) ;  
   $this->nm_location = $this->Ini->sc_protocolo . $this->Ini->server . $dir_raiz; 
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['embutida'])
   { 
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['opcao'] != "pdf")  
       { 
           $_SESSION['scriptcase']['contr_link_emb'] = $this->nm_location;
       } 
       else 
       { 
           $_SESSION['scriptcase']['contr_link_emb'] = "pdf";
       } 
   } 
   else 
   { 
       $this->nm_location = $_SESSION['scriptcase']['contr_link_emb'];
   } 
   $this->Tot         = new appointment_billing_total($this->Ini->sc_page);
   $this->Tot->Db     = $this->Db;
   $this->Tot->Erro   = $this->Erro;
   $this->Tot->Ini    = $this->Ini;
   $this->Tot->Lookup = $this->Lookup;
   if (empty($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['qt_lin_grid']))  
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['qt_lin_grid'] = 1 ;  
       $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['qt_col_grid'] = 1 ;  
   }   
   if (isset($_SESSION['scriptcase']['sc_apl_conf']['appointment_billing']['rows']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['appointment_billing']['rows']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['qt_lin_grid'] = $_SESSION['scriptcase']['sc_apl_conf']['appointment_billing']['rows'];  
       unset($_SESSION['scriptcase']['sc_apl_conf']['appointment_billing']['rows']);
   }
   if (isset($_SESSION['scriptcase']['sc_apl_conf']['appointment_billing']['cols']) && !empty($_SESSION['scriptcase']['sc_apl_conf']['appointment_billing']['cols']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['qt_col_grid'] = $_SESSION['scriptcase']['sc_apl_conf']['appointment_billing']['cols'];  
       unset($_SESSION['scriptcase']['sc_apl_conf']['appointment_billing']['cols']);
   }
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['opc_liga']['rows']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['qt_lin_grid'] = $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['opc_liga']['rows'];  
   }
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['opc_liga']['cols']))
   {
       $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['qt_col_grid'] = $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['opc_liga']['cols'];  
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['opcao'] == "muda_qt_linhas") 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['opcao']  = "igual" ;  
       if (!empty($nmgp_quant_linhas) && !is_array($nmgp_quant_linhas)) 
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['qt_lin_grid'] = $nmgp_quant_linhas ;  
       } 
       if (!empty($nmgp_quant_colunas)) 
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['qt_col_grid'] = $nmgp_quant_colunas ;  
       } 
   }   
   $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['qt_reg_grid'] = $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['qt_lin_grid'] * $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['qt_col_grid']; 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['qt_col_grid'] != 0) 
   { 
       $this->Ini->nm_width_col_dados = $this->Ini->nm_width_col_dados / $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['qt_col_grid'];
   } 
   $this->Ini->nm_width_col_dados .= "px";
   if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['ordem_select']))  
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['ordem_select'] = array(); 
       $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['ordem_select_orig'] = $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['ordem_select']; 
   } 
   if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['ordem_quebra']))  
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['ordem_grid'] = "" ; 
       $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['ordem_ant']  = ""; 
       $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['ordem_desc'] = "" ; 
   }   
   if (!empty($nmgp_ordem))  
   { 
       $nmgp_ordem = str_replace('\"', '"', $nmgp_ordem); 
       $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['ordem_grid'] = $nmgp_ordem  ; 
       $this->ordem_grid = $nmgp_ordem; 
   }   
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['opcao'] == "ordem")  
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['opcao'] = "inicio" ;  
       if (($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['ordem_ant'] == $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['ordem_grid']) && $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['ordem_desc'] == "")  
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['ordem_desc'] = " desc" ; 
       } 
       else   
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['ordem_desc'] = "" ;  
       } 
       $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['ordem_ant'] = $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['ordem_grid'];  
   }  
   if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['inicio']))  
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['inicio'] = 0 ;  
       $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['final']  = 0 ;  
   }   
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['opc_edit'])  
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['opc_edit'] = false;  
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['opcao'] != "inicio") 
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['opcao'] = "edit" ; 
       } 
   }   
   if (!empty($nmgp_parms) && $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['opcao'] != "pdf")   
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['opcao'] = "igual";
       $rec = "ini";
   }
   if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['where_orig']) || $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['prim_cons'] || !empty($nmgp_parms))  
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['prim_cons'] = false;  
       $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['where_orig'] = " where (a.appointments_id = " . $_SESSION['var_appointment_id'] . ")";  
       $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['where_pesq']        = $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['where_orig'];  
       $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['where_pesq_ant']    = $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['where_orig'];  
       $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['cond_pesq']         = ""; 
       $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['where_pesq_filtro'] = "";
   }   
   if  (!empty($this->nm_where_dinamico)) 
   {   
       $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['where_pesq'] .= $this->nm_where_dinamico;
   }   
   $this->sc_where_orig   = $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['where_orig'];
   $this->sc_where_atual  = $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['where_pesq'];
   $this->sc_where_filtro = $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['where_pesq_filtro'];
   $this->sc_where_atual_f = (!empty($this->sc_where_atual)) ? "(" . trim(substr($this->sc_where_atual, 6)) . ")" : "";
   $this->sc_where_atual_f = str_replace("%", "@percent@", $this->sc_where_atual_f);
   $this->sc_where_atual_f = "NM_where_filter*scin" . str_replace("'", "@aspass@", $this->sc_where_atual_f) . "*scout";
//
//--------- 
//
   $nmgp_opc_orig = $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['opcao']; 
   if (isset($rec)) 
   { 
       if ($rec == "ini") 
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['opcao'] = "inicio" ; 
       } 
       elseif ($rec == "fim") 
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['opcao'] = "final" ; 
       } 
           else 
           { 
               $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['opcao'] = "avanca" ; 
               $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['final'] = $rec; 
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['final'] > 0) 
               { 
                   $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['final']-- ; 
               } 
          } 
   } 
   $NM_opcao       = $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['opcao']; 
   if ($NM_opcao == "print") 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['opcao_print'] = "print" ; 
       $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['opcao']       = "igual" ; 
       if ($this->Ini->sc_export_ajax) 
       { 
           $this->Img_embbed = true;
       } 
   } 
// 
   $this->count_ger = 0;
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['opcao'] == "final" || $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['qt_reg_grid'] == "all") 
   { 
       $Gb_geral = "quebra_geral_" . $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['SC_Ind_Groupby'];
       $this->Tot->$Gb_geral();
       $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['sc_total'] = $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['tot_geral'][1] ;  
       $this->count_ger = $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['tot_geral'][1];
   } 
   if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['where_dinamic']) && $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['where_dinamic'] != $this->nm_where_dinamico)  
   { 
       unset($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['tot_geral']);
   } 
   $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['where_dinamic'] = $this->nm_where_dinamico;  
   if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['tot_geral']) || $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['where_pesq'] != $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['where_pesq_ant'] || $nmgp_opc_orig == "edit") 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['contr_total_geral'] = "NAO";
       unset($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['sc_total']);
       $Gb_geral = "quebra_geral_" . $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['SC_Ind_Groupby'];
       $this->Tot->$Gb_geral();
       if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['contr_array_resumo']))  
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['contr_array_resumo'] = "NAO";
       } 
       $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['sc_total'] = $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['tot_geral'][1] ;  
       $this->count_ger = $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['tot_geral'][1];
   } 
   $this->count_ger = $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['tot_geral'][1];
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['qt_reg_grid'] == "all") 
   { 
        $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['qt_reg_grid'] = $this->count_ger;
        $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['opcao']       = "inicio";
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['opcao'] == "inicio" || $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['opcao'] == "pesq") 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['inicio'] = 0 ; 
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['opcao'] == "final") 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['inicio'] = $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['sc_total'] - $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['qt_reg_grid']; 
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['inicio'] < 0) 
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['inicio'] = 0 ; 
       } 
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['opcao'] == "retorna") 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['inicio'] = $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['inicio'] - $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['qt_reg_grid']; 
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['inicio'] < 0) 
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['inicio'] = 0 ; 
       } 
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['opcao'] == "avanca" && $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['sc_total'] >  $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['final']) 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['inicio'] = $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['final']; 
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['opcao_print'] != "print" && substr($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['opcao'], 0, 7) != "detalhe" && $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['opcao'] != "pdf") 
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['opcao'] = "igual"; 
   } 
   $this->Rec_ini = $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['inicio'] - $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['qt_reg_grid']; 
   if ($this->Rec_ini < 0) 
   { 
       $this->Rec_ini = 0; 
   } 
   $this->Rec_fim = $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['inicio'] + $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['qt_reg_grid'] + 1; 
   if ($this->Rec_fim > $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['sc_total']) 
   { 
       $this->Rec_fim = $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['sc_total']; 
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['inicio'] > 0) 
   { 
       $this->Rec_ini++ ; 
   } 
   $this->nmgp_reg_start = $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['inicio']; 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['inicio'] > 0) 
   { 
       $this->nmgp_reg_start-- ; 
   } 
   $this->nm_grid_ini = $this->nmgp_reg_start + 1; 
   if ($this->nmgp_reg_start != 0) 
   { 
       $this->nm_grid_ini++;
   }  
//----- 
   if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
   { 
       $nmgp_select = "SELECT a.appointments_id as a_appointments_id, str_replace (convert(char(10),a.appointment_start_date,102), '.', '-') + ' ' + convert(char(8),a.appointment_start_date,20) as a_appointment_start_date, c.customers_name as c_customers_name, c.customers_address as c_customers_address, c.customers_city as c_customers_city, c.customers_state as c_customers_state, c.customers_zip as c_customers_zip, c.customers_phone as c_customers_phone, a.price as a_price, a.additional_charges as a_additional_charges, a.discount as a_discount, a.total_price as a_total_price, c.customers_email as c_customers_email from " . $this->Ini->nm_tabela; 
   } 
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
   { 
       $nmgp_select = "SELECT a.appointments_id as a_appointments_id, a.appointment_start_date as a_appointment_start_date, c.customers_name as c_customers_name, c.customers_address as c_customers_address, c.customers_city as c_customers_city, c.customers_state as c_customers_state, c.customers_zip as c_customers_zip, c.customers_phone as c_customers_phone, a.price as a_price, a.additional_charges as a_additional_charges, a.discount as a_discount, a.total_price as a_total_price, c.customers_email as c_customers_email from " . $this->Ini->nm_tabela; 
   } 
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
   { 
       $nmgp_select = "SELECT a.appointments_id as a_appointments_id, convert(char(23),a.appointment_start_date,121) as a_appointment_start_date, c.customers_name as c_customers_name, c.customers_address as c_customers_address, c.customers_city as c_customers_city, c.customers_state as c_customers_state, c.customers_zip as c_customers_zip, c.customers_phone as c_customers_phone, a.price as a_price, a.additional_charges as a_additional_charges, a.discount as a_discount, a.total_price as a_total_price, c.customers_email as c_customers_email from " . $this->Ini->nm_tabela; 
   } 
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
   { 
       $nmgp_select = "SELECT a.appointments_id as a_appointments_id, a.appointment_start_date as a_appointment_start_date, c.customers_name as c_customers_name, c.customers_address as c_customers_address, c.customers_city as c_customers_city, c.customers_state as c_customers_state, c.customers_zip as c_customers_zip, c.customers_phone as c_customers_phone, a.price as a_price, a.additional_charges as a_additional_charges, a.discount as a_discount, a.total_price as a_total_price, c.customers_email as c_customers_email from " . $this->Ini->nm_tabela; 
   } 
   elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
   { 
       $nmgp_select = "SELECT a.appointments_id as a_appointments_id, EXTEND(a.appointment_start_date, YEAR TO DAY) as a_appointment_start_date, c.customers_name as c_customers_name, c.customers_address as c_customers_address, c.customers_city as c_customers_city, c.customers_state as c_customers_state, c.customers_zip as c_customers_zip, c.customers_phone as c_customers_phone, a.price as a_price, a.additional_charges as a_additional_charges, a.discount as a_discount, a.total_price as a_total_price, c.customers_email as c_customers_email from " . $this->Ini->nm_tabela; 
   } 
   else 
   { 
       $nmgp_select = "SELECT a.appointments_id as a_appointments_id, a.appointment_start_date as a_appointment_start_date, c.customers_name as c_customers_name, c.customers_address as c_customers_address, c.customers_city as c_customers_city, c.customers_state as c_customers_state, c.customers_zip as c_customers_zip, c.customers_phone as c_customers_phone, a.price as a_price, a.additional_charges as a_additional_charges, a.discount as a_discount, a.total_price as a_total_price, c.customers_email as c_customers_email from " . $this->Ini->nm_tabela; 
   } 
   $nmgp_select .= " " . $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['where_pesq']; 
   $nmgp_order_by = ""; 
   $campos_order_select = "";
   foreach($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['ordem_select'] as $campo => $ordem) 
   {
        if ($campo != $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['ordem_grid']) 
        {
           if (!empty($campos_order_select)) 
           {
               $campos_order_select .= ", ";
           }
           $campos_order_select .= $campo . " " . $ordem;
        }
   }
   if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['ordem_grid'])) 
   { 
       $nmgp_order_by = " order by " . $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['ordem_grid'] . $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['ordem_desc']; 
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
   $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['order_grid'] = $nmgp_order_by;
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['embutida'] || $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['opcao'] == "pdf" || $this->Ini->Apl_paginacao == "FULL")
   {
       $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nmgp_select; 
       $this->rs_grid = $this->Db->Execute($nmgp_select) ; 
   }
   else  
   {
       $_SESSION['scriptcase']['sc_sql_ult_comando'] = "SelectLimit($nmgp_select, " . ($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['qt_reg_grid'] + 2) . ", $this->nmgp_reg_start)" ; 
       $this->rs_grid = $this->Db->SelectLimit($nmgp_select, $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['qt_reg_grid'] + 2, $this->nmgp_reg_start) ; 
   }  
   if ($this->rs_grid === false && !$this->rs_grid->EOF && $GLOBALS["NM_ERRO_IBASE"] != 1) 
   { 
       $this->Erro->mensagem(__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
       exit ; 
   }  
   if ($this->rs_grid->EOF || ($this->rs_grid === false && $GLOBALS["NM_ERRO_IBASE"] == 1)) 
   { 
       $this->force_toolbar = true;
       $this->nm_grid_sem_reg = $this->Ini->Nm_lang['lang_errm_empt']; 
   }  
   else 
   { 
       $this->nm_grid_colunas = 0;
       $this->a_appointments_id[0] = $this->rs_grid->fields[0] ;  
       $this->a_appointments_id[0] = (string)$this->a_appointments_id[0];
       $this->a_appointment_start_date[0] = $this->rs_grid->fields[1] ;  
       $this->c_customers_name[0] = $this->rs_grid->fields[2] ;  
       $this->c_customers_address[0] = $this->rs_grid->fields[3] ;  
       $this->c_customers_city[0] = $this->rs_grid->fields[4] ;  
       $this->c_customers_state[0] = $this->rs_grid->fields[5] ;  
       $this->c_customers_zip[0] = $this->rs_grid->fields[6] ;  
       $this->c_customers_phone[0] = $this->rs_grid->fields[7] ;  
       $this->a_price[0] = $this->rs_grid->fields[8] ;  
       $this->a_price[0] =  str_replace(",", ".", $this->a_price[0]);
       $this->a_price[0] = (string)$this->a_price[0];
       $this->a_additional_charges[0] = $this->rs_grid->fields[9] ;  
       $this->a_additional_charges[0] =  str_replace(",", ".", $this->a_additional_charges[0]);
       $this->a_additional_charges[0] = (string)$this->a_additional_charges[0];
       $this->a_discount[0] = $this->rs_grid->fields[10] ;  
       $this->a_discount[0] =  str_replace(",", ".", $this->a_discount[0]);
       $this->a_discount[0] = (string)$this->a_discount[0];
       $this->a_total_price[0] = $this->rs_grid->fields[11] ;  
       $this->a_total_price[0] =  str_replace(",", ".", $this->a_total_price[0]);
       $this->a_total_price[0] = (string)$this->a_total_price[0];
       $this->c_customers_email[0] = $this->rs_grid->fields[12] ;  
       $this->New_label['a_appointments_id'] = "" . $this->Ini->Nm_lang['lang_appointments_fld_appointments_id'] . "";
       $this->New_label['a_appointment_start_date'] = "" . $this->Ini->Nm_lang['lang_appointments_fld_appointment_start_date'] . "";
       $this->New_label['c_customers_name'] = "" . $this->Ini->Nm_lang['lang_customers_fld_customers_name'] . "";
       $this->New_label['c_customers_address'] = "" . $this->Ini->Nm_lang['lang_customers_fld_customers_address'] . "";
       $this->New_label['c_customers_city'] = "" . $this->Ini->Nm_lang['lang_customers_fld_customers_city'] . "";
       $this->New_label['c_customers_state'] = "" . $this->Ini->Nm_lang['lang_customers_fld_customers_state'] . "";
       $this->New_label['c_customers_zip'] = "" . $this->Ini->Nm_lang['lang_customers_fld_customers_zip'] . "";
       $this->New_label['c_customers_phone'] = "" . $this->Ini->Nm_lang['lang_customers_fld_customers_phone'] . "";
       $this->New_label['a_price'] = "" . $this->Ini->Nm_lang['lang_appointments_fld_price'] . "";
       $this->New_label['a_additional_charges'] = "" . $this->Ini->Nm_lang['lang_appointments_fld_additional_charges'] . "";
       $this->New_label['a_discount'] = "" . $this->Ini->Nm_lang['lang_appointments_fld_discount'] . "";
       $this->New_label['a_total_price'] = "" . $this->Ini->Nm_lang['lang_appointments_fld_total_price'] . "";
       $this->New_label['c_customers_email'] = "" . $this->Ini->Nm_lang['lang_customers_fld_customers_email'] . "";
          $this->due_date[0] = "";
          $this->barcode[0] = "";
          $this->item_desc[0] = "";
          $this->item_value[0] = "";
       $this->SC_seq_register = $this->nmgp_reg_start ; 
       $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['final'] = $this->nmgp_reg_start ; 
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['inicio'] != 0 && $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['opcao'] != "pdf") 
       { 
           $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['final']++ ; 
           $this->SC_seq_register = $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['final']; 
           $this->rs_grid->MoveNext(); 
           $this->a_appointments_id[0] = $this->rs_grid->fields[0] ;  
           $this->a_appointment_start_date[0] = $this->rs_grid->fields[1] ;  
           $this->c_customers_name[0] = $this->rs_grid->fields[2] ;  
           $this->c_customers_address[0] = $this->rs_grid->fields[3] ;  
           $this->c_customers_city[0] = $this->rs_grid->fields[4] ;  
           $this->c_customers_state[0] = $this->rs_grid->fields[5] ;  
           $this->c_customers_zip[0] = $this->rs_grid->fields[6] ;  
           $this->c_customers_phone[0] = $this->rs_grid->fields[7] ;  
           $this->a_price[0] = $this->rs_grid->fields[8] ;  
           $this->a_additional_charges[0] = $this->rs_grid->fields[9] ;  
           $this->a_discount[0] = $this->rs_grid->fields[10] ;  
           $this->a_total_price[0] = $this->rs_grid->fields[11] ;  
           $this->c_customers_email[0] = $this->rs_grid->fields[12] ;  
       } 
   } 
   $this->NM_hidden_filters = ($this->Ini->Embutida_iframe && !empty($this->nm_grid_sem_reg) && $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['initialize']) ? true : false;
   $this->nmgp_reg_inicial  = $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['final'] + 1;
   $this->nmgp_reg_final    = $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['final'] + $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['qt_reg_grid'];
   $this->nmgp_reg_final    = ($this->nmgp_reg_final > $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['tot_geral'][1]) ? $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['tot_geral'][1] : $this->nmgp_reg_final;
// 
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['embutida'])
   { 
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['doc_word'] && !$this->Ini->sc_export_ajax)
       {
           require_once($this->Ini->path_lib_php . "/sc_progress_bar.php");
           $this->pb = new scProgressBar();
           $this->pb->setRoot($this->Ini->root);
           $this->pb->setDir($_SESSION['scriptcase']['appointment_billing']['glo_nm_path_imag_temp'] . "/");
           $this->pb->setProgressbarMd5($_GET['pbmd5']);
           $this->pb->initialize();
           $this->pb->setReturnUrl("./");
           $this->pb->setReturnOption($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['word_return']);
           $this->pb->setTotalSteps($this->count_ger);
       }
       if (!$this->Ini->sc_export_ajax && !$this->Print_All && $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['opcao'] == "pdf" && $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['embutida_pdf'] != "pdf")
       {
           //---------- Gauge ----------
?>
<HTML<?php echo $_SESSION['scriptcase']['reg_conf']['html_dir'] ?>>
<HEAD>
 <TITLE><?php echo $this->Ini->Nm_lang['lang_othr_grid_titl'] ?> :: PDF</TITLE>
 <META http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <META http-equiv="Expires" content="Fri, Jan 01 1900 00:00:00 GMT">
 <META http-equiv="Last-Modified" content="<?php echo gmdate("D, d M Y H:i:s"); ?>" GMT">
 <META http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate">
 <META http-equiv="Cache-Control" content="post-check=0, pre-check=0">
 <META http-equiv="Pragma" content="no-cache">
if ($_SESSION['scriptcase']['proc_mobile'])
{
       $nm_saida->saida("   <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0\" />\r\n");
}
 <link rel="shortcut icon" href="../_lib/img/sys__NM__img__NM__1402365182_app_type_car_dealer_512px_GREY.png">
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_all ?>_grid.css" /> 
 <link rel="stylesheet" type="text/css" href="../_lib/css/<?php echo $this->Ini->str_schema_all ?>_grid<?php echo $_SESSION['scriptcase']['reg_conf']['css_dir'] ?>.css" /> 
 <?php 
 if(isset($this->Ini->str_google_fonts) && !empty($this->Ini->str_google_fonts)) 
 { 
 ?> 
 <link href="<?php echo $this->Ini->str_google_fonts ?>" rel="stylesheet" /> 
 <?php 
 } 
 ?> 
 <link rel="stylesheet" type="text/css" href="../_lib/buttons/<?php echo $this->Ini->Str_btn_css ?>" /> 
 <SCRIPT LANGUAGE="Javascript" SRC="<?php echo $this->Ini->path_js; ?>/nm_gauge.js"></SCRIPT>
</HEAD>
<BODY id="grid_freehtml" class="<?php echo $this->css_scGridPage ?>">
<table class="scGridTabela"><tr class="scGridFieldOddVert"><td>
<?php echo $this->Ini->Nm_lang['lang_pdff_gnrt']; ?>...<br>
<?php
           $this->progress_grid    = $this->rs_grid->RecordCount();
           $this->progress_pdf     = 0;
           $this->progress_res     = isset($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['pivot_charts']) ? sizeof($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['pivot_charts']) : 0;
           $this->progress_graf    = 0;
           $this->progress_tot     = 0;
           $this->progress_now     = 0;
           $this->progress_lim_tot = 0;
           $this->progress_lim_now = 0;
           if (-1 < $this->progress_grid)
           {
               $this->progress_lim_qtd = (250 < $this->progress_grid) ? 250 : $this->progress_grid;
               $this->progress_lim_tot = floor($this->progress_grid / $this->progress_lim_qtd);
               $this->progress_pdf     = floor($this->progress_grid * 0.25) + 1;
               $this->progress_tot     = $this->progress_grid + $this->progress_pdf + $this->progress_res + $this->progress_graf;
               $str_pbfile             = $this->Ini->root . $this->Ini->path_imag_temp . '/sc_pb_' . session_id() . '.tmp';
               $this->progress_fp      = fopen($str_pbfile, 'w');
               appointment_billing_pdf_progress_call("PDF\n", $this->Ini->Nm_lang);
               appointment_billing_pdf_progress_call($this->Ini->path_js   . "\n", $this->Ini->Nm_lang);
               appointment_billing_pdf_progress_call($this->Ini->path_prod . "/img/\n", $this->Ini->Nm_lang);
               appointment_billing_pdf_progress_call($this->progress_tot   . "\n", $this->Ini->Nm_lang);
               fwrite($this->progress_fp, "PDF\n");
               fwrite($this->progress_fp, $this->Ini->path_js   . "\n");
               fwrite($this->progress_fp, $this->Ini->path_prod . "/img/\n");
               fwrite($this->progress_fp, $this->progress_tot   . "\n");
               $lang_protect = $this->Ini->Nm_lang['lang_pdff_strt'];
               if (!NM_is_utf8($lang_protect))
               {
                   $lang_protect = sc_convert_encoding($lang_protect, "UTF-8", $_SESSION['scriptcase']['charset']);
               }
               appointment_billing_pdf_progress_call($this->progress_tot . "_#NM#_" . "1_#NM#_" . $lang_protect . "...\n", $this->Ini->Nm_lang);
               fwrite($this->progress_fp, "1_#NM#_" . $lang_protect . "...\n");
               flush();
           }
       }
       $nm_fundo_pagina = ""; 
       if ("" != $this->Ini->img_fun_pag)
       {
           $nm_fundo_pagina = " background=\"" . $this->Ini->path_img_modelo . "/"  . $this->Ini->img_fun_pag . "\""; 
       }
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['doc_word'])
       {
       $nm_saida->saida("  <html xmlns:o=\"urn:schemas-microsoft-com:office:office\" xmlns:x=\"urn:schemas-microsoft-com:office:word\" xmlns=\"http://www.w3.org/TR/REC-html40\">\r\n");
       }
$nm_saida->saida("<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\"\r\n");
$nm_saida->saida("            \"http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd\">\r\n");
       $nm_saida->saida("  <HTML" . $_SESSION['scriptcase']['reg_conf']['html_dir'] . ">\r\n");
       $nm_saida->saida("  <HEAD>\r\n");
       $nm_saida->saida("   <TITLE>" . $this->Ini->Nm_lang['lang_othr_grid_titl'] . "</TITLE>\r\n");
       $nm_saida->saida(" <META http-equiv=\"Content-Type\" content=\"text/html; charset=" . $_SESSION['scriptcase']['charset_html'] . "\" />\r\n");
       if ($_SESSION['scriptcase']['proc_mobile'])
       {
           $nm_saida->saida("   <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0\" />\r\n");
       }
       if (!$_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['doc_word'])
       {
       $nm_saida->saida("   <META http-equiv=\"Expires\" content=\"Fri, Jan 01 1900 00:00:00 GMT\"/>\r\n");
       $nm_saida->saida("   <META http-equiv=\"Last-Modified\" content=\"" . gmdate("D, d M Y H:i:s") . " GMT\"/>\r\n");
       $nm_saida->saida("   <META http-equiv=\"Cache-Control\" content=\"no-store, no-cache, must-revalidate\"/>\r\n");
       $nm_saida->saida("   <META http-equiv=\"Cache-Control\" content=\"post-check=0, pre-check=0\"/>\r\n");
       $nm_saida->saida("   <META http-equiv=\"Pragma\" content=\"no-cache\"/>\r\n");
       }
       $nm_saida->saida("   <link rel=\"shortcut icon\" href=\"../_lib/img/sys__NM__img__NM__1402365182_app_type_car_dealer_512px_GREY.png\">\r\n");
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['opcao'] != "pdf" && !$_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['embutida'])
       { 
           $css_body = "";
       } 
       else 
       { 
           $css_body = "margin-left:0px;margin-right:0px;margin-top:0px;margin-bottom:0px;";
       } 
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['opcao'] != "pdf" && !$_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['embutida'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['ajax_nav'])
       { 
           $nm_saida->saida("   <form name=\"form_ajax_redir_1\" method=\"post\" style=\"display: none\">\r\n");
           $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_parms\">\r\n");
           $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_outra_jan\">\r\n");
           $nm_saida->saida("   </form>\r\n");
           $nm_saida->saida("   <form name=\"form_ajax_redir_2\" method=\"post\" style=\"display: none\"> \r\n");
           $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_parms\">\r\n");
           $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_url_saida\">\r\n");
           $nm_saida->saida("    <input type=\"hidden\" name=\"script_case_init\">\r\n");
           $nm_saida->saida("   </form>\r\n");
           $nm_saida->saida("   <script type=\"text/javascript\" src=\"appointment_billing_jquery-3.6.0.min.js\"></script>\r\n");
           $nm_saida->saida("   <script type=\"text/javascript\" src=\"appointment_billing_ajax.js\"></script>\r\n");
           $nm_saida->saida("   <script type=\"text/javascript\" src=\"appointment_billing_message.js\"></script>\r\n");
           $nm_saida->saida("   <script type=\"text/javascript\">\r\n");
           $nm_saida->saida("     var sc_ajaxBg = '" . $this->Ini->Color_bg_ajax . "';\r\n");
           $nm_saida->saida("     var sc_ajaxBordC = '" . $this->Ini->Border_c_ajax . "';\r\n");
           $nm_saida->saida("     var sc_ajaxBordS = '" . $this->Ini->Border_s_ajax . "';\r\n");
           $nm_saida->saida("     var sc_ajaxBordW = '" . $this->Ini->Border_w_ajax . "';\r\n");
           $nm_saida->saida("   </script>\r\n");
$nm_saida->saida("<script>\r\n");
$nm_saida->saida("function ajax_check_file(img_name, field , i , p, p_cache){\r\n");
$nm_saida->saida("    $('.cls_'+field+'_'+i).attr('src', '" . $this->Ini->path_icones . "/ scriptcase__NM__ajax_load.gif');\r\n");
$nm_saida->saida("    $(document).ready(function(){\r\n");
$nm_saida->saida("    var rs =$.ajax({\r\n");
$nm_saida->saida("                type: \"POST\",\r\n");
$nm_saida->saida("                url: 'index.php?script_case_init=" . $this->Ini->sc_page . "',\r\n");
$nm_saida->saida("                async: true,\r\n");
$nm_saida->saida("                data: 'nmgp_opcao=ajax_check_file&AjaxCheckImg=' + img_name +'&rsargs='+ field + '&p='+ p + '&p_cache='+ p_cache,\r\n");
$nm_saida->saida("            }).done(function (rs) {\r\n");
$nm_saida->saida("                    if(rs.indexOf('</span>') != -1){\r\n");
$nm_saida->saida("                        rs = rs.substr(rs.indexOf('</span>')  + 7);\r\n");
$nm_saida->saida("                    }\r\n");
$nm_saida->saida("                    if (rs != 0) {\r\n");
$nm_saida->saida("                        rs = rs.trim().split('_@@NM@@_')[1];\r\n");
$nm_saida->saida("                        if($('.cls_'+field+'_'+i).length !=0){\r\n");
$nm_saida->saida("                            $('.cls_'+field+'_'+i).attr('src', rs);\r\n");
$nm_saida->saida("                        } else{\r\n");
$nm_saida->saida("                            $('.cls_link_doc_'+field+'_'+i).each(function(i,t){\r\n");
$nm_saida->saida("                                if($(t).attr('href') !== undefined){\r\n");
$nm_saida->saida("                                    var __tmp = $(t).attr('href').split(\"',\");\r\n");
$nm_saida->saida("                                    var ___tmp = __tmp[0].split('@SC_par@');\r\n");
$nm_saida->saida("                                    ___tmp[3] = rs;\r\n");
$nm_saida->saida("                                    __tmp[0] = ___tmp.join('@SC_par@');\r\n");
$nm_saida->saida("                                    __tmp = __tmp.join(\"',\");\r\n");
$nm_saida->saida("                                    $(t).attr('href',__tmp);\r\n");
$nm_saida->saida("                                }\r\n");
$nm_saida->saida("                            })\r\n");
$nm_saida->saida("                        }\r\n");
$nm_saida->saida("                    }\r\n");
$nm_saida->saida("                });\r\n");
$nm_saida->saida("    });\r\n");
$nm_saida->saida("}\r\n");
$nm_saida->saida("</script>\r\n");
           $nm_saida->saida("   <script type=\"text/javascript\">\r\n");
           $nm_saida->saida("      if (!window.Promise)\r\n");
           $nm_saida->saida("      {\r\n");
           $nm_saida->saida("          var head = document.getElementsByTagName('head')[0];\r\n");
           $nm_saida->saida("          var js = document.createElement(\"script\");\r\n");
           $nm_saida->saida("          js.src = \"../_lib/lib/js/bluebird.min.js\";\r\n");
           $nm_saida->saida("          head.appendChild(js);\r\n");
           $nm_saida->saida("      }\r\n");
           $nm_saida->saida("   </script>\r\n");
          $nm_saida->saida("   <script type=\"text/javascript\" src=\"../_lib/lib/js/jquery-3.6.0.min.js\"></script>\r\n");
           if ($_SESSION['scriptcase']['proc_mobile'] && !$_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['embutida']) {  
               $forced_mobile = (isset($_SESSION['scriptcase']['force_mobile']) && $_SESSION['scriptcase']['force_mobile']) ? 'true' : 'false';
               $sc_app_data   = json_encode([ 
                   'forceMobile' => $forced_mobile, 
                   'appType' => 'grid', 
                   'improvements' => true, 
                   'displayOptionsButton' => false, 
                   'displayScrollUp' => false, 
                   'bottomToolbarFixed' => true, 
                   'mobileSimpleToolbar' => true, 
                   'scrollUpPosition' => 'A', 
                   'toolbarOrientation' => 'H', 
                   'mobilePanes' => 'true', 
                   'navigationBarButtons' => unserialize('a:0:{}'), 
                   'langs' => [ 
                       'lang_refined_search' => html_entity_decode($this->Ini->Nm_lang['lang_refined_search'], ENT_COMPAT, $_SESSION['scriptcase']['charset']), 
                       'lang_summary_search_button' => html_entity_decode($this->Ini->Nm_lang['lang_summary_search_button'], ENT_COMPAT, $_SESSION['scriptcase']['charset']), 
                       'lang_details_button' => html_entity_decode($this->Ini->Nm_lang['lang_details_button'], ENT_COMPAT, $_SESSION['scriptcase']['charset']), 
                   ], 
               ]); ?> 
        <input type="hidden" id="sc-mobile-app-data" value='<?php echo $sc_app_data; ?>' />
        <script type="text/javascript" src="../_lib/lib/js/nm_modal_panes.jquery.js"></script>
        <script type="text/javascript" src="../_lib/lib/js/nm_mobile.js"></script>
        <link rel='stylesheet' href='../_lib/lib/css/nm_mobile.css' type='text/css'/>
            <script>
                console.log('teste');
                $(document).ready(function(){
                    console.log('foi');
                    bootstrapMobile();
                });
            </script>           <?php }
          $nm_saida->saida("   <script type=\"text/javascript\" src=\"" . $this->Ini->path_prod . "/third/jquery/js/jquery-ui.js\"></script>\r\n");
          $nm_saida->saida("   <link rel=\"stylesheet\" href=\"" . $this->Ini->path_prod . "/third/jquery/css/smoothness/jquery-ui.css\" type=\"text/css\" media=\"screen\" />\r\n");
          $nm_saida->saida("   <link rel=\"stylesheet\" href=\"" . $this->Ini->path_prod . "/third/font-awesome/6.2/css/all.min.css\" type=\"text/css\" media=\"screen,print\" />\r\n");
          $nm_saida->saida("   <script type=\"text/javascript\" src=\"" . $this->Ini->path_prod . "/third/jquery_plugin/malsup-blockui/jquery.blockUI.js\"></script>\r\n");
           $nm_saida->saida("   <script type=\"text/javascript\" src=\"" . $this->Ini->path_prod . "/third/jquery_plugin/touch_punch/jquery.ui.touch-punch.min.js\"></script>\r\n");
           $nm_saida->saida("        <script type=\"text/javascript\">\r\n");
           $nm_saida->saida("          var sc_pathToTB = '" . $this->Ini->path_prod . "/third/jquery_plugin/thickbox/';\r\n");
           $nm_saida->saida("          var sc_tbLangClose = \"" . html_entity_decode($this->Ini->Nm_lang['lang_tb_close'], ENT_COMPAT, $_SESSION['scriptcase']['charset']) . "\";\r\n");
           $nm_saida->saida("          var sc_tbLangEsc = \"" . html_entity_decode($this->Ini->Nm_lang['lang_tb_esc'], ENT_COMPAT, $_SESSION['scriptcase']['charset']) . "\";\r\n");
           $nm_saida->saida("        </script>\r\n");
           $nm_saida->saida("   <script type=\"text/javascript\" src=\"" . $this->Ini->path_prod . "/third/jquery_plugin/thickbox/thickbox-compressed.js\"></script>\r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" type=\"text/css\" href=\"../_lib/css/" . $this->Ini->str_schema_all . "_form.css\" /> \r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" type=\"text/css\" href=\"../_lib/css/" . $this->Ini->str_schema_all . "_form" . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css\" /> \r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" type=\"text/css\" href=\"../_lib/css/" . $this->Ini->str_schema_all . "_appdiv.css\" /> \r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" type=\"text/css\" href=\"../_lib/css/" . $this->Ini->str_schema_all . "_appdiv" . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css\" /> \r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"" . $this->Ini->path_prod . "/third/jquery_plugin/thickbox/thickbox.css\" type=\"text/css\" media=\"screen\" />\r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" type=\"text/css\" href=\"../_lib/buttons/" . $this->Ini->Str_btn_css . "\" /> \r\n");
           $nm_saida->saida("   <script type=\"text/javascript\"> \r\n");
           if (!$_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['embutida'])
           { 
               $nm_saida->saida("   function sc_session_redir(url_redir)\r\n");
               $nm_saida->saida("   {\r\n");
           $nm_saida->saida("       if (typeof(sc_session_redir_mobile) === typeof(function(){})) { sc_session_redir_mobile(url_redir); }\r\n");
               $nm_saida->saida("       if (window.parent && window.parent.document != window.document && typeof window.parent.sc_session_redir === 'function')\r\n");
               $nm_saida->saida("       {\r\n");
               $nm_saida->saida("           window.parent.sc_session_redir(url_redir);\r\n");
               $nm_saida->saida("       }\r\n");
               $nm_saida->saida("       else\r\n");
               $nm_saida->saida("       {\r\n");
               $nm_saida->saida("           if (window.opener && typeof window.opener.sc_session_redir === 'function')\r\n");
               $nm_saida->saida("           {\r\n");
               $nm_saida->saida("               window.close();\r\n");
               $nm_saida->saida("               window.opener.sc_session_redir(url_redir);\r\n");
               $nm_saida->saida("           }\r\n");
               $nm_saida->saida("           else\r\n");
               $nm_saida->saida("           {\r\n");
               $nm_saida->saida("               window.location = url_redir;\r\n");
               $nm_saida->saida("           }\r\n");
               $nm_saida->saida("       }\r\n");
               $nm_saida->saida("   }\r\n");
           }
           $nm_saida->saida("   var SC_Link_View = false;\r\n");
           if ($this->Ini->SC_Link_View)
           {
               $nm_saida->saida("   SC_Link_View = true;\r\n");
           }
           $nm_saida->saida("   var scQSInit = true;\r\n");
           $nm_saida->saida("   var scQtReg  = " . $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['qt_reg_grid'] . ";\r\n");
           $nm_saida->saida("   var scBtnGrpStatus = {};\r\n");
           $nm_saida->saida("  function SC_init_jquery(){ \r\n");
           $nm_saida->saida("   \$(function(){ \r\n");
           $nm_saida->saida("     NM_btn_disable();\r\n");
           $nm_saida->saida("     $('#id_F0_top').keyup(function(e) {\r\n");
           $nm_saida->saida("       var keyPressed = e.charCode || e.keyCode || e.which;\r\n");
           $nm_saida->saida("       if (13 == keyPressed) {\r\n");
           $nm_saida->saida("          return false; \r\n");
           $nm_saida->saida("       }\r\n");
           $nm_saida->saida("     });\r\n");
           $nm_saida->saida("     $(\".scBtnGrpText\").mouseover(function() { $(this).addClass(\"scBtnGrpTextOver\"); }).mouseout(function() { $(this).removeClass(\"scBtnGrpTextOver\"); });\r\n");
           $nm_saida->saida("     $(\".scBtnGrpClick\").mouseup(function(event){\r\n");
           $nm_saida->saida("          event.preventDefault();\r\n");
           $nm_saida->saida("          if(event.target !== event.currentTarget) return;\r\n");
           $nm_saida->saida("          if($(this).find(\"a\").prop('href') != '')\r\n");
           $nm_saida->saida("          {\r\n");
           $nm_saida->saida("              $(this).find(\"a\").click();\r\n");
           $nm_saida->saida("          }\r\n");
           $nm_saida->saida("          else\r\n");
           $nm_saida->saida("          {\r\n");
           $nm_saida->saida("              eval($(this).find(\"a\").prop('onclick'));\r\n");
           $nm_saida->saida("          }\r\n");
           $nm_saida->saida("     });\r\n");
           $nm_saida->saida("   }); \r\n");
           $nm_saida->saida("  }\r\n");
           $nm_saida->saida("  SC_init_jquery();\r\n");
           $nm_saida->saida("   \$(window).on('load', function() {\r\n");
           $nm_saida->saida("   });\r\n");
           $nm_saida->saida("   function scBtnGroupByShow(sUrl, sPos) {\r\n");
           $nm_saida->saida("     $.ajax({\r\n");
           $nm_saida->saida("       type: \"GET\",\r\n");
           $nm_saida->saida("       dataType: \"html\",\r\n");
           $nm_saida->saida("       url: sUrl\r\n");
           $nm_saida->saida("     }).done(function(data) {\r\n");
           $nm_saida->saida("       $(\"#sc_id_groupby_placeholder_\" + sPos).show();\r\n");
           $nm_saida->saida("       $(\"#sc_id_groupby_placeholder_\" + sPos).find(\"td\").html(\"\");\r\n");
           $nm_saida->saida("       $(\"#sc_id_groupby_placeholder_\" + sPos).find(\"td\").html(data);\r\n");
           $nm_saida->saida("                                $([document.documentElement, document.body]).animate({\r\n");
           $nm_saida->saida("                                    scrollTop: $(\"#sc_id_groupby_placeholder_\" + sPos).offset().top - 100\r\n");
           $nm_saida->saida("                                }, 200);\r\n");
           $nm_saida->saida("     });\r\n");
           $nm_saida->saida("   }\r\n");
           $nm_saida->saida("   function scBtnGroupByHide(sPos) {\r\n");
           $nm_saida->saida("     $(\"#sc_id_groupby_placeholder_\" + sPos).hide();\r\n");
           $nm_saida->saida("     $(\"#sc_id_groupby_placeholder_\" + sPos).find(\"td\").html(\"\");\r\n");
           $nm_saida->saida("   }\r\n");
           $nm_saida->saida("   function scBtnSelCamposShow(sUrl, sPos) {\r\n");
           $nm_saida->saida("     if ($(\"#sc_id_sel_campos_placeholder_\" + sPos).css('display') != 'none') {\r\n");
           $nm_saida->saida("         scBtnSelCamposHide(sPos);\r\n");
           $nm_saida->saida("         $(\"#selcmp_\" + sPos).removeClass(\"selected\");\r\n");
           $nm_saida->saida("         return;\r\n");
           $nm_saida->saida("     }\r\n");
           $nm_saida->saida("     $.ajax({\r\n");
           $nm_saida->saida("       type: \"GET\",\r\n");
           $nm_saida->saida("       dataType: \"html\",\r\n");
           $nm_saida->saida("       url: sUrl\r\n");
           $nm_saida->saida("     }).done(function(data) {\r\n");
           $nm_saida->saida("       $(\"#sc_id_sel_campos_placeholder_\" + sPos).find(\"td\").html(\"\");\r\n");
           $nm_saida->saida("       $(\"#sc_id_sel_campos_placeholder_\" + sPos).find(\"td\").html(data);\r\n");
           $nm_saida->saida("       $(\"#sc_id_sel_campos_placeholder_\" + sPos).show();\r\n");
           $nm_saida->saida("                                $([document.documentElement, document.body]).animate({\r\n");
           $nm_saida->saida("                                    scrollTop: $(\"#sc_id_sel_campos_placeholder_\" + sPos).offset().top - 100\r\n");
           $nm_saida->saida("                                }, 200);\r\n");
           $nm_saida->saida("     });\r\n");
           $nm_saida->saida("   }\r\n");
           $nm_saida->saida("   function scBtnSelCamposHide(sPos) {\r\n");
           $nm_saida->saida("     $(\"#sc_id_sel_campos_placeholder_\" + sPos).hide();\r\n");
           $nm_saida->saida("     $(\"#sc_id_sel_campos_placeholder_\" + sPos).find(\"td\").html(\"\");\r\n");
           $nm_saida->saida("   }\r\n");
           $nm_saida->saida("   function scBtnOrderCamposShow(sUrl, sPos) {\r\n");
           $nm_saida->saida("     if ($(\"#sc_id_order_campos_placeholder_\" + sPos).css('display') != 'none') {\r\n");
           $nm_saida->saida("         scBtnOrderCamposHide(sPos);\r\n");
           $nm_saida->saida("         $(\"#ordcmp_\" + sPos).removeClass(\"selected\");\r\n");
           $nm_saida->saida("         return;\r\n");
           $nm_saida->saida("     }\r\n");
           $nm_saida->saida("     $.ajax({\r\n");
           $nm_saida->saida("       type: \"GET\",\r\n");
           $nm_saida->saida("       dataType: \"html\",\r\n");
           $nm_saida->saida("       url: sUrl\r\n");
           $nm_saida->saida("     }).done(function(data) {\r\n");
           $nm_saida->saida("       $(\"#sc_id_order_campos_placeholder_\" + sPos).find(\"td\").html(\"\");\r\n");
           $nm_saida->saida("       $(\"#sc_id_order_campos_placeholder_\" + sPos).find(\"td\").html(data);\r\n");
           $nm_saida->saida("       $(\"#sc_id_order_campos_placeholder_\" + sPos).show();\r\n");
           $nm_saida->saida("                                $([document.documentElement, document.body]).animate({\r\n");
           $nm_saida->saida("                                    scrollTop: $(\"#sc_id_order_campos_placeholder_\" + sPos).offset().top - 100\r\n");
           $nm_saida->saida("                                }, 200);\r\n");
           $nm_saida->saida("     });\r\n");
           $nm_saida->saida("   }\r\n");
           $nm_saida->saida("   function scBtnOrderCamposHide(sPos) {\r\n");
           $nm_saida->saida("     $(\"#sc_id_order_campos_placeholder_\" + sPos).hide();\r\n");
           $nm_saida->saida("     $(\"#sc_id_order_campos_placeholder_\" + sPos).find(\"td\").html(\"\");\r\n");
           $nm_saida->saida("   }\r\n");
           $nm_saida->saida("   function scBtnGrpShow(sGroup) {\r\n");
           $nm_saida->saida("     if (typeof(scBtnGrpShowMobile) === typeof(function(){})) { return scBtnGrpShowMobile(sGroup); };\r\n");
           $nm_saida->saida("     $('#sc_btgp_btn_' + sGroup).addClass('selected');\r\n");
           $nm_saida->saida("     var btnPos = $('#sc_btgp_btn_' + sGroup).offset();\r\n");
           $nm_saida->saida("     scBtnGrpStatus[sGroup] = 'open';\r\n");
           $nm_saida->saida("     $('#sc_btgp_btn_' + sGroup).mouseout(function() {\r\n");
           $nm_saida->saida("       scBtnGrpStatus[sGroup] = '';\r\n");
           $nm_saida->saida("       setTimeout(function() {\r\n");
           $nm_saida->saida("         scBtnGrpHide(sGroup, false);\r\n");
           $nm_saida->saida("       }, 3000);\r\n");
           $nm_saida->saida("     }).mouseover(function() {\r\n");
           $nm_saida->saida("       scBtnGrpStatus[sGroup] = 'over';\r\n");
           $nm_saida->saida("     });\r\n");
           $nm_saida->saida("     $('#sc_btgp_div_' + sGroup + ' span a').click(function() {\r\n");
           $nm_saida->saida("       scBtnGrpStatus[sGroup] = 'out';\r\n");
           $nm_saida->saida("       scBtnGrpHide(sGroup, false);\r\n");
           $nm_saida->saida("     });\r\n");
           $nm_saida->saida("     $('#sc_btgp_div_' + sGroup).css({\r\n");
           $nm_saida->saida("       'left': btnPos.left\r\n");
           $nm_saida->saida("     })\r\n");
           $nm_saida->saida("     .mouseover(function() {\r\n");
           $nm_saida->saida("       scBtnGrpStatus[sGroup] = 'over';\r\n");
           $nm_saida->saida("     })\r\n");
           $nm_saida->saida("     .mouseleave(function() {\r\n");
           $nm_saida->saida("       scBtnGrpStatus[sGroup] = 'out';\r\n");
           $nm_saida->saida("       setTimeout(function() {\r\n");
           $nm_saida->saida("         scBtnGrpHide(sGroup, false);\r\n");
           $nm_saida->saida("       }, 1500);\r\n");
           $nm_saida->saida("     })\r\n");
           $nm_saida->saida("     .show('fast');\r\n");
           $nm_saida->saida("   }\r\n");
           $nm_saida->saida("   function scBtnGrpHide(sGroup, bForce) {\r\n");
           $nm_saida->saida("     if (bForce || 'over' != scBtnGrpStatus[sGroup]) {\r\n");
           $nm_saida->saida("       $('#sc_btgp_div_' + sGroup).hide('fast');\r\n");
           $nm_saida->saida("     $('#sc_btgp_btn_' + sGroup).removeClass('selected');\r\n");
           $nm_saida->saida("     }\r\n");
           $nm_saida->saida("   }\r\n");
           $nm_saida->saida("   </script> \r\n");
       } 
       if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['num_css']))
       {
           $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['num_css'] = rand(0, 1000);
       }
       $NM_css = @fopen($this->Ini->root . $this->Ini->path_imag_temp . '/sc_css_appointment_billing_grid_' . $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['num_css'] . '.css', 'w');
       if (($NM_opcao == "print" && $GLOBALS['nmgp_cor_print'] == "PB") || ($NM_opcao == "pdf" &&  $GLOBALS['nmgp_tipo_pdf'] == "pb") || ($_SESSION['scriptcase']['contr_link_emb'] == "pdf" &&  $GLOBALS['nmgp_tipo_pdf'] == "pb")) 
       { 
           $NM_css_file = $this->Ini->str_schema_all . "_grid_bw.css";
           $NM_css_dir  = $this->Ini->str_schema_all . "_grid_bw" . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css";
       } 
       else 
       { 
           $NM_css_file = $this->Ini->str_schema_all . "_grid.css";
           $NM_css_dir  = $this->Ini->str_schema_all . "_grid" . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css";
       } 
       if (is_file($this->Ini->path_css . $NM_css_file))
       {
           $NM_css_attr = file($this->Ini->path_css . $NM_css_file);
           foreach ($NM_css_attr as $NM_line_css)
           {
               $NM_line_css = str_replace("../../img", $this->Ini->path_imag_cab  , $NM_line_css);
               @fwrite($NM_css, "    " .  $NM_line_css . "\r\n");
           }
       }
       if (is_file($this->Ini->path_css . $NM_css_dir))
       {
           $NM_css_attr = file($this->Ini->path_css . $NM_css_dir);
           foreach ($NM_css_attr as $NM_line_css)
           {
               $NM_line_css = str_replace("../../img", $this->Ini->path_imag_cab  , $NM_line_css);
               @fwrite($NM_css, "    " .  $NM_line_css . "\r\n");
           }
       }
       @fclose($NM_css);
       $this->NM_css_val_embed .= "win";
       $this->NM_css_ajx_embed .= "ult_set";
       if ($this->NM_opcao == "print" || $this->Print_All)
       {
           $nm_saida->saida("  <style type=\"text/css\">\r\n");
           $NM_css = file($this->Ini->root . $this->Ini->path_imag_temp . '/sc_css_appointment_billing_grid_' . $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['num_css'] . '.css');
           foreach ($NM_css as $cada_css)
           {
              $nm_saida->saida("  " . str_replace("\r\n", "", $cada_css) . "\r\n");
           }
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"../_lib/css/" . $_SESSION['scriptcase']['erro']['str_schema'] . "\" type=\"text/css\" media=\"screen\" />\r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"../_lib/css/" . $_SESSION['scriptcase']['erro']['str_schema_dir'] . "\" type=\"text/css\" media=\"screen\" />\r\n");
           $nm_saida->saida("  </style>\r\n");
       }
       else
       {
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"" . $this->Ini->path_imag_temp . "/sc_css_appointment_billing_grid_" . $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['num_css'] . ".css\" type=\"text/css\" media=\"screen\" />\r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"../_lib/css/" . $_SESSION['scriptcase']['erro']['str_schema'] . "\" type=\"text/css\" media=\"screen\" />\r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"../_lib/css/" . $_SESSION['scriptcase']['erro']['str_schema_dir'] . "\" type=\"text/css\" media=\"screen\" />\r\n");
       }
   } 
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"../_lib/css/" . $this->Ini->str_schema_all . "_btngrp.css\" type=\"text/css\" media=\"screen\" />\r\n");
           $nm_saida->saida("   <link rel=\"stylesheet\" href=\"../_lib/css/" . $this->Ini->str_schema_all . "_btngrp" . $_SESSION['scriptcase']['reg_conf']['css_dir'] . ".css\" type=\"text/css\" media=\"screen\" />\r\n");
       $nm_saida->saida("  </HEAD>\r\n");
       $str_iframe_body = ($this->aba_iframe) ? 'marginwidth="0px" marginheight="0px" topmargin="0px" leftmargin="0px"' : '';
       if (!$this->Ini->Export_html_zip && !$_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['doc_word'] && ($this->Print_All || $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['opcao_print'] == "print")) 
       {
           if ($this->Print_All) 
           {
               $nm_saida->saida(" <link rel=\"stylesheet\" type=\"text/css\" href=\"../_lib/buttons/" . $this->Ini->Str_btn_css . "\" /> \r\n");
           }
           $nm_saida->saida("  <body id=\"grid_freehtml\" class=\"" . $this->css_scGridPage . "\" " . $str_iframe_body . " style=\"-webkit-print-color-adjust: exact;" . $css_body . "\">\r\n");
           $nm_saida->saida("   <TABLE id=\"sc_table_print\" cellspacing=0 cellpadding=0 align=\"center\" valign=\"top\" " . $this->Tab_width . ">\r\n");
           $nm_saida->saida("     <TR>\r\n");
           $nm_saida->saida("       <TD>\r\n");
           $Cod_Btn = nmButtonOutput($this->arr_buttons, "bprint", "prit_web_page()", "prit_web_page()", "Bprint_print", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
           $nm_saida->saida("           $Cod_Btn \r\n");
           $nm_saida->saida("       </TD>\r\n");
           $nm_saida->saida("     </TR>\r\n");
           $nm_saida->saida("   </TABLE>\r\n");
           $nm_saida->saida("  <script type=\"text/javascript\">\r\n");
           $nm_saida->saida("     function prit_web_page()\r\n");
           $nm_saida->saida("     {\r\n");
           $nm_saida->saida("        document.getElementById('sc_table_print').style.display = 'none';\r\n");
           $nm_saida->saida("        var is_safari = navigator.userAgent.indexOf(\"Safari\") > -1;\r\n");
           $nm_saida->saida("        var is_chrome = navigator.userAgent.indexOf('Chrome') > -1\r\n");
           $nm_saida->saida("        if ((is_chrome) && (is_safari)) {is_safari=false;}\r\n");
           $nm_saida->saida("        window.print();\r\n");
           $nm_saida->saida("        if (is_safari) {setTimeout(\"window.close()\", 1000);} else {window.close();}\r\n");
           $nm_saida->saida("     }\r\n");
           $nm_saida->saida("  </script>\r\n");
       }
       else
       {
           $nm_saida->saida("  <body id=\"grid_freehtml\" class=\"" . $this->css_scGridPage . "\" " . $str_iframe_body . " style=\"" . $css_body . "\">\r\n");
       }
       $nm_saida->saida("  " . $this->Ini->Ajax_result_set . "\r\n");
       if (!$_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['embutida'] && $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['opcao'] != "pdf" && !$this->Print_All)
       { 
           $Cod_Btn = nmButtonOutput($this->arr_buttons, "berrm_clse", "nmAjaxHideDebug()", "nmAjaxHideDebug()", "", "", "", "", "", "", "", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
           $nm_saida->saida("<div id=\"id_debug_window\" style=\"display: none;\" class='scDebugWindow'><table class=\"scFormMessageTable\">\r\n");
           $nm_saida->saida("<tr><td class=\"scFormMessageTitle\">" . $Cod_Btn . "&nbsp;&nbsp;Output</td></tr>\r\n");
           $nm_saida->saida("<tr><td class=\"scFormMessageMessage\" style=\"padding: 0px; vertical-align: top\"><div style=\"padding: 2px; height: 200px; width: 350px; overflow: auto\" id=\"id_debug_text\"></div></td></tr>\r\n");
           $nm_saida->saida("</table></div>\r\n");
       } 
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['embutida'])
   { 
           $nm_saida->saida("  <div style=\"height:1px;overflow:hidden\"><H1 style=\"font-size:0;padding:1px\"></H1></div>\r\n");
       $tab_align  = "center";
       $tab_valign = "top";
       $tab_width = " width=\"px\"";
       $nm_saida->saida("   <TABLE id=\"main_table_grid\" cellspacing=0 cellpadding=0 align=\"" . $tab_align . "\" valign=\"" . $tab_valign . "\" " . $tab_width . ">\r\n");
       $nm_saida->saida("     <TR>\r\n");
       $nm_saida->saida("       <TD>\r\n");
       $nm_saida->saida("       <div class=\"scGridBorder\">\r\n");
       if (!$_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['doc_word'])
       { 
           $nm_saida->saida("  <div id=\"id_div_process\" style=\"display: none; margin: 10px; whitespace: nowrap\" class=\"scFormProcessFixed\"><span class=\"scFormProcess\"><img border=\"0\" src=\"" . $this->Ini->path_icones . "/scriptcase__NM__ajax_load.gif\" align=\"absmiddle\" />&nbsp;" . $this->Ini->Nm_lang['lang_othr_prcs'] . "...</span></div>\r\n");
           $nm_saida->saida("  <div id=\"id_div_process_block\" style=\"display: none; margin: 10px; whitespace: nowrap\"><span class=\"scFormProcess\"><img border=\"0\" src=\"" . $this->Ini->path_icones . "/scriptcase__NM__ajax_load.gif\" align=\"absmiddle\" />&nbsp;" . $this->Ini->Nm_lang['lang_othr_prcs'] . "...</span></div>\r\n");
           $nm_saida->saida("  <div id=\"id_fatal_error\" class=\"" . $this->css_scGridLabel . "\" style=\"display: none; position: absolute\"></div>\r\n");
       } 
       $nm_saida->saida("       <TABLE width='100%' cellspacing=0 cellpadding=0>\r\n");
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['opcao'] != "pdf"){$this->chk_sc_btns();}
   }  
 }  
 function NM_cor_embutida()
 {  
   include($this->Ini->path_btn . $this->Ini->Str_btn_grid);
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['embutida'])
   {
   }
   $compl_css = "";
   $this->css_scGridPage          = $compl_css . "scGridPage";
   $this->css_scGridPageLink      = $compl_css . "scGridPageLink";
   $this->css_scGridToolbar       = $compl_css . "scGridToolbar";
   $this->css_scGridToolbarPadd   = $compl_css . "scGridToolbarPadding";
   $this->css_css_toolbar_obj     = $compl_css . "css_toolbar_obj";
   $this->css_scGridHeader        = $compl_css . "scGridHeader";
   $this->css_scGridHeaderFont    = $compl_css . "scGridHeaderFont";
   $this->css_scGridFooter        = $compl_css . "scGridFooter";
   $this->css_scGridFooterFont    = $compl_css . "scGridFooterFont";
   $this->css_scGridBlock         = $compl_css . "scGridBlock";
   $this->css_scGridTotal         = $compl_css . "scGridTotal";
   $this->css_scGridTotalFont     = $compl_css . "scGridTotalFont";
   $this->css_scGridSubtotal      = $compl_css . "scGridSubtotal";
   $this->css_scGridSubtotalFont  = $compl_css . "scGridSubtotalFont";
   $this->css_scGridFieldEven     = $compl_css . "scGridFieldEven";
   $this->css_scGridFieldEvenFont = $compl_css . "scGridFieldEvenFont";
   $this->css_scGridFieldEvenVert = $compl_css . "scGridFieldEvenVert";
   $this->css_scGridFieldEvenLink = $compl_css . "scGridFieldEvenLink";
   $this->css_scGridFieldOdd      = $compl_css . "scGridFieldOdd";
   $this->css_scGridFieldOddFont  = $compl_css . "scGridFieldOddFont";
   $this->css_scGridFieldOddVert  = $compl_css . "scGridFieldOddVert";
   $this->css_scGridFieldOddLink  = $compl_css . "scGridFieldOddLink";
   $this->css_scGridFieldClick    = $compl_css . "scGridFieldClick";
   $this->css_scGridFieldOver     = $compl_css . "scGridFieldOver";
   $this->css_scGridLabel         = $compl_css . "scGridLabel";
   $this->css_scGridLabelVert     = $compl_css . "scGridLabelVert";
   $this->css_scGridLabelFont     = $compl_css . "scGridLabelFont";
   $this->css_scGridLabelLink     = $compl_css . "scGridLabelLink";
   $this->css_scGridTabela        = $compl_css . "scGridTabela";
   $this->css_scGridTabelaTd      = $compl_css . "scGridTabelaTd";
   $this->css_scAppDivMoldura     = $compl_css . "scAppDivMoldura";
   $this->css_scAppDivHeader      = $compl_css . "scAppDivHeader";
   $this->css_scAppDivHeaderText  = $compl_css . "scAppDivHeaderText";
   $this->css_scAppDivContent     = $compl_css . "scAppDivContent";
   $this->css_scAppDivContentText = $compl_css . "scAppDivContentText";
   $this->css_scAppDivToolbar     = $compl_css . "scAppDivToolbar";
   $this->css_scAppDivToolbarInput= $compl_css . "scAppDivToolbarInput";
   $this->css_inherit_bg          = "scInheritBg";
   $this->NM_css_val_embed = "sznmxizkjnvl";
   $this->NM_css_ajx_embed = "Ajax_res";
 }  
// 
//----- 
 function grid($linhas = 0)
 {
    global 
           $nm_saida;
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['embutida'])
   { 
   $nm_saida->saida(" <TR><TD " . $this->Grid_body . " class=\"" . $this->css_scGridTabelaTd . "\"> \r\n");
   } 
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['ajax_nav'])
   { 
       $_SESSION['scriptcase']['saida_html'] = "";
   } 
   $HTTP_REFERER = (isset($_SERVER['HTTP_REFERER'])) ? $_SERVER['HTTP_REFERER'] : ""; 
   static $nm_seq_execucoes = 0; 
   static $nm_seq_titulos   = 0; 
   $nm_seq_execucoes++; 
   $nm_seq_titulos++; 
   $this->Ini->nm_cont_lin = 1; 
   $this->sc_where_orig    = $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['where_orig'];
   $this->sc_where_atual   = $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['where_pesq'];
   $this->sc_where_filtro  = $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['where_pesq_filtro'];
   if (isset($_SESSION['scriptcase']['sc_apl_conf']['appointment_billing']['lig_edit']) && $_SESSION['scriptcase']['sc_apl_conf']['appointment_billing']['lig_edit'] != '')
   {
       if ($_SESSION['scriptcase']['sc_apl_conf']['appointment_billing']['lig_edit'] == "on")  {$_SESSION['scriptcase']['sc_apl_conf']['appointment_billing']['lig_edit'] = "S";}
       if ($_SESSION['scriptcase']['sc_apl_conf']['appointment_billing']['lig_edit'] == "off") {$_SESSION['scriptcase']['sc_apl_conf']['appointment_billing']['lig_edit'] = "N";}
       $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['mostra_edit'] = $_SESSION['scriptcase']['sc_apl_conf']['appointment_billing']['lig_edit'];
   }
   if (!empty($this->nm_grid_sem_reg))
   {
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['embutida'])
       {
           $nm_saida->saida("<table id=\"apl_appointment_billing#?#$nm_seq_execucoes\" width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n");
           $nm_saida->saida("  <tr><td><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">\r\n");
           $nm_id_aplicacao = "";
           $nm_saida->saida("  <tr><td class=\"" . $this->css_scGridFieldOdd . "\" style=\"vertical-align: top;font-size:12px;color:#000000;\" colspan = \"17\" align=\"center\">\r\n");
           $nm_saida->saida("     " . $this->nm_grid_sem_reg . "\r\n");
           $nm_saida->saida("  </td></tr></table></td></tr></table>\r\n");
       }
       else
       {
           $nm_saida->saida("  <tr><td " . $this->Grid_body . " class=\"" . $this->css_scGridTabelaTd . " " . $this->css_scGridFieldOdd . "\" align=\"center\" style=\"vertical-align: top;font-size:12px;color:#000000;\">\r\n");
           if (!isset($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['force_toolbar']))
           { 
               $this->force_toolbar = true;
               $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['force_toolbar'] = true;
           } 
           if ($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['ajax_nav'])
           { 
               $_SESSION['scriptcase']['saida_html'] = "";
           } 
           $nm_saida->saida("  " . $this->nm_grid_sem_reg . "\r\n");
           if ($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['ajax_nav'])
           { 
               $this->Ini->Arr_result['setValue'][] = array('field' => 'sc_grid_body', 'value' => NM_charset_to_utf8($_SESSION['scriptcase']['saida_html']));
               $_SESSION['scriptcase']['saida_html'] = "";
           } 
       }
       return;
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['embutida'])
   { 
       $nm_saida->saida("<table id=\"apl_appointment_billing#?#$nm_seq_execucoes\" width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n");
   $nm_saida->saida(" <TR><TD> \r\n");
       $nm_id_aplicacao = "";
   } 
   else 
   { 
       $nm_id_aplicacao = " id=\"apl_appointment_billing#?#1\"";
   } 
// 
   $nm_quant_linhas = 0 ;
   $this->nm_inicio_pag = 0 ;
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['opcao'] == "pdf")
   { 
       $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['final'] = 0;
   } 
   $this->NM_flag_antigo = FALSE;
   $quant_tot_linhas = 0;
   $nm_prog_barr     = 0;
   $PB_tot            = "/" . $this->count_ger;
   while (!$this->rs_grid->EOF && $quant_tot_linhas < $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['qt_reg_grid']) 
   {  
     $nm_quant_linhas = 0;
     $this->nm_grid_colunas = 0;
     while (!$this->rs_grid->EOF && $nm_quant_linhas < $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['qt_col_grid'] && $quant_tot_linhas < $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['qt_reg_grid']) 
     {  
          $this->sc_proc_grid = true;
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['doc_word'] && !$this->Ini->sc_export_ajax)
          {
              $nm_prog_barr++;
              $Mens_bar = $this->Ini->Nm_lang['lang_othr_prcs'];
              if ($_SESSION['scriptcase']['charset'] != "UTF-8") {
                   $Mens_bar = sc_convert_encoding($Mens_bar, "UTF-8", $_SESSION['scriptcase']['charset']);
              }
              $this->pb->setProgressbarMessage($Mens_bar . ": " . $nm_prog_barr . $PB_tot);
              $this->pb->addSteps(1);
          }
          //---------- Gauge ----------
          if (!$this->Ini->sc_export_ajax && $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['opcao'] == "pdf" && -1 < $this->progress_grid)
          {
              $this->progress_now++;
              if (0 == $this->progress_lim_now)
              {
               $lang_protect = $this->Ini->Nm_lang['lang_pdff_rows'];
               if (!NM_is_utf8($lang_protect))
               {
                   $lang_protect = sc_convert_encoding($lang_protect, "UTF-8", $_SESSION['scriptcase']['charset']);
               }
                  appointment_billing_pdf_progress_call($this->progress_tot . "_#NM#_" . $this->progress_now . "_#NM#_" . $lang_protect . " " . $this->progress_now . "...\n", $this->Ini->Nm_lang);
                  fwrite($this->progress_fp, $this->progress_now . "_#NM#_" . $lang_protect . " " . $this->progress_now . "...\n");
              }
              $this->progress_lim_now++;
              if ($this->progress_lim_tot == $this->progress_lim_now)
              {
                  $this->progress_lim_now = 0;
              }
          }
          $this->a_appointments_id[$this->nm_grid_colunas] = $this->rs_grid->fields[0] ;  
          $this->a_appointments_id_orig = $this->a_appointments_id[$this->nm_grid_colunas];
          $this->a_appointments_id[$this->nm_grid_colunas] = (string)$this->a_appointments_id[$this->nm_grid_colunas];
          $this->a_appointments_id_orig = $this->a_appointments_id[$this->nm_grid_colunas];
          $this->a_appointment_start_date[$this->nm_grid_colunas] = $this->rs_grid->fields[1] ;  
          $this->a_appointment_start_date_orig = $this->a_appointment_start_date[$this->nm_grid_colunas];
          $this->c_customers_name[$this->nm_grid_colunas] = $this->rs_grid->fields[2] ;  
          $this->c_customers_name_orig = $this->c_customers_name[$this->nm_grid_colunas];
          $this->c_customers_address[$this->nm_grid_colunas] = $this->rs_grid->fields[3] ;  
          $this->c_customers_address_orig = $this->c_customers_address[$this->nm_grid_colunas];
          $this->c_customers_city[$this->nm_grid_colunas] = $this->rs_grid->fields[4] ;  
          $this->c_customers_city_orig = $this->c_customers_city[$this->nm_grid_colunas];
          $this->c_customers_state[$this->nm_grid_colunas] = $this->rs_grid->fields[5] ;  
          $this->c_customers_state_orig = $this->c_customers_state[$this->nm_grid_colunas];
          $this->c_customers_zip[$this->nm_grid_colunas] = $this->rs_grid->fields[6] ;  
          $this->c_customers_zip_orig = $this->c_customers_zip[$this->nm_grid_colunas];
          $this->c_customers_phone[$this->nm_grid_colunas] = $this->rs_grid->fields[7] ;  
          $this->c_customers_phone_orig = $this->c_customers_phone[$this->nm_grid_colunas];
          $this->a_price[$this->nm_grid_colunas] = $this->rs_grid->fields[8] ;  
          $this->a_price_orig = $this->a_price[$this->nm_grid_colunas];
          $this->a_price[$this->nm_grid_colunas] =  str_replace(",", ".", $this->a_price[$this->nm_grid_colunas]);
          $this->a_price_orig = $this->a_price[$this->nm_grid_colunas];
          $this->a_price[$this->nm_grid_colunas] = (string)$this->a_price[$this->nm_grid_colunas];
          $this->a_price_orig = $this->a_price[$this->nm_grid_colunas];
          $this->a_additional_charges[$this->nm_grid_colunas] = $this->rs_grid->fields[9] ;  
          $this->a_additional_charges_orig = $this->a_additional_charges[$this->nm_grid_colunas];
          $this->a_additional_charges[$this->nm_grid_colunas] =  str_replace(",", ".", $this->a_additional_charges[$this->nm_grid_colunas]);
          $this->a_additional_charges_orig = $this->a_additional_charges[$this->nm_grid_colunas];
          $this->a_additional_charges[$this->nm_grid_colunas] = (string)$this->a_additional_charges[$this->nm_grid_colunas];
          $this->a_additional_charges_orig = $this->a_additional_charges[$this->nm_grid_colunas];
          $this->a_discount[$this->nm_grid_colunas] = $this->rs_grid->fields[10] ;  
          $this->a_discount_orig = $this->a_discount[$this->nm_grid_colunas];
          $this->a_discount[$this->nm_grid_colunas] =  str_replace(",", ".", $this->a_discount[$this->nm_grid_colunas]);
          $this->a_discount_orig = $this->a_discount[$this->nm_grid_colunas];
          $this->a_discount[$this->nm_grid_colunas] = (string)$this->a_discount[$this->nm_grid_colunas];
          $this->a_discount_orig = $this->a_discount[$this->nm_grid_colunas];
          $this->a_total_price[$this->nm_grid_colunas] = $this->rs_grid->fields[11] ;  
          $this->a_total_price_orig = $this->a_total_price[$this->nm_grid_colunas];
          $this->a_total_price[$this->nm_grid_colunas] =  str_replace(",", ".", $this->a_total_price[$this->nm_grid_colunas]);
          $this->a_total_price_orig = $this->a_total_price[$this->nm_grid_colunas];
          $this->a_total_price[$this->nm_grid_colunas] = (string)$this->a_total_price[$this->nm_grid_colunas];
          $this->a_total_price_orig = $this->a_total_price[$this->nm_grid_colunas];
          $this->c_customers_email[$this->nm_grid_colunas] = $this->rs_grid->fields[12] ;  
          $this->c_customers_email_orig = $this->c_customers_email[$this->nm_grid_colunas];
          $this->due_date[$this->nm_grid_colunas] = "";
          $this->barcode[$this->nm_grid_colunas] = "";
          $this->item_desc[$this->nm_grid_colunas] = "";
          $this->item_value[$this->nm_grid_colunas] = "";
          $this->SC_seq_register = $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['final'] + 1; 
          $_SESSION['scriptcase']['appointment_billing']['contr_erro'] = 'on';
 $this->c_customers_city[$this->nm_grid_colunas]  .= "-".$this->c_customers_state[$this->nm_grid_colunas] .", ".$this->c_customers_zip[$this->nm_grid_colunas] ;
$this->due_date[$this->nm_grid_colunas]  = 
         $this->nm_data->CalculaData($this->a_appointment_start_date[$this->nm_grid_colunas] , "yyyy-mm-dd", "+", 10, 0, 0, "aaaa-mm-dd",  "yyyy-mm-dd"); 
      ;
$this->due_date[$this->nm_grid_colunas]  = date('Y-m-d', strtotime($this->due_date[$this->nm_grid_colunas] ));
$this->barcode[$this->nm_grid_colunas]  = "011234567891234";



$check_sql = "SELECT
   at.description,
   at.price
FROM
   appointments_type at INNER JOIN appointment_details ad ON at.appointments_type_id = ad.appointments_type_id
WHERE 
   (ad.appointments_id = ".$this->a_appointments_id[$this->nm_grid_colunas] .")";

 
      $nm_select = $check_sql; 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_select; 
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = ''; 
      $this->rs[$this->nm_grid_colunas] = array();
      if ($SCrx = $this->Db->Execute($nm_select)) 
      { 
          $SCy = 0; 
          $nm_count = $SCrx->FieldCount();
          while (!$SCrx->EOF)
          { 
                 for ($SCx = 0; $SCx < $nm_count; $SCx++)
                 { 
                        $this->rs[$this->nm_grid_colunas][$SCy] [$SCx] = $SCrx->fields[$SCx];
                 }
                 $SCy++; 
                 $SCrx->MoveNext();
          } 
          $SCrx->Close();
      } 
      elseif (isset($GLOBALS["NM_ERRO_IBASE"]) && $GLOBALS["NM_ERRO_IBASE"] != 1)  
      { 
          $this->rs[$this->nm_grid_colunas] = false;
          $this->rs_erro[$this->nm_grid_colunas] = $this->Db->ErrorMsg();
      } 


if (isset($this->rs[$this->nm_grid_colunas][0][0]))     
{
    foreach ($this->rs[$this->nm_grid_colunas]  as $key => $value) {
		$this->item_desc[$this->nm_grid_colunas]  .= $value[0]."<br />";
    	$this->item_value[$this->nm_grid_colunas]  .= "$ ".$value[1]."<br />";
	}
}
		else     
{
	$this->item_desc[$this->nm_grid_colunas]  = '';
    $this->item_value[$this->nm_grid_colunas]  = '';
}
$_SESSION['scriptcase']['appointment_billing']['contr_erro'] = 'off';
          $this->a_appointments_id[$this->nm_grid_colunas] = NM_encode_input(sc_strip_script($this->a_appointments_id[$this->nm_grid_colunas]));
          if ($this->a_appointments_id[$this->nm_grid_colunas] === "") 
          { 
              $this->a_appointments_id[$this->nm_grid_colunas] = "&nbsp;" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($this->a_appointments_id[$this->nm_grid_colunas], $_SESSION['scriptcase']['reg_conf']['grup_num'], $_SESSION['scriptcase']['reg_conf']['dec_num'], "0", "S", "2", "", "N:" . $_SESSION['scriptcase']['reg_conf']['neg_num'] , $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['num_group_digit']) ; 
          } 
          $this->a_appointment_start_date[$this->nm_grid_colunas] = NM_encode_input(sc_strip_script($this->a_appointment_start_date[$this->nm_grid_colunas]));
          if ($this->a_appointment_start_date[$this->nm_grid_colunas] === "") 
          { 
              $this->a_appointment_start_date[$this->nm_grid_colunas] = "&nbsp;" ;  
          } 
          else    
          { 
               $a_appointment_start_date_x =  $this->a_appointment_start_date[$this->nm_grid_colunas];
               nm_conv_limpa_dado($a_appointment_start_date_x, "YYYY-MM-DD");
               if (is_numeric($a_appointment_start_date_x) && strlen($a_appointment_start_date_x) > 0) 
               { 
                   $this->nm_data->SetaData($this->a_appointment_start_date[$this->nm_grid_colunas], "YYYY-MM-DD");
                   $this->a_appointment_start_date[$this->nm_grid_colunas] = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
               } 
          } 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
              $this->c_customers_name[$this->nm_grid_colunas] = NM_encode_input(sc_strip_script($this->c_customers_name[$this->nm_grid_colunas]));
          }
          else {
              $this->c_customers_name[$this->nm_grid_colunas] = sc_strip_script($this->c_customers_name[$this->nm_grid_colunas]);
          }
          if ($this->c_customers_name[$this->nm_grid_colunas] === "") 
          { 
              $this->c_customers_name[$this->nm_grid_colunas] = "&nbsp;" ;  
          } 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
              $this->c_customers_address[$this->nm_grid_colunas] = NM_encode_input(sc_strip_script($this->c_customers_address[$this->nm_grid_colunas]));
          }
          else {
              $this->c_customers_address[$this->nm_grid_colunas] = sc_strip_script($this->c_customers_address[$this->nm_grid_colunas]);
          }
          if ($this->c_customers_address[$this->nm_grid_colunas] === "") 
          { 
              $this->c_customers_address[$this->nm_grid_colunas] = "&nbsp;" ;  
          } 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
              $this->c_customers_city[$this->nm_grid_colunas] = NM_encode_input(sc_strip_script($this->c_customers_city[$this->nm_grid_colunas]));
          }
          else {
              $this->c_customers_city[$this->nm_grid_colunas] = sc_strip_script($this->c_customers_city[$this->nm_grid_colunas]);
          }
          if ($this->c_customers_city[$this->nm_grid_colunas] === "") 
          { 
              $this->c_customers_city[$this->nm_grid_colunas] = "&nbsp;" ;  
          } 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
              $this->c_customers_state[$this->nm_grid_colunas] = NM_encode_input(sc_strip_script($this->c_customers_state[$this->nm_grid_colunas]));
          }
          else {
              $this->c_customers_state[$this->nm_grid_colunas] = sc_strip_script($this->c_customers_state[$this->nm_grid_colunas]);
          }
          if ($this->c_customers_state[$this->nm_grid_colunas] === "") 
          { 
              $this->c_customers_state[$this->nm_grid_colunas] = "&nbsp;" ;  
          } 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
              $this->c_customers_zip[$this->nm_grid_colunas] = NM_encode_input(sc_strip_script($this->c_customers_zip[$this->nm_grid_colunas]));
          }
          else {
              $this->c_customers_zip[$this->nm_grid_colunas] = sc_strip_script($this->c_customers_zip[$this->nm_grid_colunas]);
          }
          if ($this->c_customers_zip[$this->nm_grid_colunas] === "") 
          { 
              $this->c_customers_zip[$this->nm_grid_colunas] = "&nbsp;" ;  
          } 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
              $this->c_customers_phone[$this->nm_grid_colunas] = NM_encode_input(sc_strip_script($this->c_customers_phone[$this->nm_grid_colunas]));
          }
          else {
              $this->c_customers_phone[$this->nm_grid_colunas] = sc_strip_script($this->c_customers_phone[$this->nm_grid_colunas]);
          }
          if ($this->c_customers_phone[$this->nm_grid_colunas] === "") 
          { 
              $this->c_customers_phone[$this->nm_grid_colunas] = "&nbsp;" ;  
          } 
          $this->a_price[$this->nm_grid_colunas] = NM_encode_input(sc_strip_script($this->a_price[$this->nm_grid_colunas]));
          if ($this->a_price[$this->nm_grid_colunas] === "") 
          { 
              $this->a_price[$this->nm_grid_colunas] = "&nbsp;" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($this->a_price[$this->nm_grid_colunas], $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", $_SESSION['scriptcase']['reg_conf']['monet_simb'], "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
          } 
          $this->a_additional_charges[$this->nm_grid_colunas] = NM_encode_input(sc_strip_script($this->a_additional_charges[$this->nm_grid_colunas]));
          if ($this->a_additional_charges[$this->nm_grid_colunas] === "") 
          { 
              $this->a_additional_charges[$this->nm_grid_colunas] = "&nbsp;" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($this->a_additional_charges[$this->nm_grid_colunas], $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", $_SESSION['scriptcase']['reg_conf']['monet_simb'], "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
          } 
          $this->a_discount[$this->nm_grid_colunas] = NM_encode_input(sc_strip_script($this->a_discount[$this->nm_grid_colunas]));
          if ($this->a_discount[$this->nm_grid_colunas] === "") 
          { 
              $this->a_discount[$this->nm_grid_colunas] = "&nbsp;" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($this->a_discount[$this->nm_grid_colunas], $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", $_SESSION['scriptcase']['reg_conf']['monet_simb'], "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
          } 
          $this->a_total_price[$this->nm_grid_colunas] = NM_encode_input(sc_strip_script($this->a_total_price[$this->nm_grid_colunas]));
          if ($this->a_total_price[$this->nm_grid_colunas] === "") 
          { 
              $this->a_total_price[$this->nm_grid_colunas] = "&nbsp;" ;  
          } 
          else    
          { 
              nmgp_Form_Num_Val($this->a_total_price[$this->nm_grid_colunas], $_SESSION['scriptcase']['reg_conf']['grup_val'], $_SESSION['scriptcase']['reg_conf']['dec_val'], "2", "S", "2", $_SESSION['scriptcase']['reg_conf']['monet_simb'], "V:" . $_SESSION['scriptcase']['reg_conf']['monet_f_pos'] . ":" . $_SESSION['scriptcase']['reg_conf']['monet_f_neg'], $_SESSION['scriptcase']['reg_conf']['simb_neg'], $_SESSION['scriptcase']['reg_conf']['unid_mont_group_digit']) ; 
          } 
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['opcao'] == "pdf" && isset($_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content']) && $_SESSION['nm_session']['sys_wkhtmltopdf_show_html_content'] == 'Y') {
              $this->c_customers_email[$this->nm_grid_colunas] = NM_encode_input(sc_strip_script($this->c_customers_email[$this->nm_grid_colunas]));
          }
          else {
              $this->c_customers_email[$this->nm_grid_colunas] = sc_strip_script($this->c_customers_email[$this->nm_grid_colunas]);
          }
          if ($this->c_customers_email[$this->nm_grid_colunas] === "") 
          { 
              $this->c_customers_email[$this->nm_grid_colunas] = "&nbsp;" ;  
          } 
          if ($this->due_date[$this->nm_grid_colunas] === "") 
          { 
              $this->due_date[$this->nm_grid_colunas] = "&nbsp;" ;  
          } 
          else    
          { 
               $due_date_x =  $this->due_date[$this->nm_grid_colunas];
               nm_conv_limpa_dado($due_date_x, "YYYY-MM-DD");
               if (is_numeric($due_date_x) && strlen($due_date_x) > 0) 
               { 
                   $this->nm_data->SetaData($this->due_date[$this->nm_grid_colunas], "YYYY-MM-DD");
                   $this->due_date[$this->nm_grid_colunas] = $this->nm_data->FormataSaida($this->nm_data->FormatRegion("DT", "ddmmaaaa"));
               } 
          } 
          if ($this->barcode[$this->nm_grid_colunas] === "") 
          { 
              $this->barcode[$this->nm_grid_colunas] = "&nbsp;" ;  
          } 
          elseif ($this->Ini->Gd_missing)
          { 
              $this->barcode[$this->nm_grid_colunas] = "<span class=\"scErrorLine\">" . $this->Ini->Nm_lang['lang_errm_gd'] . "</span>";
          } 
          else   
          { 
              $Font_bar = new BCGFont($this->Ini->path_third . '/barcodegen/class/font/Arial.ttf', 8);
              $Color_black = new BCGColor(0, 0, 0);
              $Color_white = new BCGColor(255, 255, 255);
              $out_barcode = $this->Ini->path_imag_temp . "/sc_gs1128a_" . $_SESSION['scriptcase']['sc_num_img'] . session_id() . ".png";
              $_SESSION['scriptcase']['sc_num_img']++ ;
              $this->barcode[$this->nm_grid_colunas] = (string) $this->barcode[$this->nm_grid_colunas];
              $Code_bar = new BCGgs1128();
              $Code_bar->setScale(1);
              $Code_bar->setThickness(30);
              $Code_bar->setForegroundColor($Color_black);
              $Code_bar->setBackgroundColor($Color_white);
              $Code_bar->setFont($Font_bar);
              $Code_bar->setStart('A');
              $Code_bar->setTilde(true);
              $Code_bar->parse($this->barcode[$this->nm_grid_colunas]);
              $Drawing_bar = new BCGDrawing($this->Ini->root . $out_barcode, $Color_white);
              $Drawing_bar->setBarcode($Code_bar);
              $Drawing_bar->setDPI(72);
              $Drawing_bar->draw();
              $Drawing_bar->finish(BCGDrawing::IMG_FORMAT_PNG);
          } 
          if (!empty($out_barcode)) 
          { 
              if ($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['doc_word'] || $this->Img_embbed || $this->Ini->sc_export_ajax_img) 
              { 
                  $loc_img_word = $this->NM_raiz_img . $out_barcode;
                  $reg_barcode = "";
                  if (is_file($loc_img_word)) 
                  { 
                      $tmp_barcode = fopen($loc_img_word, "rb"); 
                      $reg_barcode = fread($tmp_barcode, filesize($loc_img_word)); 
                      fclose($tmp_barcode);
                  } 
                  $this->barcode[$this->nm_grid_colunas] = "<img border=\"0\" src=\"data:image/png;base64," . base64_encode($reg_barcode) . "\"/>" ; 
              } 
              else 
              { 
                  $this->barcode[$this->nm_grid_colunas] = "<img src=\"" . $this->NM_raiz_img . $out_barcode . "\" BORDER=\"0\"/>" ; 
              } 
          } 
          if ($this->item_desc[$this->nm_grid_colunas] === "") 
          { 
              $this->item_desc[$this->nm_grid_colunas] = "&nbsp;" ;  
          } 
          if ($this->item_value[$this->nm_grid_colunas] === "") 
          { 
              $this->item_value[$this->nm_grid_colunas] = "&nbsp;" ;  
          } 
          $nm_quant_linhas++;
          $quant_tot_linhas++;
          $this->nm_grid_colunas++;
          $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['final']++;
          $this->rs_grid->MoveNext();
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['embutida'] || $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['opcao'] == "pdf" || $this->Ini->Apl_paginacao == "FULL")
          { 
              $quant_tot_linhas = 0;
          } 
     }  
     $reg = 0;
     $nm_saida->saida("  <div class=WordSection1>\r\n");
     $nm_saida->saida("  \r\n");
     $nm_saida->saida("  <table class=MsoTableGrid border=0 cellspacing=0 cellpadding=0 width=650>\r\n");
     $nm_saida->saida("   <tr>\r\n");
     $nm_saida->saida("    <td rowspan=3 valign=top>\r\n");
     $nm_saida->saida("    <p><span lang=EN-US style='font-size:26pt;font-family:\"Lucida Sans\",sans-serif'>\r\n");
     $nm_saida->saida("      <o:p>" . "AUTO CLEAN" . "</o:p></span></p>\r\n");
     $nm_saida->saida("    </td>\r\n");
     $nm_saida->saida("    <td valign=top>\r\n");
     $nm_saida->saida("    <p><span lang=EN-US style='font-size:10.0pt;font-family:\"Lucida Sans\",sans-serif'>Invoice\r\n");
     $nm_saida->saida("    #</span></p>\r\n");
     $nm_saida->saida("    </td>\r\n");
     $nm_saida->saida("    <td width=22 valign=top>\r\n");
     $nm_saida->saida("    <p><span lang=EN-US style='font-size:10.0pt;font-family:\"Lucida Sans\",sans-serif'>:</span></p>\r\n");
     $nm_saida->saida("    </td>\r\n");
     $nm_saida->saida("    <td valign=top>\r\n");
     $nm_saida->saida("    <p><span lang=EN-US style='font-size:10.0pt;font-family:\"Lucida Sans\",sans-serif'>" . $this->a_appointments_id[$reg] . "</span></p>\r\n");
     $nm_saida->saida("    </td>\r\n");
     $nm_saida->saida("   </tr>\r\n");
     $nm_saida->saida("   <tr>\r\n");
     $nm_saida->saida("    <td valign=top>\r\n");
     $nm_saida->saida("    <p><span lang=EN-US style='font-size:10.0pt;font-family:\"Lucida Sans\",sans-serif'>Invoice\r\n");
     $nm_saida->saida("    Date</span></p>\r\n");
     $nm_saida->saida("    </td>\r\n");
     $nm_saida->saida("    <td width=22 valign=top>\r\n");
     $nm_saida->saida("    <p><span lang=EN-US style='font-size:10.0pt;font-family:\"Lucida Sans\",sans-serif'>:</span></p>\r\n");
     $nm_saida->saida("    </td>\r\n");
     $nm_saida->saida("    <td valign=top>\r\n");
     $nm_saida->saida("    <p><span lang=EN-US style='font-size:10.0pt;font-family:\"Lucida Sans\",sans-serif'>" . $this->a_appointment_start_date[$reg] . "</span></p>\r\n");
     $nm_saida->saida("    </td>\r\n");
     $nm_saida->saida("   </tr>\r\n");
     $nm_saida->saida("   <tr>\r\n");
     $nm_saida->saida("    <td valign=top>\r\n");
     $nm_saida->saida("    <p><span lang=EN-US style='font-size:10.0pt;font-family:\"Lucida Sans\",sans-serif'>Invoice\r\n");
     $nm_saida->saida("    Due</span></p>\r\n");
     $nm_saida->saida("    </td>\r\n");
     $nm_saida->saida("    <td width=22 valign=top>\r\n");
     $nm_saida->saida("    <p><span lang=EN-US style='font-size:10.0pt;font-family:\"Lucida Sans\",sans-serif'>:</span></p>\r\n");
     $nm_saida->saida("    </td>\r\n");
     $nm_saida->saida("    <td valign=top>\r\n");
     $nm_saida->saida("    <p><span lang=EN-US style='font-size:10.0pt;font-family:\"Lucida Sans\",sans-serif'>" . $this->due_date[$reg] . "</span></p>\r\n");
     $nm_saida->saida("    </td>\r\n");
     $nm_saida->saida("   </tr>\r\n");
     $nm_saida->saida("  </table>\r\n");
     $nm_saida->saida("  \r\n");
     $nm_saida->saida("  <p>&nbsp;</p>\r\n");
     $nm_saida->saida("  \r\n");
     $nm_saida->saida("  <table border=1 cellspacing=0 cellpadding=2 width=650>\r\n");
     $nm_saida->saida("   <tr>\r\n");
     $nm_saida->saida("    <td width=71 valign=top>\r\n");
     $nm_saida->saida("    <p><b style='mso-bidi-font-weight:normal'><span lang=EN-US\r\n");
     $nm_saida->saida("    style='font-size:10.0pt;font-family:\"Lucida Sans\",sans-serif'>To :</span></b></p>\r\n");
     $nm_saida->saida("    </td>\r\n");
     $nm_saida->saida("    <td colspan=2 valign=top>\r\n");
     $nm_saida->saida("    <p><span lang=EN-US style='font-size:10.0pt;font-family:\"Lucida Sans\",sans-serif'>" . $this->c_customers_name[$reg] . "</span></p>\r\n");
     $nm_saida->saida("    </td>\r\n");
     $nm_saida->saida("    <td width=322 rowspan=5 valign=top><span lang=EN-US\r\n");
     $nm_saida->saida("    style='font-size:10.0pt;font-family:\"Lucida Sans\",sans-serif'>Service\r\n");
     $nm_saida->saida("    Description:</span></b></p>\r\n");
     $nm_saida->saida("    <p>" . "Servicio Auto Clean" . "</p></td>\r\n");
     $nm_saida->saida("   </tr>\r\n");
     $nm_saida->saida("   <tr>\r\n");
     $nm_saida->saida("    <td valign=top>\r\n");
     $nm_saida->saida("    <p>&nbsp;</p>\r\n");
     $nm_saida->saida("    </td>\r\n");
     $nm_saida->saida("    <td colspan=2 valign=top>\r\n");
     $nm_saida->saida("    <p><span lang=EN-US style='font-size:10.0pt;font-family:\"Lucida Sans\",sans-serif'>" . $this->c_customers_address[$reg] . "</span></p>\r\n");
     $nm_saida->saida("    </td>\r\n");
     $nm_saida->saida("   </tr>\r\n");
     $nm_saida->saida("   <tr>\r\n");
     $nm_saida->saida("    <td valign=top>\r\n");
     $nm_saida->saida("    <p>&nbsp;</p>\r\n");
     $nm_saida->saida("    </td>\r\n");
     $nm_saida->saida("    <td colspan=2 valign=top>\r\n");
     $nm_saida->saida("    <p><span lang=EN-US style='font-size:10.0pt;font-family:\"Lucida Sans\",sans-serif'>" . $this->c_customers_city[$reg] . "</span></p>\r\n");
     $nm_saida->saida("    </td>\r\n");
     $nm_saida->saida("   </tr>\r\n");
     $nm_saida->saida("   <tr>\r\n");
     $nm_saida->saida("    <td valign=top>\r\n");
     $nm_saida->saida("    <p>&nbsp;</p>\r\n");
     $nm_saida->saida("    </td>\r\n");
     $nm_saida->saida("    <td width=74 valign=top>\r\n");
     $nm_saida->saida("    <p><span lang=EN-US style='font-size:10.0pt;font-family:\"Lucida Sans\",sans-serif'>Phone:</span></p>\r\n");
     $nm_saida->saida("    </td>  \r\n");
     $nm_saida->saida("    <td width=154>\r\n");
     $nm_saida->saida("    <p><span lang=EN-US style='font-size:10.0pt;font-family:\"Lucida Sans\",sans-serif'>" . $this->c_customers_phone[$reg] . "</span></p>\r\n");
     $nm_saida->saida("    </td>\r\n");
     $nm_saida->saida("   </tr>\r\n");
     $nm_saida->saida("   <tr>\r\n");
     $nm_saida->saida("    <td valign=top>\r\n");
     $nm_saida->saida("    <p>&nbsp;</p>\r\n");
     $nm_saida->saida("    </td>\r\n");
     $nm_saida->saida("    <td valign=top>\r\n");
     $nm_saida->saida("    <p><span lang=EN-US style='font-size:10.0pt;font-family:\"Lucida Sans\",sans-serif'>Email:</span></p>\r\n");
     $nm_saida->saida("    </td>\r\n");
     $nm_saida->saida("    <td valign=top>\r\n");
     $nm_saida->saida("    <p><span lang=EN-US style='font-size:10.0pt;font-family:\"Lucida Sans\",sans-serif'>" . $this->c_customers_email[$reg] . "</span></p>\r\n");
     $nm_saida->saida("    </td>\r\n");
     $nm_saida->saida("   </tr>\r\n");
     $nm_saida->saida("  </table>\r\n");
     $nm_saida->saida("  \r\n");
     $nm_saida->saida("  <p>&nbsp;</p>\r\n");
     $nm_saida->saida("  \r\n");
     $nm_saida->saida("  <p>&nbsp;</p>\r\n");
     $nm_saida->saida("  \r\n");
     $nm_saida->saida("  <table border=1 cellspacing=0 cellpadding=0 width=650>\r\n");
     $nm_saida->saida("   <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;height:14.4pt'>\r\n");
     $nm_saida->saida("    <td width=499 colspan=3 valign=top style='width:374.4pt;border:solid windowtext 1.0pt;\r\n");
     $nm_saida->saida("    mso-border-alt:solid windowtext .5pt;background:#404040;mso-background-themecolor:\r\n");
     $nm_saida->saida("    text1;mso-background-themetint:191;padding:0cm 5.4pt 0cm 5.4pt;height:14.4pt'>\r\n");
     $nm_saida->saida("    <p class=MsoNormal align=center style='text-align:center'><b\r\n");
     $nm_saida->saida("    style='mso-bidi-font-weight:normal'><span lang=EN-US style='font-size:10.0pt;\r\n");
     $nm_saida->saida("    font-family:\"Lucida Sans\",sans-serif;color:white;mso-themecolor:background1'>Description</span></b></p>\r\n");
     $nm_saida->saida("    </td>\r\n");
     $nm_saida->saida("    <td width=140 valign=top style='width:105.75pt;border:solid windowtext 1.0pt;\r\n");
     $nm_saida->saida("    border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:\r\n");
     $nm_saida->saida("    solid windowtext .5pt;background:#404040;mso-background-themecolor:text1;\r\n");
     $nm_saida->saida("    mso-background-themetint:191;padding:0cm 5.4pt 0cm 5.4pt;height:14.4pt'>\r\n");
     $nm_saida->saida("    <p class=MsoNormal align=center style='text-align:center'><b\r\n");
     $nm_saida->saida("    style='mso-bidi-font-weight:normal'><span lang=EN-US style='font-size:10.0pt;\r\n");
     $nm_saida->saida("    font-family:\"Lucida Sans\",sans-serif;color:white;mso-themecolor:background1'>Amount</span></b></p>\r\n");
     $nm_saida->saida("    </td>\r\n");
     $nm_saida->saida("   </tr>\r\n");
     $nm_saida->saida("   <tr style='mso-yfti-irow:2;height:14.4pt'>\r\n");
     $nm_saida->saida("    <td width=499 colspan=3 valign=middle>\r\n");
     $nm_saida->saida("    <p>&nbsp;</p>\r\n");
     $nm_saida->saida("    <p>" . $this->item_desc[$reg] . "</p>\r\n");
     $nm_saida->saida("    <p>&nbsp;</p>\r\n");
     $nm_saida->saida("    </td>\r\n");
     $nm_saida->saida("    <td width=141 valign=top>\r\n");
     $nm_saida->saida("    <p>&nbsp;</p>\r\n");
     $nm_saida->saida("    <p>" . $this->item_value[$reg] . "</p>\r\n");
     $nm_saida->saida("    <p>&nbsp;</p>\r\n");
     $nm_saida->saida("    </td>\r\n");
     $nm_saida->saida("   </tr>\r\n");
     $nm_saida->saida("   <tr>\r\n");
     $nm_saida->saida("    <td width=499 valign=top >\r\n");
     $nm_saida->saida("    <p>&nbsp;</p>\r\n");
     $nm_saida->saida("    </td>\r\n");
     $nm_saida->saida("    <td width=84 valign=top >\r\n");
     $nm_saida->saida("    <p>Subtotal</p>\r\n");
     $nm_saida->saida("    </td>\r\n");
     $nm_saida->saida("    <td width=48 valign=top >\r\n");
     $nm_saida->saida("    <p>&nbsp;</p>\r\n");
     $nm_saida->saida("    </td>\r\n");
     $nm_saida->saida("    <td width=141 valign=top>\r\n");
     $nm_saida->saida("    <p>" . $this->a_price[$reg] . "</p>\r\n");
     $nm_saida->saida("    </td>\r\n");
     $nm_saida->saida("   </tr>\r\n");
     $nm_saida->saida("   <tr>\r\n");
     $nm_saida->saida("    <td width=499 valign=top >\r\n");
     $nm_saida->saida("    <p>&nbsp;</p>\r\n");
     $nm_saida->saida("    </td>\r\n");
     $nm_saida->saida("    <td width=84 valign=top >\r\n");
     $nm_saida->saida("    <p>Tax</p>\r\n");
     $nm_saida->saida("    </td>\r\n");
     $nm_saida->saida("    <td width=48 valign=top>\r\n");
     $nm_saida->saida("    <p>&nbsp;</p>\r\n");
     $nm_saida->saida("    </td>\r\n");
     $nm_saida->saida("    <td width=141 valign=top>\r\n");
     $nm_saida->saida("    <p>" . $this->a_additional_charges[$reg] . "</p>\r\n");
     $nm_saida->saida("    </td>\r\n");
     $nm_saida->saida("   </tr>\r\n");
     $nm_saida->saida("   <tr style='mso-yfti-irow:18;height:14.4pt'>\r\n");
     $nm_saida->saida("    <td width=499 valign=top>\r\n");
     $nm_saida->saida("    <p>&nbsp;</p>\r\n");
     $nm_saida->saida("    </td>\r\n");
     $nm_saida->saida("    <td width=84 valign=top>\r\n");
     $nm_saida->saida("    <p>Discount</p>\r\n");
     $nm_saida->saida("    </td>\r\n");
     $nm_saida->saida("    <td width=48 valign=top>\r\n");
     $nm_saida->saida("    <p>&nbsp;</p>\r\n");
     $nm_saida->saida("    </td>\r\n");
     $nm_saida->saida("    <td width=141 valign=top>\r\n");
     $nm_saida->saida("    <p>" . $this->a_additional_charges[$reg] . "</p>\r\n");
     $nm_saida->saida("    </td>\r\n");
     $nm_saida->saida("   </tr>\r\n");
     $nm_saida->saida("   <tr>\r\n");
     $nm_saida->saida("    <td width=499 valign=top>\r\n");
     $nm_saida->saida("    <p>&nbsp;</p>\r\n");
     $nm_saida->saida("    </td>\r\n");
     $nm_saida->saida("    <td width=84 >\r\n");
     $nm_saida->saida("    <p><b>Total</b></p>\r\n");
     $nm_saida->saida("    </td>\r\n");
     $nm_saida->saida("    <td width=48 valign=top>\r\n");
     $nm_saida->saida("    <p>&nbsp;</p>\r\n");
     $nm_saida->saida("    </td>\r\n");
     $nm_saida->saida("    <td width=141 valign=top>\r\n");
     $nm_saida->saida("    <p><b>" . $this->a_total_price[$reg] . "</b></p>\r\n");
     $nm_saida->saida("    </td>\r\n");
     $nm_saida->saida("   </tr>\r\n");
     $nm_saida->saida("  </table>\r\n");
     $nm_saida->saida("  \r\n");
     $nm_saida->saida("  <p>&nbsp;</p>\r\n");
     $nm_saida->saida("  \r\n");
     $nm_saida->saida("  <p>&nbsp;</p>\r\n");
     $nm_saida->saida("  \r\n");
     $nm_saida->saida("  <p>Make all checks payable to :<br>\r\n");
     $nm_saida->saida("   Netmake IT Solutions\r\n");
     $nm_saida->saida("  <br>\r\n");
     $nm_saida->saida("  Bank XXXX<br>\r\n");
     $nm_saida->saida("  Account XYZ-1234</p>\r\n");
     $nm_saida->saida("  \r\n");
     $nm_saida->saida("  <p>" . $this->barcode[$reg] . "</p>\r\n");
     $nm_saida->saida("  \r\n");
     $nm_saida->saida("  </div>\r\n");
   }  
   $this->rs_grid->Close();
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['ajax_nav'])
   { 
       $this->Ini->Arr_result['setValue'][] = array('field' => 'sc_grid_body', 'value' => NM_charset_to_utf8($_SESSION['scriptcase']['saida_html']));
       $_SESSION['scriptcase']['saida_html'] = "";
   } 
   $nm_saida->saida("   </TD></TR>\r\n");
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['embutida'])
   { 
       $nm_saida->saida("       </table>\r\n");
   } 
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['embutida'])
   { 
       $_SESSION['scriptcase']['contr_link_emb'] = "";   
   } 
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
   function nmgp_barra_top_normal()
   {
      global 
             $nm_saida, $nm_url_saida, $nm_apl_dependente;
      $NM_btn = false;
     if (!$_SESSION['scriptcase']['proc_mobile'] && $this->Fix_bar_top) { 
$nm_saida->saida("    <style>\r\n");
$nm_saida->saida("        #sc_grid_toobar_top {\r\n");
$nm_saida->saida("        display: block;\r\n");
$nm_saida->saida("        width: 100%;\r\n");
$nm_saida->saida("        }\r\n");
$nm_saida->saida("        #sc_grid_toobar_top_tr {\r\n");
$nm_saida->saida("            position: sticky;\r\n");
$nm_saida->saida("            top: 0px;\r\n");
$nm_saida->saida("            width: 100%;\r\n");
$nm_saida->saida("            left: 0;\r\n");
$nm_saida->saida("            z-index: 7;\r\n");
$nm_saida->saida("            background-color: var(--bg-grid-toolbar-general);\r\n");
$nm_saida->saida("            /*box-shadow: 0px 1px 5px 0px rgba(0,0,0,.2)*/\r\n");
$nm_saida->saida("        }\r\n");
$nm_saida->saida("        #sc_grid_toobar_top .scGridToolbar {\r\n");
$nm_saida->saida("            /*border-color: rgba(176, 186, 197, 0.56);*/\r\n");
$nm_saida->saida("        }\r\n");
$nm_saida->saida("        /*.scGridBorder>table {\r\n");
$nm_saida->saida("            margin-top: 60px;\r\n");
$nm_saida->saida("            box-shadow: 0 0 15px 0px rgba(0,0,0,.2);\r\n");
$nm_saida->saida("        }\r\n");
$nm_saida->saida("        .scGridBorder {\r\n");
$nm_saida->saida("            border-width: 0px !important;\r\n");
$nm_saida->saida("        }*/\r\n");
$nm_saida->saida("    </style>\r\n");
     } 
      $nm_saida->saida("      <tr style=\"display: none\">\r\n");
      $nm_saida->saida("      <td>\r\n");
      $nm_saida->saida("      <form id=\"id_F0_top\" name=\"F0_top\" method=\"post\" action=\"./\" target=\"_self\"> \r\n");
      $nm_saida->saida("      <input type=\"text\" id=\"id_sc_truta_f0_top\" name=\"sc_truta_f0_top\" value=\"\"/> \r\n");
      $nm_saida->saida("      <input type=\"hidden\" id=\"script_init_f0_top\" name=\"script_case_init\" value=\"" . NM_encode_input($this->Ini->sc_page) . "\"/> \r\n");
      $nm_saida->saida("      <input type=\"hidden\" id=\"opcao_f0_top\" name=\"nmgp_opcao\" value=\"muda_qt_linhas\"/> \r\n");
      $nm_saida->saida("      </td></tr><tr>\r\n");
      $nm_saida->saida("      <tr id=\"sc_grid_toobar_top_tr\">\r\n");
      $nm_saida->saida("       <td id=\"sc_grid_toobar_top\" class=\"" . $this->css_scGridTabelaTd . "\"> \r\n");
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['ajax_nav'])
      { 
          $_SESSION['scriptcase']['saida_html'] = "";
      } 
      $nm_saida->saida("        <table id=\"sc_grid_toobar_top_table\" class=\"" . $this->css_scGridToolbar . "\" width=\"100%\">\r\n");
      $nm_saida->saida("         <tr class=\"" . $this->css_scGridToolbarPadd . "_tr\"> \r\n");
      $nm_saida->saida("          <td class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"left\" width=\"33%\"> \r\n");
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['opcao_print'] != "print") 
      {
      $nm_saida->saida("         </td> \r\n");
      $nm_saida->saida("          <td class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"center\" width=\"33%\"> \r\n");
      if ($this->nmgp_botoes['group_1'] == "on" && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">var sc_itens_btgp_group_1_top = false;</script>\r\n");
          $nm_saida->saida("           <span id=\"sc_groupgroup_1_top\" style=\"position:relative;\">\r\n");
          $Cod_Btn = nmButtonOutput($this->arr_buttons, "group_group_1", "scBtnGrpShow('group_1_top')", "scBtnGrpShow('group_1_top')", "sc_btgp_btn_group_1_top", "", "" . $this->Ini->Nm_lang['lang_btns_expt'] . "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "" . $this->Ini->Nm_lang['lang_btns_expt'] . "", "", "", "__sc_grp__", "only_text", "text_right", "", "", "", "", "", "", "");
          $nm_saida->saida("           $Cod_Btn\r\n");
          $NM_btn  = true;
          $NM_Gbtn = false;
          $Cod_Btn = nmButtonGroupTableOutput($this->arr_buttons, "group_group_1", 'group_1', 'top', 'app', 'ini');
          $nm_saida->saida("           $Cod_Btn\r\n");
      if ($this->nmgp_botoes['pdf'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_1_top = true;</script>\r\n");
      $Tem_gb_pdf  = "s";
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['SC_Ind_Groupby'] == "sc_free_total")
      {
          $Tem_gb_pdf = "n";
      }
      $Tem_pdf_res = "n";
              $this->nm_btn_exist['pdf'][] = "pdf_top";
          $nm_saida->saida("            <div id=\"div_pdf_top\" class=\"scBtnGrpText scBtnGrpClick\">\r\n");
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bpdf", "", "", "pdf_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "thickbox", "" . $this->Ini->path_link . "appointment_billing/appointment_billing_config_pdf.php?nm_opc=pdf&nm_target=0&nm_cor=cor&papel=1&lpapel=0&apapel=0&orientacao=1&bookmarks=1&largura=1200&conf_larg=S&conf_fonte=10&grafico=XX&sc_ver_93=s&nm_tem_gb=" . $Tem_gb_pdf . "&nm_res_cons=" . $Tem_pdf_res . "&nm_ini_pdf_res=grid,resume,chart&nm_all_modules=grid,resume,chart&nm_label_group=S&nm_all_cab=N&nm_all_label=N&nm_orient_grid=5&password=n&summary_export_columns=N&pdf_zip=N&origem=cons&language=en_us&conf_socor=S&script_case_init=" . $this->Ini->sc_page . "&app_name=appointment_billing&KeepThis=true&TB_iframe=true&modal=true", "group_1", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
              $NM_Gbtn = true;
      }
      if ($this->nmgp_botoes['print'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $Tem_pdf_res = "n";
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_1_top = true;</script>\r\n");
          $nm_saida->saida("            <div id=\"div_print_top\" class=\"scBtnGrpText scBtnGrpClick\">\r\n");
              $this->nm_btn_exist['print'][] = "print_top";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bprint", "", "", "print_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "thickbox", "" . $this->Ini->path_link . "appointment_billing/appointment_billing_config_print.php?script_case_init=" . $this->Ini->sc_page . "&summary_export_columns=N&nm_opc=PC&nm_cor=PB&password=n&language=en_us&nm_page=" . NM_encode_input($this->Ini->sc_page) . "&nm_res_cons=" . $Tem_pdf_res . "&nm_ini_prt_res=grid&nm_all_modules=grid,resume,chart&origem=cons&KeepThis=true&TB_iframe=true&modal=true", "group_1", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
              $NM_Gbtn = true;
      }
          $Cod_Btn = nmButtonGroupTableOutput($this->arr_buttons, "group_group_1", 'group_1', 'top', 'app', 'fim');
          $nm_saida->saida("           $Cod_Btn\r\n");
          $nm_saida->saida("           </span>\r\n");
          $nm_saida->saida("           <script type=\"text/javascript\">\r\n");
          $nm_saida->saida("             if (!sc_itens_btgp_group_1_top) {\r\n");
          $nm_saida->saida("                 document.getElementById('sc_btgp_btn_group_1_top').style.display='none'; }\r\n");
          $nm_saida->saida("           </script>\r\n");
      }
      $nm_saida->saida("         </td> \r\n");
      $nm_saida->saida("          <td class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"right\" width=\"33%\"> \r\n");
      if ($this->nmgp_botoes['pdf'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $this->nm_btn_exist['pdf'][] = "email_pdf_top";
      $Tem_gb_pdf  = "s";
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['SC_Ind_Groupby'] == "sc_free_total")
      {
          $Tem_gb_pdf = "n";
      }
      $Tem_pdf_res = "n";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bemailpdf", "", "", "email_pdf_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "thickbox", "" . $this->Ini->path_link . "appointment_billing/appointment_billing_config_pdf.php?export_ajax=S&nm_opc=pdf&nm_target=&nm_cor=cor&papel=1&orientacao=1&bookmarks=1&largura=1200&conf_larg=S&conf_fonte=10&grafico=XX&sc_ver_93=s&nm_tem_gb=" . $Tem_gb_pdf . "&nm_res_cons=" . $Tem_pdf_res . "&nm_ini_pdf_res=grid,resume,chart&nm_all_modules=grid,resume,chart&password=n&summary_export_columns=N&origem=cons&language=en_us&conf_socor=S&nm_label_group=S&nm_all_cab=N&nm_all_label=N&&pdf_zip=Nnm_orient_grid=5&script_case_init=" . $this->Ini->sc_page . "&app_name=appointment_billing&KeepThis=true&TB_iframe=true&modal=true", "", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
              $NM_btn = true;
      }
          if (is_file("appointment_billing_help.txt") && !$this->grid_emb_form)
          {
             $Arq_WebHelp = file("appointment_billing_help.txt"); 
             if (isset($Arq_WebHelp[0]) && !empty($Arq_WebHelp[0]))
             {
                 $Arq_WebHelp[0] = str_replace("\r\n" , "", trim($Arq_WebHelp[0]));
                 $Tmp = explode(";", $Arq_WebHelp[0]); 
                 foreach ($Tmp as $Cada_help)
                 {
                     $Tmp1 = explode(":", $Cada_help); 
                     if (!empty($Tmp1[0]) && isset($Tmp1[1]) && !empty($Tmp1[1]) && $Tmp1[0] == "cons" && is_file($this->Ini->root . $this->Ini->path_help . $Tmp1[1]))
                     {
                        $Cod_Btn = nmButtonOutput($this->arr_buttons, "bhelp", "nm_open_popup('" . $this->Ini->path_help . $Tmp1[1] . "');", "nm_open_popup('" . $this->Ini->path_help . $Tmp1[1] . "');", "help_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
                        $nm_saida->saida("           $Cod_Btn \r\n");
                        $NM_btn = true;
                     }
                 }
             }
          }
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['b_sair'] || $this->grid_emb_form || $this->grid_emb_form_full || (isset($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['dashboard_info']['under_dashboard']))
      {
         $this->nmgp_botoes['exit'] = "off"; 
      }
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['opc_psq'])
      {
          $this->nm_btn_exist['exit'][] = "sai_top";
         if ($nm_apl_dependente == 1 && $this->nmgp_botoes['exit'] == "on") 
         { 
            $Cod_Btn = nmButtonOutput($this->arr_buttons, "bvoltar", "document.F5.action='$nm_url_saida'; document.F5.submit();", "document.F5.action='$nm_url_saida'; document.F5.submit();", "sai_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
            $nm_saida->saida("           $Cod_Btn \r\n");
            $NM_btn = true;
         } 
         elseif (!$this->Ini->Embutida_iframe && !$this->Ini->SC_Link_View && !$this->aba_iframe && $this->nmgp_botoes['exit'] == "on") 
         { 
            $Cod_Btn = nmButtonOutput($this->arr_buttons, "bsair", "document.F5.action='$nm_url_saida'; document.F5.submit();", "document.F5.action='$nm_url_saida'; document.F5.submit();", "sai_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
            $nm_saida->saida("           $Cod_Btn \r\n");
            $NM_btn = true;
         } 
      }
      elseif ($this->nmgp_botoes['exit'] == "on")
      {
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['sc_modal'])
        {
           $Cod_Btn = nmButtonOutput($this->arr_buttons, "bvoltar", "self.parent.tb_remove()", "self.parent.tb_remove()", "sai_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
        }
        else
        {
           $Cod_Btn = nmButtonOutput($this->arr_buttons, "bvoltar", "window.close();", "window.close();", "sai_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
        }
         $nm_saida->saida("           $Cod_Btn \r\n");
         $NM_btn = true;
      }
      }
      $nm_saida->saida("         </td> \r\n");
      $nm_saida->saida("        </tr> \r\n");
      $nm_saida->saida("       </table> \r\n");
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['ajax_nav'] && $this->force_toolbar)
      { 
          $this->Ini->Arr_result['setValue'][] = array('field' => 'sc_grid_toobar_top', 'value' => NM_charset_to_utf8($_SESSION['scriptcase']['saida_html']));
          $_SESSION['scriptcase']['saida_html'] = "";
      } 
      $nm_saida->saida("      </td> \r\n");
      $nm_saida->saida("     </tr> \r\n");
      $nm_saida->saida("      <tr style=\"display: none\">\r\n");
      $nm_saida->saida("      <td> \r\n");
      $nm_saida->saida("     </form> \r\n");
      $nm_saida->saida("      </td> \r\n");
      $nm_saida->saida("     </tr> \r\n");
      if (!$NM_btn && isset($NM_ult_sep))
      {
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['ajax_nav'] && $this->force_toolbar)
          { 
              $this->Ini->Arr_result['setDisplay'][] = array('field' => $NM_ult_sep, 'value' => 'none');
          } 
          $nm_saida->saida("     <script language=\"javascript\">\r\n");
            $nm_saida->saida("        document.getElementById('" . $NM_ult_sep . "').style.display='none';\r\n");
          $nm_saida->saida("     </script>\r\n");
      }
   }
   function nmgp_barra_top_mobile()
   {
      global 
             $nm_saida, $nm_url_saida, $nm_apl_dependente;
      $NM_btn = false;
     if (!$_SESSION['scriptcase']['proc_mobile'] && $this->Fix_bar_top) { 
$nm_saida->saida("    <style>\r\n");
$nm_saida->saida("        #sc_grid_toobar_top {\r\n");
$nm_saida->saida("        display: block;\r\n");
$nm_saida->saida("        width: 100%;\r\n");
$nm_saida->saida("        }\r\n");
$nm_saida->saida("        #sc_grid_toobar_top_tr {\r\n");
$nm_saida->saida("            position: sticky;\r\n");
$nm_saida->saida("            top: 0px;\r\n");
$nm_saida->saida("            width: 100%;\r\n");
$nm_saida->saida("            left: 0;\r\n");
$nm_saida->saida("            z-index: 7;\r\n");
$nm_saida->saida("            background-color: var(--bg-grid-toolbar-general);\r\n");
$nm_saida->saida("            /*box-shadow: 0px 1px 5px 0px rgba(0,0,0,.2)*/\r\n");
$nm_saida->saida("        }\r\n");
$nm_saida->saida("        #sc_grid_toobar_top .scGridToolbar {\r\n");
$nm_saida->saida("            /*border-color: rgba(176, 186, 197, 0.56);*/\r\n");
$nm_saida->saida("        }\r\n");
$nm_saida->saida("        /*.scGridBorder>table {\r\n");
$nm_saida->saida("            margin-top: 60px;\r\n");
$nm_saida->saida("            box-shadow: 0 0 15px 0px rgba(0,0,0,.2);\r\n");
$nm_saida->saida("        }\r\n");
$nm_saida->saida("        .scGridBorder {\r\n");
$nm_saida->saida("            border-width: 0px !important;\r\n");
$nm_saida->saida("        }*/\r\n");
$nm_saida->saida("    </style>\r\n");
     } 
      $nm_saida->saida("      <tr style=\"display: none\">\r\n");
      $nm_saida->saida("      <td>\r\n");
      $nm_saida->saida("      <form id=\"id_F0_top\" name=\"F0_top\" method=\"post\" action=\"./\" target=\"_self\"> \r\n");
      $nm_saida->saida("      <input type=\"text\" id=\"id_sc_truta_f0_top\" name=\"sc_truta_f0_top\" value=\"\"/> \r\n");
      $nm_saida->saida("      <input type=\"hidden\" id=\"script_init_f0_top\" name=\"script_case_init\" value=\"" . NM_encode_input($this->Ini->sc_page) . "\"/> \r\n");
      $nm_saida->saida("      <input type=\"hidden\" id=\"opcao_f0_top\" name=\"nmgp_opcao\" value=\"muda_qt_linhas\"/> \r\n");
      $nm_saida->saida("      </td></tr><tr>\r\n");
      $nm_saida->saida("      <tr id=\"sc_grid_toobar_top_tr\">\r\n");
      $nm_saida->saida("       <td id=\"sc_grid_toobar_top\" class=\"" . $this->css_scGridTabelaTd . "\"> \r\n");
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['ajax_nav'])
      { 
          $_SESSION['scriptcase']['saida_html'] = "";
      } 
      $nm_saida->saida("        <table id=\"sc_grid_toobar_top_table\" class=\"" . $this->css_scGridToolbar . "\" width=\"100%\">\r\n");
      $nm_saida->saida("         <tr class=\"" . $this->css_scGridToolbarPadd . "_tr\"> \r\n");
      $nm_saida->saida("          <td class=\"" . $this->css_scGridToolbarPadd . "\" nowrap valign=\"middle\" align=\"left\" width=\"33%\"> \r\n");
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['opcao_print'] != "print") 
      {
      if ($this->nmgp_botoes['group_1'] == "on" && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">var sc_itens_btgp_group_1_top = false;</script>\r\n");
          $nm_saida->saida("           <span id=\"sc_groupgroup_1_top\" style=\"position:relative;\">\r\n");
          $Cod_Btn = nmButtonOutput($this->arr_buttons, "group_group_1", "scBtnGrpShow('group_1_top')", "scBtnGrpShow('group_1_top')", "sc_btgp_btn_group_1_top", "", "" . $this->Ini->Nm_lang['lang_btns_expt'] . "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "" . $this->Ini->Nm_lang['lang_btns_expt'] . "", "", "", "__sc_grp__", "text_img", "text_right", "", "", "", "", "", "", "");
          $nm_saida->saida("           $Cod_Btn\r\n");
          $NM_btn  = true;
          $NM_Gbtn = false;
          $Cod_Btn = nmButtonGroupTableOutput($this->arr_buttons, "group_group_1", 'group_1', 'top', 'list', 'ini');
          $nm_saida->saida("           $Cod_Btn\r\n");
      if ($this->nmgp_botoes['pdf'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_1_top = true;</script>\r\n");
      $Tem_gb_pdf  = "s";
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['SC_Ind_Groupby'] == "sc_free_total")
      {
          $Tem_gb_pdf = "n";
      }
      $Tem_pdf_res = "n";
              $this->nm_btn_exist['pdf'][] = "pdf_top";
          $nm_saida->saida("            <div id=\"div_pdf_top\" class=\"scBtnGrpText scBtnGrpClick\">\r\n");
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bpdf", "", "", "pdf_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "thickbox", "" . $this->Ini->path_link . "appointment_billing/appointment_billing_config_pdf.php?nm_opc=pdf&nm_target=0&nm_cor=cor&papel=1&lpapel=0&apapel=0&orientacao=1&bookmarks=1&largura=1200&conf_larg=S&conf_fonte=10&grafico=XX&sc_ver_93=s&nm_tem_gb=" . $Tem_gb_pdf . "&nm_res_cons=" . $Tem_pdf_res . "&nm_ini_pdf_res=grid,resume,chart&nm_all_modules=grid,resume,chart&nm_label_group=S&nm_all_cab=N&nm_all_label=N&nm_orient_grid=5&password=n&summary_export_columns=N&pdf_zip=N&origem=cons&language=en_us&conf_socor=S&script_case_init=" . $this->Ini->sc_page . "&app_name=appointment_billing&KeepThis=true&TB_iframe=true&modal=true", "group_1", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
              $NM_Gbtn = true;
      }
      if ($this->nmgp_botoes['print'] == "on" && !$_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['opc_psq'] && empty($this->nm_grid_sem_reg) && !$this->grid_emb_form)
      {
          $Tem_pdf_res = "n";
          $nm_saida->saida("           <script type=\"text/javascript\">sc_itens_btgp_group_1_top = true;</script>\r\n");
          $nm_saida->saida("            <div id=\"div_print_top\" class=\"scBtnGrpText scBtnGrpClick\">\r\n");
              $this->nm_btn_exist['print'][] = "print_top";
              $Cod_Btn = nmButtonOutput($this->arr_buttons, "bprint", "", "", "print_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "thickbox", "" . $this->Ini->path_link . "appointment_billing/appointment_billing_config_print.php?script_case_init=" . $this->Ini->sc_page . "&summary_export_columns=N&nm_opc=PC&nm_cor=PB&password=n&language=en_us&nm_page=" . NM_encode_input($this->Ini->sc_page) . "&nm_res_cons=" . $Tem_pdf_res . "&nm_ini_prt_res=grid&nm_all_modules=grid,resume,chart&origem=cons&KeepThis=true&TB_iframe=true&modal=true", "group_1", "only_text", "text_right", "", "", "", "", "", "", "");
              $nm_saida->saida("           $Cod_Btn \r\n");
          $nm_saida->saida("            </div>\r\n");
              $NM_Gbtn = true;
      }
          $Cod_Btn = nmButtonGroupTableOutput($this->arr_buttons, "group_group_1", 'group_1', 'top', 'list', 'fim');
          $nm_saida->saida("           $Cod_Btn\r\n");
          $nm_saida->saida("           </span>\r\n");
          $nm_saida->saida("           <script type=\"text/javascript\">\r\n");
          $nm_saida->saida("             if (!sc_itens_btgp_group_1_top) {\r\n");
          $nm_saida->saida("                 document.getElementById('sc_btgp_btn_group_1_top').style.display='none'; }\r\n");
          $nm_saida->saida("           </script>\r\n");
      }
          if (is_file("appointment_billing_help.txt") && !$this->grid_emb_form)
          {
             $Arq_WebHelp = file("appointment_billing_help.txt"); 
             if (isset($Arq_WebHelp[0]) && !empty($Arq_WebHelp[0]))
             {
                 $Arq_WebHelp[0] = str_replace("\r\n" , "", trim($Arq_WebHelp[0]));
                 $Tmp = explode(";", $Arq_WebHelp[0]); 
                 foreach ($Tmp as $Cada_help)
                 {
                     $Tmp1 = explode(":", $Cada_help); 
                     if (!empty($Tmp1[0]) && isset($Tmp1[1]) && !empty($Tmp1[1]) && $Tmp1[0] == "cons" && is_file($this->Ini->root . $this->Ini->path_help . $Tmp1[1]))
                     {
                        $Cod_Btn = nmButtonOutput($this->arr_buttons, "bhelp", "nm_open_popup('" . $this->Ini->path_help . $Tmp1[1] . "');", "nm_open_popup('" . $this->Ini->path_help . $Tmp1[1] . "');", "help_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
                        $nm_saida->saida("           $Cod_Btn \r\n");
                        $NM_btn = true;
                     }
                 }
             }
          }
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['b_sair'] || $this->grid_emb_form || $this->grid_emb_form_full || (isset($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['dashboard_info']['under_dashboard']) && $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['dashboard_info']['under_dashboard']))
      {
         $this->nmgp_botoes['exit'] = "off"; 
      }
      if (!$_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['opc_psq'])
      {
          $this->nm_btn_exist['exit'][] = "sai_top";
         if ($nm_apl_dependente == 1 && $this->nmgp_botoes['exit'] == "on") 
         { 
            $Cod_Btn = nmButtonOutput($this->arr_buttons, "bvoltar", "document.F5.action='$nm_url_saida'; document.F5.submit();", "document.F5.action='$nm_url_saida'; document.F5.submit();", "sai_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
            $nm_saida->saida("           $Cod_Btn \r\n");
            $NM_btn = true;
         } 
         elseif (!$this->Ini->Embutida_iframe && !$this->Ini->SC_Link_View && !$this->aba_iframe && $this->nmgp_botoes['exit'] == "on") 
         { 
            $Cod_Btn = nmButtonOutput($this->arr_buttons, "bsair", "document.F5.action='$nm_url_saida'; document.F5.submit();", "document.F5.action='$nm_url_saida'; document.F5.submit();", "sai_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
            $nm_saida->saida("           $Cod_Btn \r\n");
            $NM_btn = true;
         } 
      }
      elseif ($this->nmgp_botoes['exit'] == "on")
      {
        if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['sc_modal'])
        {
           $Cod_Btn = nmButtonOutput($this->arr_buttons, "bvoltar", "self.parent.tb_remove()", "self.parent.tb_remove()", "sai_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
        }
        else
        {
           $Cod_Btn = nmButtonOutput($this->arr_buttons, "bvoltar", "window.close();", "window.close();", "sai_top", "", "", "", "absmiddle", "", "0px", $this->Ini->path_botoes, "", "", "", "", "", "only_text", "text_right", "", "", "", "", "", "", "");
        }
         $nm_saida->saida("           $Cod_Btn \r\n");
         $NM_btn = true;
      }
      }
      $nm_saida->saida("         </td> \r\n");
      $nm_saida->saida("        </tr> \r\n");
      $nm_saida->saida("       </table> \r\n");
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['ajax_nav'] && $this->force_toolbar)
      { 
          $this->Ini->Arr_result['setValue'][] = array('field' => 'sc_grid_toobar_top', 'value' => NM_charset_to_utf8($_SESSION['scriptcase']['saida_html']));
          $_SESSION['scriptcase']['saida_html'] = "";
      } 
      $nm_saida->saida("      </td> \r\n");
      $nm_saida->saida("     </tr> \r\n");
      $nm_saida->saida("      <tr style=\"display: none\">\r\n");
      $nm_saida->saida("      <td> \r\n");
      $nm_saida->saida("     </form> \r\n");
      $nm_saida->saida("      </td> \r\n");
      $nm_saida->saida("     </tr> \r\n");
      if (!$NM_btn && isset($NM_ult_sep))
      {
          if ($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['ajax_nav'] && $this->force_toolbar)
          { 
              $this->Ini->Arr_result['setDisplay'][] = array('field' => $NM_ult_sep, 'value' => 'none');
          } 
          $nm_saida->saida("     <script language=\"javascript\">\r\n");
            $nm_saida->saida("        document.getElementById('" . $NM_ult_sep . "').style.display='none';\r\n");
          $nm_saida->saida("     </script>\r\n");
      }
   }
   function nmgp_barra_top()
   {
       if(isset($_SESSION['scriptcase']['proc_mobile']) && $_SESSION['scriptcase']['proc_mobile'])
       {
           $this->nmgp_barra_top_mobile();
       }
       else
       {
           $this->nmgp_barra_top_normal();
       }
   }
   function nmgp_barra_bot()
   {
       if(isset($_SESSION['scriptcase']['proc_mobile']) && $_SESSION['scriptcase']['proc_mobile'])
       {
       }
   }
   function nmgp_embbed_placeholder_top()
   {
      global $nm_saida;
      $nm_saida->saida("     <tr id=\"sc_id_save_grid_placeholder_top\" style=\"display: none\">\r\n");
      $nm_saida->saida("      <td>\r\n");
      $nm_saida->saida("      </td>\r\n");
      $nm_saida->saida("     </tr>\r\n");
      $nm_saida->saida("     <tr id=\"sc_id_groupby_placeholder_top\" style=\"display: none\">\r\n");
      $nm_saida->saida("      <td>\r\n");
      $nm_saida->saida("      </td>\r\n");
      $nm_saida->saida("     </tr>\r\n");
      $nm_saida->saida("     <tr id=\"sc_id_sel_campos_placeholder_top\" style=\"display: none\">\r\n");
      $nm_saida->saida("      <td>\r\n");
      $nm_saida->saida("      </td>\r\n");
      $nm_saida->saida("     </tr>\r\n");
      $nm_saida->saida("     <tr id=\"sc_id_order_campos_placeholder_top\" style=\"display: none\">\r\n");
      $nm_saida->saida("      <td>\r\n");
      $nm_saida->saida("      </td>\r\n");
      $nm_saida->saida("     </tr>\r\n");
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
 function chk_sc_btns()
 {
 }
 function nm_fim_grid($flag_apaga_pdf_log = TRUE)
 {
   global
   $nm_saida, $nm_url_saida, $NMSC_modal;
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['embutida'] && isset($_SESSION['sc_session'][$this->Ini->sc_page]['SC_sub_css']))
   {
       unset($_SESSION['sc_session'][$this->Ini->sc_page]['SC_sub_css']);
       unset($_SESSION['sc_session'][$this->Ini->sc_page]['SC_sub_css_bw']);
   }
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['embutida'])
   { 
        return;
   } 
   $nm_saida->saida("   </TABLE>\r\n");
   $nm_saida->saida("   </div>\r\n");
   $nm_saida->saida("   </TR>\r\n");
   $nm_saida->saida("   </TD>\r\n");
   $nm_saida->saida("   </TABLE>\r\n");
   $nm_saida->saida("   </body>\r\n");
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['opcao'] == "pdf" || $this->Print_All)
   { 
   $nm_saida->saida("   </HTML>\r\n");
        return;
   } 
   $nm_saida->saida("   <script type=\"text/javascript\">\r\n");
   $nm_saida->saida("   NM_ancor_ult_lig = '';\r\n");
   if (!$_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['embutida'])
   { 
       if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['NM_arr_tree']))
       {
           $temp = array();
           foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['NM_arr_tree'] as $NM_aplic => $resto)
           {
               $temp[] = $NM_aplic;
           }
           $temp = array_unique($temp);
           foreach ($temp as $NM_aplic)
           {
               if ($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['ajax_nav'])
               { 
                   $this->Ini->Arr_result['setArr'][] = array('var' => ' NM_tab_' . $NM_aplic, 'value' => '');
               } 
               $nm_saida->saida("   NM_tab_" . $NM_aplic . " = new Array();\r\n");
           }
           foreach ($_SESSION['sc_session'][$this->Ini->sc_page]['NM_arr_tree'] as $NM_aplic => $resto)
           {
               foreach ($resto as $NM_ind => $NM_quebra)
               {
                   foreach ($NM_quebra as $NM_nivel => $NM_tipo)
                   {
                       if ($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['ajax_nav'])
                       { 
                           $this->Ini->Arr_result['setVar'][] = array('var' => ' NM_tab_' . $NM_aplic . '[' . $NM_ind . ']', 'value' => $NM_tipo . $NM_nivel);
                       } 
                       $nm_saida->saida("   NM_tab_" . $NM_aplic . "[" . $NM_ind . "] = '" . $NM_tipo . $NM_nivel . "';\r\n");
                   }
               }
           }
       }
   }
   $nm_saida->saida("   function NM_liga_tbody(tbody, Obj, Apl)\r\n");
   $nm_saida->saida("   {\r\n");
   $nm_saida->saida("      Nivel = parseInt (Obj[tbody].substr(3));\r\n");
   $nm_saida->saida("      for (ind = tbody + 1; ind < Obj.length; ind++)\r\n");
   $nm_saida->saida("      {\r\n");
   $nm_saida->saida("           Nv = parseInt (Obj[ind].substr(3));\r\n");
   $nm_saida->saida("           Tp = Obj[ind].substr(0, 3);\r\n");
   $nm_saida->saida("           if (Nivel == Nv && Tp == 'top')\r\n");
   $nm_saida->saida("           {\r\n");
   $nm_saida->saida("               break;\r\n");
   $nm_saida->saida("           }\r\n");
   $nm_saida->saida("           if (((Nivel + 1) == Nv && Tp == 'top') || (Nivel == Nv && Tp == 'bot'))\r\n");
   $nm_saida->saida("           {\r\n");
   $nm_saida->saida("               document.getElementById('tbody_' + Apl + '_' + ind + '_' + Tp).style.display='';\r\n");
   $nm_saida->saida("           } \r\n");
   $nm_saida->saida("      }\r\n");
   $nm_saida->saida("   }\r\n");
   $nm_saida->saida("   function NM_apaga_tbody(tbody, Obj, Apl)\r\n");
   $nm_saida->saida("   {\r\n");
   $nm_saida->saida("      Nivel = Obj[tbody].substr(3);\r\n");
   $nm_saida->saida("      for (ind = tbody + 1; ind < Obj.length; ind++)\r\n");
   $nm_saida->saida("      {\r\n");
   $nm_saida->saida("           Nv = Obj[ind].substr(3);\r\n");
   $nm_saida->saida("           Tp = Obj[ind].substr(0, 3);\r\n");
   $nm_saida->saida("           if ((Nivel == Nv && Tp == 'top') || Nv < Nivel)\r\n");
   $nm_saida->saida("           {\r\n");
   $nm_saida->saida("               break;\r\n");
   $nm_saida->saida("           }\r\n");
   $nm_saida->saida("           if ((Nivel != Nv) || (Nivel == Nv && Tp == 'bot'))\r\n");
   $nm_saida->saida("           {\r\n");
   $nm_saida->saida("               document.getElementById('tbody_' + Apl + '_' + ind + '_' + Tp).style.display='none';\r\n");
   $nm_saida->saida("               if (Tp == 'top')\r\n");
   $nm_saida->saida("               {\r\n");
   $nm_saida->saida("                   document.getElementById('b_open_' + Apl + '_' + ind).style.display='';\r\n");
   $nm_saida->saida("                   document.getElementById('b_close_' + Apl + '_' + ind).style.display='none';\r\n");
   $nm_saida->saida("               } \r\n");
   $nm_saida->saida("           } \r\n");
   $nm_saida->saida("      }\r\n");
   $nm_saida->saida("   }\r\n");
   $nm_saida->saida("   NM_obj_ant = '';\r\n");
   $nm_saida->saida("   function NM_apaga_div_lig(obj_nome)\r\n");
   $nm_saida->saida("   {\r\n");
   $nm_saida->saida("      if (NM_obj_ant != '')\r\n");
   $nm_saida->saida("      {\r\n");
   $nm_saida->saida("          NM_obj_ant.style.display='none';\r\n");
   $nm_saida->saida("      }\r\n");
   $nm_saida->saida("      obj = document.getElementById(obj_nome);\r\n");
   $nm_saida->saida("      NM_obj_ant = obj;\r\n");
   $nm_saida->saida("      ind_time = setTimeout(\"obj.style.display='none'\", 300);\r\n");
   $nm_saida->saida("      return ind_time;\r\n");
   $nm_saida->saida("   }\r\n");
   $nm_saida->saida("   function NM_btn_disable()\r\n");
   $nm_saida->saida("   {\r\n");
   foreach ($this->nm_btn_disabled as $cod_btn => $st_btn) {
      if (isset($this->nm_btn_exist[$cod_btn]) && $st_btn == 'on') {
         foreach ($this->nm_btn_exist[$cod_btn] as $cada_id) {
       $nm_saida->saida("     $('#" . $cada_id . "').prop('onclick', null).off('click').addClass('disabled').removeAttr('href');\r\n");
       $nm_saida->saida("     $('#div_" . $cada_id . "').addClass('disabled');\r\n");
         }
      }
   }
   $nm_saida->saida("   }\r\n");
   $str_pbfile = $this->Ini->root . $this->Ini->path_imag_temp . '/sc_pb_' . session_id() . '.tmp';
   if (@is_file($str_pbfile) && $flag_apaga_pdf_log)
   {
      @unlink($str_pbfile);
   }
   if ($this->Rec_ini == 0 && empty($this->nm_grid_sem_reg) && !$this->Print_All && $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['opcao'] != "pdf" && !$_SESSION['scriptcase']['proc_mobile'])
   { 
   } 
   elseif ($this->Rec_ini == 0 && empty($this->nm_grid_sem_reg) && !$this->Print_All && $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['opcao'] != "pdf" && $_SESSION['scriptcase']['proc_mobile'])
   { 
   } 
   if ($this->rs_grid->EOF && empty($this->nm_grid_sem_reg) && !$this->Print_All && $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['opcao'] != "pdf")
   {
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['opcao'] != "pdf" && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['opc_liga']['nav']) && !$_SESSION['scriptcase']['proc_mobile'])
       { 
       } 
       elseif ($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['opcao'] != "pdf" && !isset($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['opc_liga']['nav']) && $_SESSION['scriptcase']['proc_mobile'])
       { 
       } 
       $nm_saida->saida("   nm_gp_fim = \"fim\";\r\n");
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['ajax_nav'])
       {
           $this->Ini->Arr_result['setVar'][] = array('var' => 'nm_gp_fim', 'value' => "fim");
           $this->Ini->Arr_result['scrollEOF'] = true;
       }
   }
   else
   {
       $nm_saida->saida("   nm_gp_fim = \"\";\r\n");
       if ($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['ajax_nav'])
       {
           $this->Ini->Arr_result['setVar'][] = array('var' => 'nm_gp_fim', 'value' => "");
       }
   }
   if (isset($this->redir_modal) && !empty($this->redir_modal))
   {
       echo $this->redir_modal;
   }
   $nm_saida->saida("   </script>\r\n");
   if ($this->grid_emb_form || $this->grid_emb_form_full)
   {
       $nm_saida->saida("   <script type=\"text/javascript\">\r\n");
       $nm_saida->saida("      window.onload = function() {\r\n");
       $nm_saida->saida("         setTimeout(\"parent.scAjaxDetailHeight('appointment_billing', $(document).innerHeight())\",50);\r\n");
       $nm_saida->saida("      }\r\n");
       $nm_saida->saida("   </script>\r\n");
   }
   $nm_saida->saida("   </HTML>\r\n");
 }
//--- 
//--- 
 function form_navegacao()
 {
   global
   $nm_saida, $nm_url_saida;
   $str_pbfile = $this->Ini->root . $this->Ini->path_imag_temp . '/sc_pb_' . session_id() . '.tmp';
   $nm_saida->saida("   <form name=\"F3\" method=\"post\" \r\n");
   $nm_saida->saida("                     action=\"./\" \r\n");
   $nm_saida->saida("                     target=\"_self\" style=\"display: none\"> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_chave\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_opcao\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_ordem\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"SC_lig_apl_orig\" value=\"appointment_billing\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_parm_acum\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_quant_linhas\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_url_saida\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_parms\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_tipo_pdf\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_outra_jan\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_orig_pesq\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"SC_module_export\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"script_case_init\" value=\"" . NM_encode_input($this->Ini->sc_page) . "\"/> \r\n");
   $nm_saida->saida("   </form> \r\n");
   $nm_saida->saida("   <form name=\"F4\" method=\"post\" \r\n");
   $nm_saida->saida("                     action=\"./\" \r\n");
   $nm_saida->saida("                     target=\"_self\" style=\"display: none\"> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_opcao\" value=\"rec\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"rec\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nm_call_php\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"script_case_init\" value=\"" . NM_encode_input($this->Ini->sc_page) . "\"/> \r\n");
   $nm_saida->saida("   </form> \r\n");
   $nm_saida->saida("   <form name=\"F5\" method=\"post\" \r\n");
   $nm_saida->saida("                     action=\"appointment_billing_pesq.class.php\" \r\n");
   $nm_saida->saida("                     target=\"_self\" style=\"display: none\"> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"script_case_init\" value=\"" . NM_encode_input($this->Ini->sc_page) . "\"/> \r\n");
   $nm_saida->saida("   </form> \r\n");
   $nm_saida->saida("   <form name=\"F6\" method=\"post\" \r\n");
   $nm_saida->saida("                     action=\"./\" \r\n");
   $nm_saida->saida("                     target=\"_self\" style=\"display: none\"> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"script_case_init\" value=\"" . NM_encode_input($this->Ini->sc_page) . "\"/> \r\n");
   $nm_saida->saida("   </form> \r\n");
   $nm_saida->saida("   <form name=\"Fprint\" method=\"post\" \r\n");
   $nm_saida->saida("                     action=\"appointment_billing_iframe_prt.php\" \r\n");
   $nm_saida->saida("                     target=\"jan_print\" style=\"display: none\"> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"path_botoes\" value=\"" . $this->Ini->path_botoes . "\"/> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"opcao\" value=\"print\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_opcao\" value=\"print\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"tp_print\" value=\"PC\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"cor_print\" value=\"PB\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_opcao\" value=\"print\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_tipo_print\" value=\"PC\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_cor_print\" value=\"PB\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"SC_module_export\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_password\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"script_case_init\" value=\"" . NM_encode_input($this->Ini->sc_page) . "\"/> \r\n");
   $nm_saida->saida("   </form> \r\n");
   $nm_saida->saida("   <form name=\"Fexport\" method=\"post\" \r\n");
   $nm_saida->saida("                     action=\"./\" \r\n");
   $nm_saida->saida("                     target=\"_self\" style=\"display: none\"> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_opcao\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_tp_xls\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_tot_xls\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"SC_module_export\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nm_delim_line\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nm_delim_col\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nm_delim_dados\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nm_label_csv\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nm_xml_tag\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nm_xml_label\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nm_json_format\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nm_json_label\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_password\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"script_case_init\" value=\"" . NM_encode_input($this->Ini->sc_page) . "\"/> \r\n");
   $nm_saida->saida("   </form> \r\n");
   $nm_saida->saida("  <form name=\"Fdoc_word\" method=\"post\" \r\n");
   $nm_saida->saida("        action=\"./\" \r\n");
   $nm_saida->saida("        target=\"_self\"> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_opcao\" value=\"doc_word\"/> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_cor_word\" value=\"AM\"/> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"SC_module_export\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_password\" value=\"\"/>\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_navegator_print\" value=\"\"/> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"script_case_init\" value=\"" . NM_encode_input($this->Ini->sc_page) . "\"/> \r\n");
   $nm_saida->saida("  </form> \r\n");
   $nm_saida->saida("  <form name=\"Fpdf\" method=\"post\" target=\"_self\">\r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_opcao\" value=\"\"/> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_parms\" value=\"\"/> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"sc_tp_pdf\" value=\"\"/> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"sc_parms_pdf\" value=\"\"/> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_parms_pdf\" value=\"\"/> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"sc_create_charts\" value=\"\"/> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"sc_graf_pdf\" value=\"\"/> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"nmgp_graf_pdf\" value=\"\"/> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"chart_level\" value=\"\"/> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"page_break_pdf\" value=\"\"/> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"SC_module_export\" value=\"\"/> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"use_pass_pdf\" value=\"\"/> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"pdf_all_cab\" value=\"\"/> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"pdf_all_label\" value=\"\"/> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"pdf_label_group\" value=\"\"/> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"pdf_zip\" value=\"\"/> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"script_case_init\" value=\"\"/> \r\n");
   $nm_saida->saida("    <input type=\"hidden\" name=\"script_case_session\" value=\"\"/> \r\n");
   $nm_saida->saida("  </form> \r\n");
   $nm_saida->saida("   <script type=\"text/javascript\">\r\n");
   $nm_saida->saida("    document.Fdoc_word.nmgp_navegator_print.value = navigator.appName;\r\n");
   $nm_saida->saida("   function nm_gp_word_conf(cor, SC_module_export, password, ajax, str_type, bol_param)\r\n");
   $nm_saida->saida("   {\r\n");
   $nm_saida->saida("       if (\"S\" == ajax)\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           $('#TB_window').remove();\r\n");
   $nm_saida->saida("           $('body').append(\"<div id='TB_window'></div>\");\r\n");
   $nm_saida->saida("               nm_submit_modal(\"" . $this->Ini->path_link . "appointment_billing/appointment_billing_export_email.php?script_case_init={$this->Ini->sc_page}&path_img={$this->Ini->path_img_global}&path_btn={$this->Ini->path_botoes}&sType=\"+ str_type +\"&sAdd=__E__nmgp_cor_word=\" + cor + \"__E__SC_module_export=\" + SC_module_export + \"__E__nmgp_password=\" + password + \"&KeepThis=true&TB_iframe=true&modal=true\", bol_param);\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("       else\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           document.Fdoc_word.nmgp_cor_word.value = cor;\r\n");
   $nm_saida->saida("           document.Fdoc_word.nmgp_password.value = password;\r\n");
   $nm_saida->saida("           document.Fdoc_word.SC_module_export.value = SC_module_export;\r\n");
   $nm_saida->saida("           document.Fdoc_word.action = \"appointment_billing_export_ctrl.php\";\r\n");
   $nm_saida->saida("           document.Fdoc_word.submit();\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("   }\r\n");
   if ($this->Rec_ini == 0)
   {
       $nm_saida->saida("   nm_gp_ini = \"ini\";\r\n");
   }
   else
   {
       $nm_saida->saida("   nm_gp_ini = \"\";\r\n");
   }
   $nm_saida->saida("   nm_gp_rec_ini = \"" . $this->Rec_ini . "\";\r\n");
   $nm_saida->saida("   nm_gp_rec_fim = \"" . $this->Rec_fim . "\";\r\n");
   if ($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['ajax_nav'])
   {
       if ($this->Rec_ini == 0)
       {
           $this->Ini->Arr_result['setVar'][] = array('var' => 'nm_gp_ini', 'value' => "ini");
       }
       else
       {
           $this->Ini->Arr_result['setVar'][] = array('var' => 'nm_gp_ini', 'value' => "");
       }
       $this->Ini->Arr_result['setVar'][] = array('var' => 'nm_gp_rec_ini', 'value' => $this->Rec_ini);
       $this->Ini->Arr_result['setVar'][] = array('var' => 'nm_gp_rec_fim', 'value' => $this->Rec_fim);
   }
   $nm_saida->saida("   function nm_gp_submit_rec(campo) \r\n");
   $nm_saida->saida("   { \r\n");
   $nm_saida->saida("      if (nm_gp_ini == \"ini\" && (campo == \"ini\" || campo == nm_gp_rec_ini)) \r\n");
   $nm_saida->saida("      { \r\n");
   $nm_saida->saida("          return; \r\n");
   $nm_saida->saida("      } \r\n");
   $nm_saida->saida("      if (nm_gp_fim == \"fim\" && (campo == \"fim\" || campo == nm_gp_rec_fim)) \r\n");
   $nm_saida->saida("      { \r\n");
   $nm_saida->saida("          return; \r\n");
   $nm_saida->saida("      } \r\n");
   $nm_saida->saida("      nm_gp_submit_ajax(\"rec\", campo); \r\n");
   $nm_saida->saida("   } \r\n");
   $nm_saida->saida("   function nm_gp_submit_ajax(opc, parm) \r\n");
   $nm_saida->saida("   { \r\n");
   $nm_saida->saida("      return ajax_navigate(opc, parm); \r\n");
   $nm_saida->saida("   } \r\n");
   $nm_saida->saida("   function nm_gp_submit2(campo) \r\n");
   $nm_saida->saida("   { \r\n");
   $nm_saida->saida("      nm_gp_submit_ajax(\"ordem\", campo); \r\n");
   $nm_saida->saida("   } \r\n");
   $nm_saida->saida("   function nm_gp_submit3(parms, parm_acum, opc, ancor) \r\n");
   $nm_saida->saida("   { \r\n");
   $nm_saida->saida("      document.F3.target               = \"_self\"; \r\n");
   $nm_saida->saida("      document.F3.nmgp_parms.value     = parms ;\r\n");
   $nm_saida->saida("      document.F3.nmgp_parm_acum.value = parm_acum ;\r\n");
   $nm_saida->saida("      document.F3.nmgp_opcao.value     = opc ;\r\n");
   $nm_saida->saida("      document.F3.nmgp_url_saida.value = \"\";\r\n");
   $nm_saida->saida("      document.F3.action               = \"./\"  ;\r\n");
   $nm_saida->saida("      if (ancor != null) {\r\n");
   $nm_saida->saida("         ajax_save_ancor(\"F3\", ancor);\r\n");
   $nm_saida->saida("      } else {\r\n");
   $nm_saida->saida("          document.F3.submit() ;\r\n");
   $nm_saida->saida("      } \r\n");
   $nm_saida->saida("   } \r\n");
   $nm_saida->saida("   function nm_open_export(arq_export) \r\n");
   $nm_saida->saida("   { \r\n");
   $nm_saida->saida("      window.location = arq_export;\r\n");
   $nm_saida->saida("   } \r\n");
   $nm_saida->saida("   function nm_submit_modal(parms, t_parent) \r\n");
   $nm_saida->saida("   { \r\n");
   $nm_saida->saida("      if (t_parent == 'S' && typeof parent.tb_show == 'function')\r\n");
   $nm_saida->saida("      { \r\n");
   $nm_saida->saida("           parent.tb_show('', parms, '');\r\n");
   $nm_saida->saida("      } \r\n");
   $nm_saida->saida("      else\r\n");
   $nm_saida->saida("      { \r\n");
   $nm_saida->saida("         tb_show('', parms, '');\r\n");
   $nm_saida->saida("      } \r\n");
   $nm_saida->saida("   } \r\n");
   $nm_saida->saida("   function nm_move(tipo) \r\n");
   $nm_saida->saida("   { \r\n");
   $nm_saida->saida("      document.F6.target = \"_self\"; \r\n");
   $nm_saida->saida("      document.F6.submit() ;\r\n");
   $nm_saida->saida("      return;\r\n");
   $nm_saida->saida("   } \r\n");
   $nm_saida->saida("   function nm_gp_move(x, y, z, p, g, crt, ajax, chart_level, page_break_pdf, SC_module_export, use_pass_pdf, pdf_all_cab, pdf_all_label, pdf_label_group, pdf_zip) \r\n");
   $nm_saida->saida("   { \r\n");
   $nm_saida->saida("       document.F3.action           = \"./\"  ;\r\n");
   $nm_saida->saida("       document.F3.nmgp_parms.value = \"SC_null\" ;\r\n");
   $nm_saida->saida("       document.F3.nmgp_orig_pesq.value = \"\" ;\r\n");
   $nm_saida->saida("       document.F3.nmgp_url_saida.value = \"\" ;\r\n");
   $nm_saida->saida("       document.F3.nmgp_opcao.value = x; \r\n");
   $nm_saida->saida("       document.F3.nmgp_outra_jan.value = \"\" ;\r\n");
   $nm_saida->saida("       document.F3.target = \"_self\"; \r\n");
   $nm_saida->saida("       if (y == 1) \r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           document.F3.target = \"_blank\"; \r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("       if (\"busca\" == x)\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           document.F3.nmgp_orig_pesq.value = z; \r\n");
   $nm_saida->saida("           z = '';\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("       if (z != null && z != '') \r\n");
   $nm_saida->saida("       { \r\n");
   $nm_saida->saida("           document.F3.nmgp_tipo_pdf.value = z; \r\n");
   $nm_saida->saida("       } \r\n");
   $nm_saida->saida("       if (\"xls\" == x)\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           document.F3.SC_module_export.value = z;\r\n");
   if (!extension_loaded("zip"))
   {
       $nm_saida->saida("           alert (\"" . html_entity_decode($this->Ini->Nm_lang['lang_othr_prod_xtzp'], ENT_COMPAT, $_SESSION['scriptcase']['charset']) . "\");\r\n");
       $nm_saida->saida("           return false;\r\n");
   } 
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("       if (\"xml\" == x)\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           document.F3.SC_module_export.value = z;\r\n");
   $nm_saida->saida("       }\r\n");
   $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['appointment_billing_iframe_params'] = array(
       'str_tmp'          => $this->Ini->path_imag_temp,
       'str_prod'         => $this->Ini->path_prod,
       'str_btn'          => $this->Ini->Str_btn_css,
       'str_lang'         => $this->Ini->str_lang,
       'str_schema'       => $this->Ini->str_schema_all,
       'str_google_fonts' => $this->Ini->str_google_fonts,
   );
   $prep_parm_pdf = "scsess?#?" . session_id() . "?@?str_tmp?#?" . $this->Ini->path_imag_temp . "?@?str_prod?#?" . $this->Ini->path_prod . "?@?str_btn?#?" . $this->Ini->Str_btn_css . "?@?str_lang?#?" . $this->Ini->str_lang . "?@?str_schema?#?"  . $this->Ini->str_schema_all . "?@?script_case_init?#?" . $this->Ini->sc_page . "?@?jspath?#?" . $this->Ini->path_js . "?#?";
   $Md5_pdf    = "@SC_par@" . NM_encode_input($this->Ini->sc_page) . "@SC_par@appointment_billing@SC_par@" . md5($prep_parm_pdf);
   $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['Md5_pdf'][md5($prep_parm_pdf)] = $prep_parm_pdf;
   $nm_saida->saida("       if (\"pdf\" == x)\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           document.Fpdf.nmgp_opcao.value = \"pdf\";\r\n");
   $nm_saida->saida("           document.Fpdf.nmgp_parms.value = \"" . $Md5_pdf . "\";\r\n");
   $nm_saida->saida("           document.Fpdf.sc_tp_pdf.value = z;\r\n");
   $nm_saida->saida("           document.Fpdf.sc_parms_pdf.value = p;\r\n");
   $nm_saida->saida("           document.Fpdf.nmgp_parms_pdf.value = p;\r\n");
   $nm_saida->saida("           document.Fpdf.sc_create_charts.value = crt;\r\n");
   $nm_saida->saida("           document.Fpdf.sc_graf_pdf.value = g;\r\n");
   $nm_saida->saida("           document.Fpdf.nmgp_graf_pdf.value = g;\r\n");
   $nm_saida->saida("           document.Fpdf.chart_level.value = chart_level;\r\n");
   $nm_saida->saida("           document.Fpdf.page_break_pdf.value = page_break_pdf;\r\n");
   $nm_saida->saida("           document.Fpdf.SC_module_export.value = SC_module_export;\r\n");
   $nm_saida->saida("           document.Fpdf.use_pass_pdf.value = use_pass_pdf;\r\n");
   $nm_saida->saida("           document.Fpdf.pdf_all_cab.value = pdf_all_cab;\r\n");
   $nm_saida->saida("           document.Fpdf.pdf_all_label.value = pdf_all_label;\r\n");
   $nm_saida->saida("           document.Fpdf.pdf_label_group.value = pdf_label_group;\r\n");
   $nm_saida->saida("           document.Fpdf.pdf_zip.value = pdf_zip;\r\n");
   $nm_saida->saida("           document.Fpdf.script_case_init.value = \"" . NM_encode_input($this->Ini->sc_page) . "\";\r\n");
   $nm_saida->saida("           document.Fpdf.script_case_session.value = \"" . session_id() . "\";\r\n");
   $nm_saida->saida("           if (\"S\" == ajax)\r\n");
   $nm_saida->saida("           {\r\n");
   $nm_saida->saida("               $('#TB_window').remove();\r\n");
   $nm_saida->saida("               $('body').append(\"<div id='TB_window'></div>\");\r\n");
   $nm_saida->saida("               nm_submit_modal(\"" . $this->Ini->path_link . "appointment_billing/appointment_billing_export_email.php?script_case_init={$this->Ini->sc_page}&path_img={$this->Ini->path_img_global}&path_btn={$this->Ini->path_botoes}&sType=pdf&sAdd=__E__nmgp_tipo_pdf=\" + z + \"__E__sc_parms_pdf=\" + p + \"__E__sc_create_charts=\" + crt + \"__E__sc_graf_pdf=\" + g + \"__E__chart_level=\" + chart_level + \"__E__page_break_pdf=\" + page_break_pdf + \"__E__SC_module_export=\" + SC_module_export + \"__E__use_pass_pdf=\" + use_pass_pdf + \"__E__pdf_all_cab=\" + pdf_all_cab + \"__E__pdf_all_label=\" +  pdf_all_label + \"__E__pdf_label_group=\" +  pdf_label_group + \"__E__pdf_zip=\" +  pdf_zip + \"&nm_opc=pdf&KeepThis=true&TB_iframe=true&modal=true\", '');\r\n");
   $nm_saida->saida("           }\r\n");
   $nm_saida->saida("           else\r\n");
   $nm_saida->saida("           {\r\n");
   $nm_saida->saida("               document.Fpdf.action=\"appointment_billing_iframe.php\";\r\n");
   $nm_saida->saida("               document.Fpdf.submit();\r\n");
   $nm_saida->saida("           }\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("       else\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           if ((x == 'igual' || x == 'edit') && NM_ancor_ult_lig != \"\")\r\n");
   $nm_saida->saida("           {\r\n");
   $nm_saida->saida("                ajax_save_ancor(\"F3\", NM_ancor_ult_lig);\r\n");
   $nm_saida->saida("                NM_ancor_ult_lig = \"\";\r\n");
   $nm_saida->saida("            } else {\r\n");
   $nm_saida->saida("                document.F3.submit() ;\r\n");
   $nm_saida->saida("            } \r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("   } \r\n");
   $nm_saida->saida("   function nm_gp_print_conf(tp, cor, SC_module_export, password, ajax, str_type, bol_param)\r\n");
   $nm_saida->saida("   {\r\n");
   $nm_saida->saida("       if (\"S\" == ajax)\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           $('#TB_window').remove();\r\n");
   $nm_saida->saida("           $('body').append(\"<div id='TB_window'></div>\");\r\n");
   $nm_saida->saida("               nm_submit_modal(\"" . $this->Ini->path_link . "appointment_billing/appointment_billing_export_email.php?script_case_init={$this->Ini->sc_page}&path_img={$this->Ini->path_img_global}&path_btn={$this->Ini->path_botoes}&sType=\"+ str_type +\"&sAdd=__E__nmgp_tipo_print=\" + tp + \"__E__cor_print=\" + cor + \"__E__SC_module_export=\" + SC_module_export + \"__E__nmgp_password=\" + password + \"&KeepThis=true&TB_iframe=true&modal=true\", bol_param);\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("       else\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           document.Fprint.tp_print.value = tp;\r\n");
   $nm_saida->saida("           document.Fprint.cor_print.value = cor;\r\n");
   $nm_saida->saida("           document.Fprint.nmgp_tipo_print.value = tp;\r\n");
   $nm_saida->saida("           document.Fprint.nmgp_cor_print.value = cor;\r\n");
   $nm_saida->saida("           document.Fprint.SC_module_export.value = SC_module_export;\r\n");
   $nm_saida->saida("           document.Fprint.nmgp_password.value = password;\r\n");
   $nm_saida->saida("           if (password != \"\")\r\n");
   $nm_saida->saida("           {\r\n");
   $nm_saida->saida("               document.Fprint.target = '_self';\r\n");
   $nm_saida->saida("               document.Fprint.action = \"appointment_billing_export_ctrl.php\";\r\n");
   $nm_saida->saida("           }\r\n");
   $nm_saida->saida("           else\r\n");
   $nm_saida->saida("           {\r\n");
   $nm_saida->saida("               window.open('','jan_print','location=no,menubar=no,resizable,scrollbars,status=no,toolbar=no');\r\n");
   $nm_saida->saida("           }\r\n");
   $nm_saida->saida("           document.Fprint.submit() ;\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("   }\r\n");
   $nm_saida->saida("   function nm_gp_xls_conf(tp_xls, SC_module_export, password, tot_xls, ajax, str_type, bol_param)\r\n");
   $nm_saida->saida("   {\r\n");
   $nm_saida->saida("       if (\"S\" == ajax)\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           $('#TB_window').remove();\r\n");
   $nm_saida->saida("           $('body').append(\"<div id='TB_window'></div>\");\r\n");
   $nm_saida->saida("               nm_submit_modal(\"" . $this->Ini->path_link . "appointment_billing/appointment_billing_export_email.php?script_case_init={$this->Ini->sc_page}&path_img={$this->Ini->path_img_global}&path_btn={$this->Ini->path_botoes}&sType=\" + str_type +\"&sAdd=__E__SC_module_export=\" + SC_module_export + \"__E__nmgp_tp_xls=\" + tp_xls + \"__E__nmgp_tot_xls=\" + tot_xls + \"__E__nmgp_password=\" + password + \"&KeepThis=true&TB_iframe=true&modal=true\", bol_param);\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("       else\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           document.Fexport.nmgp_opcao.value = \"xls\";\r\n");
   $nm_saida->saida("           document.Fexport.nmgp_tp_xls.value = tp_xls;\r\n");
   $nm_saida->saida("           document.Fexport.nmgp_tot_xls.value = tot_xls;\r\n");
   $nm_saida->saida("           document.Fexport.nmgp_password.value = password;\r\n");
   $nm_saida->saida("           document.Fexport.SC_module_export.value = SC_module_export;\r\n");
   $nm_saida->saida("           document.Fexport.action = \"appointment_billing_export_ctrl.php\";\r\n");
   $nm_saida->saida("           document.Fexport.submit() ;\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("   }\r\n");
   $nm_saida->saida("   function nm_gp_csv_conf(delim_line, delim_col, delim_dados, label_csv, SC_module_export, password, ajax, str_type, bol_param)\r\n");
   $nm_saida->saida("   {\r\n");
   $nm_saida->saida("       if (\"S\" == ajax)\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           $('#TB_window').remove();\r\n");
   $nm_saida->saida("           $('body').append(\"<div id='TB_window'></div>\");\r\n");
   $nm_saida->saida("               nm_submit_modal(\"" . $this->Ini->path_link . "appointment_billing/appointment_billing_export_email.php?script_case_init={$this->Ini->sc_page}&path_img={$this->Ini->path_img_global}&path_btn={$this->Ini->path_botoes}&sType=\" + str_type +\"&sAdd=__E__nm_delim_line=\" + delim_line + \"__E__nm_delim_col=\" + delim_col + \"__E__nm_delim_dados=\" + delim_dados + \"__E__nm_label_csv=\" + label_csv + \"&KeepThis=true&TB_iframe=true&modal=true\", bol_param);\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("       else\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           document.Fexport.nmgp_opcao.value = \"csv\";\r\n");
   $nm_saida->saida("           document.Fexport.nm_delim_line.value = delim_line;\r\n");
   $nm_saida->saida("           document.Fexport.nm_delim_col.value = delim_col;\r\n");
   $nm_saida->saida("           document.Fexport.nm_delim_dados.value = delim_dados;\r\n");
   $nm_saida->saida("           document.Fexport.nm_label_csv.value = label_csv;\r\n");
   $nm_saida->saida("           document.Fexport.nmgp_password.value = password;\r\n");
   $nm_saida->saida("           document.Fexport.SC_module_export.value = SC_module_export;\r\n");
   $nm_saida->saida("           document.Fexport.action = \"appointment_billing_export_ctrl.php\";\r\n");
   $nm_saida->saida("           document.Fexport.submit() ;\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("   }\r\n");
   $nm_saida->saida("   function nm_gp_xml_conf(xml_tag, xml_label, SC_module_export, password, ajax, str_type, bol_param)\r\n");
   $nm_saida->saida("   {\r\n");
   $nm_saida->saida("       if (\"S\" == ajax)\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           $('#TB_window').remove();\r\n");
   $nm_saida->saida("           $('body').append(\"<div id='TB_window'></div>\");\r\n");
   $nm_saida->saida("               nm_submit_modal(\"" . $this->Ini->path_link . "appointment_billing/appointment_billing_export_email.php?script_case_init={$this->Ini->sc_page}&path_img={$this->Ini->path_img_global}&path_btn={$this->Ini->path_botoes}&sType=\" + str_type +\"&sAdd=__E__nm_xml_tag=\" + xml_tag + \"__E__nm_xml_label=\" + xml_label + \"&KeepThis=true&TB_iframe=true&modal=true\", bol_param);\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("       else\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           document.Fexport.nmgp_opcao.value   = \"xml\";\r\n");
   $nm_saida->saida("           document.Fexport.nm_xml_tag.value   = xml_tag;\r\n");
   $nm_saida->saida("           document.Fexport.nm_xml_label.value = xml_label;\r\n");
   $nm_saida->saida("           document.Fexport.nmgp_password.value = password;\r\n");
   $nm_saida->saida("           document.Fexport.SC_module_export.value = SC_module_export;\r\n");
   $nm_saida->saida("           document.Fexport.action = \"appointment_billing_export_ctrl.php\";\r\n");
   $nm_saida->saida("           document.Fexport.submit() ;\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("   }\r\n");
   $nm_saida->saida("   function nm_gp_json_conf(json_format, json_label, SC_module_export, password, ajax, str_type, bol_param)\r\n");
   $nm_saida->saida("   {\r\n");
   $nm_saida->saida("       if (\"S\" == ajax)\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           $('#TB_window').remove();\r\n");
   $nm_saida->saida("           $('body').append(\"<div id='TB_window'></div>\");\r\n");
   $nm_saida->saida("               nm_submit_modal(\"" . $this->Ini->path_link . "appointment_billing/appointment_billing_export_email.php?script_case_init={$this->Ini->sc_page}&path_img={$this->Ini->path_img_global}&path_btn={$this->Ini->path_botoes}&sType=\" + str_type +\"&sAdd=__E__nm_json_format=\" + json_format + \"__E__nm_json_label=\" + json_label + \"&KeepThis=true&TB_iframe=true&modal=true\", bol_param);\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("       else\r\n");
   $nm_saida->saida("       {\r\n");
   $nm_saida->saida("           document.Fexport.nmgp_opcao.value       = \"json\";\r\n");
   $nm_saida->saida("           document.Fexport.nm_json_format.value   = json_format;\r\n");
   $nm_saida->saida("           document.Fexport.nm_json_label.value    = json_label;\r\n");
   $nm_saida->saida("           document.Fexport.nmgp_password.value    = password;\r\n");
   $nm_saida->saida("           document.Fexport.SC_module_export.value = SC_module_export;\r\n");
   $nm_saida->saida("           document.Fexport.action = \"appointment_billing_export_ctrl.php\";\r\n");
   $nm_saida->saida("           document.Fexport.submit() ;\r\n");
   $nm_saida->saida("       }\r\n");
   $nm_saida->saida("   }\r\n");
   $nm_saida->saida("   function nm_gp_rtf_conf()\r\n");
   $nm_saida->saida("   {\r\n");
   $nm_saida->saida("       document.Fexport.nmgp_opcao.value   = \"rtf\";\r\n");
   $nm_saida->saida("       document.Fexport.action = \"appointment_billing_export_ctrl.php\";\r\n");
   $nm_saida->saida("       document.Fexport.submit() ;\r\n");
   $nm_saida->saida("   }\r\n");
   $nm_saida->saida("   nm_img = new Image();\r\n");
   $nm_saida->saida("   function nm_mostra_img(imagem, altura, largura)\r\n");
   $nm_saida->saida("   {\r\n");
   $nm_saida->saida("       tb_show(\"\", imagem, \"\");\r\n");
   $nm_saida->saida("   }\r\n");
   $nm_saida->saida("   function nm_mostra_doc(campo1, campo2)\r\n");
   $nm_saida->saida("   {\r\n");
   $nm_saida->saida("       NovaJanela = window.open (campo2 + \"?nmgp_parms=\" + campo1, \"ScriptCase\", \"resizable\");\r\n");
   $nm_saida->saida("   }\r\n");
   $nm_saida->saida("   function nm_escreve_window()\r\n");
   $nm_saida->saida("   {\r\n");
   if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['form_psq_ret']) && !empty($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['campo_psq_ret']) )
   {
      $nm_saida->saida("      if (document.Fpesq.nm_ret_psq.value != \"\")\r\n");
      $nm_saida->saida("      {\r\n");
      if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['sc_modal']) && $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['sc_modal'])
      {
         if (isset($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['iframe_ret_cap']))
         {
             $Iframe_cap = $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['iframe_ret_cap'];
             unset($_SESSION['sc_session'][$script_case_init]['appointment_billing']['iframe_ret_cap']);
             $nm_saida->saida("           var Obj_Form  = parent.document.getElementById('" . $Iframe_cap . "').contentWindow.document." . $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['form_psq_ret'] . "." . $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['campo_psq_ret'] . ";\r\n");
             $nm_saida->saida("           var Obj_Form1 = parent.document.getElementById('" . $Iframe_cap . "').contentWindow.document." . $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['form_psq_ret'] . "." . str_replace("_autocomp", "_", $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['campo_psq_ret']) . ";\r\n");
             $nm_saida->saida("           var Obj_Doc   = parent.document.getElementById('" . $Iframe_cap . "').contentWindow;\r\n");
             $nm_saida->saida("           if (parent.document.getElementById('" . $Iframe_cap . "').contentWindow.document.getElementById(\"id_read_on_" . $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['campo_psq_ret'] . "\"))\r\n");
             $nm_saida->saida("           {\r\n");
             $nm_saida->saida("               var Obj_Readonly = parent.document.getElementById('" . $Iframe_cap . "').contentWindow.document.getElementById(\"id_read_on_" . $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['campo_psq_ret'] . "\");\r\n");
             $nm_saida->saida("           }\r\n");
         }
         else
         {
             $nm_saida->saida("          var Obj_Form  = parent.document." . $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['form_psq_ret'] . "." . $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['campo_psq_ret'] . ";\r\n");
             $nm_saida->saida("          var Obj_Form1 = parent.document." . $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['form_psq_ret'] . "." . str_replace("_autocomp", "_", $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['campo_psq_ret']) . ";\r\n");
             $nm_saida->saida("          var Obj_Doc   = parent;\r\n");
             $nm_saida->saida("          if (parent.document.getElementById(\"id_read_on_" . $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['campo_psq_ret'] . "\"))\r\n");
             $nm_saida->saida("          {\r\n");
             $nm_saida->saida("              var Obj_Readonly = parent.document.getElementById(\"id_read_on_" . $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['campo_psq_ret'] . "\");\r\n");
             $nm_saida->saida("          }\r\n");
         }
      }
      else
      {
          $nm_saida->saida("          var Obj_Form  = opener.document." . $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['form_psq_ret'] . "." . $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['campo_psq_ret'] . ";\r\n");
          $nm_saida->saida("          var Obj_Form1 = opener.document." . $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['form_psq_ret'] . "." . str_replace("_autocomp", "_", $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['campo_psq_ret']) . ";\r\n");
          $nm_saida->saida("          var Obj_Doc   = opener;\r\n");
          $nm_saida->saida("          if (opener.document.getElementById(\"id_read_on_" . $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['campo_psq_ret'] . "\"))\r\n");
          $nm_saida->saida("          {\r\n");
          $nm_saida->saida("              var Obj_Readonly = opener.document.getElementById(\"id_read_on_" . $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['campo_psq_ret'] . "\");\r\n");
          $nm_saida->saida("          }\r\n");
      }
          $nm_saida->saida("          else\r\n");
          $nm_saida->saida("          {\r\n");
          $nm_saida->saida("              var Obj_Readonly = null;\r\n");
          $nm_saida->saida("          }\r\n");
      $nm_saida->saida("          if (Obj_Form.value != document.Fpesq.nm_ret_psq.value)\r\n");
      $nm_saida->saida("          {\r\n");
      $nm_saida->saida("              Obj_Form.value = document.Fpesq.nm_ret_psq.value;\r\n");
      $nm_saida->saida("              if (Obj_Form != Obj_Form1 && Obj_Form1)\r\n");
      $nm_saida->saida("              {\r\n");
      $nm_saida->saida("                  Obj_Form1.value = document.Fpesq.nm_ret_psq.value;\r\n");
      $nm_saida->saida("              }\r\n");
      $nm_saida->saida("              if (null != Obj_Readonly)\r\n");
      $nm_saida->saida("              {\r\n");
      $nm_saida->saida("                  Obj_Readonly.innerHTML = document.Fpesq.nm_ret_psq.value;\r\n");
      $nm_saida->saida("              }\r\n");
     if (!empty($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['js_apos_busca']))
     {
      $nm_saida->saida("              if (Obj_Doc." . $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['js_apos_busca'] . ")\r\n");
      $nm_saida->saida("              {\r\n");
      $nm_saida->saida("                  Obj_Doc." . $_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['js_apos_busca'] . "();\r\n");
      $nm_saida->saida("              }\r\n");
      $nm_saida->saida("              else if (Obj_Form.onchange && Obj_Form.onchange != '')\r\n");
      $nm_saida->saida("              {\r\n");
      $nm_saida->saida("                  Obj_Form.onchange();\r\n");
      $nm_saida->saida("              }\r\n");
     }
     else
     {
      $nm_saida->saida("              if (Obj_Form.onchange && Obj_Form.onchange != '')\r\n");
      $nm_saida->saida("              {\r\n");
      $nm_saida->saida("                  Obj_Form.onchange();\r\n");
      $nm_saida->saida("              }\r\n");
     }
      $nm_saida->saida("          }\r\n");
      $nm_saida->saida("      }\r\n");
   }
   $nm_saida->saida("      document.F5.action = \"appointment_billing_fim.php\";\r\n");
   $nm_saida->saida("      document.F5.submit();\r\n");
   $nm_saida->saida("   }\r\n");
   $nm_saida->saida("   function nm_open_popup(parms)\r\n");
   $nm_saida->saida("   {\r\n");
   $nm_saida->saida("       NovaJanela = window.open (parms, '', 'resizable, scrollbars');\r\n");
   $nm_saida->saida("   }\r\n");
   if (($this->grid_emb_form || $this->grid_emb_form_full) && isset($_SESSION['sc_session'][$this->Ini->sc_page]['appointment_billing']['reg_start']))
   {
       $nm_saida->saida("      $(document).ready(function(){\r\n");
       $nm_saida->saida("         setTimeout(\"parent.scAjaxDetailStatus('appointment_billing')\",50);\r\n");
       $nm_saida->saida("         setTimeout(\"parent.scAjaxDetailHeight('appointment_billing', $(document).innerHeight())\",50);\r\n");
       $nm_saida->saida("      })\r\n");
   }
   $nm_saida->saida("   </script>\r\n");
 }
}
?>
