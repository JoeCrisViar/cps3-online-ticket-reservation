const admin = require('../middlewares/admin');
const auth = require('../middlewares/auth');
const UserModel = require('../models/User');
const bcrypt = require('bcrypt');
const express = require('express');
const router = express.Router();

// SHOW ALL
router.get('/', async (req, res) => {
	// Requesting users using (ASYNC/AWAIT)
	let users = await UserModel.find().select('-password');
	res.send(users);
});

// SHOW ONE
router.get('/:id', async (req, res) => {

	// Requesting users using (ASYNC/AWAIT)
	let users = await UserModel.findById(req.params.id);
	res.send(users);
});

// INSERT 
router.post('/', async (req, res) => {
	
	// Input Validations
	if(!req.body.email) return res.status(400).send('Email is required');
	if(!req.body.password) return res.status(400).send('Password is required');

	let user = UserModel({
		firstname: req.body.firstname,
		lastname: req.body.lastname,
		email: req.body.email,
		isActive: true
	});

	// Password Encryption (ASYNC/AWAIT)
	let salt = await bcrypt.genSalt(10);
	let hashed = await bcrypt.hash(req.body.password, salt);
	user.password = hashed;

	try{
		user = await user.save();
		res.send(user);
	}catch (ex){
		res.status(400).send("Provided data is invalid: " + ex.errmsg);
	}

});

// UPDATE
router.put('/:id', auth, async (req, res) => {

	// return res.send(req.user);

	let user = await UserModel.findById(req.params.id);
	user.firstname = req.body.firstname;
	user.lastname = req.body.lastname;
	user.email = req.body.email;

	user = await user.save();
	res.send(user);
});


// UPDATE PASSWORD
router.put('/:id/change_password', auth, async (req, res) => {

	let user = await UserModel.findOne({ "email": req.body.email });

	if(!user) return res.status(400).send('Please re-login!');

	let matched = await bcrypt.compare(req.body.oldPassword, user.password);

	if(!matched) return res.status(400).send('Password is incorrect');
	
	// Hashing new password
	let salt = await bcrypt.genSalt(10);
	
	let hashed = await bcrypt.hash(req.body.newPassword, salt);
	
	user.password = hashed;

	user = await user.save();

	res.send(user);
});
// DELETE
router.delete('/:id', [auth, admin], async (req, res) => {
	let user = await UserModel.findByIdAndRemove(req.params.id);
	
	res.send(user);
});

// This is where we declare what server.js can access
module.exports = router;