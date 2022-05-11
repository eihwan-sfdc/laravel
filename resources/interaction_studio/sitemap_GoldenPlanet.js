Evergage.init({
    cookieDomain: "goldenplanet.co.kr",
    trackerUrl: "https://goldenplanet.australia-3.evergage.com"
}).then(() => {
    
    const config = {
        global: {}, 
        pageTypeDefault: {
            name: "default"
        },
        pageTypes: 
        [    
//             {
// 					name: "order_confirmation",
// 					isMatch: () => /\/services/.test(window.location.href),
//                     itemAction: Evergage.ItemAction.Purchase,
//                     catalog: {
//                         Product: {
//                                 orderId: "ord12345",
//                                 totalValue: 25000,
//                                 currency: "KRW"                                                     
//                             }
//                     }
// 			},
            {
                name: "product_detail",
                itemAction: Evergage.ItemAction.ViewItemDetail,
                isMatch : () => /\/solutions/.test(window.location.href),
                catalog:{
                    Product: {
                        _id: "블랙쿠션",
                        sku:1,
                        name: "블랙쿠션13N1",
                        description: "상품 카탈로그 테스트",       
                        inventoryCount: 1,
                        price: 30000,
                        currency:"KRW",
                        relatedCatalogObjects: { // In case you're using 'dimensions' instead of 'relatedCatalogObjects', you can continue to do so as they both function the same way.
                            Brand:["아이오페"],
                            age : ["29"]
                        }
                    }
                },
                contentZones: [
                    { name: "product_detail_recs_row_1" },
                    { name: "product_detail_recs_row_2"},
                    { name: "testHeader"},
                ] 
            },      
            {
                name: "home1",
                action: "Homepage12",
                isMatch: () => /\/goldenplanet/.test(window.location.href),                          
                contentZones: [       
                    { name: "firstName" ,selector:"test123" },        
                    { name: "home_sub_hero", selector: "div .gnb-area h1 a" },
                    { name: "home_popup" ,selector: "div .evg-light-on-dark"}
                ],listeners: [
					Evergage.listener("click", ".ba-service a.nav-link.active", () => { //add-to-cart 이벤트클릭						
                        Evergage.sendEvent({
                            name: "add-to-cart",
                            action: "add-to-cart",
                            itemAction: Evergage.ItemAction.AddToCart,
							isMatch : () => /\/services/.test(window.location.href),
                            catalog: {
                                    Product: {
                                        _id: "블랙쿠션",
                                        sku:1,
                                        name: "블랙쿠션13N1",
                                        description: "장바구니 추가",       
                                        inventoryCount: 1,
                                        price: 30000,
                                        currency:"KRW",
                                        relatedCatalogObjects: { // In case you're using 'dimensions' instead of 'relatedCatalogObjects', you can continue to do so as they both function the same way.
                                            Brand:["헤라"],
                                            age : ["29"]
                                        }
                                    }
                            }                      
                        });
                    }),
                    Evergage.listener("click", ".ba-service a.nav-link.active", () => { //Remove From Cart 이벤트 클릭					
                        Evergage.sendEvent({
                            name: "Remove-From-Cart",
                            itemAction: Evergage.ItemAction.RemoveFromCart,
							isMatch : () => /\/services/.test(window.location.href),
                            cart: {
                                singleLine: {
                                    Product: {
                                        _id: "블랙쿠션",
                                        sku:"1",
                                        name: "블랙쿠션13N1",
                                        description: "장바구니 추가",       
                                        inventoryCount: 1,
                                        price: 30000,
                                        currency:"KRW",
                                        relatedCatalogObjects: { // In case you're using 'dimensions' instead of 'relatedCatalogObjects', you can continue to do so as they both function the same way.
                                            Brand:["헤라"],
                                            age : 29
                                        }
                                    }
                                }
                            }
                        });
                    }),
                    Evergage.listener("click", "div.gnb-area h1 a", () => { //로고 클릭
                        const Company = Evergage.cashDom("div.gnb-area a img").attr('alt');
                        if (Company) {
                            Evergage.sendEvent({
                                action: "Banner",
                                catalog: {
                                    Category: {
                                        BannerName : Company
                                    }
                                }                         
                            });
                        }
                    }),
                    Evergage.listener("click", ".evg-cta", () => { //팝업창 버튼클릭
                        Evergage.sendEvent({
                                action: "BannerClick",
                                catalog: {
                                    Category: {
                                        ClickBtnName : $(".evg-cta").text()
                                    }
                                },
                                contentZones: [       
                                    { name: "home_popup" ,selector: "div .evg-light-on-dark"}
                                ]                              
                            });
                    }),
                ],			
            }
       ]
    };

    Evergage.initSitemap(config);

});