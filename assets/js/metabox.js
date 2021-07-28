(function ($) {

    $(document).ready(() => {
        $('#gen-qrcode').click((e) => {
            const wrapper = $(e.target).closest('div'),
                originalLoadingText = $(e.target).html(),
                postId = $(e.target).closest('.rwmb-meta-box').data('object-id');

            // Change loading state.
            $(e.target).prop('disabled', true).html('Loading...');

            // Load all offices for the first time.
            $.ajax({
                url: rlw.ajax_url + '?action=rlw_qrcode&volunteer=' + postId,
                type: 'get',
                dataType: "json",
                success: function (data) {

                    // Remove loading state.
                    $(e.target).prop('disabled', false).html(originalLoadingText);

                    // Validate result.
                    if (data.success) {
                        wrapper.html(data.data)
                    }
                }
            })
        })
    })
})(jQuery)