var SnImlApiClient = {
	init: function(){
		this.$divMessage = jQuery("div#sn_iml_message");
		this.$divMessage.html("WAITING FOR AUTHENTICATION...");
		//this.ajax_url = SnImlApiClientData.ajax_url;
	},
	getApi: function(){
		if(!this.api)
			this.api = apigClientFactory.newClient();
		return this.api;
	},
	getOAuthToken: function(){
		var params = {
			grant_type: "authorization_code",
			Authorization: SnImlApiClientData.authorization,
			code: SnImlApiClientData.code,
			redirect_uri: SnImlApiClientData.redirectUri, 
		};
		var body = {};
		var additionalParams = {};
		var mThis = this;
		this.getApi().v2OauthTokenPost(
			params,
			body,
			additionalParams
		).then(function(result){
			if(result.data){
				mThis.$divMessage.html("AUTHENTICATION COMPLETED. USER INFORMATION ACQUISITION IN PROGRESS...");
				mThis.getUserData(result.data);
			}
			else{
				mThis.$divMessage.html("AN ERROR OCCURRED DURING AUTHENTICATION PROCESS. TRY AGAIN AFTER FEW TIME.");
			}
			
		}).catch(function(error){
			console.log("getOAuthToken ERROR->")
			console.log(error)
			mThis.$divMessage.html("AUTHENTICATION ERROR. TRY AGAIN AFTER FEW TIME.");
		})
	},
	getUserData: function(params){
		params = params || {};
		var accessToken = params.accessToken;
		var refreshToken = params.refreshToken;
		var tokenExpiresIn = params.expiresIn;

		var onGetUserDataSuccess = params.onGetUserDataSuccess;
		var onGetUserDataUserNotSubscribed = params.onGetUserDataUserNotSubscribed;
		var onGetUserDataError = params.onGetUserDataError;
		var onElaborateLoginSuccess = params.onElaborateLoginSuccess;
		var onElaborateLoginError = params.onElaborateLoginError;
		var autoLoginUser = typeof params.autoLoginUser == 'undefined' ? true : params.autoLoginUser;
		var deleteUserData = typeof params.deleteUserData == 'undefined' ? false : params.deleteUserData;
		var shouldRefreshToken = typeof params.shouldRefreshToken == 'undefined' ? true : params.shouldRefreshToken;
		var uuid = params.uuid;

		var authToken = CryptoJS.enc.Utf8.parse(accessToken);
		authToken = "Bearer "+CryptoJS.enc.Base64.stringify(authToken);
		var params = {
			Authorization: authToken,
			"X-ITsME-Device": null,
			"X-ITsME-Role": null
		};
		var body = {};
		var additionalParams = {};
		var mThis = this;
		this.getApi().v2CustomerserviceExecuteObtainsubscriberdataGet(
			params,
			body,
			additionalParams
		).then(function(result){
			if(onGetUserDataSuccess){
				onGetUserDataSuccess(result);
			}
			else{
				mThis.$divMessage.html("USER INFORMATION RECEIVED. ELABORATING USER INFORMATION...");	
			}
			mThis.elaborateLogin(
				result.data, 
				{
					accessToken: accessToken, 
					refreshToken: refreshToken,
					tokenExpiresIn: tokenExpiresIn,
					onElaborateLoginSuccess: onElaborateLoginSuccess,
					onElaborateLoginError: onElaborateLoginError,
					autoLoginUser: autoLoginUser,
					deleteUserData: deleteUserData,
					shouldRefreshToken: shouldRefreshToken,
				}
			);
		}).catch(function(error){
			console.log("getUserData ERROR->");
			console.log(error);
			var data  = error.data || {}
			if(error.data.statusCode==-900){
				//this should happens only with userreport when a user unsuvscribe from a customer service
				//delete all shared data, except token refresh token, in this way if the user will resubscribe
				//to the customer service we can take data
				if(onGetUserDataUserNotSubscribed){
					onGetUserDataUserNotSubscribed(error);
				}
				mThis.elaborateLogin(
					{uuid: uuid}, 
					{
						accessToken: accessToken, 
						refreshToken: refreshToken,
						tokenExpiresIn: tokenExpiresIn,
						onElaborateLoginSuccess: onElaborateLoginSuccess,
						onElaborateLoginError: onElaborateLoginError,
						autoLoginUser: autoLoginUser,
						deleteUserData: deleteUserData,
						shouldRefreshToken: shouldRefreshToken,
					}
				);
			}
			else{
				if(onGetUserDataError){
					onGetUserDataError(error);
				}
				else{
					mThis.$divMessage.html("AN ERROR OCCURRED DURING ELABORATION PROCESS. TRY AGAIN AFTER FEW TIME.");
				}
			}			
		});
	},
	elaborateLogin: function(userData, params){
		params = params || {};
		var accessToken = params.accessToken;
		var refreshToken = params.refreshToken;
		var tokenExpiresIn = params.tokenExpiresIn;
		var dataTypeList = userData.oauthUserDataTypeList;
		var onElaborateLoginSuccess = params.onElaborateLoginSuccess;
		var onElaborateLoginError = params.onElaborateLoginError;
		var autoLoginUser = typeof params.autoLoginUser == 'undefined' ? true : params.autoLoginUser;
		var deleteUserData = typeof params.deleteUserData == 'undefined' ? false : params.deleteUserData;
		var shouldRefreshToken = typeof params.shouldRefreshToken == 'undefined' ? true : params.shouldRefreshToken;

		var userDataArray = new Array();
		var item = false, 
			email = "", 
			uuid = userData.uuid,
			firstName = "",
			lastName = "";
		for(var k in dataTypeList){
			item = dataTypeList[k];
			if(item.dataTypeDescription == "Email"){
				email = item.value;
			}
			else if(item.dataTypeDescription == "Name"){
				firstName = item.value;
			}
			else if(item.dataTypeDescription == "LastName"){
				lastName = item.value;
			}
			userDataArray.push({
				name: item.dataTypeDescription,
				value: item.value
			});
		}
		var data = {
			action: 'sn_iml_login_user',
			userData: {
				email: email, 
				uuid: uuid, 
				firstName: firstName, 
				lastName: lastName,
				dataArray: userDataArray,
				accessToken: accessToken,
				refreshToken: refreshToken,
				tokenExpiresIn: tokenExpiresIn,
			},
			autoLoginUser: autoLoginUser?1:0,
			deleteUserData: deleteUserData?1:0,
			shouldRefreshToken: shouldRefreshToken?1:0,

		};
		var mThis = this;
		// We can also pass the url value separately from ajax_url for front end AJAX implementations
		jQuery.post(
			SnImlApiClientData.ajax_url, 
			data, 
			function(response) {
				if(response.success){
					//reload
					if(onElaborateLoginSuccess){
						onElaborateLoginSuccess(response);
					}
					else{
						window.location = window.location.pathname;
					}
				}
				else{
					if(onElaborateLoginError){
						onElaborateLoginError(response);
					}
					else{
						mThis.$divMessage.html("AN ERROR OCCURRED. "+response.message);
					}
				}
			},
			"json"
		);
	},
	refreshToken: function(params){
		params = params || {};
		var onSuccess = params.onSuccess;
		var onError = params.onError;
		var opt = {
			grant_type: "refresh_token",
			Authorization: params.authorization,
			refresh_token: params.refreshToken,
			redirect_uri: params.redirectUri, 
		};
		var body = {};
		var additionalParams = {};
		var mThis = this;
		this.getApi().v2OauthRefreshtokenPost(
			opt,
			body,
			additionalParams
		).then(function(result){
			if(onSuccess){
				onSuccess(result);
			}
			else{
				console.log("refreshToken SUCCESS");
			}
			
		}).catch(function(error){
			console.log("getOAuthToken ERROR->")
			console.log(error)
			if(onError){
				onError(error);
			}
			else{
			}
		});
	}
}

jQuery(function($){
	//check set all data for init and getOAuthToken functions
	if(!SnImlApiClientData.authorization || !SnImlApiClientData.authorization || !SnImlApiClientData.redirectUri)
		return
	SnImlApiClient.init();
	SnImlApiClient.getOAuthToken();
	//SnImlApiClient.elaborateLogin();
})