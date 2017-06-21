<?php /* Smarty version 2.6.18, created on 2009-10-05 23:44:59
         compiled from email/housekeeping.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'email/housekeeping.tpl', 15, false),)), $this); ?>
<?php echo $this->_tpl_vars['user']->profile->first_name; ?>
, Thank You For Your Registration
<p>Dear <?php echo $this->_tpl_vars['user']->profile->first_name; ?>
,</p><br />

<p>Thank you for applying for counselling. The next step now is that your counsellor will be alerted by e-mail to your submission and he/she will read and reply to your submission letting you know whether he/she is able to work with you on the issues that you are presenting. This should take 24 hours.</p><br />

<p>Also let me tell you a little about how online counselling works. As I have already mentioned within 24 hours the counsellor will reply to you. To do this the counsellor will take time out to read fully and reply comprehensively to your concerns.</p><br />

<p>On receipt of the counsellors reply take time before you write back, if you wish to do so. Reflect on the content of the reply and respond when you are ready to. There are benefits to doing it this way. The same is true for any misunderstandings that might arise in any of the text communication, at all times e-mail back for clarity, if required.</p><br />

<p>Note: The counsellor will reply to your initial submission, but to continue with the counselling you will be required to pay for the sessions,you will be able to do this when you log into your account and select the 'Write Message' option.</p><br />


<p>Yours sincerely,</p><br />

<p><?php echo ((is_array($_tmp=$this->_tpl_vars['website'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
 Administration</p>