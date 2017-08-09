jQuery(function($){
	var $itsmeForm = $("form#social_nation_itsme_login_form");
	
	var $inputRedirectUri = $itsmeForm.find("input#sn_iml_redirect_uri");
	var $textRedirectUri = $itsmeForm.find("div#redirect_uri_text");
	var action = "action="+SocialNationItsmeLoginAdminGeneralSettings.action;
	var addActionParam = function(text){
		var val = $inputRedirectUri.val();
		if(!val.endsWith("?")){
			if(val.includes("?")){
				val+="&";
			}
			else{
				val+="?";	
			}
		}
		$textRedirectUri.html(val+action);
	};
	addActionParam();
	$inputRedirectUri.change(addActionParam);

	var $selectButtonLayout = $itsmeForm.find("select#sn_iml_button_file_name");
	var $loginButtonContainer = $itsmeForm.find("div#sn_iml_login_button_container");
	var $loginButtonImg = $loginButtonContainer.find("img");
	
	var refreshPreview = function(){
		$loginButtonImg.attr(
			"src",
			SocialNationItsmeLoginAdminGeneralSettings.src+$selectButtonLayout.val()
		);
	};
	$selectButtonLayout.change(refreshPreview);
	refreshPreview();
});