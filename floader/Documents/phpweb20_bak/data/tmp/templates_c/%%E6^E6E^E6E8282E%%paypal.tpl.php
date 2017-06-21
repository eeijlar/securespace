<?php /* Smarty version 2.6.18, created on 2008-10-19 22:08:28
         compiled from paypal.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'paypal.tpl', 8, false),)), $this); ?>
 <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" name="selectionForm"> 
		<div class="from_message">
			<p>You need to buy credits before you can send messages to your therapist. Click on the Pay Pal link below to buy a session.
			</p>	
		</div>
		<div id="sessionSpacer"></div>
		<div id="sessions">
			<input type="radio" name="group1" value="1" onclick="this.form.total.value=calculateTotal(this,<?php echo ((is_array($_tmp=$this->_tpl_vars['session'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
)" checked> One Session<br>
			<div id="sessionSpacer"></div>
			<input type="radio" name="group1" value="2" onclick="this.form.total.value=calculateTotal(this,<?php echo ((is_array($_tmp=$this->_tpl_vars['session'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
)"> Two Sessions<br>
			<div id="sessionSpacer"></div>
			<input type="radio" name="group1" value="3" onclick="this.form.total.value=calculateTotal(this,<?php echo ((is_array($_tmp=$this->_tpl_vars['session'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
)"> Three Sessions<br>
			<div id="sessionSpacer"></div>
			<input type="radio" name="group1" value="4" onclick="this.form.total.value=calculateTotal(this,<?php echo ((is_array($_tmp=$this->_tpl_vars['session'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
)"> Four Sessions<br>
			<div id="sessionSpacer"></div>
			<div id="sessionSpacer"></div>
			<div id="sessionSpacer"></div>	
			<b><label id="total" style="float:left">Total</label></b>
			<input name="total" class="from_message" value="&#8364;<?php echo ((is_array($_tmp=$this->_tpl_vars['session'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
">
		</div>	
			<div id="buynowspacer"></div>
			<div id="buynow">
			<input type="hidden" name="cmd" value="_xclick">
			<input type="hidden" name="item_name" value="Counselling Session">
			<input type="hidden" name="business" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['business'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
">
			<input type="hidden" name="amount" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['session'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
">
			<input type="hidden" name="quantity" value="1">
			<input type="hidden" name="no_shipping" value="2">
			<input type="hidden" name="no_note" value="1">
			<input type="hidden" name="currency_code" value="EUR">
			<input type="hidden" name="bn" value="PP-BuyNowBF">
			<input type="hidden" name="return" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['returnurl'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
/payment/return">   
			<input type="hidden" name="cancel" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['returnurl'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
/payment/paymentcancelled"> 						
			<input type="image" src="https://www.sandbox.paypal.com/en_GB/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
			<img alt="Buy Now - Pay Pal" border="0" src="https://www.sandbox.paypal.com/en_GB/i/scr/pixel.gif" width="1" height="1">
			</div>
</form> 