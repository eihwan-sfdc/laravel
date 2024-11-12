/** Enable detailed client-side console logging. Do not use in Prod environment! */

//SalesforceInteractions.setCookieDomain('eyeglass-store-e961361984b8.herokuapp.com')



SalesforceInteractions
  .init({
   consents: [{
     purpose: SalesforceInteractions.ConsentPurpose.Tracking,
      provider: "Example Consent Manager",
     status: SalesforceInteractions.ConsentStatus.OptIn
    }],
    personalization: {
      dataspace: "default",
    },
  })
  .then(() => {
    console.log('Data Cloud Sitemap Loaded')
    SalesforceInteractions.setLoggingLevel('debug')

    //プロファイルデータ

    const email = SalesforceInteractions.cashDom(".logged-in-user-email").text().trim();

    if (email) {

      const fname = 'Eihwan';
      const lname = 'Kim';
      const phoneNumber = '080-1111-2222';  

      SalesforceInteractions.sendEvent({
        interaction: {
          name: 'ContactPointEmail_capture',
        },
        user: {
          attributes: {
            email,
            eventType: 'contactPointEmail',
          }
        }
      })

      SalesforceInteractions.sendEvent({
        interaction: {
          name: 'Identity_capture',
        },
        user: {
          attributes: {
            email,
            fname,
            lname,
            eventType: 'identity',
            isAnonymous: 0,
          }
        }
      })
    }

    if (phoneNumber) {
      SalesforceInteractions.sendEvent({
        interaction: {
          name: 'ContactPointPhone_capture',
        },
        user: {
          attributes: {
            phoneNumber,
            eventType: 'contactPointPhone',
          }
        }
      })

      SalesforceInteractions.sendEvent({
        interaction: {
          name: 'Identity_capture',
        },
        user: {
          attributes: {
            phoneNumber,
            fname,
            lname,
            eventType: 'identity',
            isAnonymous: 0,
          }
        }
      })
    }

    ///🌸🌸🌸🌸🌸🌸🌸🌸🌸🌸🌸🌸🌸
    const sitemapConfig = {
      global: {
        locale: 'ja_JP',
        onActionEvent: (event) => {
            console.log({event})
            // Request personalization for the "footer_banner" personalization point on every page
            SalesforceInteractions.Personalization.fetch(["Max_Revenue", "Manual_Recommend_Items"]).then(
              (personalizations) => {
                console.log({personalizations})

                const {
                  BackgroundImageUrl,
                  CallToActionText,
                  CallToActionUrl,
                  Header,
                  Subheader
                } = personalizations.personalizations[0].attributes;

                const {
                  personalizationId,
                  personalizationPointId
                } = personalizations.personalizations[0]
                
                SalesforceInteractions.cashDom('.campaign-area').append(`
                	<div>
                    <p>${Header}</p>
                    <p>${Subheader}</p>
                    <img src="${BackgroundImageUrl}" width="100%" height="auto" />
                    <a href="${CallToActionUrl}" class="cta-link" data-p13n-id="${personalizationId}" data-p13n-point-id="${personalizationPointId}">${CallToActionText}</a>
                  </div>
                `)
                
                const personalizationIdRec = personalizations.personalizations[1].personalizationId
          

				SalesforceInteractions.cashDom('.campaign-area-recommend').css("display", "flex");
                personalizations.personalizations[1].data.map(v => {
                  console.log(v)
                  const {personalizationContentId} = v
                  SalesforceInteractions.cashDom('.campaign-area-recommend').append(`
                    <div data-p13n-id="${personalizationIdRec}" data-p13n-content-id="${personalizationContentId}" class="item-recommend">
                      <p>${v.productName__c}</p>
                      <p class="product-id">${v.productSKU__c}</p>
                      <p>${v.unitPrice__c}</p>
                      <a href="${v.productURL__c}" class="cta-link item-recommend-link" data-p13n-id="${personalizationIdRec}" data-p13n-content-id="${personalizationContentId}" >
                        <img src="${v.productImageURL__c}" width="300px" height="auto" />
                      </a>
                    </div>
                  `)


                })

               

              },
            );
            return event;
        },
        listeners: [
          SalesforceInteractions.listener('click', '.cta-link', (e) => {
            console.log(e.target);
            //e.preventDefault();
            SalesforceInteractions.sendEvent({ 
                interaction: { 
                    name : 'personalizationPointClick',
                    personalizationId : e.target.dataset.p13nId,
                    personalizationContentId: e.target.dataset.p13nPointId,
                }, 
            });
        
        }),
        ],
      },
        pageTypes: [
          {
            locale: 'ja_JP',
            name: "home",
            isMatch: () => window.location.pathname === '/',
            interaction: {
                name: 'Homepage',
                // catalogObject: {
                //     type: 'Page',
                //     id: 'Homepage',
                // }
                eventType: 'browse',
                pageName: 'Lighthouse Home',
                pageType: 'homepage',
                pageUrl: 'https://laravel-nto-a2161b512c29.herokuapp.com',
                pageView: '1',
            },
              /*eventType: 'browse',
              pageName: 'Lighthouse Home',
              pageType: 'homepage',
              pageUrl: window.location.href,
              pageView: '1',*/
//            },
            listeners: [],
          },
          {
            locale: 'ja_JP',
            name: "product_detail",
            isMatch: () => /detail/.test(window.location.pathname),
            interaction: {
              name: SalesforceInteractions.CatalogObjectInteractionName.ViewCatalogObject,
              eventType: 'browse',
              pageName: 'PDP',
              pageType: 'product_detail',
              pageUrl: window.location.href,
              pageView: '1',

              catalogObject: () => {
                //商品データ
                const ItemName = document.querySelector('.product-detail[data-pname]').getAttribute("data-pname");
                const ItemPrice = document.querySelector('.product-detail[data-pname]').getAttribute("data-regularprice").replace(/¥|\,/g, '');
                const ImageUrl = document.querySelector('.img-fluid').getAttribute("src");
                const ItemURL = window.location.href;
                const ItemSKU = document.querySelector('.product-detail[data-pname]').getAttribute("data-pid");

                return {
                  type: 'product_detail',
                  id: ItemSKU,
                  attributes: {
                    productName: ItemName,
                    productSku: ItemSKU,
                    productUrl: ItemURL,
                    productImageUrl: ImageUrl,
                    unitPrice: parseInt(ItemPrice),
                  }
                }
              }
            },
            listeners: [
              SalesforceInteractions.listener('click', '.item-recommend-link', (e) => {
				console.log(e.target);
	            e.preventDefault();
    	        SalesforceInteractions.sendEvent({ 
        	        /*interaction: { 
            	        name : 'personalizationPointClick',
                	    personalizationId : e.target.dataset.p13nId,
                    	personalizationContentId: e.target.dataset.p13nPointId,
	                }, */
	                interaction: {
                        name : "catalog-object-click",
                        eventType : "catalog",
                        type : "Product",
                        id : SalesforceInteractions.cashDom(e.target).find('.product-id').text(),
                        personalizationId : e.target.dataset.p13nId,
                        personalizationContentId: e.target.dataset.p13nContentId
                     }
    	        });
              }),
              SalesforceInteractions.listener('click', '.details-button', (e) => {
                // e.preventDefault();
                /*
                SalesforceInteractions.sendEvent({
                  interaction: {
                    name: SalesforceInteractions.OrderInteractionName.Purchase,
                    order: {
                      id: 'product-002',
                      totalValue: 15000,
                      currency: 'JPY',
                      lineItems: [{
                        catalogObjectType: 'Product',
                        catalogObjectId: 'product-002',
                        quantity: 1,
                        price: 15000,
                      }]
                    }
                  }
                })
                */
				
                const ItemName = document.querySelector('.product-detail[data-pname]').getAttribute("data-pname");
                const ItemPrice = document.querySelector('.product-detail[data-pname]').getAttribute("data-regularprice").replace(/¥|\,/g, '');
                const ImageUrl = document.querySelector('.img-fluid').getAttribute("src");
                const ItemURL = window.location.href;
                const ItemSKU = document.querySelector('.product-detail[data-pname]').getAttribute("data-pid");
                console.log(ItemName, ItemPrice, ImageUrl, ItemURL, ItemSKU)
                
                
				
                SalesforceInteractions.sendEvent({
                  interaction: {
                    name: SalesforceInteractions.OrderInteractionName.Purchase,
                    order: {
                      id: ItemSKU,
                      totalValue: parseInt(ItemPrice),
                      currency: 'JPY',
                      lineItems: [{
                        catalogObjectType: 'Product',
                        catalogObjectId: ItemSKU,
                        quantity: 1,
                        price: parseInt(ItemPrice),
                      }]
                    }
                  }
                })
              })
            ],
          }
        ],
        pageTypeDefault: {
          locale: 'ja_JP',
          name: 'Default',
          interaction: {
            name: 'default',
            catalogObject: {
              type: 'Page',
              id: 'Default'
            }
          }
        }
    };

    SalesforceInteractions.initSitemap(sitemapConfig);
  });