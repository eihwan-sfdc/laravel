Evergage.init({
}).then(() => {
    const config = {
        global: {
            contentZones: [
                {name: "global_infobar_top_of_page", selector: "header.site-header"},
                {name: "global_infobar_bottom_of_page", selector: "footer.footer"},
                {name: "global_popup" }
            ],
            onActionEvent: (actionEvent) => {
                const email = Evergage.cashDom(".logged-in-user-email").text().trim();
                if (email) {
                    actionEvent.user = actionEvent.user || {};
                    actionEvent.user.attributes = actionEvent.user.attributes || {};
                    actionEvent.user.attributes.emailAddress = email;
                }
                return actionEvent;
            },
            listeners: [
                Evergage.listener("submit", ".email-signup", () => {
                    const email = "dummy-email-signup-footer@salesforce.com";
                    if (email) {
                        Evergage.sendEvent({ action: "Email Sign Up - Footer", user: {attributes: {emailAddress: email}}});
                    }
                }),
            ],
        },         
        pageTypeDefault: {
            name: "default"
        },
        pageTypes: [
            {
                name: "category",
                action: "Viewed Category",
                isMatch: () => /\/category/.test(window.location.href),
                
            },
            {
                name: "product_detail",
                
                // この Page Type に該当するかどうかを判断
                isMatch: () => /\/detail/.test(window.location.href),
                
                //ページから Catalog 情報を取得
                catalog: {
                    Product: {
                        _id: () => {
                            const products = getProductsFromDataLayer() || [];
                            if (products.length > 0) {
                                return products[0].id;
                            } else {
                                return Evergage.cashDom(".product-detail[data-pid]").attr("data-pid");
                            }
                        },
                        name: Evergage.cashDom(".product-detail[data-pname]").attr("data-pname"),
                        url: Evergage.resolvers.fromHref(),
                        imageUrl: Evergage.resolvers.fromSelectorAttribute(".product-carousel .carousel-item[data-slick-index='0'] img", "src"),
                        inventoryCount: 1,
                        regular_price: Evergage.cashDom(".product-detail[data-regularprice]").attr("data-regularprice"),
                        salesprice: Evergage.cashDom(".product-detail[data-saleprice]").attr("data-saleprice"),
                        category: Evergage.cashDom(".product-detail[data-category]").attr("data-category"),
                        dimensions: {
                            Gender: () => {
                                if (Evergage.cashDom(".product-detail[data-gender]").attr("data-gender").toLowerCase() === "women") {
                                    console.log("WOMEN");
                                    return ["WOMEN"];
                                } else if (Evergage.cashDom(".product-detail[data-gender]").attr("data-gender").toLowerCase() === "men") {
                                    console.log("MEN");
                                    return ["MEN"];
                                }
                            },
                            // Color: Evergage.resolvers.fromSelectorAttributeMultiple(".color-value", "data-attr-value"),
                            // Feature: Evergage.resolvers.fromSelectorMultiple(".features .feature", (features) => {
                            //     return features.map((feature) => {
                            //         return feature.trim();
                            //     });
                            // })
                        }
                    }
                },
                contentZones: [
                    { name: "product_detail_recs_row_1", selector: ".row.recs.igo_product" },
                    { name: "product_detail_recs_row_2", selector: ".row.recs.evergage_product" },
                ],
                listeners: [ 
                    Evergage.listener("click", ".add-to-cart", () => {
                        const lineItem = { 
                            _id: Evergage.cashDom(".product-detail[data-pid]").attr("data-pid"),
                            price: Evergage.cashDom(".product-detail[data-saleprice]").attr("data-saleprice"),
                            quantity: 1,
                        };
                        Evergage.sendEvent({
                            itemAction: Evergage.ItemAction.AddToCart,
                            cart: {
                                singleLine: {
                                    Product: lineItem
                                }
                            }
                        });
                    }),
                ]
            },
            {
                name: "cart",   
                isMatch: () => /\/cart/.test(window.location.href),
                itemAction: Evergage.ItemAction.ViewCart,
                catalog: {
                    Product: {
                        lineItems: {
                            _id: () => {
                                return Evergage.resolvers.fromSelectorAttributeMultiple(".product-info .product-details", "data-pid");
                            },
                            price: () => {
                                return Evergage.resolvers.fromSelectorMultiple(".product-info .pricing");
                            },
                            quantity: () => {
                                return Evergage.resolvers.fromSelectorMultiple(".product-info .qty-card-quantity-count");
                            },
                        }
                    }
                }
            },
            {
                name: "static-page-a",
                isMatch: () => /\/static-page-a/.test(window.location.href),
                onActionEvent: (actionEvent) => {
                    actionEvent.user = actionEvent.user || {};
                    actionEvent.user.attributes = actionEvent.user.attributes || {};
                    actionEvent.user.attributes.emailAddress = "eihwan.kim+page+a@salesforce.com";
                    actionEvent.user.attributes.firstName = "Eihwan";
                    actionEvent.user.attributes.lastName = "Kim";
                return actionEvent;
                }
            },
            {
                name: "static-page-b",
                isMatch: () => /\/static-page-b/.test(window.location.href),
                onActionEvent: (actionEvent) => {
                    actionEvent.user = actionEvent.user || {};
                    actionEvent.user.attributes = actionEvent.user.attributes || {};
                    actionEvent.user.attributes.firstName = "Kamisama";
                    actionEvent.user.attributes.lastName = "Machikawa";
                return actionEvent;
                }
            },
            {
                name: "static-page-c",
                isMatch: () => /\/static-page-c/.test(window.location.href),
                onActionEvent: (actionEvent) => {
                    actionEvent.user = actionEvent.user || {};
                    actionEvent.user.attributes = actionEvent.user.attributes || {};
                    actionEvent.user.attributes.emailAddress = "eihwan.kim+page+a@salesforce.com";
                return actionEvent;
                }
            },

        ]
    };
    const getProductsFromDataLayer = () => {
        if (window.dataLayer) {
            for (let i = 0; i < window.dataLayer.length; i++) {
                if ((window.dataLayer[i].ecommerce && window.dataLayer[i].ecommerce.detail || {}).products) {
                    return window.dataLayer[i].ecommerce.detail.products;
                }
            }
        }
    };
    Evergage.initSitemap(config);
});