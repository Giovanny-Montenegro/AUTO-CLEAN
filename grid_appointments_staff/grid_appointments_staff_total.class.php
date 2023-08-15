<?php

class grid_appointments_staff_total
{
   var $Db;
   var $Erro;
   var $Ini;
   var $Lookup;

   var $nm_data;

   //----- 
   function __construct($sc_page)
   {
      $this->sc_page = $sc_page;
      $this->nm_data = new nm_data("en_us");
      if (isset($_SESSION['sc_session'][$this->sc_page]['grid_appointments_staff']['campos_busca']) && !empty($_SESSION['sc_session'][$this->sc_page]['grid_appointments_staff']['campos_busca']))
      { 
          $Busca_temp = $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_staff']['campos_busca'];
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
          $appointments_id_2 = (isset($Busca_temp['appointments_id_input_2'])) ? $Busca_temp['appointments_id_input_2'] : ""; 
          $this->appointments_id_2 = $appointments_id_2; 
          $this->staff_id = (isset($Busca_temp['staff_id'])) ? $Busca_temp['staff_id'] : ""; 
          $tmp_pos = (is_string($this->staff_id)) ? strpos($this->staff_id, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->staff_id))
          {
              $this->staff_id = substr($this->staff_id, 0, $tmp_pos);
          }
          $staff_id_2 = (isset($Busca_temp['staff_id_input_2'])) ? $Busca_temp['staff_id_input_2'] : ""; 
          $this->staff_id_2 = $staff_id_2; 
          $this->customers_id = (isset($Busca_temp['customers_id'])) ? $Busca_temp['customers_id'] : ""; 
          $tmp_pos = (is_string($this->customers_id)) ? strpos($this->customers_id, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->customers_id))
          {
              $this->customers_id = substr($this->customers_id, 0, $tmp_pos);
          }
          $customers_id_2 = (isset($Busca_temp['customers_id_input_2'])) ? $Busca_temp['customers_id_input_2'] : ""; 
          $this->customers_id_2 = $customers_id_2; 
          $this->price = (isset($Busca_temp['price'])) ? $Busca_temp['price'] : ""; 
          $tmp_pos = (is_string($this->price)) ? strpos($this->price, "##@@") : false;
          if ($tmp_pos !== false && !is_array($this->price))
          {
              $this->price = substr($this->price, 0, $tmp_pos);
          }
          $price_2 = (isset($Busca_temp['price_input_2'])) ? $Busca_temp['price_input_2'] : ""; 
          $this->price_2 = $price_2; 
      } 
   }

   //---- 
   function quebra_geral_sc_free_group_by($res_limit=false, $res_export=false)
   {
      global $nada, $nm_lang , $customers_id, $current_status_id;
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_staff']['contr_total_geral'] == "OK") 
      { 
          return; 
      } 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_staff']['tot_geral'] = array() ;  
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
      { 
          $nm_comando = "select count(*) from " . $this->Ini->nm_tabela . " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_staff']['where_pesq']; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      { 
          $nm_comando = "select count(*) from " . $this->Ini->nm_tabela . " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_staff']['where_pesq']; 
      } 
      else 
      { 
          $nm_comando = "select count(*) from " . $this->Ini->nm_tabela . " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_staff']['where_pesq']; 
      } 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
      if (!$rt = $this->Db->Execute($nm_comando)) 
      { 
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit ; 
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_staff']['tot_geral'][0] = "" . $this->Ini->Nm_lang['lang_msgs_totl'] . ""; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_staff']['tot_geral'][1] = $rt->fields[0] ; 
      $rt->Close(); 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_staff']['contr_total_geral'] = "OK";
   } 

   //---- 
   function quebra_geral_status($res_limit=false, $res_export=false)
   {
      global $nada, $nm_lang , $customers_id, $current_status_id;
      if ($_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_staff']['contr_total_geral'] == "OK") 
      { 
          return; 
      } 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_staff']['tot_geral'] = array() ;  
      if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
      { 
          $nm_comando = "select count(*) from " . $this->Ini->nm_tabela . " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_staff']['where_pesq']; 
      } 
      elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
      { 
          $nm_comando = "select count(*) from " . $this->Ini->nm_tabela . " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_staff']['where_pesq']; 
      } 
      else 
      { 
          $nm_comando = "select count(*) from " . $this->Ini->nm_tabela . " " . $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_staff']['where_pesq']; 
      } 
      $_SESSION['scriptcase']['sc_sql_ult_comando'] = $nm_comando;
      $_SESSION['scriptcase']['sc_sql_ult_conexao'] = '';
      if (!$rt = $this->Db->Execute($nm_comando)) 
      { 
         $this->Erro->mensagem (__FILE__, __LINE__, "banco", $this->Ini->Nm_lang['lang_errm_dber'], $this->Db->ErrorMsg()); 
         exit ; 
      }
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_staff']['tot_geral'][0] = "" . $this->Ini->Nm_lang['lang_msgs_totl'] . ""; 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_staff']['tot_geral'][1] = $rt->fields[0] ; 
      $rt->Close(); 
      $_SESSION['sc_session'][$this->Ini->sc_page]['grid_appointments_staff']['contr_total_geral'] = "OK";
   } 

   //-----  current_status_id
   function quebra_current_status_id_sc_free_group_by($current_status_id, $Where_qb, $Cmp_Name) 
   {
      $Var_name_gb = "SC_tot_" . $Cmp_Name;
      global $$Var_name_gb, $customers_id, $current_status_id;
      $tot_current_status_id = array() ;  
      $tot_current_status_id[0] = $current_status_id ; 
   }
   //-----  customers_id
   function quebra_customers_id_sc_free_group_by($customers_id, $Where_qb, $Cmp_Name) 
   {
      $Var_name_gb = "SC_tot_" . $Cmp_Name;
      global $$Var_name_gb, $customers_id, $current_status_id;
      $tot_customers_id = array() ;  
      $tot_customers_id[0] = $customers_id ; 
   }
   //-----  appointment_start_date
   function quebra_appointment_start_date_sc_free_group_by($appointment_start_date, $Where_qb, $Cmp_Name) 
   {
      $Var_name_gb = "SC_tot_" . $Cmp_Name;
      global $$Var_name_gb, $customers_id, $current_status_id;
      $tot_appointment_start_date = array() ;  
      $tot_appointment_start_date[0] = $appointment_start_date ; 
   }
   //-----  current_status_id
   function quebra_current_status_id_status($current_status_id, $arg_sum_current_status_id) 
   {
      global $tot_current_status_id, $customers_id, $current_status_id;
      $tot_current_status_id = array() ;  
      $tot_current_status_id[0] = $current_status_id ; 
   }
   function Ajust_statistic($comando)
   {
      if ((isset($this->Ini->nm_bases_vfp) && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_vfp)) || (isset($this->Ini->nm_bases_odbc) && in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_odbc)))
      {
          $comando = str_replace(array('count(distinct ','varp(','stdevp(','variance(','stddev('), array('sum(','sum(','sum(','sum(','sum('), $comando);
      }
      if ($this->Ini->nm_tp_variance == "P")
      {
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
          { 
              $comando = str_replace(array('count(distinct ','varp(','stdevp('), array('count(','var(','stdev('), $comando);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sqlite) && $this->Ini->sqlite_version == "old")
          {
              $comando = str_replace(array('variance(','stddev('), array('sum(','sum('), $comando);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase) && $this->Ini->Ibase_version == "old")
          {
              $comando = str_replace(array('variance(','stddev('), array('sum(','sum('), $comando);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
          {
              $comando = str_replace(array('variance(','stddev('), array('var_pop(','stddev_pop('), $comando);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
          {
                  $comando = str_replace(array('variance(','stddev('), array('var_pop(','stddev_pop('), $comando);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
          {
              $comando = str_replace(array('variance(','stddev('), array('sum(','sum('), $comando);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
          {
              $comando = str_replace(array('variance(','stddev('), array('var_pop(','stddev_pop('), $comando);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
          {
              $comando = str_replace(array('variance(','stddev('), array('var_pop(','stddev_pop('), $comando);
          }
      }
      if ($this->Ini->nm_tp_variance == "A")
      {
          if (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_access))
          { 
              $comando = str_replace(array('count(distinct ','varp(','stdevp('), array('count(','var(','stdev('), $comando);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sqlite) && $this->Ini->sqlite_version == "old")
          {
              $comando = str_replace(array('variance(','stddev('), array('sum(','sum('), $comando);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mysql))
          {
              $comando = str_replace(array('variance(','stddev('), array('var_samp(','stddev_samp('), $comando);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_postgres))
          {
              $comando = str_replace(array('variance(','stddev('), array('var_samp(','stddev_samp('), $comando);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase) && $this->Ini->Ibase_version == "old")
          {
              $comando = str_replace(array('variance(','stddev('), array('sum(','sum('), $comando);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_ibase))
          {
                  $comando = str_replace(array('variance(','stddev('), array('var_samp(','stddev_samp('), $comando);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_oracle))
          {
              $comando = str_replace(array('variance(','stddev('), array('var_samp(','stddev_samp('), $comando);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_mssql))
          { 
              $comando = str_replace(array('varp(','stdevp('), array('var(','stdev('), $comando);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_informix))
          {
              $comando = str_replace('stddev(', 'stdev(', $comando);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_db2))
          {
              $comando = str_replace(array('variance(','stddev('), array('variance_samp(','stddev_samp('), $comando);
          }
          elseif (in_array(strtolower($this->Ini->nm_tpbanco), $this->Ini->nm_bases_sybase))
          {
              $comando = str_replace(array('variance(','stddev('), array('var_samp(','stddev_samp('), $comando);
          }
      }
      return $comando;
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
