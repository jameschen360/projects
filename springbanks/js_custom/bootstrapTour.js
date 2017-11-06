$( document ).ready(function() {
    // // Instance the tour
    // var tour = new Tour({
    //     backdrop: true,
    //     onNext: function(tour){                
    //         var step_resolved  = new Promise(function(resolve){
    //             if(tour._current+1 > tour._options.steps.length)
    //                 return;

    //             tour.goTo(tour._current+1);
    //             //tour.setCurrentStep(tour._current+1);
    //             console.log((tour._current+1));
    //             // if(jQuery('body').find(tour._options.steps[(tour._current)].element).length > 0){
    //             //     console.log('#3');
    //             //     resolve(tour);
    //             // }
    //             if (tour._current === 4) {
    //                 $('.buttonFilter').click();
    //             }
    //         });

    //         return step_resolved;
    //     },          
    //     onShown: function(tour) {

    //         // ISSUE    - https://github.com/sorich87/bootstrap-tour/issues/189
    //         // FIX      - https://github.com/sorich87/bootstrap-tour/issues/189#issuecomment-49007822

    //         // You have to write your used animated effect class
    //         // Standard animated class
    //         $('.animated').removeClass('fadeIn');
    //         // Animate class from animate-panel plugin
    //         $('.animated-panel').removeClass('zoomIn');

    //     },

    //     steps: [
    //         {
    //             element: ".tour-1",
    //             title: "Search Bar",
    //             content: "Here you can search for your favorite items. Note that this function is governed by the Category Filter.",
    //             placement: "bottom",
    //             backdrop: false
    //         },
    //         {
    //             element: ".tour-2",
    //             title: "Product Cards",
    //             content: "These are the products that you can pick from. This is the default layout you will see once the page has loaded. After a filter or search has been placed, these items will change accordingly to the searched results!",
    //             placement: "bottom",
    //         },
    //         {
    //             element: ".tour-3",
    //             title: "Enter Amount",
    //             content: "An numerical amount may be entered in this field.",
    //             placement: "bottom",
    //             backdrop: false
    //         },
    //         {
    //             element: ".tour-4",
    //             title: "Add to Shopping Cart",
    //             content: "Clicking this button will add the item with the amount entered to your shopping cart.",
    //             placement: "bottom",
    //             backdrop: false
    //         },
    //         {
    //             element: ".tour-5",
    //             title: "Category Filter",
    //             content: "Clicking this will allow you to select which category you wish to shop from. This is the primary search key. The search bar on the top of the page will search based of what you have selected here. If non were selected, the search bar will search for all items similar.",
    //             placement: "left"

    //         },
    //         {
    //             element: ".tour-6",
    //             title: "My Cart",
    //             content: "This is where you can view your shopping cart.",
    //             placement: "left"

    //         },
    //         {
    //             element: ".tour-7",
    //             title: "Submit Order",
    //             content: "Clicking this will submit your order. Prior to this, the system will ask the user to accept the terms of agreements outlined by Springbank Delivery.",
    //             placement: "left"

    //         }
    //     ]           
    
    // });

    // // Initialize the tour
    // tour.init();
    // tour.start();
    // // Restart the tour
    // $('.run-tour').click(function(){
    //     tour.restart();
    // });
});
