//désactivation des "tooltips"
function deactivateTooltips() {
	var spans = document.getElementsByTagName('span'),
		spansLength = spans.length;

	for (var i = 0 ; i < spansLength ; i++) {
		if (spans[i].className == 'tooltip') {
			spans[i].style.display = 'none';
		}
	}
}

//récupérer la "tooltip" correspondante à l'input
function getTooltip(el) {
	while (el = el.nextSibling) {
		if (el.className == 'tooltip') {
			return el;
		}
	}
	return false;
}

//vérification du formulaire, renvoient true si ok
var check = {}; // On met toutes les fonctions dans un objet

check['firstname'] = function(id) {
	var name = document.getElementById(id),
		tooltipStyle = getTooltip(name).style;

	if (name.value.length >= 1) {
		name.className = 'correct';
		tooltipStyle.display = 'none';
		return true;
	}
	else {
		name.className = 'incorrect';
		tooltipStyle.display = 'block';
		return false;
	}
};
check['name'] = function(id) {
	var name = document.getElementById(id),
		tooltipStyle = getTooltip(name).style;

	if (name.value.length >= 1) {
		name.className = 'correct';
		tooltipStyle.display = 'none';
		return true;
	}
	else {
		name.className = 'incorrect';
		tooltipStyle.display = 'block';
		return false;
	}
};

check['pseudo'] = function(id) {
	var name = document.getElementById(id),
		tooltipStyle = getTooltip(name).style;

	if (name.value.length >= 6) {
		name.className = 'correct';
		tooltipStyle.display = 'none';
		return true;
	}
	else {
		name.className = 'incorrect';
		tooltipStyle.display = 'block';
		return false;
	}
};
check['password1'] = check['pseudo'];

check['password2'] = function() {
	var pwd1 = document.getElementById('password1'),
	    pwd2 = document.getElementById('password2'),
		tooltipStyle = getTooltip(pwd2).style;

	if (pwd1.value == pwd2.value && pwd2.value != '') {
		pwd2.className = 'correct';
		tooltipStyle.display = 'none';
		return true;
	}
	else {
		pwd2.className = 'incorrect';
		tooltipStyle.display = 'block';
		return false;
  }

};
check['email'] = function(id) {
	var name = document.getElementById(id),
		exp = new RegExp('^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$'),
		tooltipStyle = getTooltip(name).style;

	if (exp.test(name.value)) {
		name.className = 'correct';
		tooltipStyle.display = 'none';
		return true;
	}
	else {
		name.className = 'incorrect';
		tooltipStyle.display = 'block';
		return false;
	}
};
check['site'] = function(id) {
	var name = document.getElementById(id),
		exp = new RegExp('((http:\/\/|https:\/\/)(www.)?(([a-zA-Z0-9-]){2,}\.){1,4}([a-zA-Z]){2,6}(\/([a-zA-Z-_\/\.0-9#:?=&;,]*)?)?)'),
		tooltipStyle = getTooltip(name).style;

	if (exp.test(name.value) || name.value == '') {
		name.className = 'correct';
		tooltipStyle.display = 'none';
		return true;
	}
	else {
		name.className = 'incorrect';
		tooltipStyle.display = 'block';
		return false;
	}
};

// Evènements
(function() { //fonction anonyme pour éviter variables globales.
	var myForm = document.getElementById('register-form'),
        inputs = document.getElementsByTagName('input'),
        inputsLength = inputs.length;

	for (var i = 0 ; i < inputsLength ; i++) {
		if (inputs[i].type == 'text' || inputs[i].type == 'password') {
			inputs[i].onkeyup = function() {check[this.id](this.id);};
		}
	}

	myForm.onsubmit = function() {
		var result = true;

		for (var i in check) {
		  result = check[i](i) && result;
		}
		if (!result) {
			alert('Certain champs sont mal remplis.');
			return false;
		}
		else{
			return true;
		} 
	};

	myForm.onreset = function() {
		for (var i = 0 ; i < inputsLength ; i++) {
			if(inputs[i].type == 'text' || inputs[i].type == 'password') {
				inputs[i].className = '';
			}
		}
		deactivateTooltips(); 
	};
})();

// désactivation des "tooltips"
deactivateTooltips();