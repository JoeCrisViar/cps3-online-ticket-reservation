const mongoose = require('mongoose');

const Schema = mongoose.Schema;
const TheatreSchema = require('./Theatre');
const MovieSchema = require('./Movie');
const UserSchema = require('./User');

const TransactionSchema = new Schema({
	transaction_code: {
		type: String,
		unique: true,
		default:''
	},
	buyer_id: {
		type:Schema.Types.ObjectId,
		ref: 'User'
	},

	buyer_name: String,
	theatre_id: {
		type:Schema.Types.ObjectId,
		ref: 'Theatre'
	},
	branch: String,
	screen_id: {
		type:Schema.Types.ObjectId,
		ref: 'Theatre._id'
	},
	movie_id: {
		type:Schema.Types.ObjectId,
		ref: 'Movie'
	},
	movie_title: String,
	screen_type: String,
	screening_date: String,
	screening_time: String,
	online_fee: Number,
	no_of_seats: Number,
	payment_type: String,
	seats:[{
		seat_id: Schema.Types.ObjectId,
		ticket: {
			type: String,
			default: ''
		}

	}]
}, { timestamps: { createdAt: 'created_at' } });

module.exports = mongoose.model('Transaction', TransactionSchema);
