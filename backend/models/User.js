const mongoose = require('mongoose');

const Schema = mongoose.Schema;

const UserSchema = new Schema({
	firstname: String,
	lastname: String,
	email: {
		type: String,
		required: true,
		unique: true
	},
	isActive: {
		type: Boolean,
		default: false
	},
	password: {
		type: String,
		required: true
	},
	isAdmin: {
		type: Boolean,
		default: false
	},
	permission: [String]
});


module.exports = mongoose.model('User', UserSchema);