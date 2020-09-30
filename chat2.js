var instanse = false;
var state;
var mes;

function Chat () {
    this.update = updateChat;
    this.send = sendChat;
	this.getState = getStateOfChat;
}

//gets the state of the chat
function getStateOfChat(idea_id){
	if(!instanse){
	instanse = true;
		 $.ajax({
			   type: "POST",
			   url: "process2.php",
			   data: {  
			   			'function': 'getState',
			   			'idea_id': idea_id,
						},
			   dataType: "json",
			
			   success: function(data){
				   state = data.state;
				   instanse = false;
			   },
			});
	}	 
}
//Updates the chat
function updateChat(idea_id){
		 if(!instanse){
		 instanse = true;
	     $.ajax({
			   type: "POST",
			   url: "process2.php",
			   data: {  
			   			'function': 'update',
			   			'state': state,
			   			'idea_id': idea_id,
						},
			   dataType: "json",
			   success: function(data){
				   if(data.text){
				   	const entries = Object.entries(data.text);
					for (var key in entries) {
					    var explode = entries[0][0].split(",");
					    $('#chat-area').append($("<a href='particpaters.php?post_id="+idea_id+"' class='list-group-item list-group-item-action flex-column align-items-start'><div class = 'd-flex w-100 justify-content-between' ><h5 class = 'mb-1' >" +
					     explode[0] + " </h5><small class='text-muted'>" + explode[1] + 
					     "</small ></div> <p class = 'mb-1' > " + entries[key][1] + " </p> </a>"));

					            }		
				   }
				   document.getElementById('chat-area').scrollTop = document.getElementById('chat-area').scrollHeight;
				   instanse = false;
				   state = data.state;
			   },
			});
	 }
}

//send the message
function sendChat(message, nickname, idea_id){       
     $.ajax({
		   type: "POST",
		   url: "process2.php",
		   data: {  
		   			'function': 'send',
					'message': message,
					'nickname': nickname,
					'idea_id': idea_id,
				 },
		   dataType: "json",
		   success: function(data){
			   updateChat(idea_id);
		   },
		});
}
