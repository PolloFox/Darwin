<?php include_javascripts_for_form($form) ?>
<div id="collections_codes_screen">
<form id="collections_codes_form" class="edition qtiped_form" method="post" action="<?php echo url_for('collection/addSpecCodes?id='.$form->getObject()->getId() );?>">
<table>
  <tbody>
    <tr>
        <td colspan="2">
          <?php echo $form->renderGlobalErrors() ?>
        </td>
    </tr>
    <tr>
      <th><?php echo $form['code_prefix']->renderLabel();?></th>
      <td>
        <?php echo $form['code_prefix']->renderError(); ?>
        <?php echo $form['code_prefix'];?>
      </td>
    </tr>
    <tr>
      <th><?php echo $form['code_prefix_separator']->renderLabel();?></th>
      <td>
        <?php echo $form['code_prefix_separator']->renderError(); ?>
        <?php echo $form['code_prefix_separator'];?>
      </td>
    </tr>
    <tr>
      <th><?php echo $form['code_suffix_separator']->renderLabel();?></th>
      <td>
        <?php echo $form['code_suffix_separator']->renderError(); ?>
        <?php echo $form['code_suffix_separator'];?>
      </td>
    </tr>
    <tr>
      <th><?php echo $form['code_suffix']->renderLabel();?></th>
      <td>
        <?php echo $form['code_suffix']->renderError(); ?>
        <?php echo $form['code_suffix'];?>
      </td>
    </tr>
    <tr>
      <th><?php echo $form['code_auto_increment']->renderLabel();?></th>
      <td>
        <?php echo $form['code_auto_increment']->renderError(); ?>
        <?php echo $form['code_auto_increment'];?>
      </td>
    </tr>
    <tr>
      <th><?php echo $form['code_part_code_auto_copy']->renderLabel();?></th>
      <td>
        <?php echo $form['code_part_code_auto_copy']->renderError(); ?>
        <?php echo $form['code_part_code_auto_copy'];?>
      </td>
    </tr>
  </tbody>
  <tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form->renderHiddenFields() ?>
          &nbsp;<a href="#" class="cancel_qtip"><?php echo __('Cancel');?></a>
          <a class="widget_row_delete" href="<?php echo url_for('collection/deleteSpecCodes?id='.$form->getObject()->getId());?>" title="<?php echo __('Are you sure ?') ?>">
            <?php echo __('Delete');?>
          </a>
          <input id="save" name="submit" type="submit" value="<?php echo __('Save');?>" />
        </td>
      </tr>
  </tfoot>  
</table>
</form>

</div>