<div class="cart-box bg-dark">
    <div class="cart-body">
        <div class="close">
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" width="1.6em" height="1.6em" viewBox="0 0 122.879 122.879" enable-background="new 0 0 122.879 122.879" xml:space="preserve">
                <g>
                    <path fill-rule="evenodd" clip-rule="evenodd" fill="#fff" d="M61.44,0c33.933,0,61.439,27.507,61.439,61.439 s-27.506,61.439-61.439,61.439C27.507,122.879,0,95.372,0,61.439S27.507,0,61.44,0L61.44,0z M73.451,39.151 c2.75-2.793,7.221-2.805,9.986-0.027c2.764,2.776,2.775,7.292,0.027,10.083L71.4,61.445l12.076,12.249 c2.729,2.77,2.689,7.257-0.08,10.022c-2.773,2.765-7.23,2.758-9.955-0.013L61.446,71.54L49.428,83.728 c-2.75,2.793-7.22,2.805-9.986,0.027c-2.763-2.776-2.776-7.293-0.027-10.084L51.48,61.434L39.403,49.185 c-2.728-2.769-2.689-7.256,0.082-10.022c2.772-2.765,7.229-2.758,9.953,0.013l11.997,12.165L73.451,39.151L73.451,39.151z" />
                </g>
            </svg>
        </div>
        <div class="cart-list">
            <ul class="list-group"></ul>
            <div class="checkout">
                <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor" class="bi bi-currency-rupee" viewBox="0 0 16 16"><path d="M4 3.06h2.726c1.22 0 2.12.575 2.325 1.724H4v1.051h5.051C8.855 7.001 8 7.558 6.788 7.558H4v1.317L8.437 14h2.11L6.095 8.884h.855c2.316-.018 3.465-1.476 3.688-3.049H12V4.784h-1.345c-.08-.778-.357-1.335-.793-1.732H12V2H4v1.06Z"/></svg>
                <div class="amount"></div>
            </div>
        </div>
    </div>
</div>

<script>
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
                localStorage.setItem("total_amount", 0);
                
                $.each(data, (key, row) => {
                    console.log(row);
                    $.ajax({
                        url: `https://fakestoreapi.com/products/${row.product_id}`,
                        type: "get",
                        dataType: "JSON",
                        success: (data2) => {
                            console.log(data2);
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
                        }
                    })
                })
                $(".amount").text(localStorage.getItem("total_amount"));
            }
        })
    }

    function cart_actions(){
        $(".decrement-cart").on("click", function(){
            let cart_id = $(this).data("id");
            console.log(cart_id);
            $.ajax({
                url: "rest/cart/update",
                type: "post",
                dataType: "JSON",
                data: {
                    cart_id: cart_id,
                    count: "-1"
                },
                success: (data) => {
                    console.log(data);
                    cart_list();
                }
            })
        })

        $(".increment-cart").on("click", function(){
            let cart_id = $(this).data("id");
            console.log(cart_id);
            $.ajax({
                url: "rest/cart/update",
                type: "post",
                dataType: "JSON",
                data: {
                    cart_id: cart_id,
                    count: "+1"
                },
                success: (data) => {
                    console.log(data);
                    cart_list();
                }
            })
        })
    }
</script>