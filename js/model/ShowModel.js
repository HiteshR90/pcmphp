var ShowModel = Backbone.Model.extend({
	defaults : {
		"city" : '',
		"venue" : '',
		"detail" : '',
		"date" : '',
		"timeZone" : '',
		"cost":'',
		"link":'',
		"address":'',
		"contact":''
	},

	validate : function(attrs) {
		var errors = [];
		if (!attrs.city) {
			errors.push({
				field : 'city',
				message : 'Please enter city.'
			});
		}

		if (!attrs.venue) {
			errors.push({
				field : 'venue',
				message : 'Please enter venue.'
			});
		}

		if (!attrs.date) {
			errors.push({
				field : 'date',
				message : 'Please select date.'
			});
		}
		
		if (!attrs.timeZone) {
			errors.push({
				field : 'timezone',
				message : 'Please select TimeZone.'
			});
		} else if (attrs.timeZone == 0) {
			errors.push({
				field : 'timezone',
				message : 'Please select TimeZone.'
			});
		}

		return errors.length > 0 ? errors : false;

	}
});