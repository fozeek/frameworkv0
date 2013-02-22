$(document).ready(function(){
    
    $('.check-langage').change(function(){
	if($(this).attr('checked')){
	    if($('#hidden-langage').val() == ""){
		$('#hidden-langage').val($(this).val());
	    }
	    else {
		$('#hidden-langage').val($('#hidden-langage').val() + ',' + $(this).val());
	    }
	}
	else {
	    var temp = $('#hidden-langage').val().split(',');
	    var i;
	    for(i = 0; i < temp.length; i++){
		if(temp[i] == $(this).val()){
		    delete temp[i];
		}
	    }
	    var newVal = '';
	    var cpt = 0;
	    for(i = 0; i < temp.length; i++){
		if(temp[i] != undefined){
		    if(newVal == '')
			newVal += temp[i];
		    else
			newVal += ',' + temp[i];
		    cpt++;
		}
	    }
	    $('#hidden-langage').val(newVal);
	}
    });
    
    if($('#oiseau-volant').length > 0){
	setTimeout(function(){

		if($('#oiseau-volant').position().left > 600){
		    $('#sang').css({'display':'block'});
		}
	}, 1650);
	setTimeout(function(){

		if($('#oiseau-volant').position().left > 1000){
		    $('#oiseau-volant').css({'display':'none'});
		}
	}, 3000);
    }
});