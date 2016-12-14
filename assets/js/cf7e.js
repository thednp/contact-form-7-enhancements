( function( $ ) {
	//override the cf7 form refill with placeholder support
	$.fn.wpcf7RefillQuiz = function(quiz) {
		return this.each(function() {
			var form = $(this);

			$.each(quiz, function(i, n) {
				form.find(':input[name="' + i + '"]').clearFields();
				if ( form.find(':input[name="' + i + '"]').attr('placeholder') ) {
					form.find(':input[name="' + i + '"]').attr('placeholder',n[0]);
				} else {
					form.find(':input[name="' + i + '"]').siblings('span.wpcf7-quiz-label').text( n[0] );				
				}
				form.find('input:hidden[name="_wpcf7_quiz_answer_' + i + '"]').attr('value', n[1]);
			});
		});
	};
} )( jQuery );
