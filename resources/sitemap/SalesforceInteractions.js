SalesforceInteractions.init({
    cookieDomain: "laravel-nto-a2161b512c29.herokuapp.com",
    consents: [
    {
        purpose: SalesforceInteractions.mcis.ConsentPurpose.Personalization,
        provider: "Example Consent Manager",
        status: SalesforceInteractions.ConsentStatus.OptIn,
    },
  ],
}).then(() => {
    const sitemapConfig = {
        global: {
            onActionEvent: (actionEvent) => {
                const email = SalesforceInteractions.cashDom(".logged-in-user-email").text().trim();
                if (email) {
                    actionEvent.user = actionEvent.user || {};
                    actionEvent.user.attributes = actionEvent.user.attributes || {};
                    actionEvent.user.attributes.emailAddress = email;
                    actionEvent.user.attributes.customerId = email;
                    actionEvent.user.attributes.sfmcContactKey = email;
                    actionEvent.user.attributes.userName = email; /* attribute name is case sensitive */
                }
                return actionEvent;
            },
            contentZones: [
                {name: "global_infobar_top_of_page", selector: "header.site-header"},
                {name: "global_infobar_bottom_of_page", selector: "footer.footer"},
                {name: "global_popup" }
            ],
            listeners: [
                SalesforceInteractions.listener("submit", ".email-signup", () => {
                    const email = "dummy-email-signup-footer@salesforce.com";
                    if (email) {
                        SalesforceInteractions.sendEvent({ action: "Email Sign Up - Footer", user: {attributes: {emailAddress: email}}});
                    }
                }),
            ],
        },         
        pageTypeDefault: {
            name: "default",
            interaction: {
                name: "Default Page",
            },
        },
        pageTypes: [
            // {
            //     name: "category",
            //     action: "Viewed Category",
            //     isMatch: () => /\/category/.test(window.location.href),
                
            // },
            {
                name: "product_detail",
                
                // この Page Type に該当するかどうかを判断
                isMatch: () => /\/detail/.test(window.location.href),
                
                interaction: {
                    name: SalesforceInteractions.CatalogObjectInteractionName.ViewCatalogObject,
                    catalogObject: {
                        type: "Product",
                        id: SalesforceInteractions.cashDom(".product-detail[data-pid]").attr("data-pid"),
                        attributes: {
                            name: SalesforceInteractions.cashDom(".product-detail[data-pname]").attr("data-pname"),
                            url: window.location.href,
                            imageUrl: SalesforceInteractions.cashDom(".img-fluid").attr("src"),
                            inventoryCount: 1,
                            regular_price: SalesforceInteractions.cashDom(".product-detail[data-regularprice]").attr("data-regularprice"),
                            salesprice: SalesforceInteractions.cashDom(".product-detail[data-saleprice]").attr("data-saleprice"),
                        },
                        relatedCatalogObjects: {
                            Category: SalesforceInteractions.cashDom(".product-detail[data-category]").attr("data-category"),
                            Gender: () => {
                                if (SalesforceInteractions.cashDom(".product-detail[data-gender]").attr("data-gender").toLowerCase() === "women") {
                                    console.log("WOMEN");
                                    return ["WOMEN"];
                                } else if (SalesforceInteractions.cashDom(".product-detail[data-gender]").attr("data-gender").toLowerCase() === "men") {
                                    console.log("MEN");
                                    return ["MEN"];
                                }
                            },
                        }
                    },
                }, 
                contentZones: [
                    { name: "product_detail_recs_row_1", selector: ".row.recs.igo_product" },
                    { name: "product_detail_recs_row_2", selector: ".row.recs.evergage_product" },
                ],
                listeners: [ 
                    SalesforceInteractions.listener("click", ".add-to-cart", () => {
                        let lineItem = { 
                            catalogObjectType: "Product",
                            catalogObjectId: SalesforceInteractions.cashDom(".product-detail[data-pid]").attr("data-pid"),
                            price: SalesforceInteractions.cashDom(".product-detail[data-saleprice]").attr("data-saleprice"),
                            quantity: 1,
                        };
                        SalesforceInteractions.sendEvent({
                            interaction: {
                                name: SalesforceInteractions.CartInteractionName.AddToCart,
                                lineItem: lineItem,
                            },
                        });
                    }),
                    SalesforceInteractions.listener("click", "#viewItemDetail", () => {
                        SalesforceInteractions.sendEvent({
                            interaction: {
                                name: SalesforceInteractions.CatalogObjectInteractionName.ViewCatalogObjectDetail,
                                catalogObject: {
                                    type: "Product",
                                    id: SalesforceInteractions.cashDom(".product-detail[data-pid]").attr("data-pid"),
                                    // attributes: {
                                        
                                    // },
                                    // relatedCatalogObjects: {
                                    //   Color: [
                                    //     SalesforceInteractions.cashDom(".color-value.selected").attr(
                                    //       "data-attr-value",
                                    //     ),
                                    //   ],
                                    // },
                                }
                            }
                        });
                    }),
                    SalesforceInteractions.listener("click", "#quickViewItem", () => {
                        SalesforceInteractions.sendEvent({
                            interaction: {
                                name: SalesforceInteractions.CatalogObjectInteractionName.QuickViewCatalogObject,
                                catalogObject: {
                                type: "Product",
                                id: SalesforceInteractions.cashDom(".product-detail[data-pid]").attr("data-pid"),
                            },
                          },
                        });
                    }),
                    SalesforceInteractions.listener("click", ".quickViewClose", () => {
                        SalesforceInteractions.sendEvent({
                            interaction: {
                                name: SalesforceInteractions.mcis.CatalogObjectInteractionName.StopQuickViewCatalogObject,
                            },
                        })
                    }),
                ]
            },
            {
                name: "cart",   
                isMatch: () => /\/cart/.test(window.location.href),
                interaction: {
                    name: SalesforceInteractions.CartInteractionName.ReplaceCart,
                    lineItems: SalesforceInteractions.DisplayUtils.pageElementLoaded(
                        ".cart-empty, .checkout-btn",
                        "html",
                      ).then(() => {
                        let cartLineItems = [];
                        SalesforceInteractions.cashDom(".product-info").each((index, ele) => {
                        //   let itemQuantity = parseInt(
                        //     SalesforceInteractions.cashDom(ele).find(".qty-card-quantity-count").text().trim(),
                        //   );
                        itemQuantity = 1;
                          if (itemQuantity && itemQuantity > 0) {
                            let lineItem = {
                              catalogObjectType: "Product",
                              catalogObjectId: SalesforceInteractions.cashDom(ele)
                                .find(".line-item-name")
                                .attr("data-pid"),
                              price:
                                SalesforceInteractions.cashDom(ele)
                                  .find(".pricing")
                                  .text()
                                  .replace(/[^0-9\.]+/g, "") / itemQuantity,
                              quantity: itemQuantity,
                            };
                            cartLineItems.push(lineItem);
                          }
                        });
                        return cartLineItems;
                      }),
                },
            },
            {
                name: "order_confirmation",
                isMatch: () => /\/confirmation/.test(window.location.href),
                interaction: {
                    name: SalesforceInteractions.OrderInteractionName.Purchase,
                    order: {
                        id: SalesforceInteractions.cashDom(".order-number").attr("data-orderid"),
                        lineItems: SalesforceInteractions.DisplayUtils.pageElementLoaded(
                          ".product-line-item",
                          "html",
                        ).then(() => {
                          let purchaseLineItems = [];
                          SalesforceInteractions.cashDom(".product-line-item").each((index, ele) => {
                            let itemQuantity = 1;
                            // let itemQuantity = parseInt(
                            //   SalesforceInteractions.cashDom(ele)
                            //     .find(".qty-card-quantity-count")
                            //     .text()
                            //     .trim(),
                            // );
                            if (itemQuantity && itemQuantity > 0) {
                              let lineItem = {
                                catalogObjectType: "Product",
                                catalogObjectId: SalesforceInteractions.cashDom(ele).find(".line-item-name").attr("data-pid").trim(),
                                price: 
                                  SalesforceInteractions.cashDom(ele)
                                    .find(".pricing")
                                    .text()
                                    .trim()
                                    .replace(/[^0-9\.]+/g, "") / itemQuantity,
                                quantity: itemQuantity,
                              };
                              purchaseLineItems.push(lineItem);
                            }
                          });
                          return purchaseLineItems;
                        }),
                    }
                },
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
    SalesforceInteractions.initSitemap(sitemapConfig);
});