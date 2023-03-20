$(document).ready(function () {
	const $form = $('#edit-profil');
	const $nom = $('#nom');
	const $prenom = $('#prenom');
	const $cin = $('#cin');
	const $telephone = $('#telephone');
	const $ville = $('#ville');
	const $province = $('#province');
	const $rue = $('#rue');
	const $codePostal = $('#code-postal');
	const $email = $('#email');

	function showErrorMessage(field, message) {
		$(`.${field}`).prepend('<i class="fas fa-exclamation-circle trailing text-danger"></i>');
		$(`.${field}-erreur`).text(message);
	}

	function removeErrorMessage(field){
		$(`.${field}`).find('.trailing').remove();
		$(`.${field}-erreur`).text('');
	}

	function validation ({field, value, min, max, pattern}){
		if(value === ''){
			showErrorMessage(field, `le ${field} est obligatoire !`);
			return false;
		}else{
			if(!pattern.test(value)){
				showErrorMessage(field, `le ${field} est invalid !`);
				return false;
			}else{
				if(value.length > max){
					showErrorMessage(field, `le nombre max est ${max} caracteres !`);
					return false;
				}else{
					if(value.length < min){
						showErrorMessage(field, `le nombre mini est ${min} caracteres !`);
					}

					removeErrorMessage(field);
					return true;
				}
			}
		}
	}

	function validationByPattern({field, value, pattern}){
		if(value === ''){
			showErrorMessage(field, `le ${field} est obligatoire !`);
			return false;
		}else{
			if(!pattern.test(value)){
				showErrorMessage(field, `le ${field} est invalid !`);
				return false;
			}else{
				removeErrorMessage(field);
				return true;	
			}
		}
	}

	// Hanlde Submit Event
	$form.submit(function(e) {
		const isAllValid = [];
		isAllValid[0] = validation({ field : 'nom', value : $nom.val(), min : 3, max : 20, pattern : /^[a-zéA-Z]+$/ });
		isAllValid[1] = validation({ field : 'prenom', value : $prenom.val(), min : 3, max : 20, pattern : /^[a-zéA-Z]+$/ });
		isAllValid[2] = validation({ field : 'cin', value : $cin.val(), min : 6, max : 15, pattern : /^[a-zA-Z0-9]+$/ });
		isAllValid[3] = validation({ field : 'ville', value : $ville.val(), min : 3, max : 20, pattern : /^[a-zéA-Z]+$/ });
		isAllValid[4] = validation({ field : 'province', value : $province.val(), min : 3, max : 20, pattern : /^[a-zéA-Z]+$/ });
		isAllValid[5] = validation({ field : 'rue', value : $rue.val(), min : 7, max : 100, pattern : /^[a-z A-Zé,0-9]+$/ });
		isAllValid[6] = validationByPattern({ field : 'code-postal', value : $codePostal.val(), pattern : /^[1-9][0-9]{4}$/ });
		isAllValid[7] = validationByPattern({ field : 'telephone', value : $telephone.val(), pattern : /^\+212 ([0-9]{9})$/ });
		isAllValid[8] = validationByPattern({ field : 'email', value : $email.val(), pattern : /[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}/ });
		if(isAllValid.includes(false)){
			e.preventDefault();
		}
	});

	// handle Focus Event (removing error messages from ui)
	$('input').focus(function (){
		removeErrorMessage($(this).attr('id'))
	});


});