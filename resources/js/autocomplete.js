$(function () {
    $("#name").autocomplete({
        source: function (request, response) {
            $.ajax({
                url: "/search/autocomplete",
                data: { term: request.term },
                success: function (data) {
                    response(data);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.error("Error fetching autocomplete data:", errorThrown);
                },
            });
        },
        minLength: 1, // Minimum characters before suggestions appear
    });
});

//code size much smaller