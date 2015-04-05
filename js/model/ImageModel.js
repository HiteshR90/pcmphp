var AudioModel = Backbone.Model.extend({
	defaults : {
		"name" : '',
		"file" : ''
	},

	validate : function(attrs) {
		var errors = [];
		if (!attrs.name) {
			errors.push({
				field : 'name',
				message : 'Please enter name.'
			});
		}

		return errors.length > 0 ? errors : false;
	}
});