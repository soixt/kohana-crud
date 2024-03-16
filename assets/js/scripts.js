$(document).ready(function(){
    const CSRF_TOKEN = $('meta[name="csrf"]').attr('content');
    $('#login-form').submit(function(event){
        // Prevent the default form submission
        event.preventDefault();

        // Remove error
        $('#login-error').html('');

        // Login request
        $.ajax({
            url: $(this).attr('action'), // Specify your endpoint URL
            type: $(this).attr('method'),
            data: $(this).serialize(),
            success: function(response){
                // Handle success response
                window.location = response.dashboard;
            },
            headers: {
                'X-CSRF-TOKEN': CSRF_TOKEN
            },
            error: function(xhr){
                let errorMsg = xhr.responseJSON && xhr.responseJSON.error ? xhr.responseJSON.error : "An unknown error occurred";
                $('#login-error').html(errorMsg); // Display the error message on the page
            }
        });
    });

    $('#payment-system-from').submit(function (e) {
        e.preventDefault();
        
        // Remove errors
        $('.form-errors').html('');

        let system = $(this).data('system');

        let $update = system !== undefined ? true : false;

        // Send POST request using AJAX
        $.ajax({
            url: $update ? $(this).data('update-action') : $(this).attr('action'), // Specify your endpoint URL
            type: $(this).attr('method'),
            data: $(this).serialize() + '&system=' + system,
            headers: {
                'X-CSRF-TOKEN': CSRF_TOKEN
            },
            success: function(response){
                window.location.reload();
            },
            error: function(xhr){
                if(xhr.status === 400) {
                    let errors = xhr.responseJSON.errors;
                    for (let field in errors) {
                        // Display the error message next to the input field
                        $('#error-' + field).html(errors[field]);
                    }
                }
            }
        });
    });

    $('.open-edit-system-from').on('click', function (e) {
        e.preventDefault();
        $('#payment-system-from').data('system', $(this).data('system'));
        $('#payment-system-from input#name').val($(this).data('system-name'));
        $('#payment-system-from input#status').val($(this).data('system-status'));
        openModal('#add-system-modal');
    });

    $('#invoice-from').submit(function (e) {
        e.preventDefault();

        // Remove errors
        $('.form-errors').html('');

        // Send POST request using AJAX
        $.ajax({
            url: $(this).attr('action'), // Specify your endpoint URL
            type: $(this).attr('method'),
            data: $(this).serialize(),
            headers: {
                'X-CSRF-TOKEN': CSRF_TOKEN
            },
            success: function(response){
                window.location.reload();
            },
            error: function(xhr, status, error, response){
                if(xhr.status === 400) {
                    let errors = xhr.responseJSON.errors;
                    for (let field in errors) {
                        // Display the error message next to the input field
                        $('#error-' + field).html(errors[field].replace(field, field.replace('-', ' ')));
                    }
                }
            }
        });
    });

    $(document).on('click', '.update-status', function (e) {
        e.preventDefault();

        let status = $(this).data('status');
        let invoice = $(this).data('invoice');
        let statusColors = {
            approved: 'emerald',
            cancelled: 'red'
        };

        // Send POST request using AJAX
        $.ajax({
            url: $(this).data('url'),
            type: 'POST',
            data: {
                invoice: invoice,
                status: status
            },
            headers: {
                'X-CSRF-TOKEN': CSRF_TOKEN
            },
            success: function(response){
                $(`.update-status[data-invoice="${invoice}"]`).remove();
                $(`.invoice-status[data-invoice="${invoice}"]`).html(`
                    <div class="inline px-3 py-1 text-sm font-normal rounded-full text-${statusColors[status]}-500 gap-x-2 bg-${statusColors[status]}-100/60">
                        ${status}
                    </div>
                `);
            },
            error: function(xhr){
                if(xhr.status === 400) {
                    alert(xhr.responseJSON.error);
                }
            }
        });
    });

    // Toggle the dropdown menu
    $('#profile-dropdown-toggle').click(function(event) {
        event.stopPropagation();
        $('#profile-dropdown').toggle();
    });

    // Close the dropdown when clicking outside of it
    $(document).click(function(event) {
        if (!$(event.target).closest('#profile-dropdown, #profile-dropdown-toggle').length) {
            $('#profile-dropdown').hide();
        }
    });

    //Logout
    $('#logout').on('click', function(event) {
        event.preventDefault();
        $.ajax({
            url: $(this).attr('href'), // Specify your endpoint URL
            type: 'POST',
            data: $(this).serialize(),
            success: function(response){
                // Handle success response
                window.location = response.home;
            },
            headers: {
                'X-CSRF-TOKEN': CSRF_TOKEN
            },
            error: function(xhr){
                alert(xhr.responseJSON.error);
            }
        });
    });
});

function closeModalForm (el) {
    $(`${el} form`).get(0).reset();
    $(`${el} form`).removeAttr('data-system');
    document.querySelector(el).close();
}

function openModal (el) {
    document.querySelector(el).showModal();
}