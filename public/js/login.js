$(() => {
    $("#login_form").on("submit", (e) => {
        e.preventDefault();
        let data = new FormData(e.target);

        $.ajax({
            url: "rest/user/login",
            type: "post",
            dataType: "JSON",
            data: data,
            success: (data) => {
                if(data == 1) location.reload();
            },
            cache: false,
			contentType: false,
			processData: false,
        })
    })
})