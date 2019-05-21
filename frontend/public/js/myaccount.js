document.getElementById('btn-profile').addEventListener('click',function(){
	let profileEL = document.getElementById("profile-div");
	  if (profileEL.style.display === "none") {
	    profileEL.style.display = "block";
	  }

	  document.getElementById("transaction-div").style.display = "none";

});

document.getElementById('btn-transaction').addEventListener('click',function(){
	let transactionEL = document.getElementById("transaction-div");
	  if (transactionEL.style.display === "none") {
	    transactionEL.style.display = "block";
	  }

	  document.getElementById("profile-div").style.display = "none";

});

