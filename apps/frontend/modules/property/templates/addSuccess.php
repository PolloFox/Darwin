<div id="tests">

<?php if (isset($message)): ?>
  <div class="flash_save"><?php echo $message ?></div>
<?php endif; ?>

<form action="<?php echo url_for('property/add' .  ($form->getObject()->isNew() ? '': '?rid='.$form->getObject()->getId() ) );?>" method="post" id="property_form">
<?php echo $form['referenced_relation'];?>
<?php echo $form['record_id'];?>
<table>
  <tr>
      <td colspan="2">
        <?php echo $form->renderGlobalErrors() ?>
      </td>
  </tr>
  <tr>
    <th><?php echo $form['property_qualifier']->renderLabel();?></th>
    <td>
      <?php echo $form['property_qualifier']->renderError(); ?>
      <?php echo $form['property_qualifier'];?>
    </td>
  </tr>
  <tr>
    <th><?php echo $form['property_type']->renderLabel();?></th>
    <td>
      <?php echo $form['property_type']->renderError(); ?>
      <?php echo $form['property_type'];?>
  </td>
  </tr>
  <tr>
    <th><?php echo $form['property_sub_type']->renderLabel();?></th>
    <td>
      <?php echo $form['property_sub_type']->renderError(); ?>
      <?php echo $form['property_sub_type'];?>
    </td>
  </tr>
  <tr>
    <th><?php echo $form['date_from']->renderLabel();?></th>
    <td>
      <?php echo $form['date_from']->renderError(); ?>
      <?php echo $form['date_from'];?>
    </td>
  </tr>
  <tr>
    <th><?php echo $form['date_to']->renderLabel();?></th>
    <td>
      <?php echo $form['date_to']->renderError(); ?>
      <?php echo $form['date_to'];?>
    </td>
  </tr>

  <tr>
    <th><?php echo $form['property_unit']->renderLabel();?></th>
    <td>
      <?php echo $form['property_unit']->renderError(); ?>
      <?php echo $form['property_unit'];?>
    </td>
  </tr>

  <tr>
    <th><?php echo $form['property_accuracy_unit']->renderLabel();?></th>
    <td>
      <?php echo $form['property_accuracy_unit']->renderError(); ?>
      <?php echo $form['property_accuracy_unit'];?>
    </td>
  </tr>

  <tr>
    <th><?php echo $form['property_method']->renderLabel();?></th>
    <td>
      <?php echo $form['property_method']->renderError(); ?>
      <?php echo $form['property_method'];?>
    </td>
  </tr>

  <tr>
    <th><?php echo $form['property_tool']->renderLabel();?></th>
    <td>
      <?php echo $form['property_tool']->renderError(); ?>
      <?php echo $form['property_tool'];?>
    </td>
  </tr>
</table>


<ul class="proprety_values">
  <?php foreach($form['PropertiesValues'] as $form_value):?>
    <li>
      <?php include_partial('prop_value', array('form' => $form_value));?>
    </li>
  <?php endforeach;?>
</ul>
  <input type="submit" />
</form>
<a href="<?php echo url_for('property/addValue'. ($form->getObject()->isNew() ? '': '?id='.$form->getObject()->getId()) );?>/num/" id="add_prop_value">Add Value</a>

<script  type="text/javascript">
  $(document).ready(function () {
    $('.clear_prop').live('click',function (){
      parent = $(this).closest('li');
      nvalue='';
      $(parent).find('input').val(nvalue);
      $(parent).hide();
    });

    $('form#property_form').submit(function () {
      $('form#property_form input[type=submit]').attr('disabled','disabled');
      $.ajax({
	  type: "POST",
	  url: $(this).attr('action'),
	  data: $(this).serialize(),
	  success: function(html){
	    $('form#property_form').parent().before(html).remove();
	    //replaceWith(html);
	  }
      });
      return false;
    });

    $('#add_prop_value').click(function () {
	$.ajax({
	  type: "GET",
	  url: $(this).attr('href')+ (0+$('.proprety_values li').length),
	  success: function(html){
	    $('.proprety_values').append('<li>'+html+'<li>');
	  }
  
	});
	return false;
    });
  });
</script>
</div>