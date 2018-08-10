$(function  () 
{
	//var scrollHeightOfChatBox = document.getElementById('chatArea').scrollHeight;
	setInterval(function() {
		$('#chatArea').load('display_message.php');
		$('#chatArea').scrollTop(100000);

	},500);
});