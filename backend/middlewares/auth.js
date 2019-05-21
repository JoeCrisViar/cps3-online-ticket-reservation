const config = require('../config');
const jwt = require('jsonwebtoken');

module.exports = function (req, res, next){
	const token = req.header("x-auth-token");
	
	// Checking if there is token recieved
	if (!token) return res.status(401).send('Access Denied. No token provided.');
	
	try {
		// Synchrous Operation ( no need for await/async)
		let payload = jwt.verify(token, config.secret);
		req.user = payload;
		next();

	} catch (ex){
		res.status(400).send("Invalid token");
	}
}