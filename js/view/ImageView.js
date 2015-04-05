var ImageView = Backbone.View
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
				var template = Handlebars.compile($("#image_template").html());
				$(this.el).html(template());
				this.getImageList();
				$(document).foundation();

				var view = this;
				$('.save-image').click(function() {
					view.saveImage();
				});
			},
			events : {
				"click .add-image" : "addImage",
				"click .delete-image" : "deleteImage"
			},
			resetForm : function() {
				this.hideErrors();
			},
			addImage : function() {
				var view = this;
				// view.resetForm();
				$('#imageModal').foundation('reveal', 'open');
			},
			saveImage : function() {
				var view = this;
				view.hideErrors();
				var baseUrl = this.model.get('baseUrl');

				var fileObject = $(':input[type="file"]')[0].files[0];
				// console.log(fileObject);

				/*
				 * this.audioModel = new AudioModel({ "name" :
				 * $(".song-name").val(), "file" : fileObject });
				 */
				var ImageModel = Backbone.Model.extend({
					url : 'upload-image.php',
					fileAttribute : 'attachment'
				});
				this.imageModel = new ImageModel();
				this.imageModel.set('attachment', fileObject);
				if (!this.imageModel.isValid()) {
					view.showErrors(this.imageModel.validationError);
				} else {
					this.imageModel
							.save(
									{},
									{
										success : function(model, response) {
											view.resetForm();
											$('#imageModal').foundation(
													'reveal', 'close');
											view.getImageList();
										},
										error : function(model, response) {
											if (response.status == 401) {
												view.callBackData.functionName = "saveImage";
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
											}else if (response.status == 409) {
												var commonError = $('.commonError');
												commonError.addClass('error');
												commonError
														.find('.help-inline')
														.text(
																response.responseJSON.errorMessage);
											} else if (response) {
												console.log(response);
											}
										}
									});
				}
			},
			deleteImage : function(event) {
				var imageId = $(event.target).attr('image-id');
				var baseUrl = this.model.get('baseUrl');
				var view = this;
				$
						.ajax({
							url : 'delete-image.php?id='+imageId,
							type : 'DELETE',
							dataType : 'json',
							success : function(response) {
								view.getImageList();
							},
							error : function(error) {
								// console.log(error);
								if (error.status == 401) {
									view.callBackData.functionName = "deleteImage";
									this.loginModel = new LoginPopupModel({
										"baseUrl" : baseUrl
									});
									this.loginView = new LoginPopupView({
										model : this.loginModel
									});
									view.loginWindow.empty();
									view.loginWindow.append(this.loginView
											.render().el);
									view.loginWindow.foundation('reveal',
											'open');
								}
							}
						});
			},
			getImageList : function() {
				var baseUrl = this.model.get('baseUrl');
				var view = this;
				$
						.ajax({
							url : "get-image-list.php",
							type : "GET",
							success : function(response) {
								var imageList = $('.image-list');
								imageList.empty();
								if (response != null && response.length > 0) {
									var ulList = $('<ul class="small-block-grid-2 medium-block-grid-3 large-block-grid-5 admin-photos"></ul>');
									$(response)
											.each(
													function(index, value) {
														ulList
																.append('<li><img src="../resources/images/'
																		+ value.name
																		+ '"><br><button class="right radius delete delete-image" image-id="'
																		+ value.id
																		+ '">Delete</button></li>');
													});
									imageList.append(ulList);
								} else {
									imageList.append('<div class="error radius">Data not available</div>');
								}
							},
							error : function(error) {
								// console.log(error);
								if (error.status == 401) {
									view.callBackData.functionName = "getImageList";
									this.loginModel = new LoginPopupModel({
										"baseUrl" : baseUrl
									});
									this.loginView = new LoginPopupView({
										model : this.loginModel
									});
									view.loginWindow.empty();
									view.loginWindow.append(this.loginView
											.render().el);
									view.loginWindow.foundation('reveal',
											'open');
								}
							}
						});
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