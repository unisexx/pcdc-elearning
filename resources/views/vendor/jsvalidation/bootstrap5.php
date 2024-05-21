<script>
    jQuery(document).ready(function () {

        $("<?php echo $validator['selector']; ?>").each(function () {
            $(this).validate({
                errorElement: 'div',
                errorClass: 'invalid-feedback',

                errorPlacement: function (error, element) {
                    // console.log(element.prop('type') +' = '+ element.hasClass("select2"));
                    if (element.prop('type') === 'radio') {
                        element.closest('div.row').find('.errMsg').html(error);
                    }else if(element.prop('type') === 'select-one' && element.hasClass("select2")){
                        error.insertAfter(element.next('span.select2'));
                    } else {
                        error.insertAfter(element);
                    }
                },
                highlight: function (element) {
                    $(element).removeClass('is-valid').addClass('is-invalid'); // add the Bootstrap error class to the control group
                },

                <?php if (isset($validator['ignore']) && is_string($validator['ignore'])): ?>

                ignore: "<?php echo $validator['ignore']; ?>",
                <?php endif;?>


                unhighlight: function (element) {
                    $(element).removeClass('is-invalid').addClass('is-valid');
                },

                success: function (element) {
                    $(element).removeClass('is-invalid').addClass('is-valid'); // remove the Boostrap error class from the control group
                },

                focusInvalid: true,
                <?php if (Config::get('jsvalidation.focus_on_error')): ?>
                invalidHandler: function (form, validator) {

                    if (!validator.numberOfInvalids())
                        return;

                    $('html, body').animate({
                        scrollTop: $(validator.errorList[0].element).offset().top
                    },                       <?php echo Config::get('jsvalidation.duration_animate') ?>);

                },
                <?php endif;?>

                rules:                       <?php echo json_encode($validator['rules']); ?>
            });
        });
    });
</script>
