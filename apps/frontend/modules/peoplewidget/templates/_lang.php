<?php slot('widget_title',__('Language'));  ?>
<table class="catalogue_table">
  <thead>
    <tr>
      <th><?php echo __('Language');?></th>
      <th><?php echo __('Is Mother Language');?></th>
    </tr>
  </thead>
  <tbody>
  <?php foreach($langs as $lang):?>
  <tr>
    <td>
      <a class="link_catalogue" title="<?php echo __('Edit Languages');?>"  href="<?php echo url_for('people/lang?ref_id='.$eid.'&id='.$lang->getId());?>">
	      <?php echo format_language($lang->getLanguageCountry());?>
      </a>
      <?php if($lang->getPreferedLanguage()):?>
	(<?php echo __('Prefered');?>)
      <?php endif;?>
    </td>
    <td>
       <?php if($lang->getMother()):?>
	<?php echo __('Yes');?>
       <?php endif;?>
    </td>
    <td class="widget_row_delete">
      <a class="widget_row_delete" href="<?php echo url_for('people/deleteLang?id='.$lang->getId());?>" title="<?php echo __('Are you sure ?') ?>"><?php echo image_tag('remove.png'); ?>
      </a>
    </td>
  </tr>
  <?php endforeach;?>
  </tbody>
</table>

<br />
<?php echo image_tag('add_green.png');?>
<a title="<?php echo __('Add Language');?>" class="link_catalogue" href="<?php echo url_for('people/lang?ref_id='.$eid);?>"> 
  <?php echo __('Add');?>
</a>