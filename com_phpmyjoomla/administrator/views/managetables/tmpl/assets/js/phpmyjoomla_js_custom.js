$(document).ready(function()
{
    $('.toggle').hide();
    $('a.togglelink').on('click', function (e) {
        e.preventDefault();
        var elem = $(this).next('.toggle')
        $('.toggle').not(elem).hide('slow');
        elem.toggle('slow');
    });
    $('.customquery_toggle').hide();
    $('a.customquery').on('click', function (e) {
        e.preventDefault();
        var elem = $(this).next('.customquery_toggle')
        $('.customquery_toggle').not(elem).hide('slow');
        elem.toggle('slow');
    });
});
function setColorFilter(btn,color)
{
    var property=document.getElementById(btn);
    if (window.getComputedStyle(property).backgroundColor == 'rgb(91, 183, 91)')
    {
        property.style.backgroundColor=color;
        property.style.color = "#1c94c4";
    }
    else
    {
        property.style.backgroundColor = "#5bb75b";
        property.style.color = "#ffffff";
    }
}
function setColorCustomQuery(btn,color)
{
    var property=document.getElementById(btn);
    if (window.getComputedStyle(property).backgroundColor == 'rgb(91, 183, 91)')
    {
        property.style.backgroundColor=color;
        property.style.color = "#1c94c4";
    }
    else
    {
        property.style.backgroundColor = "#5bb75b";
        property.style.color = "#ffffff";
    }
}
$(function() {
    $('#activator').click(function(){
        $('#overlay').fadeIn('fast',function(){
            $('#box').animate({'top':'160px'},500);
        });
    });
    $('#boxclose').click(function(){
        $('#box').animate({'top':'-1000px'},500,function(){
            $('#overlay').fadeOut('fast');
        });
    });
});

function showLoadingDiv() {
    try{
        if (document.getElementById('ajax_loading')) document.getElementById('ajax_loading').className = 'loading-visible';
        if (document.getElementById('ajax_shield')) document.getElementById('ajax_shield').className = 'dark_background';
    } catch (e){}
}

function hideLoadingDiv() {
    try{
        if (document.getElementById('ajax_loading')) document.getElementById('ajax_loading').className = 'loading-invisible';
        if (document.getElementById('ajax_shield')) document.getElementById('ajax_shield').className = 'clear_background';
    } catch (e){}
}
