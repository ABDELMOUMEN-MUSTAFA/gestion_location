function loadMesLocations() {
			$.ajax({
				type : 'GET',
				url : 'http://localhost/Gestion_Locations/location/getMesLocations', 
				beforeSend: function() {
					$('main').html(`<div class="spinner text-center mt-5"><div class="spinner-border text-white" role="status"><span class="visually-hidden">Loading...</span></div></div>`);
				}, 
				complete : function() {
					$('.spinner').remove();
				},
				success : function(data) {
					const mesLocations = JSON.parse(data);
					const now = new Date().getTime();
					let mesLocationContent = '';
					mesLocations.forEach(function(l) {
					const countDownDate = new Date(l.date_retour).getTime();
					mesLocationContent = mesLocationContent + `<div class="row">
						<div class="col">
							<div class="card mb-3">
							  <div class="row g-0">
							    <div class="col-md-3 d-flex justify-content-center">
							      <img
							        src="${l.photo}"
							        alt="image voiture"
							        class="img-fluid rounded-start car-image"
							      />
							    </div>
							    <div class="col-md-6">
							      <div class="card-body">
							        <h5 class="card-title">${l.titre} ( ${l.matricule} )</h5>
							        <div class="card-text">
							         	 <div class="d-flex flex-column flex-lg-row align-items-center gap-3 mb-3">
							        	<div class="d-flex gap-3">
							        		<span data-mdb-toggle="tooltip" title="Nombre de Passagers" class="d-flex gap-2 badge badge-danger align-items-center"><i class="fa fa-users"></i> <span>${l.nombre_passagers}</span></span>
							        		<span data-mdb-toggle="tooltip" title="Nombre de Portes" class="d-flex gap-2 badge badge-danger align-items-center"><i class="fa fa-car"></i> <span>${l.nombre_portes}</span></span>
							        		<span data-mdb-toggle="tooltip" title="Nombre de Valises" class="d-flex gap-2 badge badge-danger align-items-center"><i class="fa fa-suitcase"></i> <span>${l.nombre_valises}</span></span>
							        		<span data-mdb-toggle="tooltip" title="Boite de Vitesse ${l.boite_vitesses}" class="d-flex gap-2 badge badge-danger align-items-center"><i class="fa fa-map-pin"></i> <span>${l.boite_vitesses[0].toUpperCase()}</span></span>
							        	</div>
							        	<div class="d-flex gap-3">
							        		${l.climatisation ? '<span data-mdb-toggle="tooltip" title="Climatisation" class="d-flex gap-2 badge badge-danger align-items-center"><i class="fa far fa-snowflake"> </i><span>A/C</span></span>' : ''}
							        		<span data-mdb-toggle="tooltip" title="Carburant" class="d-flex gap-2 badge badge-danger align-items-center"><i class="fa-solid fa-gas-pump"></i><span>${l.type_carburant}</span></span>
						            		${l.gps_integre ? '<span data-mdb-toggle="tooltip" title="GPS Intégré" class="d-flex gap-2 badge badge-danger align-items-center"><i class="fa-solid fa-location-dot"></i><span>GPS</span></span>' : ''}
							        	</div>
							       	</div>
							       	</div>
							        <div class="card-text">
							          <ul class="list-unstyled">
							          	<li><i class="fa-solid fa-calendar-days me-2"></i>${l.date_depart} <strong>De</strong> ${l.agence_depart}</li>
							          	<li><i class="fa-solid fa-calendar-days me-2"></i>${l.date_retour} <strong>A</strong> ${l.agence_retour}</li>
							          </ul>
							        </div>
							      </div>
							    </div>
							    <div class="col-md-3">
							    	<div class="card-body">
							    		<p class="prix-total m-0 text-center bg-danger p-2 rounded-2 fw-bolder text-white">${l.prix} DH</p>
							    		${countDownDate > now ? `<p class="text-center fs-5 mt-3 mb-0">Temps Restant</p>` : ''}
							    		<span id="${l.id}" class="d-block text-center fs-5 ${countDownDate < now ? 'fw-bolder text-danger mt-4' : ''}  remaining-time">${countDownDate > now ? countDown(l.date_retour, l.id) : 'LOCATION EXPIRE'}</span>
							    	</div>
							    </div>
							  </div>
							</div>
						</div>
					</div>`;
				});

				$('main').html(mesLocationContent).hide().fadeIn(800);
				},
				fail : function() {
					$('main').html('Please try again soon !!!');
				}
			});
}


function countDown(remainingTime, locationID){
	// Set the date we're counting down to
	const countDownDate = new Date(remainingTime).getTime();
	const now = new Date().getTime();

	// Update the count down every 1 second
	const x = setInterval(function() {
		// Get today's date and time
		const now = new Date().getTime();
	    
		// Find the distance between now and the count down date
		const distance = countDownDate - now;
	    
		// Time calculations for days, hours, minutes and seconds
		const days = Math.floor(distance / (1000 * 60 * 60 * 24));
		const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
		const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
		const seconds = Math.floor((distance % (1000 * 60)) / 1000);
	    
		// Output the result in an element with id="remaining-time"
		$("#" + locationID).text(days + "J " + hours + "H "
		+ minutes + "M " + seconds + "S");

		// If the count down is over, write some text 
		if (distance < 0) {
			clearInterval(x);
			const $remainingTime = $("#" + locationID);
			$remainingTime.text("LOCATION EXPIRE");
			$remainingTime.addClass('fw-bolder text-danger mt-4');
			$remainingTime.prev().fadeOut();
		}
	}, 1000);

	return '';
}


loadMesLocations();