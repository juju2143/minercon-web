// minercon-web 1.0
// Based on JulOS 2.0 <http://julosoft.net>

var i = 0;
var state = 0;
var command = "";
var server = "";
var password = "";

function blink(){
    $('#cursor').delay(500).fadeTo(100,0).delay(500).fadeTo(100,1, blink);
}
function execute(){
}
function loadstuff(){
	$("#stdin").before("<br/>Note that you must have enable-rcon=true and rcon.password set in your server's server.properties.<br/>Server: ");
	$(window).scrollTop($(document).height()-$(window).height());
	state = 1;
}
$(window).load(function(){
loadstuff();
blink();
});
$(document.documentElement).keypress(function(event){
	if(state == 1){
		if(event.which == 13)
		{
			server = $("#stdin").text();
			$("#stdin").before("<pre>"+$("#stdin").text()+"</pre>");
			$("#stdin").text("");
			$("#stdin").hide();
			$("#stdin").before('<br/>Password: ');
			$(window).scrollTop($(document).height()-$(window).height());
			state = 2;
		}
		else if(event.which == 8)
		{
			//$("#stdin").text($("#stdin").text().substring(0, $("#stdin").text().length-1));
		}
		else
		{
			$("#stdin").append(String.fromCharCode(event.which));
		}

	}
	else if(state == 2){
		if(event.which == 13)
		{
			password = $("#stdin").text();
			//$("#stdin").before("<pre>"+$("#stdin").text()+"</pre>");
			$("#stdin").text("");
			$("#stdin").show();
			$("#stdin").before('<br/>rcon> ');
			$(window).scrollTop($(document).height()-$(window).height());
			state = 3;
		}
		else if(event.which == 8)
		{
			//$("#stdin").text($("#stdin").text().substring(0, $("#stdin").text().length-1));
		}
		else
		{
			$("#stdin").append(String.fromCharCode(event.which));
		}

	}
	else if(state == 3)
	{
		if(event.which == 13)
		{
			commandline = $("#stdin").text();
			commandline.replace(/^\s+/, "");
			$("#stdin").before("<pre>"+$("#stdin").text()+"</pre><br/>");
			$("#stdin").text("");
			args = commandline.split(" ", 1);
			/*args = $.grep(commandline.split(" "), function(n,i){
				return (n != "");
			});*/
			if(commandline != "")
			{
				state = 0;
				$.post("minersh.php?cmd="+commandline, "server="+server+"&pass="+password, function(data){
					$("#stdin").before(data);
					$("#stdin").before("rcon> ");
					$(window).scrollTop($(document).height()-$(window).height());
					state = 3;
				});
			}else{
				$("#stdin").before("rcon> ");
				$(window).scrollTop($(document).height()-$(window).height());
			}
			if(args[0] == "exit")
			{
				state = 1;
			}
		}
		else if(event.which == 8)
		{
			//$("#stdin").text($("#stdin").text().substring(0, $("#stdin").text().length-1));
		}
		else
		{
			$("#stdin").append(String.fromCharCode(event.which));
		}
	}
});

$(document.documentElement).keydown(function(event){
	if(state == 1 || state == 2 || state == 3){
		if(event.which == 8)
		{
			$("#stdin").text($("#stdin").text().substring(0, $("#stdin").text().length-1));
		}
	}
});
