var ShowView = Backbone.View
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
				var template = Handlebars.compile($("#show_template").html());
				$(this.el).html(template());
				// this.getTimeZone();
				this.getActiveShow();
				this.getTimeZone();
				$(document).foundation();
				var view = this;
				$('.save-update-event').click(function() {
					var showId = $('.save-update-event').attr('show-id');
					if (typeof showId === "undefined") {
						view.saveEvent();
					} else {
						view.updateEvent(showId);
					}
				});

				$('#date').datetimepicker({
					dayOfWeekStart : 1,
					lang : 'en',
					minDate : 0,
					format : 'm/d/Y H:i',
					mask : '19/39/9999 29:59',
					allowBlank : true
				});
			},
			events : {
				"click .add-new-show" : "addNewShow",
				"click .edit-show" : "editShow",
				"click .delete-show" : "deleteShow"
			},
			updateEvent : function(showId) {
				var view = this;
				view.hideErrors();
				var baseUrl = this.model.get('baseUrl');
				//console.log($("#timezone option:selected").val());
				this.showModel = new ShowModel({
					"city" : $("#city").val(),
					"venue" : $("#venue").val(),
					"detail" : $("#detail").val(),
					"date" : $("#date").val(),
					"timeZone" : $("#timezone").val(),
					"cost" : $("#cost").val(),
					"link" : $("#link").val(),
					"address" : $("#address").val(),
					"contact" : $("#contactNo").val()
				});
				this.showModel.url = 'update-show.php?showId='+showId;
				if (!this.showModel.isValid()) {
					view.showErrors(this.showModel.validationError);
				} else {
					this.showModel
							.save(
									{},
									{
										success : function(model, response) {
											view.resetForm();
											$('#eventModal').foundation(
													'reveal', 'close');
											view.getActiveShow();
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
												console.log(response);
											}
										}
									});
				}
			},
			resetForm : function() {
				this.hideErrors();
				$("#city").val('');
				$("#venue").val('');
				$("#detail").val('');
				$("#date").val('');
				$('#timezone').prop('selectedIndex',0);
				$("#cost").val('');
				$("#link").val('');
				$("#address").val('');
				$("#contactNo").val('');
			},
			saveEvent : function() {
				var view = this;
				view.hideErrors();
				var baseUrl = this.model.get('baseUrl');
				this.showModel = new ShowModel({
					"city" : $("#city").val(),
					"venue" : $("#venue").val(),
					"detail" : $("#detail").val(),
					"date" : $("#date").val(),
					"timeZone" : $("#timezone").val(),
					"cost" : $("#cost").val(),
					"link" : $("#link").val(),
					"address" : $("#address").val(),
					"contact" : $("#contactNo").val()
				});
				this.showModel.url = 'add-show.php';
				if (!this.showModel.isValid()) {
					view.showErrors(this.showModel.validationError);
				} else {
					this.showModel
							.save(
									{},
									{
										success : function(model, response) {
											view.resetForm();
											$('#eventModal').foundation(
													'reveal', 'close');
											view.getActiveShow();
										},
										error : function(model, response) {
											if (response.status == 401) {
												view.callBackData.functionName = "saveEvent";
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
			editShow : function(event) {
				var showId = $(event.target).attr('show-id');
				var baseUrl = this.model.get('baseUrl');
				var view = this;
				$
						.ajax({
							url : 'edit-show.php?showId=' + showId ,
							type : 'GET',
							dataType : 'json',
							success : function(response) {
								var saveUpdateEvent = $('.save-update-event');
								saveUpdateEvent.attr("show-id", showId);
								view.resetForm();
								$("#city").val(response.city);
								$("#venue").val(response.venue);
								$("#detail").val(response.detail);
								$("#date").val(response.date);
								$("#timezone")
										.find("option")
										.filter(
												function() {
													return (($(this).val() == response.timeZone) || ($(
															this).text() == response.timeZone))
												}).prop('selected', true);
								$("#cost").val(response.cost);
								$("#link").val(response.link);
								$("#address").val(response.address);
								$("#contactNo").val(response.contact);
								$('#eventModal').foundation('reveal', 'open');
							},
							error : function(error) {
								// console.log(error);
								if (error.status == 401) {
									view.callBackData.functionName = "editShow";
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
			deleteShow : function(event) {
				var showId = $(event.target).attr('show-id');
				var baseUrl = this.model.get('baseUrl');
				var view = this;
				$
						.ajax({
							url : 'delete-show.php?showId=' + showId,
							type : 'DELETE',
							dataType : 'json',
							success : function(response) {
								view.getActiveShow();
							},
							error : function(error) {
								// console.log(error);
								if (error.status == 401) {
									view.callBackData.functionName = "deleteShow";
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
			addNewShow : function() {
				var view = this;
				var saveUpdateEvent = $('.save-update-event');
				saveUpdateEvent.removeAttr("show-id");
				view.resetForm();
				$('#eventModal').foundation('reveal', 'open');
			},
			getTimeZone : function() {
				var baseUrl = this.model.get('baseUrl');
				var view = this;
				$
						.ajax({
							url : 'get-time-zone.php',
							type : 'GET',
							dataType : 'json',
							success : function(response) {
								var timezone = $('#timezone');
								timezone.find('option').remove();
								timezone
										.append('<option value="">Time Zone</option>');
								$(response).each(
										function(index, value) {
											timezone.append('<option value="'
													+ value + '">' + value
													+ '</option>');
										});
							},
							error : function(error) {
								// console.log(error);
								if (error.status == 401) {
									view.callBackData.functionName = "getTimeZone";
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
			getActiveShow : function() {
				var baseUrl = this.model.get('baseUrl');
				var view = this;
				$
						.ajax({
							url : "get-active-show.php",
							type : "GET",
							success : function(response) {
								var showList = $('.show-list');
								showList.empty();
								if (response != null && response.length > 0) {
									var table = $('<table></table>');
									var tableHead = $('<thead></thead>');
									tableHead
											.append('<tr><th>Date</th><th>City</th><th>Venue</th><th>Description</th><th>edit</th><th>delete</th></tr>');
									var tableBody = $('<tbody></tbody>');
									$(response)
											.each(
													function(index, value) {
														var dataRow = $('<tr></tr>');
														var dataOne = $('<td>'
																+ value.date
																+ '</td>');
														var dataTwo = $('<td>'
																+ value.city
																+ '</td>');
														var dataThree = $('<td>'
																+ value.venue
																+ '</td>');
														var dataFour = $('<td>'
																+ value.detail
																+ '</td>');
														var dataFive = $('<td><button class="radius delete modal edit-show" show-id="'
																+ value.id
																+ '">+</button></td>');
														var dataSix = $('<td><button class="radius delete edit delete-show" show-id="'
																+ value.id
																+ '">X</button></td>');
														dataRow.append(dataOne);
														dataRow.append(dataTwo);
														dataRow
																.append(dataThree);
														dataRow
																.append(dataFour);
														dataRow
																.append(dataFive);
														dataRow.append(dataSix);
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
									view.callBackData.functionName = "getActiveShow";
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