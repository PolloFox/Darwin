<input type="hidden" name="only_role" id="only_role" value="0" />
<ul class="tab_choice">
  <li class="both_search_people"><?php echo __('People');?></li>
  <li class="both_search_institutions"><?php echo __('Institution');?></li>
</ul>
<div class="search_box search_catalogue_people_both">
  
</div>
<!--<span class="both_search_people"><?php echo __('People');?> : <input name="type_search" type="radio" value="people" /></span>
<span class="both_search_institutions"><?php echo __('Institution');?> <input name="type_search" type="radio" value="institution" /></span>-->

<script language="javascript">

$(document).ready(function () {
    $('.search_box').slideDown();

  $('.both_search_people').not('.activated').click( function(event)
  {
    event.preventDefault();
    $('.result_choose').die('click');
    $(".search_box").html('<img src="/images/loader.gif" />');
    $('.tab_choice .activated').removeClass('activated');
    $('.both_search_people').addClass('activated');

    $.ajax({
      type: "POST",
      url: '<?php echo url_for('people/choose?with_js=1' . ($is_choose?'&is_choose=1' : '') );?>',
      success: function(html){
        $('.search_box').html(html);
      }
    });
  });

  $('.both_search_institutions').not('.activated').click( function(event)
  {
    event.preventDefault();
    $('.result_choose').die('click');
    $(".search_box").html('<img src="/images/loader.gif" />');
    $('.tab_choice .activated').removeClass('activated');

    $('.both_search_institutions').addClass('activated');

    $.ajax({
      type: "POST",
      url: '<?php echo url_for('institution/choose?with_js=1' . ($is_choose?'&is_choose=1' : '') );?>',
      success: function(html){
        $('.search_box').html(html);
      }
    });
  });
});

</script> 