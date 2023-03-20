$(document).ready(function() {
	const $form = $('#login');
	const $email = $('#email');
	const $mdp = $('#mdp');

	function showErrorMessage(field, message) {
		$(`.${field}`).prepend('<i class="fas fa-exclamation-circle trailing text-danger"></i>');
		$(`.${field}-erreur`).text(message);
	}

	function removeErrorMessage(field){
		$(`.${field}`).find('.trailing').remove();
		$(`.${field}-erreur`).text('');
	}

	function validationByPattern({field, value, pattern}){
		if(value === ''){
			showErrorMessage(field, `le ${field} est obligatoire !`);
			return false;
		}else{
			if(field === 'email'){
				if(!pattern.test(value)){
					showErrorMessage(field, `le ${field} est invalid !`);
					return false;
				}else{
					removeErrorMessage(field);
					return true;	
				}
			}else{
				if(value.length < 10){
					showErrorMessage(field, `le mot de passe est invalid !`);
					return false;
				}
				return true;
			}
		}
	}

	// Hanlde Login
	$form.submit(function (e){
		const isEmailValid = validationByPattern({ field : 'email', value : $email.val(), pattern : /[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}/ });
		const isMdpValid = validationByPattern({ field : 'mdp', value : $mdp.val(), pattern : null });
		if(!isEmailValid || !isMdpValid){
			e.preventDefault();
		}
	});

	// handle Focus Event (removing error messages from ui)

	// This message is came from the server side
	const $flashMessage = $('#msg-flash');
	$('input').focus(function (){
		removeErrorMessage($(this).attr('id'));
		$flashMessage.fadeOut();
	});
});