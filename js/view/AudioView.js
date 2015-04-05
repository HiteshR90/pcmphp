var AudioView = Backbone.View
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
				var template = Handlebars.compile($("#audio_template").html());
				$(this.el).html(template());
				this.getAudioList();
				$(document).foundation();

				var view = this;
				$('.save-audio').click(function() {
					view.saveAudio();
				});

				$('#audioFile').change(function() {
					var valid = view.checkExtension(this);
					if (valid)
						view.validateFileSize(this);
				});
			},
			events : {
				"click .add-audio" : "addAudio",
				"click .delete-audio" : "deleteAudio"
			},
			checkExtension : function(e) {
				var validFilesTypes = [ "mp3"];
				var file = e;
				var path = file.value;

				var ext = path
						.substring(path.lastIndexOf(".") + 1, path.length)
						.toLowerCase();
				var isValidFile = false;
				for (var i = 0; i < validFilesTypes.length; i++) {
					if (ext == validFilesTypes[i]) {
						isValidFile = true;
						break;
					}
				}
				if (!isValidFile) {
					e.value = null;
					alert("Invalid File. Unknown Extension Of Music File"
							+ "Valid extensions are:\n\n"
							+ validFilesTypes.join(", "));
				}
				return isValidFile;
			},
			validateFileSize : function(e) {
				/* global document: false */
				var file = e;
				var fileSize = file.files[0].size;
				var isValidFile = false;
				if (fileSize !== 0 && fileSize <= 25214400) {
					isValidFile = true;
				}
				if (!isValidFile) {
					e.value = null;
					alert("File Size Should be Greater than 0 and less than 25 mb");
				}
				return isValidFile;
			},
			resetForm : function() {
				this.hideErrors();
				$("#audioFile").val('');
			},
			addAudio : function() {
				var view = this;
				view.resetForm();
				$('#audiModal').foundation('reveal', 'open');
			},
			saveAudio : function() {
				var view = this;
				view.hideErrors();
				var baseUrl = this.model.get('baseUrl');

				var fileObject = $(':input[type="file"]')[0].files[0];
				
				
				
				this.audioModel = new AudioModel();
				this.audioModel.url = 'upload-audio.php';
				this.audioModel.set('attachment', fileObject);
				this.audioModel.set('trackName', $('#trackName').val());

				if (!this.audioModel.isValid()) {
					view.showErrors(this.audioModel.validationError);
				} else {
					this.audioModel
							.save(
									{},
									{
										success : function(model, response) {
											view.resetForm();
											$('#audiModal').foundation(
													'reveal', 'close');
											view.getAudioList();
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
											} else if (response.status == 409) {
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
			deleteAudio : function(event) {
				var audioId = $(event.target).attr('audio-id');
				var baseUrl = this.model.get('baseUrl');
				var view = this;
				$
						.ajax({
							url : 'delete-audio.php?id=' + audioId,
							type : 'DELETE',
							dataType : 'json',
							success : function(response) {
								view.getAudioList();
							},
							error : function(error) {
								// console.log(error);
								if (error.status == 401) {
									view.callBackData.functionName = "addNewShow";
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
			getAudioList : function() {
				var baseUrl = this.model.get('baseUrl');
				var view = this;
				$
						.ajax({
							url : "get-audio-list.php",
							type : "GET",
							success : function(response) {
								var audiList = $('.audio-list');
								audiList.empty();
								if (response != null && response.length > 0) {
									var table = $('<table></table>');
									var tableHead = $('<thead></thead>');
									tableHead
											.append('<tr><th>File</th><th>Track Name</th><th>delete</th></tr>');
									var tableBody = $('<tbody></tbody>');
									$(response)
											.each(
													function(index, value) {
														var dataRow = $('<tr></tr>');
														var dataOne = $('<td>'
																+ value.track_name
																+ '</td>');
														var dataTwo = $('<td>'
																+ value.file_name
																+ '</td>');
														var dataThree = $('<td><button class="radius delete delete-audio" audio-id="'
																+ value.id
																+ '">X</button></td>');
														dataRow.append(dataTwo);
														dataRow.append(dataOne);
														dataRow
																.append(dataThree);
														tableBody
																.append(dataRow);
													});
									table.append(tableHead);
									table.append(tableBody);
									audiList.append(table);
								} else {
									audiList.append('<div class="error radius">Data not available</div>');
								}
							},
							error : function(error) {
								// console.log(error);
								if (error.status == 401) {
									view.callBackData.functionName = "getAudioList";
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