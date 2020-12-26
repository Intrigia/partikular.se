/**
*
* WAS NEVER USED BECAUSE OF TINYMCE LIMITATIONS IN GUTENBERG EDITOR
*
**/


var today = new Date();
var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
var time = today.getHours() + ":" + today.getMinutes();
var dateTime = date+' '+time;

function AutoFillValues(){
  jQuery(document).ready(function($) {
    $(".wp-block-genesis-custom-blocks-comment").parent().addClass("is-typing");
    $(".wp-block-genesis-custom-blocks-comment #inspector-text-control-1").val(editor);
    $(".wp-block-genesis-custom-blocks-comment #inspector-text-control-1").attr("value",editor);
    $(".wp-block-genesis-custom-blocks-comment #inspector-text-control-2").attr("value",dateTime);
    setTimeout(AutoFillValues, 5000);
  })
}

AutoFillValues();
