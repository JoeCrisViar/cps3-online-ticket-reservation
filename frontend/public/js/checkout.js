document.getElementById('inputGroupSelectBranch').addEventListener('change',function(){
		
		let s = document.getElementsByName('branch')[0];

		let theatre_id = s.options[s.selectedIndex].value;

		let movie_id = document.getElementById('inputMovieId').value;

		let url ='/checkout/' + theatre_id + '/movie/' + movie_id + '/screen/' + 1;
		// console.log("URL 1: " + url);
		// let url = 'http://localhost:3000/api/theatres/' + theatre_id + '/schedule';
	
		let form = document.createElement('form');

	    document.body.appendChild(form);
	    
	    form.method = 'get';
	    
	    form.action = url;
	    
	    form.submit();
		
		
});

document.getElementById('inputGroupSelectScreen').addEventListener('change',function(){
		
		let b = document.getElementsByName('branch')[0];

		let theatre_id = b.options[b.selectedIndex].value;

		 	// console.log("Theatre ID: " + theatre_id);
		
		let movie_id = document.getElementById('inputMovieId').value;
			console.log("Movie ID: " + movie_id);

		let s = document.getElementsByName('screen_type')[0];

		let screen_id = s.options[s.selectedIndex].value;

			// console.log("Screen ID: " + screen_id);	

		let url ='/checkout/' + theatre_id + '/movie/' + movie_id + '/screen/' + screen_id;
		
		// console.log("URL 2: " + url);
		// let url = 'http://localhost:3000/api/theatres/' + theatre_id + '/schedule';
	
		let form = document.createElement('form');

	    document.body.appendChild(form);
	    
	    form.method = 'get';
	    
	    form.action = url;
	    
	    form.submit();
		
		
});


document.getElementById('inputGroupSelectDate').addEventListener('change',function(){
	 let timeEL = document.getElementById("timeDiv");
	  if (timeEL.style.display === "none") {
	    timeEL.style.display = "inline-block";
	  }
	  // console.log(this.value);
	 let screeningEl = document.getElementById('screeningDate2');
	 
	 screeningEl.innerHTML = this.value;

	 document.getElementById('screeningDate3').innerHTML = this.value;

	 document.getElementById('screeningDateHidden').value = this.value;
});


document.getElementById('inputGroupSelectTime').addEventListener('change',function(){
	// console.log(this.value);
	let screeningEl = document.getElementById('screeningTime2');
	
	screeningEl.innerHTML = this.value;

	document.getElementById('screeningTime3').innerHTML = this.value;

	document.getElementById('screeningTimeHidden').value = this.value;

	let seatEL = document.getElementById("seatDiv");
		if (seatEL.style.display === "none") {
	    seatEL.style.display = "inline-block";
	 	}

	let summaryEL = document.getElementById("summaryDiv");
		if (summaryEL.style.display === "none") {
    	summaryEL.style.display = "inline-block";
  		}
	
	  let seatCount = document.getElementById("seatCount").innerHTML;

	  let seatId = [];

	  let selectedSeats = [];

	  // console.log(selectedSeats.length);
	for (let i = 1; i <= seatCount; i++) {
			
		seatId[i] = document.getElementById("seatPosition" + i).value;

		let seat = document.getElementById("seatPosition" + i);
		// console.log(seat);
		seat.addEventListener('change',function(){
			

			if(this.checked) {
	        	for (let i = 1; i <= seatId.length; i++) {
	        		
					if (seatId[i] == this.value) {

						selectedSeats.push(this.value);

						document.getElementById("selectedSeats").innerHTML += "<span class = seat" + i + ">S(" + i + "),</span>";

						document.getElementById('selectedSeats3').innerHTML += "<span class = seat" + i + ">S(" + i + "),</span>";							
							
						document.getElementById('selectedSeatsHidden').innerHTML += "<input class = seat" + i + " type='checkbox' name='seats[]'' value=" + this.value + " checked hidden>";
						console.log(document.getElementById('selectedSeatsHidden'));

						let ticketQuantity = document.getElementById("noOfSeats").innerHTML = selectedSeats.length;

							let ticketQuantityModal	= document.getElementById("noOfSeats3").innerHTML = ticketQuantity;
							
							document.getElementById("noOfSeatsHidden").value = ticketQuantity;

						let ticketPrice = document.getElementById("ticketPrice").innerHTML;
						
							let ticketPriceModal =	document.getElementById("ticketPrice3").innerHTML = ticketPrice;
						
							document.getElementById("ticketPriceHidden").value = ticketPrice;

						let onlineFee = parseInt(document.getElementById("onlineFee").innerHTML);
						
							let onlineFeeModal = document.getElementById("onlineFee3").innerHTML = onlineFee;
						
							document.getElementById("onlineFeeHidden").value = onlineFee;

						let totalPrice = document.getElementById("totalPrice").innerHTML = ((ticketQuantity * ticketPrice) + onlineFee);
						
							let totalPriceModal = document.getElementById("totalPrice3").innerHTML = totalPrice;
					
							document.getElementById("totalPriceHidden").value = totalPrice;
					}	        		

	        		// console.log(seatId[i]);
	        	}
	        	// console.log(this.value);
		    } else {
		        for (let i = 1; i <= seatId.length; i++) {
		        	
					if (seatId[i] == this.value) {
						// -= ["S(" + i + "), "]
						let selectedSeatCount = document.getElementsByClassName("seat" + i).length;
						// console.log(selectedSeatCount);
						selectedSeatCount -=1;
						// console.log(selectedSeatCount);
						// console.log(document.querySelectorAll(".seat" + i));
						// console.log(document.querySelectorAll(".seat" + i)[0]);
						let seatClassEl = document.querySelectorAll(".seat" + i);
						
						for (let x = 0; x <= selectedSeatCount; x++) {
							seatClassEl[x].remove();
						}
						
						// console.log(selectedSeats);
						let index = selectedSeats.indexOf(this.value);

						if (index > -1) {

						  selectedSeats.splice(index, 1);

						}
						document.getElementById("noOfSeats").innerHTML = selectedSeats.length;
						
						document.getElementById("noOfSeats3").innerHTML = selectedSeats.length;
						// console.log(selectedSeats);
					}	        		
	        	}
		    }

		    // console.log(selectedSeats.length);
		});
	}	



	document.getElementById('inputGroupSelectPayment').addEventListener('change',function(){
	 let btnEL = document.getElementById("confirmTicket");
	  if (btnEL.style.display === "none") {
	    btnEL.style.display = "inline-block";
	  }
	  // console.log(this.value);
	 
	 document.getElementById('payment3').innerHTML = this.value;

	 document.getElementById('paymentHidden').value = this.value;

	});
});

document.getElementById('confirmTicket').addEventListener('click',function(){

/*CHECKING*/
this.dataset.target = "#confirmTicketModal";
this.click();

});

document.getElementById('submitForm').addEventListener('click',function(){

alert("Please login first to continue");


});