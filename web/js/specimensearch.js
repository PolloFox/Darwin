function update_list(li)
{
  val = li.attr('class') ;
  if (val == 'check')
  {
    li.removeClass('check') ;
    li.addClass('uncheck') ; 
  }
  else
  {
    li.removeClass('uncheck') ;
    li.addClass('check') ; 
  }
}
function hide_or_show(li)
{
  field = li.attr('id') ;
  column = field.substr(3) ;
  val = li.attr('class') ;
  colspan = $('table.spec_results tbody tr:nth-child(2) td').attr('colspan') ;
  if(val == 'uncheck')
  {
    $("li #"+field).find('span:first').hide();
    $("li #"+field).find('span:nth-child(2)').show();
    $('table.spec_results thead tr th.col_'+column).hide();
    $('table.spec_results tbody tr td.col_'+column).hide();
    //this line below is neccessary to avoid table border to be cut
    $('table.spec_results tbody tr:nth-child(2) td').attr('colspan',colspan-1) ;
  }
  else
  {
    $("li #"+field).find('span:first').show();
    $("li #"+field).find('span:nth-child(2)').hide();
    $('table.spec_results thead tr th.col_'+column).show();
    $('table.spec_results tbody tr td.col_'+column).show();
    //this line below is neccessary to avoid table border to be cut    
    $('table.spec_results tbody tr:nth-child(2) td').attr('colspan',colspan+1) ;    
  }
}