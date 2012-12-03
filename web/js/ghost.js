function moveEnd (obj) {
    obj.focus();
    var len = obj.value.length;
    if (document.selection) {
        var sel = obj.createTextRange();
        sel.moveStart('character', len);
        sel.collapse();
        sel.select();
    } else if (typeof obj.selectionStart == 'number' && typeof obj.selectionEnd == 'number') {
        obj.selectionStart = obj.selectionEnd = len;
    }
}

function reply(name) {
    var replyBody = $("#post_body");
    var oldContent = replyBody.val();
    var prefix = "@" + name + " ";
    var newContent = ''
    if (oldContent.length > 0) {
        if (oldContent != prefix) {
            newContent = oldContent + "\n" + prefix;
        }
    } else {
        newContent = prefix
    }
    replyBody.focus();
    replyBody.val(newContent);
    moveEnd(replyBody);
}

$(document).ready(function(){
    $('.reply-action').click(function(){
        var name = $(this).data('name');
        reply(name);
    });

    $('form').submit(function(){
        $(this).find('.btn').attr('disabled', true).addClass('disabled');
    });
});