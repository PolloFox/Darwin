function getIdInClasses(el)
{
    var classes = $(el).attr("class").split(" ");
    for ( var i = 0; i < classes.length; i++ )
    {
        exp = new RegExp(".*id_([0-9]+)",'gi');
        var result = exp.exec(classes[i]) ;
        if ( result )
        {
            return result[1];
        }
    }
}

function getElInClasses(element,prefix)
{
    var classes = $(element).attr("class").split(" ");
    for ( var i = 0; i < classes.length; i++ )
    {
        exp = new RegExp(prefix+"(.*)",'gi');
        var result = exp.exec(classes[i]) ;
        if ( result )
        {
            return result[1];
        }
    }
}

function addFormError(form_el, message)
{
    if( $(form_el).is(':visible') )
    {
//         $(form_el).addClass('error_fld');
        $(form_el).qtip({
            content: message,
            show: { ready: true, when : { event: 'none'} },
            hide: { when: { event: 'change' } },
            style: { 
                width: 200,
                padding: 5,
                background: '#ec9593',
                color: 'black',
                border: {
                    width: 7,
                    radius: 5,
                    color: '#c36b70'
                },
                tip: 'bottomLeft',
                name: 'dark', // Inherit the rest of the attributes from the preset dark style
            },
            position: {
                corner: {
                    target: 'topRight',
                    tooltip: 'bottomLeft'
                }
            },
        });
        return true
    }
    else
    {
        return false;
    }
}

function removeAllQtip()
{
    var i = $.fn.qtip.interfaces.length; while(i--)
    {
            // Access current elements API
        var api = $.fn.qtip.interfaces[i];
            // Queue the animation so positions are updated correctly
        if(api && api.status.rendered && !api.status.hidden && !api.elements.target.is('.button'))
            api.destroy();
    };
}

function addBlackScreen()
{
    $(document).ready(function()
    {
        $('<div id=\"qtip-blanket\">')
            .css({
                position: 'absolute',
                top: $(document).scrollTop(), // Use document scrollTop so it's on-screen even if the window is scrolled
                left: 0,
                height: $(document).height(), // Span the full document height...
                width: '100%', // ...and full width
                opacity: 0.7, // Make it slightly transparent
                backgroundColor: 'black',
                zIndex: 5000  // Make sure the zIndex is below 6000 to keep it below tooltips!
            })
            .appendTo(document.body) // Append to the document body
            .hide(); // Hide it initially
    });
}

function hideForRefresh(el)
{
  $(el).css({position: 'relative'})
  $(el).append('<div id="loading_screen" />')
  $('#loading_screen').css({
                position: 'absolute',
                top: 0,
                left: 0,
                width: '100%', 
                height: '100%',
                opacity: 0.3,
                backgroundColor: 'black',
		cursor: 'wait',
                zIndex: 10000
            });
}

function showAfterRefresh(el)
{
  $(el).children('#loading_screen').remove();
}

$(document).ready(function () {
  $('.cancel_qtip').live('click',function () {
    $('.qtip-button').click();
  });
});