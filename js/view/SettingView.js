var SettingView = Backbone.View
		.extend({
			el : $('.content'),
			callBackData : {
				functionName : null
			},
			initialize : function() {
				return this.loginWindow = $("#modal1"), this.loginWindow.on(
						"authed", function(e) {
							return function() {
								return e.checkIfSubmitForm()
							}
						}(this)), this.listenTo(this.model, "change",
						this.render);
			},
			render : function() {
				var template = Handlebars.compile($("#setting_template").html());
				$(this.el).html(template());
				//this.getAudioList();
				$(document).foundation();
			},
			events : {
				"click .change-password" : "changePassword",
				"click .update-email" : "updateEmail"
			},
			resetForm : function() {
				this.hideErrors();
				$("#new_password").val('');
				$("#confirm_password").val('');
				$("#current_password").val('');
			},
			changePassword : function() {
				var view = this;
				view.hideErrors();
				var baseUrl = this.model.get('baseUrl');
				this.changePasswordModel = new ChangePasswordModel({
					"newPassword" : $("#new_password").val(),
					"confirmPassword" : $("#confirm_password").val(),
					"currentPassword" : $("#current_password").val()
				});
				this.changePasswordModel.url = 'change-password.php';
				if (!this.changePasswordModel.isValid()) {
					console.log(this.changePasswordModel.validationError);
					view.showErrors(this.changePasswordModel.validationError);
				} else {
					this.changePasswordModel
							.save(
									{},
									{
										success : function(model, response) {
											view.resetForm();
											$('.changePasswordSuccess').find('.help-inline').text(response.message);
											console.log(response);
										},
										error : function(model, response) {
											if (response.status == 401) {
												view.callBackData.functionName = "savePreferenceFirst";
												this.loginModel = new LoginPopupModel(
														{
															"baseUrl" : baseUrl
														});
												this.loginView = new LoginPopupView(
														{
															model : this.loginModel
														});
												view.loginWindow.empty();
												view.loginWindow
														.append(this.loginView
																.render().el);
												view.loginWindow.foundation(
														'reveal', 'open');
											} else if (response) {
												$('.changePasswordError').find('.help-inline').text(response.responseJSON['errorMessage']);
												console.log(response);
											}
										}
									});
				}
			},
			updateEmail : function() {
				alert($("#email").val());
				var view = this;
				view.hideErrors();
				var baseUrl = this.model.get('baseUrl');
				this.emailModel = new EmailModel({
					"email" : $("#email").val()
				});
				this.emailModel.url = 'change-email.php';
				if (!this.emailModel.isValid()) {
					view.showErrors(this.emailModel.validationError);
				} else {
					this.emailModel
							.save(
									{},
									{
										success : function(model, response) {
											$('.emailSuccess').find('.help-inline').text(response.message);
											console.log(response);
										},
										error : function(model, response) {
											if (response.status == 401) {
												view.callBackData.functionName = "savePreferenceFirst";
												this.loginModel = new LoginPopupModel(
														{
															"baseUrl" : baseUrl
														});
												this.loginView = new LoginPopupView(
														{
															model : this.loginModel
														});
												view.loginWindow.empty();
												view.loginWindow
														.append(this.loginView
																.render().el);
												view.loginWindow.foundation(
														'reveal', 'open');
											} else if (response) {
												$('.emailError').find('.help-inline').text(response.responseJSON['errorMessage']);
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