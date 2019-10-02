var username = "Admin";
function send_message(conv,message){
    $("#converse").html(conv +"<span class style>" + "<span id='chat-bot'>Admin : </span>" + message + "</span><br>");

    $(".current-msg").hide();
    $(".current-msg").delay(500).fadeIn();
    $(".current-msg").removeClass("current-msg");


}

$(function(){
    var open = false;
    var conv = $("#converse").html();
    $("#send").click(function(){
        var usermsg = $("#textbox").val();
        conv = $("#converse").html();
        console.log(conv.length);
        if (usermsg != "") {
            $("#textbox").val("");
            $.get("../getresponse.php", {q:"T"}, function(data, status){
                // alert("Data: " + data + "\nStatus: " + status);
                $.ajax({
                    url:"../MessageWriter.php",
                    type:'POST',
                    data: {
                        ChatRoom: Chatroom,
                        Text: usermsg,
                        Owner: "Admin"
                    },
                    dataType: "text",
                    success:function(data){
                        //data Print
                    },
                    error:function(jqXHR, textStatus, errorThrown){
                    }
                });
            });
            //$("#converse").scrollTop($("#converse").prop("scrollHeight"));

        }
    });

    $("#chat-button").click(function(){
        $("#chat-box").animate({"right":"0px"});
    });
    $("#cancel").click(function(){
        $("#chat-box").animate({"right":"-300px"});
    });

});
