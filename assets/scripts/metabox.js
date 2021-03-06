(function ($) {

    class Metabox {
        constructor() {
            this.onGenerateQRCode();
            this.onAvailabilityChange();
            this.onEmergencyContactChange();
        }
        onGenerateQRCode() {
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
        }

        onAvailabilityChange() {
            const availabilitySelect = $('#rlw_availability'),
                availabilityAmountInput = $('#rlw_amount'),
                availabilityAmountInputWrapper = availabilityAmountInput.closest('.rwmb-field.rwmb-number-wrapper'),
                availabilitySelectValue = availabilitySelect.val();

            if (!availabilitySelectValue || 'unlimited' === availabilitySelectValue) {
                availabilityAmountInputWrapper.hide();
            }

            availabilitySelect.change((e) => {
                const targetValue = $(e.target).val();
                if (targetValue && 'unlimited' !== targetValue) {
                    availabilityAmountInputWrapper.show();
                } else {
                    availabilityAmountInputWrapper.hide();
                }
            })
        }

        onEmergencyContactChange() {
            const emergencyContactInput = $('#rlw_emergency_contact'),
                emergencyContactRelation = $('#rlw_emergency_relation'),
                emergencyContactRelationWrapper = emergencyContactRelation.closest('.rwmb-field.rwmb-select-wrapper');

            if (!emergencyContactInput.val()) {
                emergencyContactRelationWrapper.hide();
            }

            emergencyContactInput.keyup((e) => {
                if ($(e.target).val()) {
                    emergencyContactRelationWrapper.show();
                } else {
                    emergencyContactRelationWrapper.hide();
                }
            })
        }
    }

    new Metabox();
})(jQuery)