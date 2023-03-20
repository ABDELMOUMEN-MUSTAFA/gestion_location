$(document).ready(function (){
	const $categorieRadioBtn = $('input[name="categories"]');
	const $locationForm = $('#location');

	function showError(name) {
		const message = $(`.${name.replace('_', '-')}-error`);
		console.log(message);
		if(name === 'date_depart'){
			message.html('<i class="fa fa-exclamation-circle" aria-hidden="true"></i> veuillez choissir la date de départ');
		}else if(name === 'date_retour'){
			message.html('<i class="fa fa-exclamation-circle" aria-hidden="true"></i> veuillez choissir la date de retour');
		}else if(name === 'heure_depart'){
			message.html('<i class="fa fa-exclamation-circle" aria-hidden="true"></i> veuillez choissir l\'heure de départ');
		}else{
			message.html('<i class="fa fa-exclamation-circle" aria-hidden="true"></i> veuillez choissir l\'heure de retour');
		}
		const $fieldElement = $(`[name="${name}"]`);

		$fieldElement.parent().parent().before(message);
		$fieldElement.addClass('error');
	
	}

	function removeError(className) {
		$(`.${className}-error`).fadeOut(200, function() { $(this).html(''); });
		$(`#${className}`).removeClass('error');
	}

	function validationFields(name, value) {
		if(value === ''){
			showError(name);
			return false;
		}
		return true;
	}

	function agencesValidation() {
		const $agenceDepart = $('#agence-depart');
		const $agenceRetour = $('#agence-retour');

		if($agenceDepart.val() === null || $agenceRetour.val() === null){
			if($agenceDepart.val() === null){				
				$('.agence-depart-error').html('<i class="fa fa-exclamation-circle" aria-hidden="true"></i> veuillez choissir l\'agence de départ');
				$agenceDepart.addClass('error');
			}

			if($agenceRetour.val() === null){
				$('.agence-retour-error').html('<i class="fa fa-exclamation-circle" aria-hidden="true"></i> veuillez choissir l\'agence de retour');
				$agenceRetour.addClass('error');
			}
			return false;
		}
		return true;
	}

	function loadCars(data, categorieID = '') {
			$.ajax({
				type : 'GET',
				url : 'http://localhost/Gestion_Locations/car/' + categorieID, 
				data,
				beforeSend: function() {
					$('.nombre-voiture-trouve').html('');
					$('#cars').html(`<div class="spinner"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>`);
				}, 
				complete : function() {
					$('.spinner').remove();
				},
				success : function(data) {
					const voitures = JSON.parse(data);
					$('.nombre-voiture-trouve').remove();
					$('#cars').before(`<p class="nombre-voiture-trouve">Nous avons trouvé <strong style="color: #c9e77a">${voitures.length} véhicules</strong></p>`);
					let carsContent = '';
					voitures.forEach(function(v) {
				carsContent = carsContent + `
					<div class="card text-white">
					  <div class="row">
					    <div class="col-lg-4 text-center align-self-center">
					     <div class="card-body d-flex align-items-center flex-column">
				         <img
				          src="${v.photo}"
				          class="img-fluid rounded-start car-image"
				          alt="car image"
				        />
				        <img
				          src="${v.logo}"
				          class="img-fluid car-logo"
				          alt="car logo"
				        /> 
				       </div>
					    </div>
					    <div class="col-lg-8">
					      <div class="card-body">
					       	<div>
					       		<h4 class="card-title">${v.titre}</h4>
					        <h5 class="text-muted">${v.sous_titre}</h5>
					        <div class="d-flex flex-column flex-lg-row align-items-center gap-3 mb-3 justify-content-center">
					        	<div class="d-flex gap-3">
					        		<span data-mdb-toggle="tooltip" title="Nombre de Passagers" class="d-flex gap-2 badge badge-danger align-items-center"><i class="fa fa-users"></i> <span>${v.nombre_passagers}</span></span>
					        		<span data-mdb-toggle="tooltip" title="Nombre de Portes" class="d-flex gap-2 badge badge-danger align-items-center"><i class="fa fa-car"></i> <span>${v.nombre_portes}</span></span>
					        		<span data-mdb-toggle="tooltip" title="Nombre de Valises" class="d-flex gap-2 badge badge-danger align-items-center"><i class="fa fa-suitcase"></i> <span>${v.nombre_valises}</span></span>
					        		<span data-mdb-toggle="tooltip" title="Boite de Vitesse ${v.boite_vitesses}" class="d-flex gap-2 badge badge-danger align-items-center"><i class="fa fa-map-pin"></i> <span>${v.boite_vitesses[0].toUpperCase()}</span></span>
					        	</div>
					        	<div class="d-flex gap-3">
					        		${v.climatisation ? '<span data-mdb-toggle="tooltip" title="Climatisation" class="d-flex gap-2 badge badge-danger align-items-center"><i class="fa far fa-snowflake"> </i><span>A/C</span></span>' : ''}
					        		<span data-mdb-toggle="tooltip" title="Carburant" class="d-flex gap-2 badge badge-danger align-items-center"><i class="fa-solid fa-gas-pump"></i><span>${v.type_carburant}</span></span>
				            		${v.gps_integre ? '<span data-mdb-toggle="tooltip" title="GPS Intégré" class="d-flex gap-2 badge badge-danger align-items-center"><i class="fa-solid fa-location-dot"></i><span>GPS</span></span>' : ''}
					        	</div>
					       	</div>
					       </div>
					        <hr>
					        <div class="d-flex flex-column flex-lg-row justify-content-between">
					        	<ul class="list-unstyled">
					        	<li><i class="fa fa-caret-right" aria-hidden="true"></i> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Âge minimum : 21 ans</li>
					        	<li><i class="fa fa-caret-right" aria-hidden="true"></i> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Année de permis minimum : ${v.annee_permis_min} ans</li>
					        	<li><i class="fa fa-caret-right" aria-hidden="true"></i> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Franchise accident : ${v.franchise_accedent} DH</li>
					        	<li><i class="fa fa-caret-right" aria-hidden="true"></i> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Franchise vol : ${v.franchise_vol} DH</li>
					        	<li><i class="fa fa-caret-right" aria-hidden="true"></i> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Caution : ${v.caution} DH</li>
					        </ul>
					        <div class="align-self-center">
					        	<div class="d-flex flex-column">
					        		<strong class="h3 text-center text-lg-start">${v.prix_jour} DH / Jour</strong>
					        		<a href="http://localhost/Gestion_Locations/location/${v.matricule}" class="btn btn-danger btn-lg btn-block" style="width: 250px">LOUER &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa-solid fa-arrow-right"></i></a>
					        	</div>
					        </div>
					        </div>
					      </div>
					    </div>
					  </div>
					  ${v.is_disponible === false ? `<div class="mask rounded" style="background-color: hsla(0, 0%, 0%, 0.5)"><div class="d-flex justify-content-center align-items-center h-100"><p class="text-danger bg-dark rounded p-2 mb-0"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> Véhicule indisponible du ${v.date_depart} au ${v.date_retour}</p></div></div>` : ''}
					  </div>`;
					});

					$('#cars').html(carsContent).hide().fadeIn(800);
					$('.categories').removeClass('d-none');
					if(voitures.length !== 0){
						$('footer').removeClass('d-none');
					}else{
						$('footer').addClass('d-none');
					}
				},
				fail : function() {
					$('#cars').html('Please try again soon !!!');
				}
			});
	}

	$categorieRadioBtn.change(function(event) {
		$locationForm.submit();
	});

	$locationForm.submit(function(event) {
		event.preventDefault();
		const fields = $(this).serializeArray();
		const isAllvalid = [];
		fields.forEach(function (field) {
			isAllvalid.push(validationFields(field.name, field.value));
		});

		// Agence validation
		isAllvalid.push(agencesValidation());
		if(!isAllvalid.includes(false)){
			if(dateCompare(fields[2].value + ' ' + fields[3].value, fields[4].value + ' ' + fields[5].value)){
				const data = $(this).serialize();
				const categorieID = $('input[type="radio"]:checked').val();
				return loadCars(data, categorieID);
			}
			// if user select wrong dates
			$('.cars').html('');
			$('.categories').addClass('d-none');
			$('.nombre-voiture-trouve').remove();
			$('footer').addClass('d-none');
		}
	});

	// remove error messages
	$('select[id^="agence"], [id^="date"], [id^="heure"]').focus(function (event) {
		removeError($(this).attr('id'));
	});

	function dateCompare(dateD, dateR){
	    const dateDepart = new Date(dateD);
	    const dateRetour = new Date(dateR);
	    const now = new Date();

	    if(dateDepart >= dateRetour){
        	$('.date-retour-error').html('<i class="fa fa-exclamation-circle" aria-hidden="true"></i> la date de départ doit etre inférieur a la date de retour');
        	$('#date-retour').addClass('error');
        	$('#date-depart').addClass('error');
	        return false;
	    }

	    if(now >= dateDepart){
	    	$('.date-depart-error').html('<i class="fa fa-exclamation-circle" aria-hidden="true"></i> la date de départ doit etre superieur a maintenant');
        	$('#date-depart').addClass('error');
	        return false;
	    }

	    $('#date-retour').removeClass('error');
	    $('#date-depart').removeClass('error'); 
	    return true;
	}

	 
	$('[type="text"]').datepicker({
    	numberOfMonths: 2,
    	showButtonPanel: true,
    	minDate: 'dateToday',
    	dateFormat: 'yy-mm-dd',
    });
	
});