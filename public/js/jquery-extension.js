//create by: angelito tan
$(document).ready(function(){
var last;
	$('.side-block').bind(
		"mouseenter mouseleave mousedown",
		function(event){
			//id = this.id;
			if(event.type=='mouseenter'){
				if(this.id!=last){
					$(this).css({background:'#E0FFFF'});
				}
			}
			else if(event.type=='mouseleave')
			{
				if(this.id != last){
					$(this).css({background:'white'});
				}
			}
			else
			{
				$(".side-block").css({background:'white'});
				$(this).css({background:'#99CCFF'});
				$('#side'+this.id).css({color:'#f36e2c'});
				//$('#side'+this.id).css({color:'#f36e2c', background: '#E0FFFF'});
				$('#side'+last).css({color:'#336699'});
				last=this.id;
			}
	});	
	

});