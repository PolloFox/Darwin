<?php include_stylesheets_for_form($form) ?>
<?php include_javascripts_for_form($form) ?>

  <?php echo form_tag('igs/search'.( isset($is_choose) ? '?is_choose='.$is_choose : '') , array('class'=>'search_form','id'=>'igs_filter'));?>
  <div class="container">
    <table class="search" id="<?php echo ($is_choose)?'search_and_choose':'search' ?>">
      <thead>
        <tr>
          <th><?php echo $form['ig_num']->renderLabel() ?></th>
          <th><?php echo $form['from_date']->renderLabel(); ?></th>
          <th><?php echo $form['to_date']->renderLabel(); ?></th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><?php echo $form['ig_num']->render() ?></td>
          <td><?php echo $form['from_date']->render() ?></td>
          <td><?php echo $form['to_date']->render() ?></td>
          <td><input class="search_submit" type="submit" name="search" value="<?php echo __('Search'); ?>" /></td>
        </tr>
      </tbody>
    </table>
    <div class="search_results">
      <div class="search_results_content">
      </div>
    </div>
    <?php if($sf_user->isAtLeast(Users::ENCODER)):?> <div class='new_link'><a <?php echo !(isset($is_choose) && $is_choose)?'':'target="_blank"';?> href="<?php echo url_for('igs/new') ?>"><?php echo __('New');?></a></div><?php endif;?>
  </div>
</form>
