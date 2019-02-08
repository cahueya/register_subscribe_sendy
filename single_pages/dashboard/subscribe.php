<?php 


defined('C5_EXECUTE') or die("Access Denied.");
$form = $ih = Core::make('helper/form');
$ci = Loader::helper('concrete/ui');
?>



<div class="container">



<form method="post" action="<?= $view->action('update_configuration')?>">
    <fieldset><legend><?php echo t('Subscription Data'); ?></legend>
        
    <div class="col-xs-12 col-md-6">        
        <div class="form-group">
            <label for="API_KEY"><?php echo t('Your API Key'); ?></label>
            <?php echo $form->text('API_KEY', $API_KEY, array('class' => 'span2', 'placeholder'=>t('API KEY')))?>
        </div>
    </div>        
    <div class="col-xs-12 col-md-6">    
        <div class="form-group">
            <label for="INSTALL_URL"><?php echo t('The URL of your Sendy Installation'); ?></label>
            <?php echo $form->text('INSTALL_URL', $INSTALL_URL, array('class' => 'span2', 'placeholder'=>t('Install URL')))?>
        </div>
    </div>        
    <div class="col-xs-12 col-md-6">    
        <div class="form-group">
            <label for="LIST_ID"><?php echo t('The List to which you want to subscribe'); ?></label>
            <?php echo $form->text('LIST_ID', $LIST_ID, array('class' => 'span2', 'placeholder'=>t('List ID')))?>
        </div>
    </div>
      

    </fieldset>


</div>


    <div class="ccm-dashboard-form-actions-wrapper">
        <div class="ccm-dashboard-form-actions">
            <button class="pull-right btn btn-success" type="submit" ><?php echo t('Save')?></button>
        </div>
    </div>
</form>