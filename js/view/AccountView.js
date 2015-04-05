var AccountView = Backbone.View.extend({
	el : $('.content'),
	callBackData : {
		functionName : null
	},
	initialize : function() {
		return this.loginWindow = $("#modal1"), this.loginWindow.on("authed",
				function(e) {
					return function() {
						return e.checkIfSubmitForm()
					}
				}(this)), this.listenTo(this.model, "change", this.render);
	},
	render : function() {
		var template = Handlebars.compile($("#account_template").html());
		$(this.el).html(template());
		$(document).foundation();
	},
	events : {
		"click .change-password" : "changePassword",
		"click .delete-audio" : "deleteAudio"
	},
	resetForm : function() {
		$('#newPassword').val('');
		$('#confirmPassword').val('');
		$('#currentPassword').val('');
	},
	changePassword : function() {
		var view = this;
		view.hideErrors();
		var baseUrl = this.model.get('baseUrl');

		this.changePasswordModel = new ChangePasswordModel({
			"newPassword" : $('#newPassword').val(),
			"confirmPassword" : $('#confirmPassword').val(),
			"currentPassword" : $('#currentPassword').val()
		});

		this.changePasswordModel.url = baseUrl + '/change-password.json';

		if (!this.changePasswordModel.isValid()) {
			view.showErrors(this.changePasswordModel.validationError);
		} else {
			this.changePasswordModel.save({}, {
				success : function(model, response) {
					view.resetForm();
					$("#successMSG").find('.help-inline').text(response.message);
				},
				error : function(model, response) {
					if (response.status == 401) {
						view.callBackData.functionName = "changePassword";
						this.loginModel = new LoginPopupModel({
							"baseUrl" : baseUrl
						});
						this.loginView = new LoginPopupView({
							model : this.loginModel
						});
						view.loginWindow.empty();
						view.loginWindow.append(this.loginView.render().el);
						view.loginWindow.foundation('reveal', 'open');
					} else if (response.status == 400) {
						view.showErrors(response.responseJSON.errors);
					} else if (response) {
						console.log(response);
					}
				}
			});
		}
	},
	showErrors : function(errors) {
		_.each(errors, function(error) {
			var controlGroup = $('.' + error.field + 'Error');
			controlGroup.addClass('error');
			controlGroup.find('.help-inline').text(error.message);
		}, this);
	},
	hideErrors : function() {
		$('.control-group').removeClass('error');
		$('.help-inline').text('');
	},
	checkIfSubmitForm : function(e) {
		this.loginWindow.foundation('reveal', 'close');
		if (this.callBackData.functionName == "profileData") {
			this.callBackData.functionName = null;
			this.profileData();
		} else if (this.callBackData.functionName == "changePassword") {
			this.callBackData.functionName = null;
			this.changePassword();
		} else if (this.callBackData.functionName == "saveProfile") {
			this.callBackData.functionName = null;
			this.saveProfile();
		} else if (this.callBackData.functionName == "updatePaypal") {
			this.callBackData.functionName = null;
			this.updatePaypal();
		} else if (this.callBackData.functionName == "updateBank") {
			this.callBackData.functionName = null;
			this.updateBank();
		} else if (this.callBackData.functionName == "myPurchase") {
			this.callBackData.functionName = null;
			this.myPurchase();
		} else if (this.callBackData.functionName == "hotelSearch") {
			this.callBackData.functionName = null;
			this.hotelSearch();
		}
	}
});