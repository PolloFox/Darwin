<?php slot('title', __('Search sampling location'));  ?>        
<div class="page">
  <h1><?php echo __('Sampling location search');?></h1>
  <?php include_partial('searchForm', array('form' => $form, 'is_choose' => false)) ?>
</div>
