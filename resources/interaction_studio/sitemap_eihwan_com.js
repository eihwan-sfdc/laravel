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
                    Evergage.listener("click", "#viewItemDetail", () => {
                        const lineItem = { 
                            _id: Evergage.cashDom(".product-detail[data-pid]").attr("data-pid"),
                        };
                        Evergage.sendEvent({
                            itemAction: Evergage.ItemAction.ViewItemDetail,
                            catalog: {
                                Product: lineItem
                            }
                        });
                    }),
                    Evergage.listener("click", "#quickViewItem", () => {
                        const pid = Evergage.cashDom(".product-detail[data-pid]").attr("data-pid");
                        if (!pid) {
                            return;
                        }
                        Evergage.sendEvent({
                            itemAction: Evergage.ItemAction.QuickViewItem,
                            catalog: {
                                Product: {
                                    _id: pid
                                }
                            }
                        });
                    }),
                    Evergage.listener("click", ".quickViewClose", () => {
                        Evergage.sendEvent({
                            action: "Close Quick View",
                            itemAction: Evergage.ItemAction.QuickViewItem,
                        })
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
                name: "order_confirmation",
                isMatch: () => /\/confirmation/.test(window.location.href),
                itemAction: Evergage.ItemAction.Purchase,
                order: {
                    Product: {
                        orderId: Evergage.cashDom(".order-number").attr("data-orderid").trim(),
                        totalValue: Evergage.cashDom(".order-number").attr("data-totalprice").trim(),
                        currency: "JPY",
                    }
                }
                // interaction: {
                //     name: Evergage.OrderInteractionName.Purchase,
                //     order: {
                //         id: Evergage.DisplayUtils.pageElementLoaded(".order-number", "html").then((ele) => {
                //             return Evergage.resolvers.fromSelector(".order-number");
                //         }),
                //         lineItems: Evergage.DisplayUtils.pageElementLoaded(".product-line-item", "html").then(() => {   
                //             let purchaseLineItems = [];
                //             Evergage.cashDom(".product-line-item").each((index, ele) => {
                //                 let itemQuantity = parseInt(SalesforceInteractions.cashDom(ele).find(".qty-card-quantity-count").text().trim());
                //                 if (itemQuantity && itemQuantity > 0) {
                //                     let lineItem = {
                //                         catalogObjectType: "Product",
                //                         catalogObjectId: Evergage.cashDom(ele).find(".line-item-quantity-info").attr("data-pid").trim(),
                //                         price: Evergage.cashDom(ele).find(".pricing").text().trim().replace(/[^0-9\.]+/g,"")/itemQuantity,
                //                         quantity: itemQuantity
                //                     };
                //                     purchaseLineItems.push(lineItem);
                //                 }    
                //             })
                //             return purchaseLineItems;
                //         })
                //     }
                // }
            },
            {
                name: "static-page-a",
                isMatch: () => /\/static-page-a/.test(window.location.href),
                onActionEvent: (actionEvent) => {
                    actionEvent.user = actionEvent.user || {};
                    actionEvent.user.attributes = actionEvent.user.attributes || {};
                    actionEvent.user.attributes.customerId = "test123";
                    actionEvent.user.attributes.nonIdentityEmail = "test123+1@salesforce.com";
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
                    actionEvent.user.attributes.customerId = "test123";
                    actionEvent.user.attributes.firstName = "Test";
                    actionEvent.user.attributes.lastName = "Taro";
                return actionEvent;
                }
            },
            {
                name: "static-page-c",
                isMatch: () => /\/static-page-c/.test(window.location.href),
                onActionEvent: (actionEvent) => {
                    actionEvent.user = actionEvent.user || {};
                    actionEvent.user.attributes = actionEvent.user.attributes || {};
                    actionEvent.user.attributes.customerId = "test123";
                    actionEvent.user.attributes.nonIdentityEmail = "test123+2@salesforce.com";
                    actionEvent.user.attributes.encryptedField = atob("VEVTVA==");
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