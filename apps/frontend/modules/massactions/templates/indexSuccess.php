<?php slot('title','Mass Actions');?>
<div class="page" id="mass_action">
  <h1><?php echo __('Mass Actions :');?></h1>
  <?php echo form_tag('massactions/index', array('autocomplete'=>"off"));?>
  <table>
    <tbody>
      <tr>
        <th><?php echo $form['source']->renderLabel();?></th>
        <td><?php echo $form['source'];?></td>
      </tr>
      <tr>
        <td colspan="2">
          <div  id="item_list">
            <?php if(isset($items)):?>
              <?php include_partial('itemlist',array('items'=>$items));?>
            <?php else:?>
              <?php echo $form['item_list'];?>
            <?php endif;?>
          </div>
        </td>
      </tr>

      <tr>
        <th><?php echo $form['field_action']->renderLabel();?></th>
        <td><?php echo $form['field_action'];?></td>
      </tr>

      <tr id="action_sub_form">
        <td colspan="2" >
          <div>
            <?php foreach($form['MassActionForm'] as  $key => $sform):?>
              <?php include_partial('subform',array('form'=>$form,'mAction' => $key));?>
            <?php endforeach;?>
          </div>
        </td>
      </tr>
    </tbody>
    <tfoot>
      <tr>
        <td colspan="2"><input type="submit" id="mass_submit" value="<?php echo __('Go');?>" /></td>
      </tr>
    </tfoot>
  </table>
  </form>
</div>
<script type="text/javascript">
function chooseSource(event)
{
  if(! event  && $('#mass_action_source').val() != '')
  {
    $('#mass_action .fld_group ul').hide();
    $(".group_"+$('#mass_action_source').val()+" ul").show();
  }
  else
  {
    if($('#mass_action_source').val() == '')
    {
      $('#item_list').html('');
      $('#item_list').addClass('disabled');
      checkItem();
    }
    else
    {
      $("#item_list").html('<img src="<?php echo image_path('loader.gif');?>" />');
      $('#item_list').load('<?php echo url_for('massactions/items');?>/source/' + $('#mass_action_source').val() , function() {
        checkItem();
      });
      $('#mass_action .fld_group ul').hide();
      $(".group_"+$('#mass_action_source').val()+" ul").show();
      ///SHOW OR HIDE possible action  UNCHECK not possible actions
    }
  }
}

function checkItem()
{
  if( $('#item_list .item_row').length == 0)
  {
    $('#mass_action .fld_group ul :checkbox').removeAttr('checked');
    $('#mass_action .fld_group ul :checkbox').attr('disabled','disabled');
    chooseAction();
  }
  else
  {
    $(".group_"+$('#mass_action_source').val()+" ul :checkbox").removeAttr('disabled');
  }
}

function chooseAction()
{
  if(! $(this).is(':checked'))
  {
    $('#action_sub_form').addClass('disabled');
    $('#sub_form_'+$(this).val()).remove();
  }
  else
  {
    $('#action_sub_form').removeClass('disabled');
    $("#action_sub_form > td > div").html('<img src="<?php echo image_path('loader.gif');?>" />');
    $('#action_sub_form > td > div').load('<?php echo url_for('massactions/getSubForm');?>/source/' + $('#mass_action_source').val() + '/maction/' + $(this).val() , function() {});
  }
  changeSubmit(false);
}

function changeSubmit(status)
{
  if(status)
    $('#mass_submit').removeAttr('disabled');
  else
    $('#mass_submit').attr('disabled','disabled');
}

$(document).ready(function () {

  chooseSource();
  $('#mass_action_source').change(chooseSource);
  $('#mass_action .fld_group ul :checkbox').change(chooseAction);
  $('#mass_submit').closest('form').submit(function (event)
  {
    if(! confirm('<?php echo __('Are you sure ?') ?>'))
    {
      event.preventDefault();
    }
  });

});

</script>