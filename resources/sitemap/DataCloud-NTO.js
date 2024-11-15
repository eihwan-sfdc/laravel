// Sample SiteMap for Northern Trail Outfitters
// For debugging, log the version of the sitemap. 
// Iterate with each change so you can ensure the sitemap has updated.
console.log('Data Cloud SDK v1.0 Detected')

// ********* Start CONSENT Check Part 1 **********
// The Function below is used to Get a Cookie Value for a specific cookie item. This is used to retrieve consent information, but can be used beyond consent to obtain other cookie values if required

function getCookieValue(name) {
    var cookieFieldValue = document.cookie.split('; ').find((item) => item.trim().startsWith(name));
    var cookiePair = cookieFieldValue.split('=');
  
    if(cookiePair[0] === name) {
      return decodeURIComponent(cookiePair[1]); // Decode the cookie value and return it
          }
    
    // Return null if the cookie with the given name is not found
    return null;
  }

// Use function above to check cookie for consent. This cqcid value is NOT a true consent field, the code below is added as an example of checking the cookie for a value
var myConsentValue = getCookieValue('cqcid'); // <--- Replace 'cqcid' with cookie field containing consent (as provided by client web team)

// Check output of consent cookie to determine if consent applied. This test looks for value NOT equal to 0 -- update equality test and value as required
let activeConsentStatus;

if (myConsentValue !== '0' && myConsentValue !== null) {        // <--- Update MyConsentValue test to be expected value (eg myConsentValue === '1')
    console.log('Consent Opt In for Value: ' + myConsentValue);
    activeConsentStatus = SalesforceInteractions.ConsentStatus.OptIn;
    }
else {
    console.log('Consent Opt Out for Value: ' + myConsentValue);
    activeConsentStatus = SalesforceInteractions.ConsentStatus.OptOut;
    }
// ********* End CONSENT Check Part 1 **********


SalesforceInteractions.init({
   personalization: {
    dataspace: "Personalization",
  },
    //Define the cookieDomain to specify where cookies should be stored for the website. 
    //This setting ensures that cookies are only accessible within the specified domain, making it more secure and preventing potential security vulnerabilities.
    cookieDomain: 'northerntrailoutfitters.com', // <--- Update Cookie Domain with relevant client website domain 

// ********* Start CONSENT Check Part 2 **********
// This logs consent to Data Cloud BehavioralEvents. If Consent is opt out, remainder of sitemap does not process
    consents: [{
        purpose: 'Data Cloud Web SDK',
        provider: 'Consent Provider',
        status: activeConsentStatus
    }]
// ********* END CONSENT Check Part 2 **********

}).then(() => {
    console.log('Data Cloud Sitemap Loaded')

    // Comment loggingLevel and all console.log not necessary for Production
    SalesforceInteractions.setLoggingLevel('debug')
    const {
        cashDom,
        listener,
        resolvers,
        sendEvent,
        util,
        CatalogObjectInteractionName
    } = SalesforceInteractions

    // ********* Start Determine LOCALE **********
    // Get Locale for user to write into Behavioral Events. The commented code below can be used if locale is captured by he site. Comment out the "return navigator.languages" statement. Replace it with the commented code immediately below it
    let locale = (() => {
        return navigator.languages && navigator.languages.length ? navigator.languages[0] : navigator.language;
        // const cqLocale = window.CQuotient.locale;
        // if (cqLocale === 'default') {
            // Use the browser's language settings
            // navigator.languages is an array of preferred languages ordered by the user preference
        //     return navigator.languages && navigator.languages.length ? navigator.languages[0] : navigator.language;
        // } else {
        //     return cqLocale;
        // }
    })();

    console.log('locale: ' + locale); // This will log the determined locale value
    // ********* End Determine LOCALE **********
    
    let config = {
        // Global Configuration will apply listeners to all pages the SDK is installed. Global config fires on each pageload.
        // Typical use-case would be to capture the response on a footer form that displays on all pages of the website or to retrieve information from a URL parameter

        global: {
            // ********* Start Retreive Party Identifier from URL PARAMETER **********

            onActionEvent: (actionEvent) => {
                //ActionEvents are used for actions that dont trigger via a listener. In this case the action is required on each pageload (check for URL parameters).
                // the code below extracts the value of the parameter mcsubscriberkey and writes it to the [SDK Name]-partyIdentification DLO
                // If there are no parameters to capture for party identification then the onaction section can be commented out

                const queryString = window.location.search.toLowerCase();
                const urlParams = new URLSearchParams(queryString);
                const paramId1 = urlParams.get('mcsubscriberkey');  // <--- Update parameter name to name of parameter containing user identifier (in lower case)

                if (paramId1) {
                    console.log('URL Parameter Detected: ' + paramId1) 
                    actionEvent.user = actionEvent.user || {};
                    actionEvent.user.attributes = actionEvent.user.attributes || {};
                    actionEvent.user.attributes.userId = paramId1;
                    actionEvent.user.attributes.eventType = 'partyIdentification';
                    actionEvent.user.attributes.IDType = 'Person Identifier';  
                    actionEvent.user.attributes.IDName = 'MC Subscriber Key'; // <-- Update IDName to match name of party identifier name field in Data Cloud
                }

                return actionEvent;

            },
            // ********* END Retreive Party Identifier from URL Parameter **********

            listeners: [

                // ****** START Listen for FORM COMPLETION with Name + Email + Phone ******

                // The example below listens for the click of the "Create Account" button as a trigger for form submission.
                // A second test is added to this to validate the page url matches, because other unrelated buttons exist with this id on other pages
                listener('click', '.btn.btn-block.btn-primary', (event) => {       // <-- Update button id/class for relevant button on target site
                    console.log('button event fired')

                    if (window.location.pathname.split('/').includes('Login-Register')) {     // <-- This check could potentially be removed if button only appears with the relevant form. Otherwise update check to validate page URL where button is located 
                        console.log('url check fired')
                        // Set variables to capture input values on corresponding fields with ids '#id-name'
                        // When using the Identity eventType, values in the corresponding Identity DLO that are not specified here will overwrite as null
                        // Add a new field by duplicating const and replacing the selector
                        // const newField = SalesforceInteractions.cashDom("#newField").val()

                        const emailAddress = SalesforceInteractions.cashDom("#registration-form-email").val() // <-- update id "#registration-form-email" with identifier for email address on relevant form
                        const firstName = SalesforceInteractions.cashDom("#registration-form-fname").val()    // <-- update id "#registration-form-fname" with identifier for first name on relevant form
                        const lastName = SalesforceInteractions.cashDom("#registration-form-lname").val()     // <-- update id "#registration-form-lname" with identifier for last name on relevant form
                        const phoneNumber = SalesforceInteractions.cashDom("#registration-form-phone").val()  // <-- update id "#registration-form-phone" with identifier for phone on relevant form
                        // const addlField = SalesforceInteractions.cashDom("#addl-field-name").val()         // <-- Remove comment marker and update for additional field name(s) if required

                        if (emailAddress) {
                            console.log('Email: ' + emailAddress)
                            // This step writes email to the DLO [SDK Name]-contactPointEmail
                            sendEvent({
                                interaction: {
                                    name: 'submitForm'
                                },
                                user: {
                                    attributes: {
                                        email: emailAddress,
                                        eventType: 'contactPointEmail'
                                    }
                                }
                            })
                        }

                        if (phoneNumber) {
                            console.log('Phone: ' + phoneNumber)
                            // This step writes email to the DLO [SDK Name]-contactPointPhone
                            sendEvent({
                                interaction: {
                                    name: 'submitForm'
                                },
                                user: {
                                    attributes: {
                                        phoneNumber: phoneNumber,
                                        eventType: 'contactPointPhone'
                                    }
                                }
                            })
                        }

                        if (firstName || lastName) {
                            console.log('Name: ' + firstName + ' ' + lastName)

                        // This step writes a record to the DLO [SDK Name]-identity to ensure email signups are mapped to individual
                        // The identity object should be populated to ensure mapping to individual.  
                            sendEvent({
                                interaction: {
                                    name: 'submitForm'
                                },
                                user: {
                                    attributes: {
                                        firstName: firstName || '',
                                        lastName: lastName || '',
                                        // addlField: addlField || '',   // <-- if adding additional fields, update names, remove comment marker to add here
                                        eventType: 'identity',
                                        isAnonymous: 0
                                    }
                                }
                            })
                        }
                    }
                }),
                // ****** END Listen for Form Completion with Name + Email + Phone ******

                // ****** START Listen for Email Only FORM COMPLETION ******
                listener('click', $("button[value='Subscribe']"), (event) => {          
                    console.log('Email Subscribe event fired')
                    // Set variables to capture input values on corresponding fields with ids '#id-name'
                    // When using identity eventType, values not set will overwrite as null
                    

                    const emailAddress = SalesforceInteractions.cashDom("#dwfrm_mcsubscribe_email").val()  // <-- Update id "#dwfrm_mcsubscribe_email" with identifier for email address on relevant form
                    // const newField = SalesforceInteractions.cashDom("#newField").val() // <-- Add additional field(s) by duplicating const and replacing the id (#newField) in the selector
                    if (emailAddress) {
                        // This step writes email to the DLO [SDK Name]-contactPointEmail
                        sendEvent({
                            interaction: {
                                name: 'submitForm'
                            },
                            user: {
                                attributes: {
                                    email: emailAddress,
                                    eventType: 'contactPointEmail'
                                }
                            }
                        })
                        // This step writes a record to the DLO [SDK Name]-identity to ensure email signups are mapped to individual
                        // The identity object should be populated to ensure mapping to individual.  
                        // Note: writing to the identity object without a first name or lastname specified will results in those fields being blanked out
                        // The assumption is email subscription fields are entered before more details logins occur, making the risk of lost data small
                        sendEvent({
                            interaction: {
                                name: 'submitForm'
                            },
                            user: {
                                attributes: {
                                    eventType: 'identity',
                                    isAnonymous: 0
                                }
                            }
                        })
                    }
                })
                // ****** END Listen for Email only Form Completion ******
            ],
         
        },

        // ****** Start Specify DEFAULT PAGE TYPE ******
        // Default page type is specified to write details as a catalog object
        // This will fire when none of the pagetype statements below exist. date, device, URL etc will be captured in the [SDK Name]-BehavioralEvents object in Data Cloud
        pageTypes: [],
        pageTypeDefault: {
            locale: locale,
            name: "Default",
            interaction: {
                name: SalesforceInteractions.CatalogObjectInteractionName.ViewCatalogObject,
                catalogObject: {
                    type: 'Page',
                    id: 'Default',
                    color: 'Brown',
                    itemType: 'Product',
                    productImageUrl: 'https://www.northerntrailoutfitters.com/on/demandware.static/-/Sites-nto-apparel/default/dw221acc7f/images/large/1010516AK5-0.jpg',
                    productName: 'DummyVestBrown',
                    productSku: 'DummyVestBrown',
                    productUrl: 'https://www.northerntrailoutfitters.com/default/men/jackets-%26-vests/vests/men%E2%80%99s-pill-vest-1010516AK5.html',
                    size: 'S',
                    unitPrice: '70',
                }
            },
        },
        // ****** END Specify Default PAGE TYPE ******
    };
    const PageId = SalesforceInteractions.cashDom("meta[name='PAGE']").attr("content")

    // ****** Start Specify SPECIFIC PAGE TYPES ******

    // Page Types will identify and send events based on current page. As mentioned above, if none of these criteria fire, the Default page type will be recorded
    // In the examples below all page types are written as Catalog events which will appear in the [SDK Name]-BehavioralEvents object in Data Cloud

    // Homepage
    config.pageTypes.push({
        locale: locale,
        name: 'Homepage',
        isMatch: () => {
            // Pathname excludes root domain and excludes query parameters
            // Example www.mysite.com/products/red-shirt?test=param would be /products/red-shirt
            return window.location.pathname.split('/').includes('homepage')
        },
        interaction: {
            name: SalesforceInteractions.CatalogObjectInteractionName.ViewCatalogObject,
            catalogObject: {
                type: 'Page',
                id: 'Homepage',
                color: 'BLACK',
                itemType: 'Product',
                productImageUrl: 'https://www.northerntrailoutfitters.com/on/demandware.static/-/Sites-nto-apparel/default/dw8b666c6e/images/large/1010024AC8-0.jpg',
                productName: 'DummyVestBlack',
                productSku: 'DummyVestBlack',
                productUrl: 'https://www.northerntrailoutfitters.com/default/men/jackets-%26-vests/vests/men%27s-everyday-vest-1010024AC8.html',
                size: 'M',
                unitPrice: '700',
            }
        },
        listeners: []
    });

    // Womens Pages 
    config.pageTypes.push({
        locale: locale,
        name: 'Women',
        isMatch: () => {
            return window.location.pathname.split('/')[2].split('-').includes('women')
        },
        interaction: {
            name: SalesforceInteractions.CatalogObjectInteractionName.ViewCatalogObject,
            catalogObject: {
                type: 'Page',
                id: 'Women',
                color: 'BLACK',
                itemType: 'Product',
                productImageUrl: 'https://www.northerntrailoutfitters.com/on/demandware.static/-/Sites-nto-apparel/default/dwe0974982/images/large/2030902AC8-0.jpg',
                productName: 'DummyShortsBlack',
                productSku: 'DummyShortsBlack',
                productUrl: 'https://www.northerntrailoutfitters.com/default/women/bottoms/shorts/women%E2%80%99s-ambition-shorts-2030902AC8.html',
                size: 'M',
                unitPrice: '50',
            }
        },
        listeners: []
    });

    // Mens Pages
    config.pageTypes.push({
        locale: locale,
        name: 'Men',
        isMatch: () => {
            return window.location.pathname.split('/')[2].split('-').includes('men')
        },
        interaction: {
            name: SalesforceInteractions.CatalogObjectInteractionName.ViewCatalogObject,
            catalogObject: {
                type: 'Page',
                id: 'Men',
                color: 'BLACK',
                itemType: 'Product',
                productImageUrl: 'https://www.northerntrailoutfitters.com/on/demandware.static/-/Sites-nto-apparel/default/dw3d172150/images/large/2030630AC8-0.jpg',
                productName: 'DummyPantsBlack',
                productSku: 'DummyPantsBlack',
                productUrl: 'https://www.northerntrailoutfitters.com/default/men/bottoms/snow-%26-alpine/women%27s-rainier-l5-gtx-pro-full-zip-bib-2030630AC8.html',
                size: 'M',
                unitPrice: '575',
            }
        },
        listeners: []
    });

    // ****** End Specify SPECIFIC PAGE TYPES ******

    SalesforceInteractions.initSitemap(config);
});