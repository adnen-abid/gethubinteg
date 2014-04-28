<form name="frmname" action="https://www.paypal.com/cgi-bin/webscr"  method="post">
<input type="hidden" name="rm" value="2"/>
<input type="hidden" name="cmd" value="_xclick"/>


  <input type="hidden" value="helmertravel@gmail.com" name="business" />

  <input type="hidden" value="<?php echo WEB_URL; ?>home/paypal_response" name="return" />
  
  <input type="hidden" value="" name="cancel_return" />
  <input type="hidden" value="" name="notify_url" />
  <input type="hidden" value="Egyptian Spirit" name="item_name" />
                    
  <input type="hidden" value="1" name="amount" />
  <input type="hidden" value="USD" name="currency_code" />
<div class="loading_part">
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tableborder">
      <tr>
            <td width="616" height="84" align="center" valign="top" style="background:#22717b; margin-top:15px; -moz-border-radius: 11px;
 -webkit-border-radius: 11px; border-radius: 11px; behavior: url(border-radius.htc);">
    <div class="logo" style="height:84px;"><input type="submit" ></div></td>
      </tr>
      <tr>
        <td height="30" align="center" valign="baseline" class="underline">&nbsp;</td>
      </tr>
      <tr>
        <td height="30" align="center" valign="baseline" class="text" style="color:#09F;">Please do not refresh the screen or press backspace key , as we are currently connecting to payment gateway</td>
      </tr>
      <tr>
        <td align="center" valign="middle">
        <img src="<?php echo WEB_DIR ?>images/27.gif" width="128px"/>
        </td>
        
      </tr>
      <tr><td>&nbsp;</td></tr>
           <tr>
        <td height="30" align="center" valign="baseline">&nbsp;</td>
      </tr>
    </table>
   
  </div></form>