const admin = require('../middlewares/admin');
const auth = require('../middlewares/auth');
const MovieModel = require('../models/Movie');
const TheatreModel = require('../models/Theatre');
const bcrypt = require('bcrypt');
const express = require('express');
const router = express.Router();

// SHOW ALL BRANCH
router.get('/', async (req, res) => {
	// Requesting users using (ASYNC/AWAIT)
	let theatres = await TheatreModel.find();
	res.send(theatres);
});

// SHOW ALL SCREEN
router.get('/:id/screen', async (req, res) => {	

	let theatre = await TheatreModel.findById(req.params.id);

	try{
		res.send(theatre.screens);
	}catch (ex){
		res.status(400).send("Provided data is invalid: " + ex.errmsg);
	}

});

// SHOW ALL SCHEDULE
router.get('/:id/schedule', async (req, res) => {	

	let theatre = await TheatreModel.findById(req.params.id);

	try{
		res.send(theatre.schedules);
	}catch (ex){
		res.status(400).send("Provided data is invalid: " + ex.errmsg);
	}

});

// SHOW ALL SEATS
router.get('/:id/seat', async (req, res) => {	

	let theatre = await TheatreModel.findById(req.params.id);

	try{
		res.send(theatre.seats);
	}catch (ex){
		res.status(400).send("Provided data is invalid: " + ex.errmsg);
	}

});

// SHOW ONE BRANCH
router.get('/:id', async (req, res) => {
	let theatre_id = req.params.id;

	if(theatre_id == 1){
		theatre	= { _id: theatre_id };
		res.send(theatre);
		
	}else{
	// Requesting users using (ASYNC/AWAIT)v
	let theatre = await TheatreModel.findById(theatre_id);
		
		res.send(theatre);
	}
});


// SHOW ONE SCREEN
router.get('/:t_id/screen/:s_id', async (req, res) => {
	let theatre_id = req.params.t_id;
	let screen_id = req.params.s_id;

	if(screen_id == 1){
		screen	= { _id: screen_id };
		res.send(screen);
		
	}else{
		
		let screen = await TheatreModel.findOne({_id: theatre_id}, (err, theatre) => {
			if (err) {
				console.log(err);
				res.status(400)
				res.json({
					success: false,
					err
				})
				res.end()
				return
			}
			// console.log(theatre.screens);

			let screen = theatre.screens.filter(function (screen) {
	    		return screen._id == screen_id;
	  		}).pop();

			res.send(screen);
	    	// theatre.screens.id(screen._id);
		});
		// console.log(screen);
	}
});


// STORE BRANCH
router.post('/', async (req, res) => {
	
	// Input Validations
	if(!req.body.branch) return res.status(400).send('Branch is required');
	if(!req.body.location) return res.status(400).send('Location is required');	

	let theatre = TheatreModel({
		branch: req.body.branch,
		location: req.body.location
	});

	// Insert Movie

	try{
		theatre = await theatre.save();
		res.send(theatre);
	}catch (ex){
		res.status(400).send("Provided data is invalid: " + ex.errmsg);
	}

});


// STORE SCREEN
router.post('/:id/screen', auth, async (req, res) => {	

	let theatre = await TheatreModel.findById(req.params.id);

	theatre.screens.push({
			screen_type: req.body.screen_type,
			price: req.body.price
	});

	try{
		theatre = await theatre.save();
		res.send(theatre);
	}catch (ex){
		res.status(400).send("Provided data is invalid: " + ex.errmsg);
	}

});

// STORE SCHEDULE
router.post('/:id/schedule', auth, async (req, res) => {	

	let theatre = await TheatreModel.findById(req.params.id);

	theatre.schedules.push({
		movie_id: req.body.movie_id,
		startdate: req.body.startdate,
		enddate:req.body.enddate,
		times: req.body.times,
		status: req.body.status

	});

	try{
		theatre = await theatre.save();
		res.send(theatre);
	}catch (ex){
		res.status(400).send("Provided data is invalid: " + ex.errmsg);
	}

});


// STORE SEAT
router.post('/:id/seat', auth, async (req, res) => {
	
	// Input Validations
	if(!req.body.position) return res.status(400).send('Screen type is required');
		

	let theatre = await TheatreModel.findById(req.params.id);

	theatre.seats.push({
			position: req.body.position,
			status: req.body.status
	});

	try{
		theatre = await theatre.save();
		res.send(theatre);
	}catch (ex){
		res.status(400).send("Provided data is invalid: " + ex.errmsg);
	}

});




// UPDATE BRANCH
router.put('/:id', [auth, admin], async (req, res) => {

	// return res.send(req.user);

	let theatre = await TheatreModel.findById(req.params.id);
		theatre.branch = req.body.branch;
		theatre.location = req.body.location;

	theatre = await theatre.save();
	res.send(theatre);
});

// UPDATE SCHEDULE
router.put('/:t_id/schedule/:s_id', [auth, admin], async (req, res) => {
	let theater_id = req.params.t_id;
	let schedule_id = req.params.s_id;

	try{
		let schedule = await TheatreModel.findOneAndUpdate(
	        {"_id": theater_id, "schedules._id": schedule_id }, 
	        {
	        	$set:{
		        	"schedules.$.movie_id": req.body.movie_id,
		        	"schedules.$.startdate": req.body.startdate,
		        	"schedules.$.enddate": req.body.enddate,
		        	"schedules.$.status": req.body.status
		        }
		    },
	        function(err, data){
	           if(err) return err;
	           res.send(data);
	    });
	}catch (ex){
		res.status(400).send("Provided data is invalid: " + ex.errmsg);
	}
    
});

// UPDATE SCREEN
router.put('/:b_id/screen/:s_id', [auth, admin], async (req, res) => {
	let branch_id = req.params.b_id;
	let screen_id = req.params.s_id;

	try{
		let screen = await TheatreModel.findOneAndUpdate(
	        {"_id": branch_id, "screens._id": screen_id }, 
	        {
	        	$set:{
		        	"screens.$.screen_type": req.body.screen_type,
		        	"screens.$.price": req.body.price
		        }
		    },
	        function(err, data){
	           if(err) return err;
	           res.send(data);
	    });
	}catch (ex){
		res.status(400).send("Provided data is invalid: " + ex.errmsg);
	}
    
});

// UPDATE SEAT
router.put('/:b_id/seat/:s_id', auth, async (req, res) => {
	let branch_id = req.params.b_id;
	let seat_id = req.params.s_id;

	try{
		let seat = await TheatreModel.findOneAndUpdate(
	        {"_id": branch_id, "seats._id": seat_id }, 
	        {
	        	$set:{
		        	"seats.$.status": req.body.status
		        }
		    },
	        function(err, data){
	           if(err) return err;
	           res.send(data);
	    });
	}catch (ex){
		res.status(400).send("Provided data is invalid: " + ex.errmsg);
	}
    
});

// DELETE BRANCH
router.delete('/:id', [auth, admin], async (req, res) => {
	let branch = await TheatreModel.findByIdAndRemove(req.params.id);
	
	res.send(branch);
});

// DELETE SCREEN
router.delete('/:b_id/screen/:s_id', [auth, admin], async (req, res) => {
	let branch_id = req.params.b_id;
	let screen_id = req.params.s_id;

	 TheatreModel.findOneAndUpdate(
        {_id: branch_id}, 
        {
        	$pull: {screens: {
        		_id: screen_id
	        	}
	        }
	    },
        function(err, data){
           if(err) return err;
           res.send(data);
    });
});

// DELETE SCHEDULE
router.delete('/:t_id/schedule/:s_id', [auth, admin], async (req, res) => {
	let theatre_id = req.params.t_id;
	let schedule_id = req.params.s_id;

	 TheatreModel.findOneAndUpdate(
        {_id: theatre_id}, 
        {
        	$pull: {schedules: {
        		_id: schedule_id
	        	}
	        }
	    },
        function(err, data){
           if(err) return err;
           res.send(data);
    });
});


// DELETE SEAT
router.delete('/:b_id/seat/:s_id', [auth, admin], async (req, res) => {
	let branch_id = req.params.b_id;
	let seat_id = req.params.s_id;

	 TheatreModel.findOneAndUpdate(
        {_id: branch_id}, 
        {
        	$pull: {seats: {
        		_id: seat_id
	        	}
	        }
	    },
        function(err, data){
           if(err) return err;
           res.send(data);
    });
});

// This is where we declare what server.js can access
module.exports = router;