<html>
  <head>
    <title>dcWordTree</title>
    <?php echo dcPage::jsPageTabs($default_tab);?>
  </head>
  <body>
    <h2><?php echo html::escapeHTML($core->blog->name);?> &gt; dcWordTree</h2>
    <?php if (!empty($message)):?>
    <p class="message"><?php echo $message;?></p>
    <?php endif;?>

    <form action="<?php echo $p_url;?>" method="post" enctype="multipart/form-data">
    <?php if ($dcwordtree_active || $is_super_admin):?>
    <div class="multi-part" id="settings" title="<?php echo __('Settings');?>">
      <h3 class="hidden-if-js"><?php echo __('Settings');?></h3>
      <?php if ($is_super_admin):?>
      <div class="fieldset">
	<h3><?php echo __('Plugin activation');?></h3>
	<p>
	  <label class="classic" for="dcwordtree_active">
	    <?php echo form::checkbox('dcwordtree_active', 1, $dcwordtree_active);?>
	    <?php echo __('Enable dcWordTree plugin');?>
	  </label>
	</p>
      </div>
      <?php endif;?>

      <p>
	<input type="submit" name="saveconfig" value="<?php echo __('Save configuration');?>" />
      </p>
    </div>

    <?php if ($dcwordtree_active):?>
    <div class="multi-part" id="configuration" title="<?php echo __('Configuration');?>">
      <h3 class="hidden-if-js"><?php echo __('Configuration');?></h3>
    </div>
    <?php endif;?>

    <input type="hidden" name="p" value="dcWordTree"/>
    <?php echo $core->formNonce();?>
    </form>
    <?php endif;?>
    <?php dcPage::helpBlock('dcWordTree');?>
  </body>
</html>
