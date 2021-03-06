<h3>Individuals</h3>
      <table class="results">
        <thead>
          <tr>
            <th></th>
            <th><?php echo __('Type');?></th>
            <th><?php echo __('Sex');?></th>
            <th><?php echo __('State');?></th>
            <th><?php echo __('Stage');?></th>
            <th><?php echo __('Social status');?></th> 
            <th><?php echo __('Rock form');?></th>
            <th></th>
          </tr>
        </thead>
        <?php foreach($items as $key=>$item):?>
          <tbody>
            <tr class="indiv_<?php echo $item->getId(); ?>">
              <td rowspan="2">
                <?php if ($item->getWithParts()): ?>
                  <?php echo image_tag('blue_expand.png', array('alt' => '+', 'class'=> 'tree_cmd_td collapsed')); ?>
                  <?php echo image_tag('blue_expand_up.png', array('alt' => '-', 'class'=> 'tree_cmd_td expanded')); ?>
                <?php else:?>
                  <?php echo image_tag('grey_expand.png', array('alt' => '+', 'class'=> 'collapsed')); ?>
                <?php endif ?>
              </td>
              <td>
                <?php if ($item->getType() == "not applicable") : ?>
                -
                <?php else : ?>
                  <?php echo $item->getType() ; ?>
                 <?php endif ; ?>
              </td>
              <td>
                <?php if ($item->getSex() == "not applicable") : ?>
                -
                <?php else : ?>
                  <?php echo $item->getSex() ; ?>
                 <?php endif ; ?>
              </td>
              <td>
                <?php if ($item->getState() == "not applicable") : ?>
                -
                <?php else : ?>
                  <?php echo $item->getState() ; ?>
                 <?php endif ; ?>
              </td>
              <td>
                <?php if ($item->getStage() == "not applicable") : ?>
                -
                <?php else : ?>
                  <?php echo $item->getStage() ; ?>
                 <?php endif ; ?>
              </td>
              <td>
                <?php if ($item->getSocialStatus() == "not applicable") : ?>
                -
                <?php else : ?>
                  <?php echo $item->getSocialStatus() ; ?>
                 <?php endif ; ?>
              </td>
              <td>
                <?php if ($item->getRockForm() == "not applicable") : ?>
                -
                <?php else : ?>
                  <?php echo $item->getRockForm() ; ?>
                 <?php endif ; ?>
              </td>
              <td rowspan="2"> 
                <?php if($user_allowed) : ?>
                  <?php echo link_to(image_tag('edit.png', array("title" => __("Edit this individual"))),'individuals/edit?id='.$item->getId());?>
                  <?php echo link_to(image_tag('duplicate.png', array("title" => __("Duplicate this individual"))),'individuals/edit?spec_id='.$item->getSpecimenRef().
                  '&duplicate_id='.$item->getId(), array('class' => 'duplicate_link'));?>
                <?php endif ; ?>
                <?php echo link_to(image_tag('blue_eyel.png', array("title" => __("View"))),'individuals/view?id='.$item->getId(), array('title'=>__('View this individual')));?>
              </td>
            </tr>
            <tr>
              <td colspan='6'>
                <?php if($item->getWithParts()):?>
                  <div id="container_part_<?php echo $item->getId();?>" class='tree'>
                  </div>
                  <script type="text/javascript">
                  $('tr.indiv_<?php echo $item->getId(); ?> img.collapsed').click(function() 
                  {
                      $(this).hide();
                      $(this).siblings('.expanded').show();
                      $.get('<?php echo url_for("specimensearch/partTree?id=".$item->getId()) ;?>',function (html){
                            $('#container_part_<?php echo $item->getId();?>').html(html).slideDown();
                            });
                  });
                  $('tr.indiv_<?php echo $item->getId(); ?> img.expanded').click(function() 
                  {
                      $(this).hide();
                      $(this).siblings('.collapsed').show();
                      $('#container_part_<?php echo $item->getId();?>').slideUp();
                  });
                  </script>
                <?php endif;?>
              </td>
            </tr>
          </tbody>
          <?php endforeach;?>
      </table>
