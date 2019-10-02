var username = "Guest";
function send_message(message){
	$("#converse").html($("#converse").html +"<span class style>" + "<span id='chat-bot'>Admin : </span>" + message + "</span><br>");

	/*
	$(".current-msg").hide();
	$(".current-msg").delay(500).fadeIn();
	$(".current-msg").removeClass("current-msg");
	*/
}
function Send_event(Text){
	$.ajax({
		url:"MessageWriter.php",
		type:'POST',
		data: {
			Text: Text,
			Owner: "Guest"
		},
		dataType: "text",
		success:function(data){
			//data Print
			conv = $("#converse").html();
			ai(conv,Text);
		},
		error:function(jqXHR, textStatus, errorThrown){
		}
	});
}

function ai(conv,message){
		// $("#send").click(function(){
			$.ajax({
				url:"BotUsing.php",
				type:'GET',
				data: "",
				async: false,
				dataType: "text",
				success:function(data){
					//data Print
					//$("#converse").html($("#converse").html() +data);
					if(data == "ON"){
					$.get("getresponse.php", {q:message}, function(data, status){
						//alert("Data: " + message + "\nStatus: " + status);
						$.ajax({
							url:"MessageWriter.php",
							type:'POST',
							data: {
								Text: data,
								Owner: "Admin"
							},
							dataType: "text",
							success:function(data){
								//data Print
							},
							error:function(jqXHR, textStatus, errorThrown){
								alert("ChatSyncError \n" + textStatus + " : " + errorThrown);
							}
						});
					});
					}
				},
				error:function(jqXHR, textStatus, errorThrown){
					alert("ChatSyncError \n" + textStatus + " : " + errorThrown);
				}
			});


		// });
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
				$.ajax({
					url:"MessageWriter.php",
					type:'POST',
					data: {
						Text: usermsg,
						Owner: "Guest"
					},
					async: false,
					dataType: "text",
					success:function(data){
						//data Print
						conv = $("#converse").html();
						ai(conv,usermsg);
					},
					error:function(jqXHR, textStatus, errorThrown){
					}
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
