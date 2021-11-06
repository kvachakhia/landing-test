<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Landing
 */

?>



<footer>



</footer>




<?php wp_footer(); ?>
<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>

<script>
    jQuery(document).ready(function($) {

        $('.submit-button').on('click', function() {
            resetErrors();  

            var data = {
                'action': 'send_message',
                'fname': $('#fname').val(),
                'title': $('#title').val(),
                'company': $('#company').val(),
                'email': $('#email').val(),
            };

            $.ajax({
                type: 'POST',
                url: '<?php echo admin_url('admin-ajax.php'); ?>',
                data: data,
                success: function(resp) {

                    var obj = jQuery.parseJSON(resp);

                    $.each(obj, function(i, v) {
                        console.log(i + " => " + v); // view in console for error messages
                        var msg = '<label class="error" for="' + i + '">' + v + '</label>';
                        $('input[name="' + i + '"]').addClass('inputTxtError').after(msg);
                    });
                    var keys = Object.keys(resp);
                    $('input[name="' + keys[0] + '"]').focus();

                }
            });
        });
    });

    function resetErrors() {
        $('form input, form select').removeClass('inputTxtError');
        $('label.error').remove();
    }
</script>

</body>

</html>