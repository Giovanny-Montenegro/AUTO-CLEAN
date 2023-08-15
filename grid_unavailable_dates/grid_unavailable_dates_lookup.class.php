<?php
class grid_unavailable_dates_lookup
{
//  
   function lookup_yearly(&$yearly) 
   {
      $conteudo = "" ; 
      if ($yearly == "Y")
      { 
          $conteudo = "" . $this->Ini->Nm_lang['lang_opt_yes'] . "";
      } 
      if ($yearly == "N")
      { 
          $conteudo = "" . $this->Ini->Nm_lang['lang_opt_no'] . "";
      } 
      if (!empty($conteudo)) 
      { 
          $yearly = $conteudo; 
      } 
   }  
}
?>
