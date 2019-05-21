document.getElementById('inputGroupMovie').addEventListener('change',function(){
		let s = document.getElementsByName('movie_id')[0];

		let movie_id = s.options[s.selectedIndex].value;

		let theatre_id = document.getElementById('inputTheatreId').value;
	
		let url ='/theatres/' + theatre_id + '/schedule/create/' + movie_id;
	
		let form = document.createElement('form');
	    document.body.appendChild(form);
	    form.method = 'get';
	    form.action = url;
	    
	    form.submit();
		
		
});