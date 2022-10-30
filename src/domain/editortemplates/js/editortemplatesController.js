leantime.editortemplatesController = (function () {

    var initModals = function () {
        _initModals();
    };
    var _initModals = function () {
        var modalConfig = {
            sizes: {
                minW: 400,
                minH: 350
            },
            resizable: true,
            autoSizable: true,
            callbacks: {
                afterShowCont: function () {
                    jQuery(".formModal").nyroModal(modalConfig);
                },
                beforeClose: function () {
                    location.reload();
                }


            },
            titleFromIframe: true
        };
        jQuery(".editortemplateModal").nyroModal(modalConfig);
    };

    //Constructor
    (function () {
        jQuery(document).ready(
            function () {

                _initModals();
            }
        );

    })();


    // Make public what you want to have public, everything else is private
    return {
        initModals: initModals,
    };
})();
