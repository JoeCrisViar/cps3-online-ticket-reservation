const mongoose = require('mongoose');

const Schema = mongoose.Schema;

const TheatreSchema = new Schema({
		branch: {
			type: String,
			required: true,
			unique: true
		},
		location: {
			type: String,
			required: true
		},
		screens: [{
			screen_type: {
				type: String /*e.g C1: THX, Dolby Digital, DTS, VIP*/
 			},
			price: { 
				type: Number
			}

		}], 
		schedules: [{
			movie_id:{
				type: Schema.Types.ObjectId,
				ref: 'Movie'
			},
			startdate: String,
			enddate: String,
			times:[String],
			status: {
				type: String,
				default: "Coming Soon" /*Showing, Coming Soon, Not Available*/
			}
		}],
		seats: [{
				position: Number,
				status: Boolean, /* reserved / available */
			}]

});

module.exports = mongoose.model('Theatre', TheatreSchema);