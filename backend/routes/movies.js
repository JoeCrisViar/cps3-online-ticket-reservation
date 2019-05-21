const admin = require('../middlewares/admin');
const auth = require('../middlewares/auth');
const MovieModel = require('../models/Movie');
const bcrypt = require('bcrypt');
const express = require('express');
const router = express.Router();

// SHOW ALL
router.get('/', async (req, res) => {
	// Requesting users using (ASYNC/AWAIT)
	let movies = await MovieModel.find();
	res.send(movies);
});

// SHOW ONE
router.get('/:id', async (req, res) => {

	// Requesting users using (ASYNC/AWAIT)
	let movies = await MovieModel.findById(req.params.id);
	res.send(movies);
});

// INSERT 
router.post('/', async (req, res) => {
	
	// Input Validations
	if(!req.body.title) return res.status(400).send('Title is required');
	if(!req.body.release_date) return res.status(400).send('Release date is required');

	let movie = MovieModel({
		title: req.body.title,
		release_date: req.body.release_date
	});

	try{
		movie = await movie.save();
		res.send(movie);
	}catch (ex){
		res.status(400).send("Provided data is invalid: " + ex.errmsg);
	}

});

// UPDATE
router.put('/:id', auth, async (req, res) => {

	// return res.send(req.user);

	let movie = await MovieModel.findById(req.params.id);
	movie.title = req.body.title;
	movie.release_date = req.body.release_date;

	movie = await movie.save();
	res.send(movie);
});

// DELETE
router.delete('/:id', [auth, admin], async (req, res) => {
	let movie = await MovieModel.findByIdAndRemove(req.params.id);
	
	res.send(movie);
});

router.post('/:id/theatre', auth, async (req, res) => {	

	let movie = await MovieModel.findById(req.params.id);
	
	try{

		movie.theatres.push({
			theatre_id: req.body.theatre_id
		});

		movie = await movie.save();
		console.log(movie);
		res.send(movie);

	}catch (ex){
		res.status(400).send("Provided data is invalid: " + ex.errmsg);
	}

});
// This is where we declare what server.js can access
module.exports = router;