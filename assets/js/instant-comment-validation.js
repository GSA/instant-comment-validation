/*!-------------------------------------------------------
 * Instant Comment Validation - v1.0 - 30/6/2014
 * http://wordpress.org/plugins/instant-comment-validation/
 * Copyright (c) 2014 Mrinal Kanti Roy; License: GPLv2 or later
---------------------------------------------------------*/
jQuery(document).ready(function($) {
	$('#commentform').validate({	 
		rules: {
		  author: {
			required: false,
			minlength: 1
		  },		 
		  email: {
			required: false,
			email: true
		  },
		  comment: {
			required: true,
			minlength: 1
		  }
		},		 
		messages: {
		  author: "Please enter your name",
		  email: "Please enter a valid email address",
		  comment: "Please type your comment"
		},		 
		errorElement: "div",
		errorPlacement: function(error, element) {
		  element.after(error);
		}	 
	});
});
