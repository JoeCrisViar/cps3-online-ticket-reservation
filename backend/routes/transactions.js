const admin = require('../middlewares/admin');
const auth = require('../middlewares/auth');
const TransactionModel = require('../models/Transaction');
const bcrypt = require('bcrypt');
const express = require('express');
const router = express.Router();

// SHOW ALL TRANSACTION
router.get('/', async (req, res) => {
	// Requesting users using (ASYNC/AWAIT)
	let transactions = await TransactionModel.find();
	res.send(transactions);
});

// SHOW ONE TRANSACTION by user_id
router.get('/:user_id', async (req, res) => {
	let user_id = req.params.user_id;

	
	// Requesting users using (ASYNC/AWAIT)v
	let transaction = await TransactionModel.find({buyer_id: user_id});
		
	res.send(transaction);
	
});


// SAVE TRANSACTION 
router.post('/', auth, async (req, res) => {
	
	// Input Validations
	// if(!req.body.email) return res.status(400).send('Email is required');
	// if(!req.body.password) return res.status(400).send('Password is required');

	let transaction = TransactionModel({

		transaction_code: req.body.transaction_code,

		buyer_id: req.body.buyer_id,

		buyer_name: req.body.buyer_name,

		theatre_id: req.body.theatre_id,

		branch: req.body.branch,

		screen_id: req.body.screen_id,

		movie_id: req.body.movie_id,

		movie_title: req.body.movie_title,

		screen_type: req.body.screen_type,

		screening_date: req.body.screening_date,

		screening_time: req.body.screening_time,

		online_fee: req.body.online_fee,

		no_of_seats: req.body.no_of_seats,

		payment_type: req.body.payment_type
	});

	try{
		transaction = await transaction.save();
		res.send(transaction);
	}catch (ex){
		res.status(400).send("Provided data is invalid: " + ex.errmsg);
	}

});

// STORE TRANSACTION SEAT
router.post('/:id/seat', auth, async (req, res) => {
	
	// Input Validations
	// if(!req.body.position) return res.status(400).send('Screen type is required');
		

	let transaction = await TransactionModel.findById(req.params.id);

	transaction.seats.push({
		seat_id: req.body.seat_id,
		ticket: req.body.ticket
	});

	try{
		transaction = await transaction.save();
		res.send(transaction);
	}catch (ex){
		res.status(400).send("Provided data is invalid: " + ex.errmsg);
	}

});


// // UPDATE SEAT STATUS
// router.put('/:t_id/seat/:s_id', auth, async (req, res) => {
// 	let transaction_id = req.params.t_id;
// 	let seat_id = req.params.s_id;

// 	try{
// 		let schedule = await TransactionModel.findOneAndUpdate(
// 	        {"_id": transaction_id, "seats._id": seat_id }, 
// 	        {
// 	        	$set:{
// 		        	"seats.$.status": req.body.status
// 		        }
// 		    },
// 	        function(err, data){
// 	           if(err) return err;
// 	           res.send(data);
// 	    });
// 	}catch (ex){
// 		res.status(400).send("Provided data is invalid: " + ex.errmsg);
// 	}
    
// });


// This is where we declare what server.js can access
module.exports = router;