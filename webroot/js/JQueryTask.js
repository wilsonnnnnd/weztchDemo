$(document).ready(function ()
{
$('#all').on('click',function()
{
if(this.checked)
{
$('.checkbox').each(function(){
this.checked = true;
});
}
else
{
$('.checkbox').each(function(){
this.checked = false;
});
}
});

$('.checkbox').on('click',function()
{
if($('.checkbox:checked').length == $('.checkbox').length)
{
$('#all').prop('checked',true);
}
else
{
//$('#all').prop('checked',false);
}
});

$('.tablepadded tbody tr:even').addClass("listeven");

$('.tablepadded tbody tr').mouseover(function () { $(this).addClass('dataHover'); });


$('.tablepadded tbody tr').mouseout(function () { $(this).removeClass('dataHover'); });

$('.tablepadded tbody tr td').each(function()
{
if ($(this).text() == 'Arabian')
{
$(this).parent().css('background-color','red')
}

});
});

$(function() {
$( "#tabs" ).tabs();
});