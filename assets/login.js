import './styles/login.scss';

const $ = require('jquery');
// this "modifies" the jquery module: adding behavior to it
// the bootstrap module doesn't export/return anything


// start the Stimulus application
import 'bootstrap';

require('select2')

$('document').ready(function(){
    $('#registration_form_is_practitioner').change(function(){
    	if(this.checked) {
    		$('#user_related').removeClass('d-none');
    	}
    	else
    		$('#user_related').addClass('d-none');
    });

    //Show filename to upload
    $('.custom-file-input').change(function(e){
    	let inputFile = e.currentTarget;
    	$(inputFile).parent().find('.custom-file-label').html(inputFile.files[0].name);
    });
});

