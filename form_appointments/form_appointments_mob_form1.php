<div id="form_appointments_mob_form1" style='<?php echo ($this->tabCssClass["form_appointments_mob_form1"]['class'] == 'scTabInactive' ? 'display: none; width: 1px; height: 0px; overflow: scroll' : ''); ?>'>
<?php $sc_hidden_no = 1; $sc_hidden_yes = 0; ?>
   <a name="bloco_0"></a>
   <table width="100%" height="100%" cellpadding="0" cellspacing=0><tr valign="top"><td width="100%" height="">
<div id="div_hidden_bloco_3"><!-- bloco_c -->
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
<TABLE align="center" id="hidden_bloco_3" class="scFormTable<?php echo $this->classes_100perc_fields['table'] ?>" width="100%" style="height: 100%;"><?php if ($sc_hidden_no > 0) { echo "<tr>"; }; 
      $sc_hidden_yes = 0; $sc_hidden_no = 0; ?>


   <?php
    if (!isset($this->nm_new_label['details']))
    {
        $this->nm_new_label['details'] = "details";
    }
?>
<?php
   $nm_cor_fun_cel  = (isset($nm_cor_fun_cel) && $nm_cor_fun_cel  == $this->Ini->cor_grid_impar ? $this->Ini->cor_grid_par : $this->Ini->cor_grid_impar);
   $nm_img_fun_cel  = (isset($nm_img_fun_cel) && $nm_img_fun_cel  == $this->Ini->img_fun_imp    ? $this->Ini->img_fun_par  : $this->Ini->img_fun_imp);
   $details = $this->details;
   $sStyleHidden_details = '';
   if (isset($this->nmgp_cmp_hidden['details']) && $this->nmgp_cmp_hidden['details'] == 'off')
   {
       unset($this->nmgp_cmp_hidden['details']);
       $sStyleHidden_details = 'display: none;';
   }
   $bTestReadOnly = true;
   $sStyleReadLab_details = 'display: none;';
   $sStyleReadInp_details = '';
   if (/*$this->nmgp_opcao != "novo" && */isset($this->nmgp_cmp_readonly['details']) && $this->nmgp_cmp_readonly['details'] == 'on')
   {
       $bTestReadOnly = false;
       unset($this->nmgp_cmp_readonly['details']);
       $sStyleReadLab_details = '';
       $sStyleReadInp_details = 'display: none;';
   }
?>
<?php if (isset($this->nmgp_cmp_hidden['details']) && $this->nmgp_cmp_hidden['details'] == 'off') { $sc_hidden_yes++;  ?>
<input type="hidden" name="details" value="<?php echo $this->form_encode_input($details) . "\">"; ?>
<?php } else { $sc_hidden_no++; ?>

    <TD class="scFormDataOdd css_details_line" id="hidden_field_data_details" style="<?php echo $sStyleHidden_details; ?>vertical-align: top;"> <table style="border-width: 0px; border-collapse: collapse; width: 100%"><tr><td width="100%" class="scFormDataFontOdd css_details_line" style="vertical-align: top;padding: 0px">
<?php
 if (isset($_SESSION['scriptcase']['dashboard_scinit'][ $_SESSION['sc_session'][$this->Ini->sc_page]['form_appointments_mob']['dashboard_info']['dashboard_app'] ][ $this->Ini->sc_lig_target['C_@scinf_details'] ]) && '' != $_SESSION['scriptcase']['dashboard_scinit'][ $_SESSION['sc_session'][$this->Ini->sc_page]['form_appointments_mob']['dashboard_info']['dashboard_app'] ][ $this->Ini->sc_lig_target['C_@scinf_details'] ]) {
     $_SESSION['sc_session'][$this->Ini->sc_page]['form_appointments_mob']['form_appointment_details_mob_script_case_init'] = $_SESSION['scriptcase']['dashboard_scinit'][ $_SESSION['sc_session'][$this->Ini->sc_page]['form_appointments_mob']['dashboard_info']['dashboard_app'] ][ $this->Ini->sc_lig_target['C_@scinf_details'] ];
 }
 else {
     $_SESSION['sc_session'][$this->Ini->sc_page]['form_appointments_mob']['form_appointment_details_mob_script_case_init'] = $this->Ini->sc_page;
 }
 $_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['form_appointments_mob']['form_appointment_details_mob_script_case_init'] ]['form_appointment_details_mob']['embutida_proc']  = false;
 $_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['form_appointments_mob']['form_appointment_details_mob_script_case_init'] ]['form_appointment_details_mob']['embutida_form']  = true;
 $_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['form_appointments_mob']['form_appointment_details_mob_script_case_init'] ]['form_appointment_details_mob']['embutida_call']  = true;
 $_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['form_appointments_mob']['form_appointment_details_mob_script_case_init'] ]['form_appointment_details_mob']['embutida_multi'] = false;
 $_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['form_appointments_mob']['form_appointment_details_mob_script_case_init'] ]['form_appointment_details_mob']['embutida_liga_form_insert'] = 'on';
 $_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['form_appointments_mob']['form_appointment_details_mob_script_case_init'] ]['form_appointment_details_mob']['embutida_liga_form_update'] = 'on';
 $_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['form_appointments_mob']['form_appointment_details_mob_script_case_init'] ]['form_appointment_details_mob']['embutida_liga_form_delete'] = 'on';
 $_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['form_appointments_mob']['form_appointment_details_mob_script_case_init'] ]['form_appointment_details_mob']['embutida_liga_form_btn_nav'] = 'off';
 $_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['form_appointments_mob']['form_appointment_details_mob_script_case_init'] ]['form_appointment_details_mob']['embutida_liga_grid_edit'] = 'on';
 $_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['form_appointments_mob']['form_appointment_details_mob_script_case_init'] ]['form_appointment_details_mob']['embutida_liga_grid_edit_link'] = 'on';
 $_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['form_appointments_mob']['form_appointment_details_mob_script_case_init'] ]['form_appointment_details_mob']['embutida_liga_qtd_reg'] = '5';
 $_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['form_appointments_mob']['form_appointment_details_mob_script_case_init'] ]['form_appointment_details_mob']['embutida_liga_tp_pag'] = 'total';
 $_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['form_appointments_mob']['form_appointment_details_mob_script_case_init'] ]['form_appointment_details_mob']['embutida_parms'] = "NM_btn_insert*scinS*scoutNM_btn_update*scinS*scoutNM_btn_delete*scinS*scoutNM_btn_navega*scinN*scout";
 $_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['form_appointments_mob']['form_appointment_details_mob_script_case_init'] ]['form_appointment_details_mob']['foreign_key']['appointments_id'] = $this->nmgp_dados_form['appointments_id'];
 $_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['form_appointments_mob']['form_appointment_details_mob_script_case_init'] ]['form_appointment_details_mob']['where_filter'] = "appointments_id = " . $this->nmgp_dados_form['appointments_id'] . "";
 $_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['form_appointments_mob']['form_appointment_details_mob_script_case_init'] ]['form_appointment_details_mob']['where_detal']  = "appointments_id = " . $this->nmgp_dados_form['appointments_id'] . "";
 if ($_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['form_appointments_mob']['form_appointment_details_mob_script_case_init'] ]['form_appointments_mob']['total'] < 0)
 {
     $_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['form_appointments_mob']['form_appointment_details_mob_script_case_init'] ]['form_appointment_details_mob']['where_filter'] = "1 <> 1";
 }
 $sDetailSrc = ('novo' == $this->nmgp_opcao) ? 'form_appointments_mob_empty.htm' : $this->Ini->link_form_appointment_details_mob_edit . '?script_case_init=' . $this->form_encode_input($this->Ini->sc_page) . '&script_case_detail=Y';
 foreach ($_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['form_appointments_mob']['form_appointment_details_mob_script_case_init'] ]['form_appointment_details_mob'] as $i => $v)
 {
     $_SESSION['sc_session'][ $_SESSION['sc_session'][$this->Ini->sc_page]['form_appointments_mob']['form_appointment_details_mob_script_case_init'] ]['form_appointment_details'][$i] = $v;
 }
if (isset($this->Ini->sc_lig_target['C_@scinf_details']) && 'nmsc_iframe_liga_form_appointment_details_mob' != $this->Ini->sc_lig_target['C_@scinf_details'])
{
    if ('novo' != $this->nmgp_opcao)
    {
        $sDetailSrc .= '&under_dashboard=1&dashboard_app=' . $_SESSION['sc_session'][$this->Ini->sc_page]['form_appointments_mob']['dashboard_info']['dashboard_app'] . '&own_widget=' . $this->Ini->sc_lig_target['C_@scinf_details'] . '&parent_widget=' . $_SESSION['sc_session'][$this->Ini->sc_page]['form_appointments_mob']['dashboard_info']['own_widget'];
        $sDetailSrc  = $this->addUrlParam($sDetailSrc, 'script_case_init', $_SESSION['sc_session'][$this->Ini->sc_page]['form_appointments_mob']['form_appointment_details_mob_script_case_init']);
    }
?>
<script type="text/javascript">
$(function() {
    scOpenMasterDetail("<?php echo $this->Ini->sc_lig_target['C_@scinf_details'] ?>", "<?php echo $sDetailSrc; ?>");
});
</script>
<?php
}
else
{
?>
<iframe border="0" id="nmsc_iframe_liga_form_appointment_details_mob"  marginWidth="0" marginHeight="0" frameborder="0" valign="top" height="100" width="450px" name="nmsc_iframe_liga_form_appointment_details_mob"  scrolling="auto" src="<?php echo $sDetailSrc; ?>"></iframe>
<?php
}
?>
</td></tr><tr><td style="vertical-align: top; padding: 0"><table class="scFormFieldErrorTable" style="display: none" id="id_error_display_details_frame"><tr><td class="scFormFieldErrorMessage"><span id="id_error_display_details_text"></span></td></tr></table></td></tr></table> </TD>
   <?php }?>





<?php if ($sc_hidden_yes > 0 && $sc_hidden_no > 0) { ?>


    <TD class="scFormDataOdd" colspan="<?php echo $sc_hidden_yes * 1; ?>" >&nbsp;</TD>




<?php } 
?> 






   </tr>
</TABLE></div><!-- bloco_f -->
   </td></tr></table>
   </div>
