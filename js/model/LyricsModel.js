var LyricsModel = Backbone.Model.extend({
	defaults : {
		"songname" : '',
		"songcontent" : ''
	},

	validate : function(attrs) {
		var errors = [];
		if (!attrs.songname) {
			errors.push({
				field : 'songname',
				message : 'Please enter city.'
			});
		}

		if (!attrs.songcontent) {
			errors.push({
				field : 'songcontent',
				message : 'Please enter venue.'
			});
		}

		return errors.length > 0 ? errors : false;

	}
});