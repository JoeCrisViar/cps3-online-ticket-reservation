// Configs includes
const config = require('../config');
const jwt = require('jsonwebtoken');
const UserModel = require('../models/User');
const bcrypt = require('bcrypt');
const express = require('express');
const router = express.Router();

router.post('/', async (req, res) => {
	let user = await UserModel.findOne({ "email": req.body.email });

	if(!user) return res.status(400).send('Email or Password is incorrect');

	let matched = await bcrypt.compare(req.body.password, user.password);

	if(!matched) return res.status(400).send('Email or Password is incorrect');

	// Creating TOKEN
	const token = jwt.sign({ _id: user._id, firstname: user.firstname, lastname: user.lastname, isAdmin: user.isAdmin }, config.secret);

	res.header('x-auth-token', token).send(user);
});

module.exports = router;