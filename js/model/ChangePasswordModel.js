var ChangePasswordModel = Backbone.Model.extend({
	fileAttribute : 'attachment',
	defaults : {
		"newPassword" : '',
		"confirmPassword" : '',
		"currentPassword" : ''
	},
	validate : function(attrs) {
		var errors = [];
		if (!attrs.newPassword) {
			errors.push({
				field : 'newPassword',
				message : 'Please enter new password.'
			});
		}
		if (!attrs.confirmPassword) {
			errors.push({
				field : 'confirmPassword',
				message : 'Please enter confirm password.'
			});
		}
		if (!attrs.currentPassword) {
			errors.push({
				field : 'currentPassword',
				message : 'Please enter current password.'
			});
		}
		return errors.length > 0 ? errors : false;
	}
});