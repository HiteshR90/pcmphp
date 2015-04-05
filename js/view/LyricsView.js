var LyricsView = Backbone.View
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
				var template = Handlebars.compile($("#lyrics_template").html());
				$(this.el).html(template());
				this.getLyricsList();
				$(document).foundation();
				var view = this;
				$('.save-update-lyrics').click(function() {
					var lyricsId = $('.save-update-lyrics').attr('lyrics-id');
					if (typeof lyricsId === "undefined") {
						view.saveLyrics();
					} else {
						view.updateLyrics(lyricsId);
					}
				});
			},
			events : {
				"click .add-new-lyrics" : "addNewLyrics",
				"click .edit-lyrics" : "editLyrics",
				"click .delete-lyrics" : "deleteLyrics"
			},
			updateLyrics : function(lyricsId) {
				var view = this;
				view.hideErrors();
				var baseUrl = this.model.get('baseUrl');
				//console.log($("#timezone option:selected").val());
				//alert(CKEDITOR.instances['lyricsContent'].getData());
				this.lyricsModel = new LyricsModel({
					"songname" : $("#song_names").val(),
					"songcontent" : CKEDITOR.instances['lyricsContent'].getData()
				});
				this.lyricsModel.url = 'update-lyrics.php?lyricsId='+lyricsId;
				if (!this.lyricsModel.isValid()) {
					view.showErrors(this.lyricsModel.validationError);
				} else {
					this.lyricsModel
							.save(
									{},
									{
										success : function(model, response) {
											view.resetForm();
											CKEDITOR.instances['lyricsContent'].destroy();
											$('#lyricsModal').foundation(
													'reveal', 'close');
											view.getLyricsList();
										},
										error : function(model, response) {
											if (response.status == 401) {
												view.callBackData.functionName = "updateLyrics";
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
												console.log(response);
											}
										}
									});
				}
			},
			resetForm : function() {
				this.hideErrors();
				$("#song_names").val('');
				$("#lyricsContent").val('');
			},
			saveLyrics : function() {
				var view = this;
				view.hideErrors();
				this.lyricsModel = new LyricsModel({
					"songname" : $("#song_names").val(),
					"songcontent" : CKEDITOR.instances['lyricsContent'].getData()
				});
				this.lyricsModel.url = 'add-lyrics.php';
				if (!this.lyricsModel.isValid()) {
					view.showErrors(this.lyricsModel.validationError);
				} else {
					this.lyricsModel
							.save(
									{},
									{
										success : function(model, response) {
											view.resetForm();
											CKEDITOR.instances['lyricsContent'].destroy();
											$('#lyricsModal').foundation(
													'reveal', 'close');
											view.getLyricsList();
										},
										error : function(model, response) {
											if (response.status == 401) {
												view.callBackData.functionName = "saveLyrics";
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
												console.log(response);
											}
										}
									});
				}
			},
			editLyrics : function(event) {
				var lyricsId = $(event.target).attr('lyrics-id');
				var view = this;
				$
						.ajax({
							url : 'edit-lyrics.php?lyricsId=' + lyricsId ,
							type : 'GET',
							dataType : 'json',
							success : function(response) {
								var saveUpdateLyrics = $('.save-update-lyrics');
								saveUpdateLyrics.attr("lyrics-id", lyricsId);
								view.resetForm();
								$("#song_names").val(response.songname);
								$("#lyricsContent").val(response.content);
								CKEDITOR.replace('lyricsContent');
								$('#lyricsModal').foundation('reveal', 'open');
							},
							error : function(error) {
								// console.log(error);
								if (error.status == 401) {
									view.callBackData.functionName = "editLyrics";
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
			deleteLyrics : function(event) {
				var lyricsId = $(event.target).attr('lyrics-id');
				var view = this;
				$
						.ajax({
							url : 'delete-lyrics.php?lyricsId=' + lyricsId,
							type : 'DELETE',
							dataType : 'json',
							success : function(response) {
								view.getLyricsList();
							},
							error : function(error) {
								// console.log(error);
								if (error.status == 401) {
									view.callBackData.functionName = "deleteLyrics";
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
			addNewLyrics : function() {
				//alert( CKEDITOR.instances.lyricsContent );
				
				   
				CKEDITOR.replace('lyricsContent');
				
				
				
				var view = this;
				var saveUpdateEvent = $('.save-update-lyrics');
				saveUpdateEvent.removeAttr("lyrics-id");
				view.resetForm();
				
				
				$('#lyricsModal').foundation('reveal', 'open');
			},
			getLyricsList : function() {
				var baseUrl = this.model.get('baseUrl');
				var view = this;
				$
						.ajax({
							url : "get-lyrics-list.php",
							type : "GET",
							success : function(response) {
								var showList = $('.lyrics-list');
								showList.empty();
								if (response != null && response.length > 0) {
									var table = $('<table></table>');
									var tableHead = $('<thead></thead>');
									tableHead.append('<tr><th>Track Name</th><th>edit</th><th>delete</th></tr>');
									var tableBody = $('<tbody></tbody>');
									$(response)
											.each(
													function(index, value) {
														var dataRow = $('<tr></tr>');
														var dataOne = $('<td>'
																+ value.title
																+ '</td>');
														var dataThree = $('<td><button class="radius delete modal edit-lyrics" lyrics-id="'
																+ value.id
																+ '">+</button></td>');
														var dataFour = $('<td><button class="radius delete edit delete-lyrics" lyrics-id="'
																+ value.id
																+ '">X</button></td>');
														dataRow.append(dataOne);
														dataRow
																.append(dataThree);
														dataRow
																.append(dataFour);
														tableBody
																.append(dataRow);
													});
									table.append(tableHead);
									table.append(tableBody);
									showList.append(table);
								} else {
									showList.append('<div class="error radius">Data not available</div>');
								}
							},
							error : function(error) {
								// console.log(error);
								if (error.status == 401) {
									view.callBackData.functionName = "getLyricsList";
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