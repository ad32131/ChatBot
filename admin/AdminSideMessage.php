<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <title>ADMIN Side ChatBox</title>
    <script>
        var ChatSyncVal = 0;
        var RecvChatSyncVal =0;
        var Chatroom="<?php echo $_GET[ChatRoom]; ?>";
        setInterval( function ChatSync(){
            //$("#converse").html($("#converse").html() +"<br><span class style>" + "<span id='chat-bot'>Admin: </span>TEST</span>");
            $.ajax({
                url:"../ChatSync.php",
                type:'GET',
                data: "ChatRoom=<?php echo $_GET[ChatRoom]; ?>",
                dataType: "text",
                success:function(data){
                    //alert(data);
                    RecvChatSyncVal = data;
                    if(ChatSyncVal != RecvChatSyncVal){
                            ChatSyncVal = Number(ChatSyncVal)+1;
                            $.ajax({
                                url:"../ChatMessageRangeCheck.php",
                                type:'GET',
                                data: "StartIndex="+(ChatSyncVal)+"&MaxIndex="+(RecvChatSyncVal)+"&ChatRoom=<?php echo $_GET[ChatRoom]; ?>",
                                dataType: "text",
                                success:function(data){
                                    //data Print
                                    $("#converse").html($("#converse").html() +data);
                                    ChatSyncVal = RecvChatSyncVal;
                                },
                                error:function(jqXHR, textStatus, errorThrown){
                                    alert("ChatSyncError \n" + textStatus + " : " + errorThrown);
                                }
                            });
                    }
                },
                error:function(jqXHR, textStatus, errorThrown){
                    alert("ChatSyncError \n" + textStatus + " : " + errorThrown);
                }
            });
        },1000);

    </script>
</head>
<body>
<div id="header">
    <div id="chat-button"><i class="fa fa-3x fa-comments" aria-hidden="true"></i></div>
</div>
<div id="chat-box">
    <div id="chat-head">Chat-Bot<i id="cancel" class="fa fa-times"></i></div>
    <div id="converse" style="overflow:scroll;">
        <!--
        <span class="" style=""><span id="chat-bot">Admin: Hello </span>Hi, what's your name?</span>
        <span id="chat-user">You: OK</span>
        -->
    </div>
    <div id="controls">
        <textarea id="textbox" class="controls-elements" placeholder="Say something.."></textarea>
        <button id="send" class="controls-elements"><i id="send-icon" class="fa fa-paper-plane"></i></button>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.2.1.js" integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
<script src="js/AdminChatBot.js"></script>
</body>
</html>