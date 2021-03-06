<table class="catalogue_table">
  <thead>
    <tr>
      <th><?php echo __('Link');?></th>
      <th><?php echo __('Comment');?></th>
      <th></th>
    </tr>
  </thead>
  <tbody>
  <?php foreach($links as $link):?>
  <tr>
    <td>  
      <?php echo link_to($link->getUrl(),'extlinks/extLinks?table='.$table.'&cid='.$link->getId().'&id='.$eid,array('class' => 'link_catalogue','title' => __('Edit Url') )) ; ?>  
      <a href="<?php echo $link->getUrl();?>" target="_pop" class='complete_widget'>
      <?php echo image_tag('next.png',array('title'=>__('Go to this link'))) ; ?>
      </a>          
    </td>
    <td>
      <?php echo $link->getComment();?>
    </td>
    <td class="widget_row_delete">   
      <a class="widget_row_delete" href="<?php echo url_for('catalogue/deleteRelated?table=ext_links&id='.$link->getId());?>" title="<?php echo __('Delete Link') ?>"><?php echo image_tag('remove.png'); ?>
      </a>
    </td>
  </tr>
  <?php endforeach;?>
  </tbody>
</table>

<br />
<?php echo image_tag('add_green.png');?><a title="<?php echo __('Add Link');?>" class="link_catalogue" href="<?php echo url_for('extlinks/extLinks?table='.$table.'&id='.$eid);?>"><?php echo __('Add');?></a>
