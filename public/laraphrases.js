var laraphrases = function() {

    editor.init();

    var token = $("meta[name='_token']").attr("content");

    // Trigger AJAX on textchange
    var trigger_binded_events_for_phrasable_class = 1;
    var timer = {}
    var timer_status = {}

    $('.laraphrase').on('DOMNodeInserted DOMNodeRemoved DOMCharacterDataModified', function(e){
        var t = $(this),
            url = t.attr('data-url'),
            newValue = t.html();

        if (trigger_binded_events_for_phrasable_class == 1){

            clearTimeout(timer[url]);
            timer_status[url] = 0;

            $('#laraphrase-box').addClass('busy');
            $('#laraphrase-message').text('Busy!');

            timer[url] = setTimeout(function(){

                if ( newValue.length > 1) {
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: { _token: token, newValue: newValue },
                        dataType: "json",
                        success: function(data){
                            $('#laraphrase-box').removeClass();
                            $('#laraphrase-box').addClass('success');
                            $('#laraphrase-message').text('Saved!');
                        },
                        error: function(data){
                            $('#laraphrase-box').removeClass();
                            $('#laraphrase-box').addClass('error');
                            $('#laraphrase-message').text(data.responseJSON.message);
                        }
                    });
                }
                delete timer_status[url]
            },2500)
            timer_status[url] = 1;
        }
    });

    // Edit Mode On/Off Button
    $('#edit-mode-onoffswitch').on('change', function(){
        if(this.checked){
            $('.laraphrase').addClass("laraphrase_editable_mode_on").attr("contenteditable", "true");
            $.cookie("editing_mode", "true");
        }
        else{
            $('.laraphrase').removeClass("laraphrase_editable_mode_on").attr("contenteditable", "false");
            $.cookie("editing_mode", "false");
        }
    });

    if($.cookie("editing_mode") == null){
        $.cookie("editing_mode", "true");
        $('#edit-mode-onoffswitch').prop('checked', true)
    }
    else if($.cookie("editing_mode") == "true"){
        $('#edit-mode-onoffswitch').prop('checked', true)
    }else{
        $('#edit-mode-onoffswitch').prop('checked', false)
    }

}

$(document).ready(laraphrases);