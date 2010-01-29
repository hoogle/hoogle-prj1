YUI().use('node-menunav', function (Y) {
    Y.on('contentready', function () {
        var el = this;
        el.plug(Y.Plugin.NodeMenuNav, {});
    }, '#navigation');
});
