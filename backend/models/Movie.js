const mongoose = require('mongoose');

const Schema = mongoose.Schema;

const MovieSchema = new Schema({
	title: {
		type: String,
		required: true,
		unique: true
	},
	release_date: {
		type: Date
	},
	theatres: [{
		theatre_id: {
			type:Schema.Types.ObjectId,
			ref: 'Theatre'
		}
	}]


});

module.exports = mongoose.model('Movie', MovieSchema);