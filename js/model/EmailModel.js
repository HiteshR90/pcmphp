var EmailModel = Backbone.Model.extend({
	fileAttribute : 'attachment',
	defaults : {
		"email" : ''
	},
	validate : function(attrs) {
		var errors = [];
		if (!attrs.email) {
			errors.push({
				field : 'email',
				message : 'Please enter email.'
			});
		}
		return errors.length > 0 ? errors : false;
	}
});