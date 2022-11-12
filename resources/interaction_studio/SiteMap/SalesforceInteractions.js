SalesforceInteractions.init({
    consents: [{
        purpose: SalesforceInteractions.mcis.ConsentPurpose.Personalization,
        provider: "Example Consent Manager",
        status: SalesforceInteractions.ConsentStatus.OptIn
    }]
}).then(() => {
    const config = {
        global: {
            contentZones: [
                {name: "global_infobar_top_of_page", selector: "header.site-header"},
                {name: "global_infobar_bottom_of_page", selector: "footer.footer"},
                {name: "global_popup" }
            ],
            onActionEvent: (actionEvent) => {
                const email = SalesforceInteractions.cashDom(".logged-in-user-email").text().trim();
                actionEvent.user = actionEvent.user || {};
                actionEvent.user.identities = actionEvent.user.identities || {};
                actionEvent.user.attributes = actionEvent.user.attributes || {};
                
                if (email) {
                    actionEvent.user.identities.userId = email;
                    actionEvent.user.attributes.userId = email; // When "actionEvent.user.attributes.userId" is not set, [Event was missing core field: userId (ID of current user or email address)] error occurs 
                    actionEvent.user.identities.emailAddress = email;
                    actionEvent.user.identities.customerId = email;
                    actionEvent.user.identities.sfmcContactKey = email;
                    actionEvent.user.identities.userName = email; /* attribute name is case sensitive */
                } else {
                    actionEvent.user.identities.userId = "unknown-hogehoge-identities";
                    actionEvent.user.attributes.userId = "unknown-hogehoge-attributes"; // When "actionEvent.user.attributes.userId" is not set, [Event was missing core field: userId (ID of current user or email address)] error occurs 
                }
                return actionEvent;
            },
            listeners: [
                SalesforceInteractions.listener("submit", ".email-signup", () => {
                    const email = "dummy-email-signup-footer@salesforce.com";
                    if (email) {
                        SalesforceInteractions.sendEvent({ action: "Email Sign Up - Footer", user: {identities: {emailAddress: email}}});
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
                name: "detail",
                
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
                                return SalesforceInteractions.cashDom(".product-detail[data-pid]").attr("data-pid");
                            }
                        },
                        name: SalesforceInteractions.cashDom(".product-detail[data-pname]").attr("data-pname"),
                        url: SalesforceInteractions.resolvers.fromHref(),
                        imageUrl: SalesforceInteractions.resolvers.fromSelectorAttribute(".product-carousel .carousel-item[data-slick-index='0'] img", "src"),
                        inventoryCount: 1,
                        regular_price: SalesforceInteractions.cashDom(".product-detail[data-regularprice]").attr("data-regularprice"),
                        salesprice: SalesforceInteractions.cashDom(".product-detail[data-saleprice]").attr("data-saleprice"),
                        category: SalesforceInteractions.cashDom(".product-detail[data-category]").attr("data-category"),
                        dimensions: {
                            Gender: () => {
                                if (SalesforceInteractions.cashDom(".product-detail[data-gender]").attr("data-gender").toLowerCase() === "women") {
                                    console.log("WOMEN");
                                    return ["WOMEN"];
                                } else if (SalesforceInteractions.cashDom(".product-detail[data-gender]").attr("data-gender").toLowerCase() === "men") {
                                    console.log("MEN");
                                    return ["MEN"];
                                }
                            },
                            // Color: SalesforceInteractions.resolvers.fromSelectorAttributeMultiple(".color-value", "data-attr-value"),
                            // Feature: SalesforceInteractions.resolvers.fromSelectorMultiple(".features .feature", (features) => {
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
                    SalesforceInteractions.listener("click", ".add-to-cart", () => {
                        const lineItem = { 
                            _id: SalesforceInteractions.cashDom(".product-detail[data-pid]").attr("data-pid"),
                            price: SalesforceInteractions.cashDom(".product-detail[data-saleprice]").attr("data-saleprice"),
                            quantity: 1,
                        };
                        SalesforceInteractions.sendEvent({
                            itemAction: SalesforceInteractions.ItemAction.AddToCart,
                            cart: {
                                singleLine: {
                                    Product: lineItem
                                }
                            }
                        });
                    }),
                    SalesforceInteractions.listener("click", "#viewItemDetail", () => {
                        const lineItem = { 
                            _id: SalesforceInteractions.cashDom(".product-detail[data-pid]").attr("data-pid"),
                        };
                        SalesforceInteractions.sendEvent({
                            itemAction: SalesforceInteractions.ItemAction.ViewItemDetail,
                            catalog: {
                                Product: lineItem
                            }
                        });
                    }),
                    SalesforceInteractions.listener("click", "#quickViewItem", () => {
                        const pid = SalesforceInteractions.cashDom(".product-detail[data-pid]").attr("data-pid");
                        if (!pid) {
                            return;
                        }
                        SalesforceInteractions.sendEvent({
                            itemAction: SalesforceInteractions.ItemAction.QuickViewItem,
                            catalog: {
                                Product: {
                                    _id: pid
                                }
                            }
                        });
                    }),
                    SalesforceInteractions.listener("click", ".quickViewClose", () => {
                        SalesforceInteractions.sendEvent({
                            action: "Close Quick View",
                            itemAction: SalesforceInteractions.ItemAction.QuickViewItem,
                        })
                    }),
                ]
            },
            {
                name: "cart",   
                isMatch: () => /\/cart/.test(window.location.href),
                itemAction: SalesforceInteractions.CartInteractionName.ReplaceCart,
                catalog: {
                    Product: {
                        lineItems: {
                            _id: () => {
                                return SalesforceInteractions.resolvers.fromSelectorAttributeMultiple(".product-info .product-details .line-item-name", "data-pid");
                            },
                            price: () => {
                                return SalesforceInteractions.resolvers.fromSelectorMultiple(".product-info .pricing");
                            },
                            quantity: () => {
                                return SalesforceInteractions.resolvers.fromSelectorMultiple(".product-info .qty-card-quantity-count");
                            },
                        }
                    }
                }
            },
            {
                name: "order_confirmation",
                isMatch: () => /\/confirmation/.test(window.location.href),
                interaction:{
                    name: SalesforceInteractions.OrderInteractionName.Purchase,
                    order: {
                        Product: {
                            orderId: () => {
                                return SalesforceInteractions.DisplayUtils.pageElementLoaded(".order-number", "html").then((ele) => {
                                    return SalesforceInteractions.resolvers.fromSelector(".order-number");
                                });
                            },
                            lineItems: {
                                _id: () => {
                                    return SalesforceInteractions.resolvers.fromSelectorAttributeMultiple(".product-info .product-details .line-item-name", "data-pid");
                                },
                                price: () => {
                                    return SalesforceInteractions.resolvers.fromSelectorMultiple(".product-info .pricing");
                                },
                                quantity: () => {
                                    return SalesforceInteractions.resolvers.fromSelectorMultiple(".product-info .qty-card-quantity-count");
                                }
                            }
                        }
                    }   
                }
            },
            {
                name: "static-page-a",
                isMatch: () => /\/static-page-a/.test(window.location.href),
                onActionEvent: (actionEvent) => {
                    actionEvent.user = actionEvent.user || {};
                    actionEvent.user.identities = actionEvent.user.identities || {};
                    actionEvent.user.attributes = actionEvent.user.attributes || {};
                    actionEvent.user.identities.customerId = "customerKey43415881";
                    actionEvent.user.attributes.nonIdentityEmail = "cloz2me@gmail.com";
                    actionEvent.user.attributes.firstName = "Eihwan";
                    actionEvent.user.attributes.lastName = "Kim";
                    actionEvent.user.attributes.UserName = "UserName HogeHoge";
                    actionEvent.user.attributes.title = "title";
                return actionEvent;
                }
            },
            {
                name: "static-page-b",
                isMatch: () => /\/static-page-b/.test(window.location.href),
                onActionEvent: (actionEvent) => {
                    actionEvent.user = actionEvent.user || {};
                    actionEvent.user.identities = actionEvent.user.identities || {};
                    actionEvent.user.attributes = actionEvent.user.attributes || {};
                    
                    actionEvent.user.identities.customerId = "test123";
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
                    actionEvent.user.identities = actionEvent.user.identities || {};
                    actionEvent.user.attributes = actionEvent.user.attributes || {};
/*                    
                    actionEvent.user.identities.customerId = "customerId";
                    actionEvent.user.attributes.name = "name";
                    actionEvent.user.attributes.title = "title";
                    actionEvent.user.attributes.displayName = "displayName";
*/
                    actionEvent.user.attributes.userName = "userName";
                    actionEvent.user.attributes.displayName = "displayName";
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
    SalesforceInteractions.initSitemap(config);
});