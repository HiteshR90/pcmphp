var AudioModel = Backbone.Model.extend({
	fileAttribute : 'attachment',
	defaults : {
		"attachment" : '',
		"trackName":''
	},
	validate : function(attrs) {
		var errors = [];
		if (!attrs.attachment) {
			errors.push({
				field : 'attachment',
				message : 'Please select file.'
			});
		}
		if (!attrs.trackName) {
			errors.push({
				field : 'trackName',
				message : 'Please enter trackname.'
			});
		}
		return errors.length > 0 ? errors : false;
	}
});