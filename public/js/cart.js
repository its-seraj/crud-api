$(() => {
    function cart_count(){
        $.ajax({
            url: "rest/cart/count",
            type: "get",
            dataType: "JSON",
            success: (data) => {
                // console.log(data);
                $(".count").text(data);
            }
        })
    }
    cart_count();
    
    $(".close").on("click", () => {
        $(".cart-box").animate({
            width: "toggle",
        });
        cart_count();
    })

    $(".mycart").on("click", () => {
        $(".cart-box").animate({
            width: "toggle",
        });
        cart_list();
    });

    function cart_list() {
        $.ajax({
            url: "rest/cart/list",
            type: "get",
            dataType: "JSON",
            success: (data) => {
                // console.log(data);
                $(".list-group").html("");
                $(".amount").text(0);
                
                $.each(data, (key, row) => {
                    // console.log(row);
                    $.ajax({
                        url: `https://fakestoreapi.com/products/${row.product_id}`,
                        type: "get",
                        dataType: "JSON",
                        success: (data2) => {
                            // console.log(data2);
                            let tpl = `
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <img src="${data2.image}" alt="" srcset="">
                                <div class="cart-counter">
                                    <svg xmlns="http://www.w3.org/2000/svg" data-id="${row.id}" width="16" height="16" fill="currentColor" class="decrement-cart bi bi-cart-dash-fill" viewBox="0 0 16 16"><path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zM6.5 7h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1 0-1z"/></svg>
                                    <span class="badge badge-primary badge-pill">${row.count}</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" data-id="${row.id}" width="16" height="16" fill="currentColor" class="increment-cart bi bi-cart-plus-fill" viewBox="0 0 16 16"><path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zM9 5.5V7h1.5a.5.5 0 0 1 0 1H9v1.5a.5.5 0 0 1-1 0V8H6.5a.5.5 0 0 1 0-1H8V5.5a.5.5 0 0 1 1 0z"/></svg>
                                </div>
                            </li>
                            `;

                            $(".amount").text((parseFloat($(".amount").text()) + data2.price * row.count).toFixed(2));
                            
                            $(".list-group").append(tpl);
                            cart_actions();
                        },
                        async: false,
                    })
                })
            },
            async: false,
        })
    }

    function cart_actions(){
        $(".decrement-cart").off().on("click", function(){
            let cart_id = $(this).data("id");
            $.ajax({
                url: "rest/cart/update",
                type: "post",
                dataType: "JSON",
                data: {
                    cart_id: cart_id,
                    count: "-1"
                },
                success: (data) => {
                    // console.log(data);
                    cart_list();
                }
            })
        })

        $(".increment-cart").off().on("click", function(){
            let cart_id = $(this).data("id");
            $.ajax({
                url: "rest/cart/update",
                type: "post",
                dataType: "JSON",
                data: {
                    cart_id: cart_id,
                    count: "+1"
                },
                success: (data) => {
                    // console.log(data);
                    cart_list();
                }
            })
        })
    }
})