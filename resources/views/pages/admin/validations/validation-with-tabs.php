<script>
    jQuery(document).ready(function(){

        $("<?php echo $validator['selector']; ?>").validate({
            highlight: function (element) { // hightlight error inputs
                $(element).closest('.form-group').addClass('has-error'); // set error class to the control group
            },
            unhighlight: function (element) { // revert the change done by hightlight
                $(element).closest('.form-group').removeClass('has-error'); // set error class to the control group
            },
            invalidHandler: function(event, validator) {
            	// 'this' refers to the form
                var errors = validator.numberOfInvalids();
                $('.language-tabs li').removeClass('active');
                $('.tab-pane').removeClass('active');
                $('#parent_'+$(validator.errorList[0].element).closest('.tab-pane').attr('id')).addClass('active');
                $(validator.errorList[0].element).closest('.tab-pane').addClass('active');
            },
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",  // validate all fields including form hidden input
            errorPlacement: function(error, element) {
                
                if (element.attr("type") == "radio") {
                    error.insertAfter(element.parents('div').find('.radio-list'));
                } else {
                	if(element.attr('type') == 'file') { 
                    	error.insertAfter(element.parent());
                	} else if(element.parent('.input-group').length) {
                    	error.insertAfter(element.parent());
                	} else if (element.get(0).tagName == 'SELECT'){
                		error.insertAfter(element.closest('.select2').parent());
                	} else {
                    	error.insertAfter(element);
                    }
                }
            },
            success: function (label) {
                label.closest('.form-group').removeClass('has-error').addClass('has-success'); // set success class to the control group
            },
            rules: <?php echo json_encode($validator['rules']); ?> 

        });
    })
</script>