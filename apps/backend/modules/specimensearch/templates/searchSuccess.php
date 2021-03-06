<?php slot('title', __('Specimens search result'));  ?>
<?php use_javascript('double_list.js');?>
<?php include_partial('result_cols', array('source' => $source, 'columns' => $columns, 'field_to_show' => $field_to_show));?>

<div class="encoding">
  <?php include_stylesheets_for_form($form) ?>
  <?php include_javascripts_for_form($form) ?>
  <div class="page" id="search_div">
    <h1 id="title"><?php echo __('Specimens Search Result');?></h1>
    <?php echo form_tag('specimensearch/searchResult'.( isset($is_choose) ? '?is_choose='.$is_choose : '') , array('class'=>'specimensearch_form','id'=>'specimen_filter'));?>
      <ul id="intro" class="hidden">
        <?php 
        // Render all the form fields as hidden input if possible. if the value is an array or and object render them as usual
        foreach($form as $row)
        { 
          $w = new sfWidgetFormInputHidden();
          $attributes = $form->getWidget($row->getName())->getAttributes();
          if(is_string($row->getValue()) || is_null($row->getValue()))
            echo '<li>'.$w->render( $form->getWidgetSchema()->generateName($row->getName()),$row->getValue(),$attributes).'</li>';
          else
            echo '<li>'.$row.'</li>';
        }?>
      </ul>
      <div class="search_results">
        <div class="search_results_content">
          <?php include_partial('searchSuccess',
                                array('specimensearch' => $specimensearch,
                                      'codes' => $codes,
                                      'part_codes' => $part_codes,
                                      'form' => $form, 
                                      'orderBy' => $orderBy,
                                      's_url' => $s_url,
                                      'orderDir' => $orderDir,
                                      'currentPage' => $currentPage,
                                      'pagerLayout' => $pagerLayout,
                                      'is_specimen_search' => $is_specimen_search,
                                      'columns' => $columns,
                                      'source' => $source
                                     )
                               ); ?>
        </div>
      </div>
      <?php if(isset($is_pinned_only_search)):?>
        <input type="hidden" name="pinned" value="true" />
      <?php endif;?>
      <script  type="text/javascript">
        $(document).ready(function () {
          $("ul.column_menu > li > ul > li").click(function(){
            update_list($(this));
            hide_or_show($(this));
          });

          $('form#specimen_filter select.double_list_select-selected option').attr('selected', 'selected');
          $('body').duplicatable({
            duplicate_href: '<?php echo url_for('specimen/confirm');?>',
            duplicate_binding_type: 'live'
          });

          $("#criteria_butt").click(function(){
            // Reselect all double list options that should be selected to be taken in account in the form submit
            // Submit the form with criteria = 1 -> telling we request the index template
            $('#specimen_filter').attr('action','<?php echo url_for('specimensearch/search?criteria=1');?>').submit();
          });
        <?php if($is_specimen_search):?>
          $('#del_from_spec').click(function(){
            pins = '';
            pins_array = new Array();
            $('.spec_results tbody tr .remove_on').not('.hidden').each(function(){
              rid = getIdInClasses($(this).closest('tr'));
              pins_array.push(rid);
            });
            if(pins_array.length == 0)
            {
              alert("<?php echo __('You must select at least one specimen.');?>");
            }
            else
            {
              if(confirm('<?php echo addslashes(__('Are you sure?'));?>'))
              {
                $.get('<?php echo url_for('savesearch/removePin?search='.$is_specimen_search);?>/ids/' + pins_array.join(',') ,function (html){
                  for(var i = 0; i < pins_array.length; ++i)
                  {
                    $('.rid_' + pins_array[i]).closest('tbody').remove();
                  }
                  if($('.spec_results tbody').length == 0)
                  {
                    location.reload();
                  }
                });
              }
            }
          });
        <?php endif;?>
        });
      </script>
    </form>
      <div class="check_right" id="save_button"> 
        <a href="<?php echo url_for('specimen/confirm') ; ?>" class="hidden"></a>
        <?php include_partial('savesearch/saveSpec', array('spec_lists'=>$spec_lists,'source' => $source));?>

        <?php if(! $is_specimen_search):?>
          <?php include_partial('savesearch/saveSearch', array('source' => $source));?>
        <?php endif;?>
      </div>
      <?php if(!isset($is_pinned_only_search) && ! $is_specimen_search):?>
        <input type="button" id="criteria_butt" class="save_search" value="<?php echo __('Back to criteria'); ?>">
      <?php else:?>
        <input type="button" id="del_from_spec" class="save_search" value="<?php echo __('Remove selected'); ?>">
      <?php endif;?>     
  </div>
</div>
