<table>
  <tr>
	<th class="top_aligned"><?php echo $form['accuracy']->renderLabel();?></th>
	<td>
	  <?php echo $form['accuracy']->renderError();?>
	  <?php echo $form['accuracy']->render() ?>
	</td>
  </tr>
  <tr id='specimen_parts_count_min'>
	<th><?php echo $form['specimen_part_count_min']->renderLabel();?></th>
	<td>
	  <?php echo $form['specimen_part_count_min']->renderError();?>
	  <?php echo $form['specimen_part_count_min']->render() ?>
	</td>
  </tr>
  <tr id='specimen_parts_count_max'>
	<th><?php echo $form['specimen_part_count_max']->renderLabel();?></th>
	<td>
	  <?php echo $form['specimen_part_count_max']->renderError();?>
	  <?php echo $form['specimen_part_count_max']->render() ?>
	</td>
  </tr>
</table>
<script>
jQuery(function(){
    if($('input#specimen_parts_accuracy_0:checked').length)
    {
        $('tr#specimen_parts_count_max').hide();
    }
    $("input[name=specimen_parts\\[accuracy\\]]").click(function ()
    {
        if($('input#specimen_parts_accuracy_0:checked').length)
        {
            $('tr#specimen_parts_count_max').hide();
        }
        else
        {
            $('tr#specimen_parts_count_max').show();
        }
        if($('#specimen_parts_specimen_part_count_max').val() < $('#specimen_parts_specimen_part_count_min').val())
            $('#specimen_parts_specimen_part_count_max').val($('#specimen_parts_specimen_part_count_min').val());
    });
});
</script>