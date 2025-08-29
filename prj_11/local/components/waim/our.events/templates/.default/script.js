BX.ready(function () {
    BX.addCustomEvent('onAjaxSuccess', function () {
        let event = new Event("load");
        window.dispatchEvent(event);
    });
});
